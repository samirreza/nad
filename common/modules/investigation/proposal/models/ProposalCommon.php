<?php

namespace nad\common\modules\investigation\proposal\models;

use Yii;
use yii\helpers\ArrayHelper;
use nad\common\helpers\Utility;
use core\behaviors\PreventDeleteBehavior;
use extensions\file\behaviors\FileBehavior;
use nad\office\modules\expert\models\Expert;
use extensions\i18n\validators\JalaliDateToTimestamp;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\investigation\report\models\Report;
use nad\common\modules\investigation\method\models\Method;
use nad\common\modules\investigation\source\models\Source;
use nad\common\modules\investigation\source\models\SourceArchived;
use nad\common\modules\investigation\instruction\models\Instruction;
use nad\common\modules\investigation\common\behaviors\CommentBehavior;
use nad\common\modules\investigation\source\behaviors\ExpertsBehavior;
use nad\common\modules\investigation\common\behaviors\TaggableBehavior;
use nad\common\modules\investigation\proposal\behaviors\PartnersBehavior;
use nad\common\modules\investigation\common\models\BaseInvestigationModel;
use nad\common\modules\investigation\proposal\behaviors\NotificationBehavior;
use nad\common\modules\investigation\common\behaviors\CodeNumeratorBehavior;

class ProposalCommon extends BaseInvestigationModel
{
    // TODO remove lastCodeNumber from table asap

    // check BaseInvestigationModel to make sure you don't use same status codes
    // const STATUS_IN_NEXT_STEP = 8; this one is for "report step" & is defined in BaseInvestigationModel
    const STATUS_IN_NEXT_STEP_FOR_METHOD = 10;
    const STATUS_IN_NEXT_STEP_FOR_INSTRUCTION = 11;
    const STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD = 12;
    const STATUS_IN_NEXT_STEP_FOR_REPORT_INSTRUCTION = 13;
    const STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION = 14;
    const STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION = 15;

    const STATUS_WAITING_FOR_CHECK_BY_MANAGER = 30; // I chose 30 to make sure no conflict would happen with prev status codes. It could be less though.
    const STATUS_WAITING_FOR_SESSION_DATE = 31;
    const STATUS_WAITING_FOR_SESSION_RESULT = 32;
    const STATUS_WAITING_FOR_NEXT_STATUS = 33;
    const STATUS_WAITING_FOR_CORRECTION_BY_EXPERT = 34;

    const STATUS_WAITING_FOR_SEND_TO_WRITE_REPORT = -1;
    const STATUS_WAITING_FOR_SEND_TO_WRITE_METHOD = -2;
    const STATUS_WAITING_FOR_SEND_TO_WRITE_INSTRUCTION = -3;
    const STATUS_WAITING_FOR_SEND_TO_WRITE_REPORT_METHOD = -4;
    const STATUS_WAITING_FOR_SEND_TO_WRITE_REPORT_INSTRUCTION = -5;
    const STATUS_WAITING_FOR_SEND_TO_WRITE_METHOD_INSTRUCTION = -6;
    const STATUS_WAITING_FOR_SEND_TO_WRITE_REPORT_METHOD_INSTRUCTION = -7;

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
                    'determinativeColumn' => 'categoryId',
                    'tableName' => $this->tableName(),
                    // 'condition' => 'consumer = :consumer',
                    // 'conditionParams' => [':consumer' => static::CONSUMER_CODE]
                ],
                'partners' => PartnersBehavior::class,
                [
                    'class' => PreventDeleteBehavior::class,
                    'relations' => [
                        [
                            'relationMethod' => 'getReport',
                            'relationName' => 'گزارش'
                        ],
                        [
                            'relationMethod' => 'getMethods',
                            'relationName' => 'روش'
                        ],
                        [
                            'relationMethod' => 'getInstructions',
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
                                'maxSize' => 100 * 1024 * 1024,
                                // 'required' => true
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
            ['tags', 'validateTagsCount', 'skipOnEmpty' => true],
            [
                'title',
                'unique',
                'targetAttribute' => ['title', 'categoryId'],
                'message' => 'ترکیب عنوان و رده تکراری است'
            ],
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
            'sourceId' => 'دسترسی به منشا',
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

    public function getReports()
    {
        return $this->hasMany(Report::class, ['proposalId' => 'id']);
    }

    // TODO fix this for many reports relation
    public function getReportAsString()
    {
        if (!isset($this->reports)) {
            return null;
        }
        return ''; //$this->report[0]->title;
    }

    public function getMethods()
    {
        // TODO Rewrite with ActiveRecord::exists()
        $methods = Method::findAll(['proposalId' => $this->id]);
        if (isset($methods)) {
            return $this->hasMany(Method::class, ['proposalId' => 'id']);
        } else {
            return $this->hasMany(MethodArchived::class, ['proposalId' => 'id']);
        }
    }

    public function getInstructions()
    {
        // TODO Rewrite with ActiveRecord::exists()
        $instructions = Instruction::findAll(['proposalId' => $this->id]);
        if (isset($instructions)) {
            return $this->hasMany(Instruction::class, ['proposalId' => 'id']);
        } else {
            return $this->hasMany(InstructionArchived::class, ['proposalId' => 'id']);
        }
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
                        // ->alias('src')
                        ->innerJoinWith('expertsQuery exp')
                        ->andWhere([
                            Source::tableName() . '.status' => Source::STATUS_IN_NEXT_STEP,
                            'exp.id' => Yii::$app->user->identity->expert->id,
                            Source::tableName() . '.consumer' => $sourceConsumerCode
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
            // self::STATUS_IN_MANAGER_HAND => 'نزد مدیر', // not used
            // self::STATUS_WAITING_FOR_SESSION => 'نوبت جلسه', // not used
            // self::STATUS_WAIT_FOR_NEGOTIATION => 'نوبت مذاکره', // not used
            // self::STATUS_REJECTED => 'رد', // we don't have "reject" in proposal
            self::STATUS_INPROGRESS => 'در دست نگارش',
            self::STATUS_WAIT_FOR_CONVERSATION => 'تبادل نظر',
            self::STATUS_WAITING_FOR_CHECK_BY_MANAGER => 'منتظر بررسی توسط مدیر',
            self::STATUS_WAITING_FOR_SESSION_DATE => 'منتظر تعیین زمان جلسه',
            self::STATUS_WAITING_FOR_SESSION_RESULT => 'منتظر جلسه و ثبت نتیجه',
            self::STATUS_NEED_CORRECTION => 'منتظر ارسال به کارشناس جهت اصلاح',
            self::STATUS_WAITING_FOR_CORRECTION_BY_EXPERT => 'نزد کارشناس جهت اصلاح',
            self::STATUS_ACCEPTED => 'منتظر تعیین کارشناس',
            self::STATUS_LOCKED => 'قفل شده',
            self::STATUS_WAITING_FOR_NEXT_STATUS => 'منتظر تعیین وضعیت',

            // -----------------------------------------
            self::STATUS_WAITING_FOR_SEND_TO_WRITE_REPORT => 'منتظر ارسال جهت نگارش گزارش',
            self::STATUS_WAITING_FOR_SEND_TO_WRITE_METHOD => 'منتظر ارسال جهت نگارش روش',
            self::STATUS_WAITING_FOR_SEND_TO_WRITE_INSTRUCTION => 'منتظر ارسال جهت نگارش دستورالعمل',
            self::STATUS_WAITING_FOR_SEND_TO_WRITE_REPORT_METHOD => 'منتظر ارسال جهت نگارش گزارش و روش',
            self::STATUS_WAITING_FOR_SEND_TO_WRITE_REPORT_INSTRUCTION => 'منتظر ارسال جهت نگارش گزارش و دستورالعمل',
            self::STATUS_WAITING_FOR_SEND_TO_WRITE_METHOD_INSTRUCTION => 'منتظر ارسال جهت نگارش روش و دستورالعمل',
            self::STATUS_WAITING_FOR_SEND_TO_WRITE_REPORT_METHOD_INSTRUCTION => 'منتظر ارسال جهت نگارش گزارش، روش و دستورالعمل',
            // -----------------------------------------

            self::STATUS_IN_NEXT_STEP => 'منتظر نگارش گزارش اول/دوم/...',
            self::STATUS_IN_NEXT_STEP_FOR_METHOD => 'منتظر نگارش روش اول/دوم/...',
            self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION => 'منتظر نگارش دستورالعمل اول/دوم/...',
            self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD => 'منتظر نگارش گزارش و روش اول/دوم/...',
            self::STATUS_IN_NEXT_STEP_FOR_REPORT_INSTRUCTION => 'منتظر نگارش گزارش و دستورالعمل اول/دوم/...',
            self::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION => 'منتظر نگارش روش و دستورالعمل اول/دوم/...',
            self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION => 'منتظر نگارش گزارش، روش و دستورالعمل اول/دوم/...',
        ];
    }

    public function getStatusLabel(){
        $result = '';

        if($this->status == self::STATUS_ACCEPTED && $this->reportExpertId != null){
            return 'منتظر ارسال جهت نگارش گزارش/روش/دستورالعمل';
        } elseif($this->status == self::STATUS_IN_NEXT_STEP){ // report
            // $result = 'منتظر ارسال جهت نگارش روش/دستورالعمل';
            $result = $this->getExtraStatusLabel('reports' , 'گزارش');
        } elseif($this->status == self::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION){
            // $result =  'منتظر ارسال جهت نگارش گزارش/روش';
            $result = $this->getExtraStatusLabel('instructions' , 'دستورالعمل');
        } elseif($this->status == self::STATUS_IN_NEXT_STEP_FOR_METHOD){
            // $result =  'منتظر ارسال جهت نگارش گزارش/دستورالعمل';
            $result = $this->getExtraStatusLabel('methods' , 'روش');
        } elseif($this->status == self::STATUS_IN_NEXT_STEP_FOR_METHOD_INSTRUCTION){
            // $result =  'منتظر ارسال جهت نگارش گزارش';
            $result = $this->getExtraStatusLabel('methods' , 'روش');
            $result .= ' - ' . $this->getExtraStatusLabel('instructions' , 'دستورالعمل');
        } elseif($this->status == self::STATUS_IN_NEXT_STEP_FOR_REPORT_INSTRUCTION){
            // $result =  'منتظر ارسال جهت نگارش روش';
            $result = $this->getExtraStatusLabel('reports' , 'گزارش');
            $result .= ' - ' . $this->getExtraStatusLabel('instructions' , 'دستورالعمل');
        } elseif($this->status == self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD){
            // $result =  'منتظر ارسال جهت نگارش دستورالعمل';
            $result = $this->getExtraStatusLabel('reports' , 'گزارش');
            $result .= ' - ' . $this->getExtraStatusLabel('methods' , 'روش');
        } elseif($this->status == self::STATUS_IN_NEXT_STEP_FOR_REPORT_METHOD_INSTRUCTION){
            $result = $this->getExtraStatusLabel('reports' , 'گزارش');
            $result .= ' - ' . $this->getExtraStatusLabel('methods' , 'روش');
            $result .= ' - ' . $this->getExtraStatusLabel('instructions' , 'دستورالعمل');
        }else{
            return self::getStatusLables()[$this->status];
        }

        return $result;

    }

    public function getExtraStatusLabel($relatedEntity, $customLabel){
        $entityGetFunction = 'get' . ucfirst($relatedEntity);
        $relatedEntities = $this->$entityGetFunction();
        $entityCount = isset($relatedEntities) ? $relatedEntities->count(): 0;
            $label = 'منتظر نگارش  ' . $customLabel . ' ';

            switch ($entityCount + 1) {
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
                    $label .= Utility::convertNumberToPersianWords($entityCount + 1);
                    break;
            }

            if($entityCount > 0)
                $label .= '/بایگانی';

            return $label;
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
        else if($newStatus == self::STATUS_IN_MANAGER_HAND) // TODO remove this elseif asap
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
        return ($this->status != self::STATUS_REJECTED && $this->userHolder == Proposal::USER_HOLDER_MANAGER &&
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
        return $this->status != self::STATUS_REJECTED && $this->status != self::STATUS_LOCKED;
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

    public function getExpertFullNamesAsString()
    {
        $output = '';
        $expert = $this->getReportExpert()->one();
        if(isset($expert)){
            $output .= $expert->user->fullName ;
        }

        return $output;
    }
}
