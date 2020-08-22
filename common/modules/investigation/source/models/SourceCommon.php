<?php

namespace nad\common\modules\investigation\source\models;

use Yii;
use nad\common\helpers\Utility;
use core\behaviors\PreventDeleteBehavior;
use nad\office\modules\expert\models\Expert;
use extensions\i18n\validators\JalaliDateToTimestamp;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\investigation\proposal\models\Proposal;
use nad\common\modules\investigation\proposal\models\ProposalCommon;
use nad\common\modules\investigation\common\behaviors\CommentBehavior;
use nad\common\modules\investigation\source\behaviors\ExpertsBehavior;
use nad\common\modules\investigation\common\behaviors\TaggableBehavior;
// use nad\common\modules\investigation\source\behaviors\ReasonsBehavior;
use nad\common\modules\investigation\common\models\BaseInvestigationModel;
use nad\common\modules\investigation\source\behaviors\NotificationBehavior;
use nad\common\modules\investigation\common\behaviors\CodeNumeratorBehavior;

class SourceCommon extends BaseInvestigationModel
{
    const USER_HOLDER_MANAGER = 0;
    const USER_HOLDER_EXPERT = 1;

    const STATUS_WAITING_FOR_CHECK_BY_MANAGER = 30; // I chose 30 to make sure no conflict would happen with prev status codes. It could be less though.
    const STATUS_WAITING_FOR_SESSION_DATE = 31;
    const STATUS_WAITING_FOR_SESSION_RESULT = 32;
    const STATUS_WAITING_FOR_NEXT_STATUS = 33;
    const STATUS_WAITING_FOR_CORRECTION_BY_EXPERT = 34;
    const STATUS_WAITING_FOR_SEND_TO_WRITE_PROPOSAL = -1;
    const STATUS_IN_NEXT_STEP_ONE_PROPOSAL = -2;
    const STATUS_IN_NEXT_STEP_MORE_PROPOSALS = -3;

    public $moduleId = 'source';
    public $ownerClassName = __NAMESPACE__ . '\Source';

    const EVENT_SET_EXPERTS = 'set-experts';
    const EVENT_DELIVERD_TO_MANAGER = 'deliverd-to-manager';
    const EVENT_DELIVERD_TO_EXPERT = 'deliverd-to-expert';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'experts' => ExpertsBehavior::class,
                'tags' => [
                    'class' => TaggableBehavior::class,
                    'moduleId' => $this->moduleId,
                    'customOwner' => $this->ownerClassName
                ],
                'comments' => [
                    'class' => CommentBehavior::class,
                    'moduleId' => $this->moduleId,
                    'customOwner' => $this->ownerClassName
                ],
                'codeNumerator' => [
                    'class' => CodeNumeratorBehavior::class,
                    'determinativeColumn' => 'categoryId',
                    'tableName' => $this->tableName(),
                    // 'condition' => 'consumer = :consumer',
                    // 'conditionParams' => [':consumer' => static::CONSUMER_CODE]
                ],
                [
                    'class' => PreventDeleteBehavior::class,
                    'relations' => [
                        [
                            'relationMethod' => 'getProposals',
                            'relationName' => 'پروپوزال'
                        ]
                    ]
                ],
                'notification' => NotificationBehavior::class
            ]
        );
    }

    public function rules()
    {
        return [
            [['title', 'englishTitle'], 'trim'],
            [
                [
                    'title',
                    'createdAt',
                    'reasonForGenesis',
                    'necessity',
                    'mainReasonId',
                    'categoryId'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            ['proceedings', 'required', 'on' => self::SCENARIO_WRITE_PROCEEDINGS],
            ['negotiationResult', 'required', 'on' => self::SCENARIO_WRITE_NEGOTIATION_RESULT],
            ['experts', 'required', 'on' => self::SCENARIO_SET_EXPERT],
            [['title', 'englishTitle'], 'string', 'max' => 255],
            [['reasonForGenesis', 'necessity', 'description', 'proceedings', 'negotiationResult'], 'string'],
            [['tags', 'references'], 'safe'],
            ['englishTitle', 'default', 'value' => null],
            [
                'createdAt',
                JalaliDateToTimestamp::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
            ],
            [
                'sessionDate',
                JalaliDateToTimestamp::class,
                'hourAttr' => 'sessionHourAttribute',
                'minuteAttr' => 'sessionMinuteAttribute',
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
            ],
            [
                ['title', 'reasonForGenesis', 'necessity', 'description', 'proceedings', 'negotiationResult'],
                FarsiCharactersValidator::class
            ],
            [
                'title',
                'unique',
                'targetAttribute' => ['title', 'categoryId'],
                'message' => 'ترکیب عنوان و رده تکراری است'
            ],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SET_EXPERT] = ['experts'];
        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'englishTitle' => 'عنوان انگلیسی',
            'createdAt' => 'تاریخ درج',
            'reasonForGenesis' => 'بیان مساله',
            'necessity' => 'سابقه پیدایش',
            'description' => 'توضیحات',
            'mainReasonId' => 'علت طرح موضوع',
            'categoryId' => 'رده',
            'references' => 'منابع',
            'tags' => 'کلید واژه‌ها',
            'status' => 'وضعیت',
            'userHolder' => 'نزد',
            'createdBy' => 'کارشناس',
            'updatedAt' => 'آخرین بروزرسانی',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه جلسه',
            'negotiationResult' => 'نتیجه مذاکره',
            'uniqueCode' => 'شناسه',
            'experts' => 'کارشناسان نگارش پروپوزال'
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            $this->consumer = static::CONSUMER_CODE;

            if(Yii::$app->user->can('superuser')){
                $this->userHolder = self::USER_HOLDER_MANAGER;
            }else{
                $this->userHolder = self::USER_HOLDER_EXPERT;
            }
        }

        $this->setUniqueCode();
        return true;
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->category->uniqueCode . '.' .
            $this->numberPartOfUniqueCode;
        // $this->uniqueCode = static::CONSUMER_CODE . '.' . $this->mainReason->code .
            // '.' . $this->numberPartOfUniqueCode;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (
            isset($changedAttributes['status']) &&
            $changedAttributes['status'] == self::STATUS_ACCEPTED &&
            $this->status == self::STATUS_IN_NEXT_STEP
        ) {
            $this->trigger(self::EVENT_SET_EXPERTS);
        }elseif(
            isset($changedAttributes['userHolder']) &&
            $changedAttributes['userHolder'] == self::USER_HOLDER_EXPERT &&
            $this->userHolder == self::USER_HOLDER_MANAGER
        ){
            $this->trigger(self::EVENT_DELIVERD_TO_MANAGER);
        }elseif(
            isset($changedAttributes['userHolder']) &&
            $changedAttributes['userHolder'] == self::USER_HOLDER_MANAGER &&
            $this->userHolder == self::USER_HOLDER_EXPERT
        ){
            $this->trigger(self::EVENT_DELIVERD_TO_EXPERT);
        }

        parent::afterSave($insert, $changedAttributes);
    }

    public function getMainReason()
    {
        return $this->hasOne(SourceReason::class, ['id' => 'mainReasonId']);
    }

    public function getMainReasonAsString()
    {
        if (!isset($this->mainReason)) {
            return null;
        }
        return $this->mainReason->title;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }

    public function getExpertsQuery()
    {
        return $this->hasMany(Expert::class, ['id' => 'expertId'])
            ->viaTable('nad_investigation_source_expert_relation', ['sourceId' => 'id']);
    }

    public function getProposals()
    {
        return $this->hasMany(ProposalCommon::class, ['sourceId' => 'id']);
    }

    // TODO this function is NOT used anymore. Remove asap.
    public function canUserCreateProposal()
    {
        if ($this->status == self::STATUS_IN_NEXT_STEP) {
            if (Yii::$app->user->can('superuser')) {
                return true;
            }
            return $this->hasExperts(Expert::findOne([
                'userId' => Yii::$app->user->id
            ])->id);
        }
        return false;
    }

    public static function tableName()
    {
        return 'nad_investigation_source';
    }

    // TODO remove unused statuses asap
    public static function getStatusLables()
    {
        return [
            // self::STATUS_IN_MANAGER_HAND => 'نزد مدیر', // not used
            // self::STATUS_WAITING_FOR_SESSION => 'نوبت جلسه', // not used
            // self::STATUS_WAIT_FOR_NEGOTIATION => 'نوبت مذاکره', // not used
            self::STATUS_INPROGRESS => 'در دست نگارش',
            self::STATUS_WAIT_FOR_CONVERSATION => 'تبادل نظر',
            self::STATUS_WAITING_FOR_CHECK_BY_MANAGER => 'منتظر بررسی توسط مدیر',
            self::STATUS_WAITING_FOR_SESSION_DATE => 'منتظر تعیین زمان جلسه',
            self::STATUS_WAITING_FOR_SESSION_RESULT => 'منتظر جلسه و ثبت نتیجه',
            // self::STATUS_NEED_CORRECTION => 'منتظر ارسال به کارشناس جهت اصلاح',
            self::STATUS_WAITING_FOR_CORRECTION_BY_EXPERT => 'نزد کارشناس جهت اصلاح',
            self::STATUS_ACCEPTED => 'منتظر تعیین کارشناس',
            self::STATUS_WAITING_FOR_SEND_TO_WRITE_PROPOSAL => 'منتظر ارسال جهت نگارش پروپوزال',
            self::STATUS_IN_NEXT_STEP_ONE_PROPOSAL => 'منتظر نگارش پروپوزال اول',
            self::STATUS_IN_NEXT_STEP_MORE_PROPOSALS => 'منتظر نگارش پروپوزال دوم/سوم/...',
            // self::STATUS_IN_NEXT_STEP => 'منتظر نگارش پروپوزال اول/دوم/...', // don't remove it, it IS used.
            self::STATUS_WAITING_FOR_NEXT_STATUS => 'منتظر تعیین وضعیت',
            self::STATUS_LOCKED => 'قفل شده',
            self::STATUS_REJECTED => 'رد',
        ];
    }

    public function getStatusLabel(){
        if($this->status == self::STATUS_ACCEPTED && $this->hasAnyExpert()){
            return 'منتظر ارسال جهت نگارش پروپوزال';
        } elseif ($this->status == self::STATUS_IN_NEXT_STEP) {
            $proposalsCount = isset($this->proposals) ? $this->getProposals()->count(): 0;
            $label = 'منتظر نگارش پروپوزال ';

            switch ($proposalsCount + 1) {
                case 1:
                    $label .= 'اول';
                    break;
                case 2:
                    $label .= 'دوم';
                    break;
                case 3:
                    $label .= 'سوم';
                    break;
                case 4:
                    $label .= 'چهارم';
                    break;
                case 5:
                    $label .= 'پنجم';
                    break;
                default:
                    $label .= Utility::convertNumberToPersianWords($proposalsCount + 1);
                    break;
            }

            if($proposalsCount > 0)
                $label .= '/بایگانی';

            return $label;
        }

        return self::getStatusLables()[$this->status];
    }

    public static function getUserHolderLables()
    {
        return [
            self::USER_HOLDER_MANAGER => 'مدیر',
            self::USER_HOLDER_EXPERT => 'کارشناس'
        ];
    }

    public function changeStatus($newStatus)
    {
        if($newStatus == self::STATUS_IN_NEXT_STEP && $this->status != self::STATUS_LOCKED)
            $this->userHolder = self::USER_HOLDER_EXPERT;
        else if($newStatus == self::STATUS_WAITING_FOR_SESSION_DATE){
            $this->proceedings = null;
            $this->sessionDate = null;
        }
        else if($newStatus == self::STATUS_IN_MANAGER_HAND)
            $this->userHolder = self::USER_HOLDER_MANAGER;

        $this->status = $newStatus;

        $this->save();
    }

    public function changeArchive($newStatus)
    {
        $this->isArchived = $newStatus;
        $this->save(false);
    }

    // TODO move all "can" functions to "BaseInvestigationModel" class if other classes need them.
    public function canUserUpdateOrDelete()
    {
        if ($this->status != self::STATUS_LOCKED && $this->status != self::STATUS_REJECTED && Yii::$app->user->can('superuser')) {
            return true;
        }
        if ($this->userHolder == self::USER_HOLDER_EXPERT &&
            (
                $this->status == self::STATUS_WAITING_FOR_CORRECTION_BY_EXPERT ||
                $this->status == self::STATUS_INPROGRESS
            )
        ) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                ['investigation' => $this]
            );
        }
        return false;
    }

    public function canUserDeliverToManager()
    {
        if (
            $this->status != self::STATUS_IN_NEXT_STEP &&
            $this->status != self::STATUS_REJECTED &&
            $this->status != self::STATUS_LOCKED &&
            $this->userHolder != self::USER_HOLDER_MANAGER &&
            (
                $this->userHolder == self::USER_HOLDER_EXPERT
                ||
                (
                    Yii::$app->user->can('superuser')
                    &&
                    (
                        $this->status == self::STATUS_INPROGRESS ||
                        $this->status = self::STATUS_WAITING_FOR_CORRECTION_BY_EXPERT
                    )
                )
            )
        ) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                ['investigation' => $this]
            );

        }
        return false;
    }

    public function canManagerDeliverToExpert(){
        return Yii::$app->user->can('superuser') &&  (
            $this->status == self::STATUS_NEED_CORRECTION
            ||
            $this->status == self::STATUS_WAITING_FOR_NEXT_STATUS
            ||
            ($this->status == self::STATUS_WAIT_FOR_CONVERSATION && $this->comments)
        ) && $this->userHolder == self::USER_HOLDER_MANAGER;
    }

    public function canSetWaitForSession(){
        return ($this->status != self::STATUS_REJECTED && $this->userHolder == Source::USER_HOLDER_MANAGER &&
        Yii::$app->user->can('superuser') &&
        $this->status != self::STATUS_ACCEPTED &&
        $this->status != self::STATUS_NEED_CORRECTION &&
        $this->status != self::STATUS_WAITING_FOR_SESSION_DATE &&
        $this->status != self::STATUS_WAITING_FOR_SESSION_RESULT &&
        // $this->status != Source::STATUS_WAITING_FOR_SESSION && // commented so user can set multiple sessions
        $this->status != self::STATUS_IN_NEXT_STEP && !($this->status == self::STATUS_WAIT_FOR_CONVERSATION && !$this->comments) && $this->status != self::STATUS_LOCKED);
    }

    public function canSetSessionDate()
    {
        return Yii::$app->user->can('superuser') && $this->status != self::STATUS_REJECTED && $this->status != self::STATUS_IN_NEXT_STEP && $this->status != self::STATUS_LOCKED && (($this->sessionDate == null && $this->status == self::STATUS_WAITING_FOR_SESSION_DATE) || ($this->sessionDate != null && $this->status == self::STATUS_WAITING_FOR_SESSION_RESULT));
    }

    public function canWriteProceedings()
    {
        return Yii::$app->user->can('superuser') && $this->status != self::STATUS_REJECTED &&
        $this->status != self::STATUS_IN_NEXT_STEP && $this->status != self::STATUS_LOCKED &&
            $this->sessionDate != null &&
            ($this->proceedings == null && $this->status == self::STATUS_WAITING_FOR_SESSION_RESULT);
    }

    public function canStartConverstation()
    {
        if ($this->status != self::STATUS_ACCEPTED && $this->status != self::STATUS_REJECTED && $this->userHolder == self::USER_HOLDER_MANAGER && Yii::$app->user->can('superuser') && $this->status != self::STATUS_WAIT_FOR_CONVERSATION &&
        $this->status != self::STATUS_NEED_CORRECTION &&
        $this->status != self::STATUS_IN_NEXT_STEP && $this->status != self::STATUS_LOCKED && (($this->status != self::STATUS_WAITING_FOR_SESSION_DATE) && ($this->status != self::STATUS_WAITING_FOR_SESSION_RESULT))) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                ['investigation' => $this]
            );
        }
        return false;
    }

    public function canHaveConverstation()
    {
        if ($this->status != self::STATUS_ACCEPTED && $this->status != self::STATUS_REJECTED && $this->status == self::STATUS_WAIT_FOR_CONVERSATION && $this->status != self::STATUS_IN_NEXT_STEP && $this->status != self::STATUS_LOCKED && !($this->status == self::STATUS_WAITING_FOR_SESSION && !$this->proceedings)) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                ['investigation' => $this]
            );
        }
        return false;
    }

    // TODO This function is not used anymore, remove asap
    public function canSetForCorrection()
    {
        if(Yii::$app->user->can('superuser') &&
         (
            $this->status == self::STATUS_WAITING_FOR_NEXT_STATUS
            ||
            ($this->status == self::STATUS_WAIT_FOR_CONVERSATION && $this->comments)
         )
        ) {
            return true;
        }

        return false;
    }

    public function canAcceptOrReject()
    {
        if (Yii::$app->user->can('superuser')) {
            if (
                $this->status == self::STATUS_WAITING_FOR_NEXT_STATUS // This is for session flow
            ) {
                return true;
            } elseif (
                $this->status == self::STATUS_WAIT_FOR_CONVERSATION &&
                $this->comments
            ) {
                return true;
            } elseif(
                $this->status == self::STATUS_WAITING_FOR_CHECK_BY_MANAGER
            ){
                return true;
            }
        }

        return false;
    }

    public function canSendToWriteProposal(){
        return ($this->status == self::STATUS_ACCEPTED && $this->hasAnyExpert() && Yii::$app->user->can('superuser'));
    }

    public function canSetExpert(){
        return (Yii::$app->user->can('superuser') && ($this->status == self::STATUS_ACCEPTED || $this->status == self::STATUS_IN_NEXT_STEP));
    }

    /**
     * User can NOT create any new proposal for a locked source.
     *
     * @return boolean
     */
    public function canLock(){
        return $this->status != self::STATUS_REJECTED && $this->status != self::STATUS_LOCKED;
    }

    /**
     * User can NOT create any new proposal for a locked source.
     *
     * @return boolean
     */
    public function canUnlock(){
        return $this->status != self::STATUS_REJECTED && $this->status == self::STATUS_LOCKED;
    }
}
