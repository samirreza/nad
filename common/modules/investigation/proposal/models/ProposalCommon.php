<?php

namespace nad\common\modules\investigation\proposal\models;

use Yii;
use yii\helpers\ArrayHelper;
use core\behaviors\PreventDeleteBehavior;
use extensions\file\behaviors\FileBehavior;
use nad\office\modules\expert\models\Expert;
use extensions\i18n\validators\JalaliDateToTimestamp;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\investigation\report\models\Report;
use nad\common\modules\investigation\source\models\Source;
use nad\common\modules\investigation\source\models\SourceArchived;
use nad\common\modules\investigation\common\behaviors\CommentBehavior;
use nad\common\modules\investigation\common\behaviors\TaggableBehavior;
use nad\common\modules\investigation\proposal\behaviors\PartnersBehavior;
use nad\common\modules\investigation\common\models\BaseInvestigationModel;
use nad\common\modules\investigation\proposal\behaviors\NotificationBehavior;
use nad\common\modules\investigation\common\behaviors\CodeNumeratorBehavior;

class ProposalCommon extends BaseInvestigationModel
{
    // TODO remove lastCodeNumber from table asap

    // check BaseInvestigationModel to make sure you don't use same status codes
    // const STATUS_IN_NEXT_STEP = 9; this one is for "report step" & is defined in BaseInvestigationModel
    const STATUS_IN_NEXT_STEP_FOR_METHOD = 10;
    const STATUS_IN_NEXT_STEP_FOR_INSTRUCTION = 11;
    const STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD = 12;
    const STATUS_IN_NEXT_STEP_FOR_REPORT_INSTRUCTION = 13;
    const STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION = 14;
    const STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION = 15;

    const USER_HOLDER_MANAGER = 0;
    const USER_HOLDER_EXPERT = 1;

    public $moduleId = 'proposal';
    public $ownerClassName = __NAMESPACE__ . '\Proposal';

    const EVENT_SET_EXPERT = 'set-expert';
    const EVENT_DELIVERD_TO_MANAGER = 'deliverd-to-manager';
    const EVENT_DELIVERD_TO_EXPERT = 'deliverd-to-expert';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
                    'determinativeColumn' => 'categoryId'
                ],
                'partners' => PartnersBehavior::class,
                [
                    'class' => PreventDeleteBehavior::class,
                    'relations' => [
                        [
                            'relationMethod' => 'getReport',
                            'relationName' => 'گزارش'
                        ]
                    ]
                ],
                [
                    'class' => FileBehavior::class,
                    'groups' => [
                        'file' => [
                            'type' => FileBehavior::TYPE_FILE,
                            'rules' => [
                                'extensions' => [
                                    'png',
                                    'jpg',
                                    'jpeg',
                                    'pdf',
                                    'doc',
                                    'docx',
                                    'xls',
                                    'xlsx',
                                    'ppt',
                                    'pptx',
                                    'zip'
                                ],
                                'maxSize' => 100 * 1024 * 1024
                            ]
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
                    // 'methodDesc',
                    'categoryId',
                    'sourceId',
                    'tags'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            ['proceedings', 'required', 'on' => self::SCENARIO_WRITE_PROCEEDINGS],
            ['negotiationResult', 'required', 'on' => self::SCENARIO_WRITE_NEGOTIATION_RESULT],
            ['reportExpertId', 'required', 'on' => self::SCENARIO_SET_EXPERT],
            [['title', 'englishTitle'], 'string', 'max' => 255],
            [['reasonForGenesis', 'necessity', 'description', 'proceedings', 'negotiationResult', 'methodDesc', 'estimatedCost'], 'string'],
            ['englishTitle', 'default', 'value' => null],
            [['partners', 'references'], 'safe'],
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
                ['title', 'reasonForGenesis', 'necessity', 'description', 'proceedings', 'negotiationResult', 'methodDesc', 'estimatedCost'],
                FarsiCharactersValidator::class
            ],
            ['tags', 'validateTagsCount', 'skipOnEmpty' => true]
        ];
    }

    public function validateTagsCount($model, $attribute)
    {
        if (count($this->tags) < 3) {
            $this->addError(
                'tags',
                'تعداد کلید واژه‌ها باید حداقل ۳ عدد باشد.'
            );
        }
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SET_EXPERT] = ['reportExpertId'];
        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'englishTitle' => 'عنوان انگلیسی',
            'createdAt' => 'تاریخ درج',
            'reasonForGenesis' => 'تعریف مسئله',
            'necessity' => 'هدف و ضرورت اجرا',
            'methodDesc' => 'روش کار',
            'estimatedCost' => 'براورد هزینه اجرا پروژه',
            'description' => 'توضیحات',
            'partners' => 'همکاران',
            'references' => 'منابع',
            'tags' => 'کلید واژه‌ها',
            'status' => 'وضعیت',
            'createdBy' => 'کارشناس',
            'updatedAt' => 'آخرین بروزرسانی',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه جلسه',
            'negotiationResult' => 'نتیجه مذاکره',
            'uniqueCode' => 'شناسه',
            'sourceId' => 'منشا',
            'reportExpertId' => 'کارشناس نگارش گزارش/روش/دستورالعمل',
            'categoryId' => 'رده',
            'userHolder' => 'نزد'
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

    public function afterSave($insert, $changedAttributes)
    {
        if (
            isset($changedAttributes['status']) &&
            ($changedAttributes['status'] == self::STATUS_ACCEPTED || self::isInAnyOfNextSteps($this->status)) &&
            self::isInAnyOfNextSteps($this->status)
        ) {
            $this->trigger(self::EVENT_SET_EXPERT);
        }elseif(
            isset($changedAttributes['userHolder']) &&
            $changedAttributes['userHolder'] == self::USER_HOLDER_EXPERT &&
            $this->userHolder == self::USER_HOLDER_MANAGER // USER_HOLDER_MANAGER: just to overwrite old records
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

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->category->uniqueCode . '.' .
            $this->numberPartOfUniqueCode;
        // $this->uniqueCode = static::CONSUMER_CODE . '.' .
        //     str_pad(
        //         static::find()->andWhere(['<', 'id', $this->id])->count() + 1,
        //         3,
        //         '0',
        //         STR_PAD_LEFT
        //     ) . '.' .
        //     $this->lastCodeNumber;
    }

    public function getPartnersQuery()
    {
        return $this->hasMany(Expert::class, ['id' => 'expertId'])
            ->viaTable('nad_investigation_proposal_partner_relation', ['proposalId' => 'id']);
    }

    public function getSource()
    {
        // TODO Rewrite with ActiveRecord::exists()
        $source = Source::findOne($this->sourceId);
        if(isset($source))
            return $this->hasOne(Source::class, ['id' => 'sourceId']);
        else
            return $this->hasOne(SourceArchived::class, ['id' => 'sourceId']);
    }

    public function getSourceAsString()
    {
        if(!isset($this->source)){
            return null;
        }
        return $this->source->title;
    }

    public function getReport()
    {
        return $this->hasOne(Report::class, ['proposalId' => 'id']);
    }

    public function getReportAsString()
    {
        if (!isset($this->Report)) {
            return null;
        }
        return $this->Report->title;
    }

    public function getReportExpert()
    {
        return $this->hasOne(Expert::class, ['id' => 'reportExpertId']);
    }

    public function getReportExpertAsString()
    {
        if (!isset($this->reportExpert)) {
            return null;
        }
        return $this->reportExpert->user->fullName;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }

    public function getExpertSourcesForDropdown($sourceConsumerCode){
        $expertSources = [];
        if (Yii::$app->user->can('superuser')) {
            $expertSources = Source::find()
                            ->andWhere([
                                'status' => Source::STATUS_IN_NEXT_STEP,
                                'consumer' => $sourceConsumerCode
                                ])
                            ->all();
        }else{
            $expertSources = Source::find()
                        ->alias('src')
                        ->innerJoinWith('expertsQuery exp')
                        ->andWhere([
                            'src.status' => Source::STATUS_IN_NEXT_STEP,
                            'exp.id' => Yii::$app->user->identity->expert->id,
                            'src.consumer' => $sourceConsumerCode
                            ])
                        ->all();
        }

        return ArrayHelper::map($expertSources, 'id', 'title');
    }

    // TODO this function is NOT used anymore. Remove asap.
    public function canUserCreateReport()
    {
        if ($this->status == self::STATUS_IN_NEXT_STEP) {
            if (Yii::$app->user->can('superuser')) {
                return true;
            }
            return $this->reportExpertId == Expert::findOne([
                'userId' => Yii::$app->user->id
            ])->id;
        }
        return false;
    }

    public static function tableName()
    {
        return 'nad_investigation_proposal';
    }

    public static function getStatusLables()
    {
        return [
            self::STATUS_INPROGRESS => 'در دست تهیه',
            self::STATUS_IN_MANAGER_HAND => 'نزد مدیر',
            self::STATUS_WAITING_FOR_SESSION => 'نوبت جلسه',
            self::STATUS_WAIT_FOR_NEGOTIATION => 'نوبت مذاکره',
            self::STATUS_WAIT_FOR_CONVERSATION => 'تبادل نظر',
            self::STATUS_NEED_CORRECTION => 'نیازمند اصلاح',
            // self::STATUS_REJECTED => 'رد', // we don't have "reject" in proposal
            self::STATUS_ACCEPTED => 'منتظر تعیین کارشناس',
            self::STATUS_IN_NEXT_STEP => 'منتظر گزارش جدید',
            self::STATUS_IN_NEXT_STEP_FOR_METHOD => 'منتظر روش جدید',
            self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION => 'منتظر دستورالعمل جدید',
            self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD => 'منتظر گزارش و روش جدید',
            self::STATUS_IN_NEXT_STEP_FOR_REPORT_INSTRUCTION => 'منتظر گزارش و دستورالعمل جدید',
            self::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION => 'منتظر روش و دستورالعمل جدید',
            self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION => 'منتظر گزارش، روش و دستورالعمل جدید',
            self::STATUS_LOCKED => 'در انتظار بایگانی (قفل شده)',
        ];
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
        if(self::isInAnyOfNextSteps($newStatus) && $this->status != self::STATUS_LOCKED)
            $this->userHolder = self::USER_HOLDER_EXPERT;
        else if($newStatus == self::STATUS_WAITING_FOR_SESSION){
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
        if ($this->status != self::STATUS_REJECTED && Yii::$app->user->can('superuser')) {
            return true;
        }
        if ($this->status != self::STATUS_REJECTED &&
            $this->userHolder == self::USER_HOLDER_EXPERT &&
            (
                $this->status == self::STATUS_NEED_CORRECTION ||
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
        if (!self::isInAnyOfNextSteps($this->status) && $this->status != self::STATUS_REJECTED && $this->userHolder != self::USER_HOLDER_MANAGER && ($this->userHolder == self::USER_HOLDER_EXPERT || Yii::$app->user->can('superuser'))) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                ['investigation' => $this]
            );

        }
        return false;
    }

    public function canManagerDeliverToExpert(){
        return $this->status != self::STATUS_REJECTED && $this->canAcceptOrRejectOrSendForCorrection() && $this->userHolder != self::USER_HOLDER_EXPERT;
    }

    public function canSetWaitForSession(){
        return ($this->status != self::STATUS_REJECTED && $this->userHolder == Proposal::USER_HOLDER_MANAGER &&
        Yii::$app->user->can('superuser') &&
        $this->status != self::STATUS_ACCEPTED
        // && $this->status != Proposal::STATUS_WAITING_FOR_SESSION // commented so user can set multiple sessions
        && !self::isInAnyOfNextSteps($this->status) && !($this->status == self::STATUS_WAIT_FOR_CONVERSATION && !$this->comments) && $this->status != self::STATUS_LOCKED);
    }

    public function canSetSessionDate()
    {
        return Yii::$app->user->can('superuser') && $this->status != self::STATUS_REJECTED && !self::isInAnyOfNextSteps($this->status) && $this->status != self::STATUS_LOCKED && (($this->sessionDate == null && $this->status == self::STATUS_WAITING_FOR_SESSION) || $this->sessionDate != null);
    }

    public function canWriteProceedings()
    {
        return Yii::$app->user->can('superuser') && $this->status != self::STATUS_REJECTED &&
        !self::isInAnyOfNextSteps($this->status) && $this->status != self::STATUS_LOCKED &&
        $this->status != self::STATUS_ACCEPTED &&
            $this->sessionDate != null &&
            (($this->proceedings == null && $this->status == self::STATUS_WAITING_FOR_SESSION) || $this->proceedings != null);
    }

    public function canStartConverstation()
    {
        if ($this->status != self::STATUS_ACCEPTED &&
        $this->status != self::STATUS_REJECTED && $this->userHolder == self::USER_HOLDER_MANAGER && Yii::$app->user->can('superuser') && $this->status != self::STATUS_WAIT_FOR_CONVERSATION && !self::isInAnyOfNextSteps($this->status) && $this->status != self::STATUS_LOCKED && (($this->status != self::STATUS_WAITING_FOR_SESSION) || ($this->status == self::STATUS_WAITING_FOR_SESSION && $this->proceedings))) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                ['investigation' => $this]
            );
        }
        return false;
    }

    public function canHaveConverstation()
    {
        if ($this->status != self::STATUS_ACCEPTED && $this->status != self::STATUS_REJECTED && $this->status == self::STATUS_WAIT_FOR_CONVERSATION && !self::isInAnyOfNextSteps($this->status) && $this->status != self::STATUS_LOCKED && !($this->status == self::STATUS_WAITING_FOR_SESSION && !$this->proceedings)) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                ['investigation' => $this]
            );
        }
        return false;
    }

    public function canSetForCorrection()
    {
        if($this->status != self::STATUS_ACCEPTED && $this->status != self::STATUS_REJECTED && $this->status != self::STATUS_NEED_CORRECTION && Yii::$app->user->can('superuser')){
            if (
                $this->status == self::STATUS_INPROGRESS
                ||
                $this->status == self::STATUS_ACCEPTED
                ||
                (
                    $this->status == self::STATUS_WAITING_FOR_SESSION &&
                    $this->proceedings
                )
                ||
                (
                    $this->status == self::STATUS_WAIT_FOR_CONVERSATION &&
                    $this->comments
                )
            ) {
                return true;
            }
        }

        return false;
    }

    public function canAcceptOrRejectOrSendForCorrection()
    {
        if (Yii::$app->user->can('superuser')) {
            if ($this->status == self::STATUS_INPROGRESS) {
                return true;
            } elseif ($this->status == self::STATUS_NEED_CORRECTION) {
                return true;
            } elseif (
                $this->status == self::STATUS_WAITING_FOR_SESSION &&
                $this->proceedings
            ) {
                return true;
            } elseif (
                $this->status == self::STATUS_WAIT_FOR_NEGOTIATION &&
                $this->negotiationResult
            ) {
                return true;
            } elseif (
                $this->status == self::STATUS_WAIT_FOR_CONVERSATION &&
                $this->comments
            ) {
                return true;
            }
        }

        return false;
    }

    public function canSendToWriteReport(){
        return ($this->status != self::STATUS_REJECTED && ($this->status == self::STATUS_ACCEPTED || self::isInAnyOfNextSteps($this->status)) && $this->reportExpertId != null && Yii::$app->user->can('superuser') &&
        ($this->status != self::STATUS_IN_NEXT_STEP && $this->status != self::STATUS_IN_NEXT_STEP_FOR_REPORT_INSTRUCTION && $this->status != self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD && $this->status != self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION)
        );
    }

    public function canSendToWriteMethod(){
        return ($this->status != self::STATUS_REJECTED && ($this->status == self::STATUS_ACCEPTED || self::isInAnyOfNextSteps($this->status)) && $this->reportExpertId != null && Yii::$app->user->can('superuser') &&
        ($this->status != self::STATUS_IN_NEXT_STEP_FOR_METHOD && $this->status != self::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION && $this->status != self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD && $this->status != self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION)
        );
    }

    public function canSendToWriteInstruction(){
        return ($this->status != self::STATUS_REJECTED && ($this->status == self::STATUS_ACCEPTED || self::isInAnyOfNextSteps($this->status)) && $this->reportExpertId != null && Yii::$app->user->can('superuser') &&
        ($this->status != self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION && $this->status != self::STATUS_IN_NEXT_STEP_FOR_REPORT_INSTRUCTION && $this->status != self::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION && $this->status != self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION)
        );
    }

    public function canSetExpert(){
        return (Yii::$app->user->can('superuser') && ($this->status == self::STATUS_ACCEPTED || self::isInAnyOfNextSteps($this->status)));
    }

    /**
     * User can NOT create any new report, method, instruction, ... for a locked proposal.
     *
     * @return boolean
     */
    public function canLock(){
        return self::isInAnyOfNextSteps($this->status);
    }

    /**
     * User can NOT create any new report, method, instruction, ... for a locked proposal.
     *
     * @return boolean
     */
    public function canUnlock(){
        return $this->status == self::STATUS_LOCKED;
    }

    public function getNextStepStatus($nextStepType){
        $nextStepStatusCode = null;
        switch ($nextStepType) {
            case self::STATUS_IN_NEXT_STEP : // for report
                if($this->status == self::STATUS_IN_NEXT_STEP_FOR_METHOD){
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD;
                }else if($this->status == self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION){
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_REPORT_INSTRUCTION;
                }else if($this->status == self::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION){
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION;
                }else{
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP;
                }
                break;
            case self::STATUS_IN_NEXT_STEP_FOR_METHOD :
                if($this->status == self::STATUS_IN_NEXT_STEP){
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD;
                }else if($this->status == self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION){
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION;
                }else if($this->status == self::STATUS_IN_NEXT_STEP_FOR_REPORT_INSTRUCTION){
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION;
                }else{
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_METHOD;
                }
                break;
            case self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION :
                if($this->status == self::STATUS_IN_NEXT_STEP){
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_REPORT_INSTRUCTION;
                }else if($this->status == self::STATUS_IN_NEXT_STEP_FOR_METHOD){
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION;
                }else if($this->status == self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD){
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION;
                }{
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION;
                }
                break;
            default:
                break;
        }

        return $nextStepStatusCode;
    }

    public static function isInAnyOfNextSteps($status){
        if(
            $status == self::STATUS_IN_NEXT_STEP ||
            $status == self::STATUS_IN_NEXT_STEP_FOR_METHOD ||
            $status == self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION ||
            $status == self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD ||
            $status == self::STATUS_IN_NEXT_STEP_FOR_REPORT_INSTRUCTION ||
            $status == self::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION ||
            $status == self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION
        ){
            return true;
        }

        return false;
    }
}
