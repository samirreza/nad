<?php

namespace nad\common\modules\investigation\method\models;

use Yii;
use yii\helpers\ArrayHelper;
use core\behaviors\PreventDeleteBehavior;
use extensions\file\behaviors\FileBehavior;
use nad\office\modules\expert\models\Expert;
use extensions\i18n\validators\JalaliDateToTimestamp;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\extensions\graphGenerator\behaviors\GraphBehavior;
use nad\common\modules\investigation\method\models\Method;
use nad\common\modules\investigation\report\models\Report;
use nad\common\modules\investigation\report\models\ReportArchived;
use nad\common\modules\investigation\proposal\models\Proposal;
use nad\common\modules\investigation\proposal\models\ProposalArchived;
use nad\common\modules\investigation\common\behaviors\CommentBehavior;
use nad\common\modules\investigation\common\behaviors\TaggableBehavior;
use nad\common\modules\investigation\method\behaviors\PartnersBehavior;
use nad\common\modules\investigation\common\models\BaseInvestigationModel;
use nad\common\modules\investigation\method\behaviors\NotificationBehavior;
use nad\common\modules\investigation\common\behaviors\CodeNumeratorBehavior;

class MethodCommon extends BaseInvestigationModel
{
    // TODO remove lastCodeNumber from table asap

    // check BaseInvestigationModel to make sure you don't use same status codes
    // const STATUS_IN_NEXT_STEP = 8; this one is for "source step" & is defined in BaseInvestigationModel
    const STATUS_IN_NEXT_STEP_FOR_INSTRUCTION = 11;
    const STATUS_IN_NEXT_STEP_FOR_SOURCE_INSTRUCTION = 13;

    const USER_HOLDER_MANAGER = 0;
    const USER_HOLDER_EXPERT = 1;

    public $moduleId = 'method';
    public $ownerClassName = __NAMESPACE__ . '\Method';

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
                            'relationMethod' => 'getInstruction',
                            'relationName' => 'دستورالعمل'
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
                        ],
                        'methodDoc' => [
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
                    'abstract',
                    'categoryId'
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
                ['proposalId', 'reportId'],
                'validateOneAttributeOnly',
                'skipOnEmpty' => false
            ]
        ];
    }

    public function validateOneAttributeOnly($attribute, $params){
        if (empty($this->proposalId) && empty($this->reportId)) {
            $errorMessage = 'پروپوزال یا گزارش مرتبط را انتخاب کنید.';
            $this->addError('proposalId', $errorMessage);
            $this->addError('reportId',  $errorMessage);
        }
        else if(!empty($this->proposalId) && !empty($this->reportId)){
            $errorMessage = 'تنها مجاز به انتخاب یکی از فیلدهای پروپوزال یا گزارش هستید.';
            $this->addError('proposalId', $errorMessage);
            $this->addError('reportId', $errorMessage);
        }
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'englishTitle' => 'عنوان انگلیسی',
            'createdAt' => 'تاریخ درج',
            'abstract' => 'خلاصه روش',
            'description' => 'توضیحات',
            'categoryId' => 'رده',
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
            'proposalId' => 'پروپوزال',
            'expertId' => 'کارشناس نگارش منشا/دستورالعمل',
            'userHolder' => 'نزد',
            'reportId' => 'گزارش',
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SET_EXPERT] = ['expertId'];
        return $scenarios;
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
    }

    public function getPartnersQuery()
    {
        return $this->hasMany(Expert::class, ['id' => 'expertId'])
            ->viaTable('nad_investigation_method_partner_relation', ['methodId' => 'id']);
    }

    public function getSource(){
        // first set with direct relations
        $proposal = $this->proposal;
        $report = $this->report;

        // then set with indirect relations if direct relations are null
        $source = null;
        if(isset($proposal))
            $source = $proposal->source;
        elseif(isset($report))
            $source = $report->proposal->source;

        return $source;
    }

    public function getSourceAsString()
    {
        if(!isset($this->source)){
            return null;
        }
        return $this->source->title;
    }

    public function getProposal()
    {
        // TODO Rewrite with ActiveRecord::exists()
        if (isset($this->proposalId)) {
            $proposal = Proposal::findOne($this->proposalId);
            if (isset($proposal)) {
                return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
            } else {
                return $this->hasOne(ProposalArchived::class, ['id' => 'proposalId']);
            }
        }elseif(isset($this->reportId)){
            return $this->report->proposal;
        }else{
            return null;
        }
    }

    public function getProposalAsString()
    {
        if(!isset($this->proposal)){
            return null;
        }
        return $this->proposal->title;
    }

    public function getReport()
    {
        // TODO Rewrite with ActiveRecord::exists()
        if (isset($this->reportId)) {
            $report = Report::findOne($this->reportId);
            if (isset($report)) {
                return $this->hasOne(Report::class, ['id' => 'reportId']);
            } else {
                return $this->hasOne(ReportArchived::class, ['id' => 'reportId']);
            }
        }else{
            return null;
        }
    }

    public function getReportAsString()
    {
        if(!isset($this->report)){
            return null;
        }
        return $this->report->title;
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

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }

    public function getExpertProposalsForDropdown($proposalConsumerCode){
        $expertProposals = [];
        if (Yii::$app->user->can('superuser')) {
            $expertProposals = Proposal::find()
                            ->andWhere([
                                'in',
                                'status',
                                [
                                    Proposal::STATUS_IN_NEXT_STEP_FOR_METHOD,
                                    Proposal::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD,
                                    Proposal::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION,
                                    Proposal::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION,
                                ]
                            ])
                            ->all();
        }else{
            $expertProposals = Proposal::find()
                        ->andWhere([
                            'in',
                            'status',
                            [
                                Proposal::STATUS_IN_NEXT_STEP_FOR_METHOD,
                                Proposal::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD,
                                Proposal::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION,
                                Proposal::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION,
                            ]
                        ])
                        ->andWhere([
                            'reportExpertId' => Yii::$app->user->identity->expert->id,
                            'consumer' => $proposalConsumerCode
                            ])
                        ->all();
        }

        return ArrayHelper::map($expertProposals, 'id', 'title');
    }

    public function getExpertReportsForDropdown($reportConsumerCode){
        $expertReports = [];
        if (Yii::$app->user->can('superuser')) {
            $expertReports = Report::find()
                            ->andWhere([
                                'in',
                                'status',
                                [
                                    Report::STATUS_IN_NEXT_STEP_FOR_METHOD, // only for method
                                    Report::STATUS_IN_NEXT_STEP_FOR_SOURCE_METHOD,
                                    Report::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION,
                                    Report::STATUS_IN_NEXT_STEP_FOR_SOURCE_METHOD_INSTRUCTION,
                                ]
                            ])
                            ->all();
        }else{
            $expertReports = Report::find()
                        ->andWhere([
                            'in',
                            'status',
                            [
                                Report::STATUS_IN_NEXT_STEP_FOR_METHOD, // only for method
                                Report::STATUS_IN_NEXT_STEP_FOR_SOURCE_METHOD,
                                Report::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION,
                                Report::STATUS_IN_NEXT_STEP_FOR_SOURCE_METHOD_INSTRUCTION,
                            ]
                        ])
                        ->andWhere([
                            'expertId' => Yii::$app->user->identity->expert->id,
                            'consumer' => $reportConsumerCode
                            ])
                        ->all();
        }

        return ArrayHelper::map($expertReports, 'id', 'title');
    }

    public static function tableName()
    {
        return 'nad_investigation_method';
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
            self::STATUS_ACCEPTED => 'منتظر تعیین کارشناس',
            self::STATUS_IN_NEXT_STEP => 'منتظر منشا جدید',
            self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION => 'منتظر دستورالعمل جدید',
            self::STATUS_IN_NEXT_STEP_FOR_SOURCE_INSTRUCTION => 'منتظر منشا و دستورالعمل جدید',
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
        return ($this->status != self::STATUS_REJECTED && $this->userHolder == Method::USER_HOLDER_MANAGER &&
        Yii::$app->user->can('superuser') &&
        $this->status != self::STATUS_ACCEPTED
        // && $this->status != Method::STATUS_WAITING_FOR_SESSION // commented so user can set multiple sessions
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

    public function canSendToWriteSource(){
        return ($this->status != self::STATUS_REJECTED && ($this->status == self::STATUS_ACCEPTED || self::isInAnyOfNextSteps($this->status)) && $this->expertId != null && Yii::$app->user->can('superuser') &&
        ($this->status != self::STATUS_IN_NEXT_STEP && $this->status != self::STATUS_IN_NEXT_STEP_FOR_SOURCE_INSTRUCTION)
        );
    }

    public function canSendToWriteInstruction(){
        return ($this->status != self::STATUS_REJECTED && ($this->status == self::STATUS_ACCEPTED || self::isInAnyOfNextSteps($this->status)) && $this->expertId != null && Yii::$app->user->can('superuser') &&
        ($this->status != self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION && $this->status != self::STATUS_IN_NEXT_STEP_FOR_SOURCE_INSTRUCTION)
        );
    }

    public function canSetExpert(){
        return (Yii::$app->user->can('superuser') && ($this->status == self::STATUS_ACCEPTED || self::isInAnyOfNextSteps($this->status)));
    }

    /**
     * User can NOT create any new method, method, instruction, ... for a locked method.
     *
     * @return boolean
     */
    public function canLock(){
        return self::isInAnyOfNextSteps($this->status);
    }

    /**
     * User can NOT create any new method, method, instruction, ... for a locked method.
     *
     * @return boolean
     */
    public function canUnlock(){
        return $this->status == self::STATUS_LOCKED;
    }

    public function getNextStepStatus($nextStepType){
        $nextStepStatusCode = null;
        switch ($nextStepType) {
            case self::STATUS_IN_NEXT_STEP : // for source
                if($this->status == self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION){
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_SOURCE_INSTRUCTION;
                }else{
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP;
                }
                break;
            case self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION :
                if($this->status == self::STATUS_IN_NEXT_STEP){
                    $nextStepStatusCode = self::STATUS_IN_NEXT_STEP_FOR_SOURCE_INSTRUCTION;
                }else{
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
            $status == self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION ||
            $status == self::STATUS_IN_NEXT_STEP_FOR_SOURCE_INSTRUCTION
        ){
            return true;
        }

        return false;
    }
}