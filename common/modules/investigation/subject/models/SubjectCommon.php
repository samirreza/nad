<?php

namespace nad\common\modules\investigation\subject\models;

use Yii;
use nad\common\helpers\Lookup;
use nad\common\helpers\Utility;
use core\behaviors\PreventDeleteBehavior;
use extensions\file\behaviors\FileBehavior;
use nad\office\modules\expert\models\Expert;
use extensions\i18n\validators\JalaliDateToTimestamp;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\investigation\common\behaviors\CommentBehavior;
use nad\common\modules\investigation\common\behaviors\TaggableBehavior;
use nad\common\modules\investigation\common\models\BaseInvestigationModel;
use nad\common\modules\investigation\subject\behaviors\NotificationBehavior;
use nad\common\modules\investigation\subject\behaviors\PartnersBehavior;
use nad\common\modules\investigation\common\behaviors\CodeNumeratorBehavior;

class SubjectCommon extends BaseInvestigationModel
{
    const LOOKUP_MISSION_TYPE = 'nad.investigation.subject.missionType';
    const LOOKUP_SEO_CODE = 'nad.investigation.subject.seoCode';

    const USER_HOLDER_MANAGER = 0;
    const USER_HOLDER_EXPERT = 1;

    const IS_MISSION_NEEDED_NO = 0;
    const IS_MISSION_NEEDED_YES = 1;

    const STATUS_WAITING_FOR_CHECK_BY_MANAGER = 30; // I chose 30 to make sure no conflict would happen with prev status codes. It could be less though.
    const STATUS_WAITING_FOR_SESSION_DATE = 31;
    const STATUS_WAITING_FOR_SESSION_RESULT = 32;
    const STATUS_WAITING_FOR_NEXT_STATUS = 33;
    const STATUS_WAITING_FOR_CORRECTION_BY_EXPERT = 34;
    const STATUS_WAITING_FOR_EXPERT_ACCEPT = 40;
    const STATUS_ACCEPTED_BY_EXPERT = 41;
    const STATUS_REPORT_ACCEPTED = 42;
    const STATUS_REPORT_REJECTED = 43; // TODO not used, remove it asap
    const STATUS_WAITING_FOR_SEND_TO_WRITE_REPORT = -1;

    public $moduleId = 'subject';
    public $ownerClassName = __NAMESPACE__ . '\Subject';

    private $_unitCode;
    public function getUnitCode()
    {
        if(!empty($this->_unitCode))
            return $this->_unitCode;
        elseif(!empty($this->uniqueCode)){
            if(isset(explode('.', $this->uniqueCode)[0])){
                return explode('.', $this->uniqueCode)[0];
            }else{
                return null;
            }
        }

        return null;
    }

    public function setUnitCode($value)
    {
        $this->_unitCode = trim($value);
    }

    private $_creatorExpertCode;
    public function getCreatorExpertCode()
    {
        if(!empty($this->_creatorExpertCode))
            return $this->_creatorExpertCode;
        elseif(!empty($this->uniqueCode)){
            if(isset(explode('.', $this->uniqueCode)[1])){
                return explode('.', $this->uniqueCode)[1];
            }else{
                return null;
            }
        }

        return null;
    }

    public function setCreatorExpertCode($value)
    {
        $this->_creatorExpertCode = trim($value);
    }

    private $_seoCode;
    public function getSeoCode()
    {
        if(!empty($this->_seoCode))
            return $this->_seoCode;
        elseif(!empty($this->uniqueCode)){
            if(isset(explode('.', $this->uniqueCode)[2])){
                return $this->getSeoCodeAsNumber((explode('.', $this->uniqueCode)[2]));
            }else{
                return null;
            }
        }

        return null;
    }

    public function setSeoCode($value)
    {
        $this->_seoCode = trim($value);
    }

    private $_reportExpertCode;
    public function getReportExpertCode()
    {
        if(!empty($this->_reportExpertCode))
            return $this->_reportExpertCode;
        elseif(!empty($this->uniqueCode)){
            if(isset(explode('.', $this->uniqueCode)[1])){
                return explode('.', $this->uniqueCode)[1];
            }else{
                return null;
            }
        }

        return null;
    }

    public function setReportExpertCode($value)
    {
        $this->_reportExpertCode = trim($value);
    }

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
                'partners' => PartnersBehavior::class,
                'codeNumerator' => [
                    'class' => CodeNumeratorBehavior::class,
                    'determinativeColumn' => 'consumer',
                    'tableName' => $this->tableName(),
                    // 'condition' => 'consumer = :consumer',
                    // 'conditionParams' => [':consumer' => static::CONSUMER_CODE]
                ],
                [
                    'class' => FileBehavior::class,
                    'groups' => [
                        'subjectFile' => [
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
                        'reportFile' => [
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
                        'reportFile2' => [
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
            [['text2', 'text', 'description', 'proceedings', 'negotiationResult', 'missionObjective', 'missionPlace', 'unitCode', 'creatorExpertCode', 'seoCode', 'reportExpertCode', 'workshopInfo'], 'trim'],
            [
                [
                    'title',
                    'createdAt',
                    'text2',
                    'text',
                    'unitCode',
                    'creatorExpertCode',
                    'seoCode'
                ],
                'required'
            ],
            ['sessionDate', 'required', 'on' => self::SCENARIO_SET_SESSION_DATE],
            [['expertId', 'missionObjective', 'reportExpertCode'], 'required', 'on' => self::SCENARIO_SET_EXPERT],
            [['title', 'englishTitle', 'missionPlace', 'unitCode', 'creatorExpertCode', 'seoCode', 'reportExpertCode'], 'string', 'max' => 255],
            [['text2', 'text', 'description', 'proceedings', 'missionObjective', 'workshopInfo'], 'string'],
            [['partners', 'tags', 'references'], 'safe'],
            [['englishTitle', 'missionPlace'], 'default', 'value' => null],
            [['missionType'], 'default', 'value' => 1],
            ['isMissionNeeded', 'integer'],
            [
                'createdAt',
                JalaliDateToTimestamp::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
            ],
            [
                ['sessionDate', 'missionDate', 'reportDeadlineDate'],
                JalaliDateToTimestamp::class,
                'hourAttr' => 'sessionHourAttribute',
                'minuteAttr' => 'sessionMinuteAttribute',
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
            ],
            [
                ['title', 'text2', 'text', 'description', 'proceedings', 'negotiationResult', 'missionObjective', 'missionPlace'],
                FarsiCharactersValidator::class
            ],
            // TODO This has bugs so I commented it
            // [
            //     'title',
            //     'unique',
            //     'targetAttribute' => ['title', 'consumer'],
            //     'message' => 'ترکیب عنوان و رده تکراری است'
            // ],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SET_EXPERT] = ['expertId', 'missionObjective', 'isMissionNeeded', 'missionPlace', 'missionDate', 'reportDeadlineDate', 'missionType', 'reportExpertCode', 'workshopInfo'];
        return $scenarios;
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'englishTitle' => 'عنوان انگلیسی',
            'createdAt' => 'تاریخ درج',
            'text' => 'متن موضوع',
            'text2' => 'متن گزارش',
            'description' => 'توضیحات',
            'references' => 'منابع',
            'partners' => 'همکاران',
            'tags' => 'کلید واژه‌ها',
            'tags' => 'کلید واژه‌ها',
            'status' => 'وضعیت',
            'userHolder' => 'نزد',
            'createdBy' => 'پیشنهاددهنده',
            'updatedAt' => 'آخرین بروزرسانی',
            'deliverToManagerDate' => 'تاریخ تحویل به مدیر',
            'sessionDate' => 'تاریخ جلسه توجیهی',
            'proceedings' => 'نتیجه جلسه',
            'negotiationResult' => 'نتیجه مذاکره',
            'uniqueCode' => 'شناسه',
            'expertId' => 'کارشناس گزارش/ماموریت',
            'missionObjective' => 'هدف گزارش/ماموریت',
            'isMissionNeeded' => 'نیاز به ماموریت دارد',
            'missionPlace' => 'مکان ماموریت',
            'missionDate' => 'زمان ماموریت',
            'reportDeadlineDate' => 'زمان تحویل گزارش',
            'missionType' => 'نوع ماموریت',
            'unitCode' => 'کد واحد',
            'creatorExpertCode' => 'کد کارشناس',
            'reportExpertCode' => 'کد کارشناس',
            'seoCode' => 'کد SEO',
            'workshopInfo' => 'مشخصات کارگاه'
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if($this->isNewRecord)
                $this->creatorExpertCode = Yii::$app->user->identity->expert->personnelId;
            elseif($this->scenario == self::SCENARIO_SET_EXPERT){
                $myExpert = Expert::findOne($this->expertId);
                $this->reportExpertCode = $myExpert->personnelId;
            }
            return true;
        }
        return false;
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->consumer = static::CONSUMER_CODE;

            if(Yii::$app->user->can('superuser')){
                $this->userHolder = self::USER_HOLDER_MANAGER;
                $this->status = self::STATUS_ACCEPTED;
                $this->deliverToManagerDate = time();
            }else{
                $this->userHolder = self::USER_HOLDER_EXPERT;
            }
        }

        if($this->getOldAttribute('status') != $this->status && $this->status == self::STATUS_ACCEPTED){
            $this->deleteComments();
        }

        if($this->isMissionNeeded == self::IS_MISSION_NEEDED_NO){
            $this->missionPlace = null;
            $this->missionDate = null;
            $this->missionType = null;
        }

        if($this->getOldAttribute('expertId') != $this->expertId && $this->status == self::STATUS_ACCEPTED){
            $this->deleteComments();
        }

        if($this->getOldAttribute('expertId') != $this->expertId && $this->getOldAttribute('expertId') != null){
            $this->text2 = '-'; // dash is for passing dummy validation LOL
            $this->status = self::STATUS_ACCEPTED;
            $this->deliverToManagerDate = null;
            $this->sessionDate = null;
            $this->proceedings = null;
        }

        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->setUniqueCode();

        return true;
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = trim($this->unitCode . '.' . ($this->isReport()?$this->reportExpertCode:$this->creatorExpertCode) . '.' . $this->getSeoCodeAsChar() . '.' . $this->numberPartOfUniqueCode . (isset($this->missionType)? '.' . Lookup::extra(self::LOOKUP_MISSION_TYPE, $this->missionType):''), '.');
        // $this->uniqueCode = static::CONSUMER_CODE . '.' . $this->mainReason->code .
            // '.' . $this->numberPartOfUniqueCode;
    }

    public function getPartnersQuery()
    {
        return $this->hasMany(Expert::class, ['id' => 'expertId'])
            ->viaTable('nad_investigation_subject_partner_relation', ['subjectId' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (
            isset($changedAttributes['status']) &&
            ($changedAttributes['status'] == self::STATUS_ACCEPTED &&
            $this->status == self::STATUS_WAITING_FOR_EXPERT_ACCEPT)
        ) {
            $this->trigger(self::EVENT_SET_EXPERT);
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

    public function getExpert()
    {
        return $this->hasOne(Expert::class, ['id' => 'expertId']);
    }

    public function getExpertAsString()
    {
        if (!isset($this->expert)) {
            return null;
        }
        return $this->expert->user->fullName;
    }

    public static function tableName()
    {
        return 'nad_investigation_subject';
    }

    // TODO remove unused statuses asap
    public static function getStatusLables()
    {
        return [
            self::STATUS_INPROGRESS => 'در حال انجام', // for subject
            self::STATUS_ACCEPTED_BY_EXPERT => 'در حال انجام', // for report
            self::STATUS_WAIT_FOR_CONVERSATION => 'نظر/سوال',
            self::STATUS_WAITING_FOR_CHECK_BY_MANAGER => 'منتظر بررسی',
            self::STATUS_WAITING_FOR_SESSION_DATE => 'منتظر تعیین زمان جلسه',
            self::STATUS_WAITING_FOR_SESSION_RESULT => 'منتظر جلسه و ثبت نتیجه',
            self::STATUS_WAITING_FOR_CORRECTION_BY_EXPERT => 'منتظر اصلاح',
            self::STATUS_ACCEPTED => 'منتظر تعیین کارشناس گزارش',
            self::STATUS_WAITING_FOR_SEND_TO_WRITE_REPORT => 'منتظر ارسال جهت نگارش گزارش',
            self::STATUS_WAITING_FOR_NEXT_STATUS => 'منتظر تعیین وضعیت',
            self::STATUS_LOCKED => 'قفل شده',
            self::STATUS_REJECTED => 'رد شده',
            self::STATUS_REPORT_ACCEPTED => 'تایید شده',
            // self::STATUS_REPORT_REJECTED => 'رد شده', // TODO not used, remove it asap
            self::STATUS_WAITING_FOR_EXPERT_ACCEPT => 'منتظر دریافت کارشناس'
        ];
    }

    public function getStatusLabel(){
        if($this->status == self::STATUS_ACCEPTED && $this->expertId != null){
            return 'منتظر ارسال جهت نگارش گزارش';
        }

        $postfix = '';
        if ($this->status != self::STATUS_ACCEPTED) {
            if ($this->isReport()) {
                $postfix = ' (گزارش)';
            } else {
                $postfix = ' (موضوع)';
            }
        }

        return self::getStatusLables()[$this->status] . $postfix;
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
        if ($newStatus == self::STATUS_WAITING_FOR_EXPERT_ACCEPT && $this->status != self::STATUS_LOCKED) {
            $this->userHolder = self::USER_HOLDER_EXPERT;
        }
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

    // TODO this function is NOT used anymore. Remove asap.
    public function canUserCreateReport()
    {
        if ($this->status == self::STATUS_ACCEPTED_BY_EXPERT) {
            if (Yii::$app->user->can('superuser')) {
                return true;
            }
            return $this->expertId != null;
        }
        return false;
    }

    public function canUserUpdateOrDelete()
    {
        if ($this->userHolder == self::USER_HOLDER_MANAGER && $this->status != self::STATUS_LOCKED && Yii::$app->user->can('superuser') &&
        (
            ($this->isReport() && $this->text2 != '-' && $this->text2 != null)
            ||
            (!$this->isReport())
        )
        ) {
            return true;
        }
        if ($this->userHolder == self::USER_HOLDER_EXPERT &&
            (
                (
                    $this->isReport() && $this->expertId == Yii::$app->user->identity->expert->id
                )
                ||
                (
                    !$this->isReport() && $this->createdBy == Yii::$app->user->id
                )
            )
            &&
            (
                $this->status == self::STATUS_WAITING_FOR_CORRECTION_BY_EXPERT ||
                $this->status == self::STATUS_INPROGRESS ||
                $this->status == self::STATUS_ACCEPTED_BY_EXPERT
            )
        ) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                [
                    'investigation' => $this,
                    'allowSecondExpert' => true
                ]
            );
        }
        return false;
    }

    public function canUserDeliverToManager()
    {
        if (
            (
                ($this->isReport() && $this->text2 != '<p>-</p>' && $this->text2 != '-' && $this->text2 != null)
                ||
                !$this->isReport()
            )
            &&
            $this->status != self::STATUS_REPORT_ACCEPTED &&
            $this->status != self::STATUS_REPORT_REJECTED &&
            $this->status != self::STATUS_REJECTED &&
            $this->status != self::STATUS_LOCKED &&
            $this->status != self::STATUS_WAITING_FOR_EXPERT_ACCEPT &&
            !($this->expertId != null && $this->status == self::STATUS_WAIT_FOR_CONVERSATION) &&
            $this->userHolder == self::USER_HOLDER_EXPERT &&
            (
                (
                    !$this->isReport()
                    &&
                    $this->createdBy == Yii::$app->user->id
                )
                ||
                (
                    $this->isReport()
                    &&
                    $this->expertId == Yii::$app->user->identity->expert->id
                )
            )
        ) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                [
                    'investigation' => $this,
                    'allowSecondExpert' => true
                ]
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
        return (
            $this->userHolder == Subject::USER_HOLDER_MANAGER &&
            Yii::$app->user->can('superuser') &&
            $this->status != self::STATUS_ACCEPTED &&
            $this->status != self::STATUS_REJECTED &&
            $this->status != self::STATUS_REPORT_ACCEPTED &&
            $this->status != self::STATUS_REPORT_REJECTED &&
            $this->status != self::STATUS_NEED_CORRECTION &&
            $this->status != self::STATUS_WAITING_FOR_SESSION_DATE &&
        // $this->status != Subject::STATUS_WAITING_FOR_SESSION && // commented so user can set multiple sessions
        !($this->status == self::STATUS_WAIT_FOR_CONVERSATION && !$this->comments) && $this->status != self::STATUS_LOCKED);
    }

    public function canSetSessionDate()
    {
        return Yii::$app->user->can('superuser') &&
        (
            $this->status == self::STATUS_WAITING_FOR_SESSION_DATE
            ||
            (
                $this->status == self::STATUS_WAITING_FOR_NEXT_STATUS &&
                $this->sessionDate != null
            )
        );
    }

    public function canStartConverstation()
    {
        if ($this->status != self::STATUS_ACCEPTED && $this->status != self::STATUS_REJECTED && (($this->userHolder == self::USER_HOLDER_MANAGER && Yii::$app->user->can('superuser')) || ($this->userHolder == self::USER_HOLDER_EXPERT && $this->status == self::STATUS_WAITING_FOR_EXPERT_ACCEPT)) && $this->status != self::STATUS_WAIT_FOR_CONVERSATION &&
        $this->status != self::STATUS_NEED_CORRECTION &&
        (
            $this->status != self::STATUS_REPORT_ACCEPTED &&
            $this->status != self::STATUS_REPORT_REJECTED
        ) && $this->status != self::STATUS_LOCKED && ($this->status != self::STATUS_WAITING_FOR_SESSION_DATE)
        &&
        (
            ($this->isReport() && ($this->expertId == Yii::$app->user->identity->expert->id || Yii::$app->user->can('superuser')))
            ||
            (!$this->isReport() && (($this->createdBy == Yii::$app->user->id) || Yii::$app->user->can('superuser')))
        )
        ) {
                return true;
            // return Yii::$app->user->can(
            //     'investigation.manageOwnInvestigation',
            //     [
            //         'investigation' => $this,
            //         'allowSecondExpert' => true
            //     ]
            // );
        }
        return false;
    }

    public function canHaveConverstation()
    {
        if (
            $this->status != self::STATUS_ACCEPTED &&
            $this->status != self::STATUS_REJECTED &&
            $this->status == self::STATUS_WAIT_FOR_CONVERSATION &&
            (
                $this->status != self::STATUS_REPORT_ACCEPTED &&
                $this->status != self::STATUS_REPORT_REJECTED
            )
            && $this->status != self::STATUS_LOCKED
            && !($this->status == self::STATUS_WAITING_FOR_SESSION)
            &&
            (
                ($this->isReport() && ($this->expertId == Yii::$app->user->identity->expert->id || Yii::$app->user->can('superuser')))
                ||
                (!$this->isReport())
            )
            ) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                [
                    'investigation' => $this,
                    'allowSecondExpert' => true
                ]
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
        if (Yii::$app->user->can('superuser') && $this->userHolder == self::USER_HOLDER_MANAGER) {
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

    public function canSendToWriteReport(){
        return ($this->status == self::STATUS_ACCEPTED && $this->expertId != null && Yii::$app->user->can('superuser'));
    }

    public function canSetExpert(){
        return (
            Yii::$app->user->can('superuser') &&
            $this->status != self::STATUS_LOCKED &&
            $this->status != self::STATUS_REPORT_ACCEPTED &&
            $this->status != self::STATUS_WAITING_FOR_CORRECTION_BY_EXPERT &&
            (
                ($this->isReport() && $this->status != self::STATUS_INPROGRESS) ||
                (
                    ($this->status == self::STATUS_ACCEPTED || $this->expertId != null) &&
                    (
                        $this->status != self::STATUS_REPORT_ACCEPTED &&
                        $this->status != self::STATUS_REPORT_REJECTED
                    )
                )
            )
        );
    }

    public function canExpertAccept(){
        return ($this->status == self::STATUS_WAITING_FOR_EXPERT_ACCEPT || (($this->expertId != null && $this->status == self::STATUS_WAIT_FOR_CONVERSATION)))
        && $this->userHolder == self::USER_HOLDER_EXPERT
        && Yii::$app->user->identity->expert->id == $this->expertId;
    }

    /**
     * User can NOT create any new otherreport for a locked subject.
     *
     * @return boolean
     */
    public function canLock(){
        return $this->status != self::STATUS_REJECTED
        && $this->status != self::STATUS_LOCKED
        &&
        (
            $this->status != self::STATUS_REPORT_REJECTED
        );
    }

    /**
     * User can NOT create any new otherreport for a locked subject.
     *
     * @return boolean
     */
    public function canUnlock(){
        return $this->status == self::STATUS_LOCKED;
    }

    public function getExpertFullNamesAsString()
    {
        $output = '';
        $expert = $this->getExpert()->one();
        if(isset($expert)){
            $output .= $expert->user->fullName ;
        }

        return $output;
    }

    public function isReport(){
        if($this->expertId != null)
            return true;

        return false;
    }

    public function getSeoCodeAsChar(){
        $codes = Lookup::extras(self::LOOKUP_SEO_CODE);
        $result = $codes[$this->seoCode];

        return $result;
    }

    public function getSeoCodeAsNumber($input){
        Lookup::$_items = []; // a nasty hack cause $_items is a shared static variable with unexpected initial value!!
        $codes = Lookup::extras(self::LOOKUP_SEO_CODE, false);
        $result = array_search($input, $codes);

        return $result;
    }
}
