<?php

namespace nad\common\modules\investigation\otherreport\models;

use Yii;
use yii\helpers\ArrayHelper;
use nad\common\helpers\Utility;
use core\behaviors\PreventDeleteBehavior;
use extensions\file\behaviors\FileBehavior;
use nad\office\modules\expert\models\Expert;
use extensions\i18n\validators\JalaliDateToTimestamp;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\extensions\graphGenerator\behaviors\GraphBehavior;
use nad\common\modules\investigation\otherreport\models\Otherreport;
use nad\common\modules\investigation\subject\models\Subject;
use nad\common\modules\investigation\subject\models\SubjectArchived;
use nad\common\modules\investigation\common\behaviors\CommentBehavior;
use nad\common\modules\investigation\source\behaviors\ExpertsBehavior;
use nad\common\modules\investigation\common\behaviors\TaggableBehavior;
use nad\common\modules\investigation\otherreport\behaviors\PartnersBehavior;
use nad\common\modules\investigation\common\models\BaseInvestigationModel;
use nad\common\modules\investigation\otherreport\behaviors\NotificationBehavior;
use nad\common\modules\investigation\common\behaviors\CodeNumeratorBehavior;

class OtherreportCommon extends BaseInvestigationModel
{
    // TODO remove lastCodeNumber from table asap

    // check BaseInvestigationModel to make sure you don't use same status codes
    // const STATUS_IN_NEXT_STEP = 8; this one is for "source step" & is defined in BaseInvestigationModel

    const STATUS_WAITING_FOR_CHECK_BY_MANAGER = 30; // I chose 30 to make sure no conflict would happen with prev status codes. It could be less though.
    const STATUS_WAITING_FOR_SESSION_DATE = 31;
    const STATUS_WAITING_FOR_SESSION_RESULT = 32;
    const STATUS_WAITING_FOR_NEXT_STATUS = 33;
    const STATUS_WAITING_FOR_CORRECTION_BY_EXPERT = 34;

    const USER_HOLDER_MANAGER = 0;
    const USER_HOLDER_EXPERT = 1;

    public $moduleId = 'otherreport';
    public $ownerClassName = __NAMESPACE__ . '\Otherreport';

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
                'partners' => PartnersBehavior::class,
                // [
                //     'class' => PreventDeleteBehavior::class,
                //     'relations' => [
                //         [
                //             'relationMethod' => '',
                //             'relationName' => ''
                //         ]
                //     ]
                // ],
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
                        ],
                        'otherreportDoc' => [
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
                    'subjectId',
                    'abstract',
                    'uniqueCode'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            ['proceedings', 'required', 'on' => self::SCENARIO_WRITE_PROCEEDINGS],
            ['negotiationResult', 'required', 'on' => self::SCENARIO_WRITE_NEGOTIATION_RESULT],
            [['title', 'englishTitle'], 'string', 'max' => 255],
            [['abstract', 'description', 'proceedings', 'negotiationResult'], 'string'],
            ['englishTitle', 'default', 'value' => null],
            [['partners', 'tags', 'references'], 'safe'],
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
                ['title', 'abstract', 'description', 'proceedings', 'negotiationResult'],
                FarsiCharactersValidator::class
            ],
            [
                'title',
                'unique',
                'targetAttribute' => ['title' , 'subjectId'],
                'message' => 'ترکیب عنوان و موضوع تکراری است'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'englishTitle' => 'عنوان انگلیسی',
            'createdAt' => 'تاریخ درج',
            'abstract' => 'چکیده',
            'description' => 'توضیحات',
            'references' => 'منابع',
            'partners' => 'همکاران',
            'tags' => 'کلید واژه‌ها',
            'status' => 'وضعیت',
            'createdBy' => 'کارشناس',
            'updatedAt' => 'آخرین بروزرسانی',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه جلسه',
            'negotiationResult' => 'نتیجه مذاکره',
            'uniqueCode' => 'شناسه',
            'subjectId' => 'موضوع',
            'userHolder' => 'نزد',
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
        $this->uniqueCode = $this->uniqueCode;
    }

    public function getPartnersQuery()
    {
        return $this->hasMany(Expert::class, ['id' => 'expertId'])
            ->viaTable('nad_investigation_otherreport_partner_relation', ['otherreportId' => 'id']);
    }

    public function getSubject()
    {
        // TODO Rewrite with ActiveRecord::exists()
        if (isset($this->subjectId)) {
            $subject = Subject::findOne($this->subjectId);
            if (isset($subject)) {
                return $this->hasOne(Subject::class, ['id' => 'subjectId']);
            } else {
                return $this->hasOne(SubjectArchived::class, ['id' => 'subjectId']);
            }
        }else{
            return null;
        }
    }

    public function getSubjectAsString()
    {
        if(!isset($this->subject)){
            return null;
        }
        return $this->subject->title;
    }

    public function getExpertSubjectsForDropdown($subjectConsumerCode){
        $expertSubjects = [];
        if (Yii::$app->user->can('superuser')) {
            $expertSubjects = Subject::find()
                            ->andWhere([
                                'in',
                                'status',
                                [
                                    Subject::STATUS_IN_NEXT_STEP, // only for otherreport
                                ]
                            ])->andWhere([
                                'consumer' => $subjectConsumerCode
                                ])
                            ->all();
        }else{
            $expertSubjects = Subject::find()
                        ->andWhere([
                            'in',
                            'status',
                            [
                                Subject::STATUS_IN_NEXT_STEP, // only for otherreport
                            ]
                        ])
                        ->andWhere([
                            'expertId' => Yii::$app->user->identity->expert->id,
                            'consumer' => $subjectConsumerCode
                            ])
                        ->all();
        }

        return ArrayHelper::map($expertSubjects, 'id', 'title');
    }

    public static function tableName()
    {
        return 'nad_investigation_otherreport';
    }

    public static function getStatusLables()
    {
        return [
            self::STATUS_INPROGRESS => 'در دست نگارش',
            self::STATUS_WAIT_FOR_CONVERSATION => 'تبادل نظر',
            self::STATUS_WAITING_FOR_CHECK_BY_MANAGER => 'منتظر بررسی توسط مدیر',
            self::STATUS_WAITING_FOR_SESSION_DATE => 'منتظر تعیین زمان جلسه',
            self::STATUS_WAITING_FOR_SESSION_RESULT => 'منتظر جلسه و ثبت نتیجه',
            self::STATUS_NEED_CORRECTION => 'منتظر ارسال به کارشناس جهت اصلاح',
            self::STATUS_WAITING_FOR_CORRECTION_BY_EXPERT => 'نزد کارشناس جهت اصلاح',
            self::STATUS_ACCEPTED => 'تایید شده',
            self::STATUS_LOCKED => 'قفل شده',
            self::STATUS_WAITING_FOR_NEXT_STATUS => 'منتظر تعیین وضعیت',
            self::STATUS_IN_NEXT_STEP => 'پایان',
        ];
    }

    public function getStatusLabel(){
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
        if(self::isInAnyOfNextSteps($newStatus) && $this->status != self::STATUS_LOCKED)
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
        if (!self::isInAnyOfNextSteps($this->status) &&
         $this->status != self::STATUS_REJECTED &&
         $this->status != self::STATUS_LOCKED &&
         $this->userHolder != self::USER_HOLDER_MANAGER &&
          (
              $this->userHolder == self::USER_HOLDER_EXPERT
               ||
               Yii::$app->user->can('superuser')
          )) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                ['investigation' => $this]
            );

        }
        return false;
    }

    public function canManagerDeliverToExpert(){
        return Yii::$app->user->can('superuser') && (
            $this->status == self::STATUS_NEED_CORRECTION
            ||
            $this->status == self::STATUS_WAITING_FOR_NEXT_STATUS
            ||
            ($this->status == self::STATUS_WAIT_FOR_CONVERSATION && $this->comments)
         ) && $this->userHolder == self::USER_HOLDER_MANAGER;
    }

    public function canSetWaitForSession(){
        return ($this->status != self::STATUS_REJECTED && $this->userHolder == self::USER_HOLDER_MANAGER &&
        Yii::$app->user->can('superuser') &&
        $this->status != self::STATUS_ACCEPTED &&
        $this->status != self::STATUS_NEED_CORRECTION &&
        $this->status != self::STATUS_WAITING_FOR_SESSION_DATE &&
        $this->status != self::STATUS_WAITING_FOR_SESSION_RESULT &&
        // && $this->status != Proposal::STATUS_WAITING_FOR_SESSION // commented so user can set multiple sessions
        !self::isInAnyOfNextSteps($this->status) && !($this->status == self::STATUS_WAIT_FOR_CONVERSATION && !$this->comments) && $this->status != self::STATUS_LOCKED);
    }

    public function canSetSessionDate()
    {
        return Yii::$app->user->can('superuser') && $this->status != self::STATUS_REJECTED && !self::isInAnyOfNextSteps($this->status) && $this->status != self::STATUS_LOCKED && (
            (
                $this->sessionDate == null && $this->status == self::STATUS_WAITING_FOR_SESSION_DATE
            )
            ||
            (
                $this->sessionDate != null && $this->status == self::STATUS_WAITING_FOR_SESSION_RESULT
            )
        );
    }

    public function canWriteProceedings()
    {
        return Yii::$app->user->can('superuser') && $this->status != self::STATUS_REJECTED &&
        !self::isInAnyOfNextSteps($this->status) && $this->status != self::STATUS_LOCKED &&
        $this->status != self::STATUS_ACCEPTED &&
            $this->sessionDate != null &&
            ($this->proceedings == null && $this->status == self::STATUS_WAITING_FOR_SESSION_RESULT);
    }

    public function canStartConverstation()
    {
        if ($this->status != self::STATUS_ACCEPTED &&
        $this->status != self::STATUS_REJECTED && $this->userHolder == self::USER_HOLDER_MANAGER && Yii::$app->user->can('superuser') && $this->status != self::STATUS_WAIT_FOR_CONVERSATION && !self::isInAnyOfNextSteps($this->status) && $this->status != self::STATUS_LOCKED &&
        $this->status != self::STATUS_NEED_CORRECTION &&
        ($this->status != self::STATUS_WAITING_FOR_SESSION_DATE && $this->status != self::STATUS_WAITING_FOR_SESSION_RESULT)) {
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

    // TODO This function is not used anymore, remove asap
    public function canSetForCorrection()
    {
        if(Yii::$app->user->can('superuser') &&
        (
            $this->status == self::STATUS_WAITING_FOR_NEXT_STATUS
            ||
            ($this->status == self::STATUS_WAIT_FOR_CONVERSATION && $this->comments)
         )
        ){
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

    public function canSendToWriteSource(){
        return ($this->status != self::STATUS_REJECTED && ($this->status == self::STATUS_ACCEPTED || self::isInAnyOfNextSteps($this->status)) && Yii::$app->user->can('superuser') &&
        ($this->status != self::STATUS_IN_NEXT_STEP)
        );
    }

    public function canSetExpert(){
        return (Yii::$app->user->can('superuser') && ($this->status == self::STATUS_ACCEPTED || self::isInAnyOfNextSteps($this->status)));
    }

    /**
     * User can NOT create any new otherreport, otherreport, otherreport, ... for a locked otherreport.
     *
     * @return boolean
     */
    public function canLock(){
        return $this->status != self::STATUS_REJECTED && $this->status != self::STATUS_LOCKED;
    }

    /**
     * User can NOT create any new otherreport, otherreport, otherreport, ... for a locked otherreport.
     *
     * @return boolean
     */
    public function canUnlock(){
        return $this->status == self::STATUS_LOCKED;
    }

    public function getNextStepStatus($nextStepType){
        return self::STATUS_IN_NEXT_STEP;
    }

    public static function isInAnyOfNextSteps($status){
        if(
            $status == self::STATUS_IN_NEXT_STEP
            //  ||
            // $status == self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION ||
            // $status == self::STATUS_IN_NEXT_STEP_FOR_SOURCE_INSTRUCTION
        ){
            return true;
        }

        return false;
    }
}
