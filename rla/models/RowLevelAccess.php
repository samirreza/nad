<?php

namespace nad\rla\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use core\behaviors\TimestampBehavior;
use modules\user\backend\models\User;

/**
 * This is the model class for table "row_level_access".
 *
 * @property int $id
 * @property int $seq_access_id
 * @property int $user_id
 * @property int $access_type
 * @property int $expire_date
 */
class RowLevelAccess extends \yii\db\ActiveRecord
{
    public const ROW_LEVEL_ACCESS_TYPE_PERMANENT = 1;
    public const ROW_LEVEL_ACCESS_TYPE_TEMPORARY = 2;
    public const ROW_LEVEL_ACCESS_EXPIRE__DEFAULT_DURATION = 24*60*60; // defaults to one day (in seconds)

    public $userIds;
    public $seqAccessIds;
    public $accessTypes;
    public $expireDates;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'row_level_access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seqAccessIds'], 'required'],
            [['userIds', 'accessTypes', 'expireDates'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'seq_access_id' => 'Seq Access ID',
            'user_id' => 'User ID',
            'access_type' => 'دسترسی زماندار',
            'expire_date' => 'Expire Date',
            'userIds' => 'لیست کاربران'
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ],
        ];
    }

    public static function getItemTypes(){
        return [
            'text' => 'همه قسمتها',
            'state' => ['opened' => true ],
            'children' => [
                [
                    'text' => 'مدیریت',
                    'children' => [
                        [
                            'text' => 'راهبری',
                            'children' => [
                                [
                                    'text' => 'پایش',
                                    'children' => [
                                        [
                                            'id' => 'nad\coordination\payesh\excelmanager\models\ExcelFileSearch',
                                            'text' => 'انتقال داده',
                                            'icon' => 'fa fa-arrow-left',
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'text' => 'فرایند',
                    'children' => [
                        [
                            'text' => 'فرایندها',
                            'children' => [
                                [
                                    'text' => 'ته نشینی',
                                    'children' => [
                                        [
                                            'text' => 'بررسی فرایندی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigation\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigation\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigation\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigation\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigation\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigation\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigation\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationMonitor\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationMonitor\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationMonitor\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationMonitor\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationMonitor\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationMonitor\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationMonitor\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی طراحی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\sedimentation\payesh\excelmanager\models\ExcelFileSearch',
                                                    'text' => 'انتقال داده',
                                                    'icon' => 'fa fa-arrow-left',
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                [
                                    'text' => 'فیلترشنی',
                                    'children' => [
                                        [
                                            'text' => 'بررسی فرایندی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\filter\investigation\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigation\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigation\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigation\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigation\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigation\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigation\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationMonitor\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationMonitor\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationMonitor\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationMonitor\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationMonitor\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationMonitor\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationMonitor\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی طراحی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\filter\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\filter\payesh\excelmanager\models\ExcelFileSearch',
                                                    'text' => 'انتقال داده',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'کارتریج',
                                    'children' => [
                                        [
                                            'text' => 'بررسی فرایندی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigation\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigation\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigation\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigation\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigation\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigation\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigation\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationMonitor\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationMonitor\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationMonitor\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationMonitor\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationMonitor\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationMonitor\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationMonitor\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی طراحی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\cartridge\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\cartridge\payesh\excelmanager\models\ExcelFileSearch',
                                                    'text' => 'انتقال داده',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'آر او',
                                    'children' => [
                                        [
                                            'text' => 'بررسی فرایندی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\ro\investigation\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigation\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigation\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigation\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigation\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigation\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigation\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationMonitor\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationMonitor\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationMonitor\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationMonitor\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationMonitor\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationMonitor\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationMonitor\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی طراحی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\ro\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\ro\payesh\excelmanager\models\ExcelFileSearch',
                                                    'text' => 'انتقال داده',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'پساب',
                                    'children' => [
                                        [
                                            'text' => 'بررسی فرایندی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigation\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigation\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigation\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigation\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigation\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigation\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigation\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationMonitor\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationMonitor\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationMonitor\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationMonitor\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationMonitor\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationMonitor\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationMonitor\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی طراحی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\wastewater\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'میکروبیولوژی',
                                    'children' => [
                                        [
                                            'text' => 'بررسی فرایندی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigation\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigation\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigation\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigation\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigation\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigation\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigation\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationMonitor\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationMonitor\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationMonitor\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationMonitor\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationMonitor\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationMonitor\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationMonitor\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی طراحی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\microbial\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'گرافن',
                                    'children' => [
                                        [
                                            'text' => 'بررسی فرایندی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigation\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigation\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigation\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigation\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigation\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigation\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigation\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationMonitor\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationMonitor\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationMonitor\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationMonitor\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationMonitor\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationMonitor\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationMonitor\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی طراحی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\graphene\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'تکنولوژی های نو',
                                    'children' => [
                                        [
                                            'text' => 'بررسی فرایندی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigation\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigation\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigation\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigation\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigation\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigation\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigation\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationMonitor\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationMonitor\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationMonitor\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationMonitor\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationMonitor\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationMonitor\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationMonitor\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی طراحی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\newTechnology\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'هیدرولیک',
                                    'children' => [
                                        [
                                            'text' => 'بررسی فرایندی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigation\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigation\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigation\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigation\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigation\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigation\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigation\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationMonitor\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationMonitor\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationMonitor\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationMonitor\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationMonitor\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationMonitor\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationMonitor\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی طراحی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\hydraulic\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'انتقال حرارت',
                                    'children' => [
                                        [
                                            'text' => 'بررسی فرایندی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigation\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigation\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigation\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigation\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigation\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigation\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigation\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationMonitor\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationMonitor\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationMonitor\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationMonitor\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationMonitor\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationMonitor\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationMonitor\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'بررسی طراحی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\ird\heattransfer\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ]
                            ]
                        ],
                        [
                            'text' => 'مواد',
                            'children' => [
                                [
                                    'text' => 'گندزدا',
                                    'children' => [
                                        [
                                            'text' => 'مطالعات کلی و دستورالعمل ها',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\materials\disinfectant\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\disinfectant\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\disinfectant\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\disinfectant\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\disinfectant\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\disinfectant\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\disinfectant\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'منعقدکننده',
                                    'children' => [
                                        [
                                            'text' => 'مطالعات کلی و دستورالعمل ها',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\materials\coagulant\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\coagulant\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\coagulant\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\coagulant\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\coagulant\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\coagulant\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\coagulant\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'شوینده قلیایی',
                                    'children' => [
                                        [
                                            'text' => 'مطالعات کلی و دستورالعمل ها',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\materials\alkalineWasher\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\alkalineWasher\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\alkalineWasher\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\alkalineWasher\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\alkalineWasher\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\alkalineWasher\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\alkalineWasher\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'شوینده اسیدی',
                                    'children' => [
                                        [
                                            'text' => 'مطالعات کلی و دستورالعمل ها',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\materials\acidicWasher\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\acidicWasher\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\acidicWasher\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\acidicWasher\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\acidicWasher\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\acidicWasher\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\acidicWasher\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'جی آر اس',
                                    'children' => [
                                        [
                                            'text' => 'مطالعات کلی و دستورالعمل ها',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\materials\grs\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\grs\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\grs\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\grs\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\grs\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\grs\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\grs\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'ضدرسوب',
                                    'children' => [
                                        [
                                            'text' => 'مطالعات کلی و دستورالعمل ها',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\materials\antisediment\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\antisediment\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\antisediment\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\antisediment\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\antisediment\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\antisediment\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\antisediment\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'ضدمیکروب',
                                    'children' => [
                                        [
                                            'text' => 'مطالعات کلی و دستورالعمل ها',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\materials\antimicrobial\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\antimicrobial\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\antimicrobial\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\antimicrobial\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\antimicrobial\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\antimicrobial\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\antimicrobial\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'رنگ ها',
                                    'children' => [
                                        [
                                            'text' => 'مطالعات کلی و دستورالعمل ها',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\materials\colors\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\colors\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\colors\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\colors\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\colors\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\colors\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\colors\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'لاک بیرنگ',
                                    'children' => [
                                        [
                                            'text' => 'مطالعات کلی و دستورالعمل ها',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\materials\lacquer\investigationDesign\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\lacquer\investigationDesign\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\lacquer\investigationDesign\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\lacquer\investigationDesign\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\lacquer\investigationDesign\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\lacquer\investigationDesign\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\materials\lacquer\investigationDesign\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'آزمایشگاه',
                            'children' => [
                                [
                                    'text' => 'آزمایش های بهره برداری',
                                    'children' => [
                                        [
                                            'text' => 'فعالیت بررسی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\laboratory\unit1\investigation1\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit1\investigation1\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit1\investigation1\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit1\investigation1\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit1\investigation1\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit1\investigation1\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit1\investigation1\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ]
                                    ]
                                ],
                                [
                                    'text' => 'ارزیابی مواد مصرفی',
                                    'children' => [
                                        [
                                            'text' => 'فعالیت بررسی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\laboratory\unit2\investigation1\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit2\investigation1\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit2\investigation1\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit2\investigation1\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit2\investigation1\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit2\investigation1\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit2\investigation1\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ]
                                    ]
                                ],
                                [
                                    'text' => 'تجهیزات آزمایشگاهی',
                                    'children' => [
                                        [
                                            'text' => 'فعالیت بررسی',
                                            'children' => [
                                                [
                                                    'id' => 'nad\process\laboratory\unit3\investigation1\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit3\investigation1\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit3\investigation1\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit3\investigation1\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit3\investigation1\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit3\investigation1\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\process\laboratory\unit3\investigation1\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'text' => 'فنی',
                    // 'state' => [ 'disabled' => true ],
                    'children' => [
                        [
                            'text' => 'لوله کشی',
                            'children' => [
                                [
                                    'text' => 'مراحل',
                                    'children' => [
                                        [
                                            'id' => 'nad\engineering\piping\stage\models\StageSearch',
                                            'text' => 'داده گاه مراحل',
                                            'icon' => 'fa fa-arrow-left',

                                        ],
                                        [
                                            'text' => 'بررسی بهبود',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\piping\stage\investigationImprovement\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\piping\stage\investigationImprovement\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\piping\stage\investigationImprovement\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\piping\stage\investigationImprovement\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\piping\stage\investigationImprovement\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\piping\stage\investigationImprovement\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\piping\stage\investigationImprovement\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\piping\stage\payesh\excelmanager\models\ExcelFileSearch',
                                                    'text' => 'انتقال داده',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'دستگاه ها',
                                    'children' => [
                                        [
                                            'text' => 'بررسی بهبود',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\piping\device\investigationImprovement\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\piping\device\investigationImprovement\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\piping\device\investigationImprovement\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\piping\device\investigationImprovement\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\piping\device\investigationImprovement\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\piping\device\investigationImprovement\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\piping\device\investigationImprovement\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'id' => 'nad\engineering\piping\device\device\models\DeviceSearch',
                                            'text' => 'تجهیزات',
                                            'icon' => 'fa fa-arrow-left',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'مکانیک',
                            'children' => [
                                [
                                    'text' => 'دستگاه ها',
                                    'children' => [
                                        [
                                            'text' => 'بررسی بهبود',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\mechanics\device\investigationImprovement\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\mechanics\device\investigationImprovement\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\mechanics\device\investigationImprovement\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\mechanics\device\investigationImprovement\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\mechanics\device\investigationImprovement\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\mechanics\device\investigationImprovement\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\mechanics\device\investigationImprovement\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'id' => 'nad\engineering\mechanics\device\device\models\DeviceSearch',
                                            'text' => 'تجهیزات',
                                            'icon' => 'fa fa-arrow-left',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'برق',
                            'children' => [
                                [
                                    'text' => 'مراحل',
                                    'children' => [
                                        [
                                            'id' => 'nad\engineering\electricity\stage\models\StageSearch',
                                            'text' => 'داده گاه مراحل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'text' => 'بررسی بهبود',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\electricity\stage\investigationImprovement\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\electricity\stage\investigationImprovement\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\electricity\stage\investigationImprovement\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\electricity\stage\investigationImprovement\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\electricity\stage\investigationImprovement\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\electricity\stage\investigationImprovement\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\electricity\stage\investigationImprovement\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ],
                                        ],
                                        [
                                            'text' => 'پایش',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\electricity\stage\payesh\excelmanager\models\ExcelFileSearch',
                                                    'text' => 'انتقال داده',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'دستگاه ها',
                                    'children' => [
                                        [
                                            'text' => 'بررسی بهبود',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\electricity\device\investigationImprovement\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\electricity\device\investigationImprovement\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\electricity\device\investigationImprovement\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\electricity\device\investigationImprovement\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\electricity\device\investigationImprovement\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\electricity\device\investigationImprovement\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\electricity\device\investigationImprovement\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'id' => 'nad\engineering\electricity\device\device\models\DeviceSearch',
                                            'text' => 'تجهیزات',
                                            'icon' => 'fa fa-arrow-left',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'ابزاردقیق',
                            'children' => [
                                [
                                    'text' => 'مراحل',
                                    'children' => [
                                        [
                                            'id' => 'nad\engineering\instrument\stage\models\StageSearch',
                                            'text' => 'داده گاه مراحل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'text' => 'بررسی بهبود',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\instrument\stage\investigationImprovement\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\instrument\stage\investigationImprovement\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\instrument\stage\investigationImprovement\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\instrument\stage\investigationImprovement\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\instrument\stage\investigationImprovement\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\instrument\stage\investigationImprovement\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\instrument\stage\investigationImprovement\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'دستگاه ها',
                                    'children' => [
                                        [
                                            'text' => 'بررسی بهبود',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\instrument\device\investigationImprovement\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\instrument\device\investigationImprovement\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\instrument\device\investigationImprovement\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\instrument\device\investigationImprovement\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\instrument\device\investigationImprovement\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\instrument\device\investigationImprovement\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\instrument\device\investigationImprovement\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'id' => 'nad\engineering\instrument\device\device\models\DeviceSearch',
                                            'text' => 'تجهیزات',
                                            'icon' => 'fa fa-arrow-left',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'کنترل',
                            'children' => [
                                [
                                    'text' => 'مراحل',
                                    'children' => [
                                        [
                                            'id' => 'nad\engineering\control\stage\models\StageSearch',
                                            'text' => 'داده گاه مراحل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'text' => 'بررسی بهبود',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\control\stage\investigationImprovement\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\control\stage\investigationImprovement\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\control\stage\investigationImprovement\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\control\stage\investigationImprovement\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\control\stage\investigationImprovement\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\control\stage\investigationImprovement\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\control\stage\investigationImprovement\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'دستگاه ها',
                                    'children' => [
                                        [
                                            'text' => 'بررسی بهبود',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\control\device\investigationImprovement\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\control\device\investigationImprovement\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\control\device\investigationImprovement\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\control\device\investigationImprovement\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\control\device\investigationImprovement\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\control\device\investigationImprovement\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\control\device\investigationImprovement\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'id' => 'nad\engineering\control\device\device\models\DeviceSearch',
                                            'text' => 'تجهیزات',
                                            'icon' => 'fa fa-arrow-left',
                                        ]
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'ساختمان',
                            'children' => [
                                [
                                    'text' => 'مراحل',
                                    'children' => [
                                        [
                                            'id' => 'nad\engineering\construction\stage\models\StageSearch',
                                            'text' => 'داده گاه مراحل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'text' => 'بررسی بهبود',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\construction\stage\investigationImprovement\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\construction\stage\investigationImprovement\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\construction\stage\investigationImprovement\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\construction\stage\investigationImprovement\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\construction\stage\investigationImprovement\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\construction\stage\investigationImprovement\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\construction\stage\investigationImprovement\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'ژئوتکنیک',
                            'children' => [
                                [
                                    'text' => 'مراحل',
                                    'children' => [
                                        [
                                            'id' => 'nad\engineering\geotechnics\stage\models\StageSearch',
                                            'text' => 'داده گاه مراحل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'text' => 'بررسی بهبود',
                                            'children' => [
                                                [
                                                    'id' => 'nad\engineering\geotechnics\stage\investigationImprovement\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\geotechnics\stage\investigationImprovement\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\geotechnics\stage\investigationImprovement\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\geotechnics\stage\investigationImprovement\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\geotechnics\stage\investigationImprovement\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\geotechnics\stage\investigationImprovement\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\engineering\geotechnics\stage\investigationImprovement\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                            ]
                        ]
                    ]
                ],
                [
                    'text' => 'احداث',
                    'children' => [
                        [
                            'text' => 'ساختمان',
                            'children' => [
                                [
                                    'text' => 'واحد 1',
                                    'children' => [
                                        [
                                            'text' => 'فعالیت الف',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit1\investigation1\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit1\investigation1\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit1\investigation1\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit1\investigation1\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit1\investigation1\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit1\investigation1\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit1\investigation1\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ب',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit1\investigation2\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ج',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit1\investigation3\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت د',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit1\investigation4\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ه',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit1\investigation5\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'واحد 2',
                                    'children' => [
                                        [
                                            'text' => 'فعالیت الف',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit2\investigation1\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit2\investigation1\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit2\investigation1\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit2\investigation1\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit2\investigation1\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit2\investigation1\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit2\investigation1\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ب',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit2\investigation2\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ج',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit2\investigation3\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت د',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit2\investigation4\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ه',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit2\investigation5\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'واحد 3',
                                    'children' => [
                                        [
                                            'text' => 'فعالیت الف',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit3\investigation1\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit3\investigation1\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit3\investigation1\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit3\investigation1\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit3\investigation1\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit3\investigation1\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\construction\unit3\investigation1\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ب',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit3\investigation2\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ج',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit3\investigation3\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت د',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit3\investigation4\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ه',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\construction\unit3\investigation5\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ]
                            ]
                        ],
                        [
                            'text' => 'تجهیزات',
                            'children' => [
                                [
                                    'text' => 'واحد 1',
                                    'children' => [
                                        [
                                            'text' => 'فعالیت الف',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit1\investigation1\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit1\investigation1\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit1\investigation1\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit1\investigation1\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit1\investigation1\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit1\investigation1\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit1\investigation1\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ب',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit1\investigation2\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ج',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit1\investigation3\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت د',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit1\investigation4\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ه',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit1\investigation5\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'واحد 2',
                                    'children' => [
                                        [
                                            'text' => 'فعالیت الف',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit2\investigation1\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit2\investigation1\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit2\investigation1\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit2\investigation1\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit2\investigation1\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit2\investigation1\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit2\investigation1\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ب',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit2\investigation2\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ج',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit2\investigation3\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت د',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit2\investigation4\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ه',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit2\investigation5\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'واحد 3',
                                    'children' => [
                                        [
                                            'text' => 'فعالیت الف',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit3\investigation1\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit3\investigation1\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit3\investigation1\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit3\investigation1\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit3\investigation1\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit3\investigation1\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\equipment\unit3\investigation1\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ب',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit3\investigation2\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ج',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit3\investigation3\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت د',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit3\investigation4\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ه',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\equipment\unit3\investigation5\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ]
                            ]
                        ],
                        [
                            'text' => 'چاه',
                            'children' => [
                                [
                                    'text' => 'واحد 1',
                                    'children' => [
                                        [
                                            'text' => 'فعالیت الف',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit1\investigation1\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit1\investigation1\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit1\investigation1\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit1\investigation1\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit1\investigation1\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit1\investigation1\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit1\investigation1\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ب',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit1\investigation2\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ج',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit1\investigation3\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت د',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit1\investigation4\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ه',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit1\investigation5\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'واحد 2',
                                    'children' => [
                                        [
                                            'text' => 'فعالیت الف',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit2\investigation1\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit2\investigation1\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit2\investigation1\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit2\investigation1\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit2\investigation1\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit2\investigation1\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit2\investigation1\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ب',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit2\investigation2\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ج',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit2\investigation3\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت د',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit2\investigation4\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ه',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit2\investigation5\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'واحد 3',
                                    'children' => [
                                        [
                                            'text' => 'فعالیت الف',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit3\investigation1\source\models\SourceSearch',
                                                    'text' => 'منشا',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit3\investigation1\proposal\models\ProposalSearch',
                                                    'text' => 'پروپوزال',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit3\investigation1\report\models\ReportSearch',
                                                    'text' => 'گزارش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit3\investigation1\method\models\MethodSearch',
                                                    'text' => 'روش',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit3\investigation1\instruction\models\InstructionSearch',
                                                    'text' => 'دستورالعمل',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit3\investigation1\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                                [
                                                    'id' => 'nad\build\well\unit3\investigation1\reference\models\ReferenceSearch',
                                                    'text' => 'منابع',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ب',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit3\investigation2\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ج',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit3\investigation3\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت د',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit3\investigation4\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                        [
                                            'text' => 'فعالیت ه',
                                            'children' => [
                                                [
                                                    'id' => 'nad\build\well\unit3\investigation5\subject\models\SubjectSearch',
                                                    'text' => 'سایرگزارشها',
                                                    'icon' => 'fa fa-arrow-left',
                                                ],
                                            ]
                                        ],
                                    ]
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    'text' => 'تامین',
                    'children' => [
                        [
                            'text' => 'خرید',
                            'children' => [
                                [
                                    'text' => 'فعالیت الف',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit1\investigation1\source\models\SourceSearch',
                                            'text' => 'منشا',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit1\investigation1\proposal\models\ProposalSearch',
                                            'text' => 'پروپوزال',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit1\investigation1\report\models\ReportSearch',
                                            'text' => 'گزارش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit1\investigation1\method\models\MethodSearch',
                                            'text' => 'روش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit1\investigation1\instruction\models\InstructionSearch',
                                            'text' => 'دستورالعمل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit1\investigation1\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit1\investigation1\reference\models\ReferenceSearch',
                                            'text' => 'منابع',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ب',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit1\investigation2\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ج',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit1\investigation3\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت د',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit1\investigation4\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ه',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit1\investigation5\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'ساخت و تعمیر',
                            'children' => [
                                [
                                    'text' => 'فعالیت الف',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit2\investigation1\source\models\SourceSearch',
                                            'text' => 'منشا',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit2\investigation1\proposal\models\ProposalSearch',
                                            'text' => 'پروپوزال',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit2\investigation1\report\models\ReportSearch',
                                            'text' => 'گزارش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit2\investigation1\method\models\MethodSearch',
                                            'text' => 'روش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit2\investigation1\instruction\models\InstructionSearch',
                                            'text' => 'دستورالعمل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit2\investigation1\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit2\investigation1\reference\models\ReferenceSearch',
                                            'text' => 'منابع',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ب',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit2\investigation2\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ج',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit2\investigation3\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت د',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit2\investigation4\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ه',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit2\investigation5\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'جابجایی',
                            'children' => [
                                [
                                    'text' => 'فعالیت الف',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit3\investigation1\source\models\SourceSearch',
                                            'text' => 'منشا',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit3\investigation1\proposal\models\ProposalSearch',
                                            'text' => 'پروپوزال',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit3\investigation1\report\models\ReportSearch',
                                            'text' => 'گزارش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit3\investigation1\method\models\MethodSearch',
                                            'text' => 'روش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit3\investigation1\instruction\models\InstructionSearch',
                                            'text' => 'دستورالعمل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit3\investigation1\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\supply\unit3\investigation1\reference\models\ReferenceSearch',
                                            'text' => 'منابع',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ب',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit3\investigation2\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ج',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit3\investigation3\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت د',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit3\investigation4\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ه',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\supply\unit3\investigation5\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                            ]
                        ]
                    ]
                ],
                [
                    'text' => 'آی تی',
                    'children' => [
                        [
                            'text' => 'واحد 1',
                            'children' => [
                                [
                                    'text' => 'فعالیت الف',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit1\investigation1\source\models\SourceSearch',
                                            'text' => 'منشا',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit1\investigation1\proposal\models\ProposalSearch',
                                            'text' => 'پروپوزال',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit1\investigation1\report\models\ReportSearch',
                                            'text' => 'گزارش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit1\investigation1\method\models\MethodSearch',
                                            'text' => 'روش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit1\investigation1\instruction\models\InstructionSearch',
                                            'text' => 'دستورالعمل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit1\investigation1\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit1\investigation1\reference\models\ReferenceSearch',
                                            'text' => 'منابع',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ب',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit1\investigation2\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ج',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit1\investigation3\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت د',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit1\investigation4\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ه',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit1\investigation5\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'واحد 2',
                            'children' => [
                                [
                                    'text' => 'فعالیت الف',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit2\investigation1\source\models\SourceSearch',
                                            'text' => 'منشا',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit2\investigation1\proposal\models\ProposalSearch',
                                            'text' => 'پروپوزال',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit2\investigation1\report\models\ReportSearch',
                                            'text' => 'گزارش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit2\investigation1\method\models\MethodSearch',
                                            'text' => 'روش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit2\investigation1\instruction\models\InstructionSearch',
                                            'text' => 'دستورالعمل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit2\investigation1\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit2\investigation1\reference\models\ReferenceSearch',
                                            'text' => 'منابع',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ب',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit2\investigation2\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ج',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit2\investigation3\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت د',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit2\investigation4\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ه',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit2\investigation5\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'واحد 3',
                            'children' => [
                                [
                                    'text' => 'فعالیت الف',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit3\investigation1\source\models\SourceSearch',
                                            'text' => 'منشا',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit3\investigation1\proposal\models\ProposalSearch',
                                            'text' => 'پروپوزال',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit3\investigation1\report\models\ReportSearch',
                                            'text' => 'گزارش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit3\investigation1\method\models\MethodSearch',
                                            'text' => 'روش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit3\investigation1\instruction\models\InstructionSearch',
                                            'text' => 'دستورالعمل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit3\investigation1\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\informationtech\unit3\investigation1\reference\models\ReferenceSearch',
                                            'text' => 'منابع',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ب',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit3\investigation2\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ج',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit3\investigation3\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت د',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit3\investigation4\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ه',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\informationtech\unit3\investigation5\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                            ]
                        ]
                    ]
                ],
                [
                    'text' => 'مالی',
                    'children' => [
                        [
                            'text' => 'واحد 1',
                            'children' => [
                                [
                                    'text' => 'فعالیت الف',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit1\investigation1\source\models\SourceSearch',
                                            'text' => 'منشا',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit1\investigation1\proposal\models\ProposalSearch',
                                            'text' => 'پروپوزال',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit1\investigation1\report\models\ReportSearch',
                                            'text' => 'گزارش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit1\investigation1\method\models\MethodSearch',
                                            'text' => 'روش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit1\investigation1\instruction\models\InstructionSearch',
                                            'text' => 'دستورالعمل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit1\investigation1\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit1\investigation1\reference\models\ReferenceSearch',
                                            'text' => 'منابع',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ب',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit1\investigation2\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ج',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit1\investigation3\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت د',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit1\investigation4\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ه',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit1\investigation5\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'واحد 2',
                            'children' => [
                                [
                                    'text' => 'فعالیت الف',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit2\investigation1\source\models\SourceSearch',
                                            'text' => 'منشا',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit2\investigation1\proposal\models\ProposalSearch',
                                            'text' => 'پروپوزال',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit2\investigation1\report\models\ReportSearch',
                                            'text' => 'گزارش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit2\investigation1\method\models\MethodSearch',
                                            'text' => 'روش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit2\investigation1\instruction\models\InstructionSearch',
                                            'text' => 'دستورالعمل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit2\investigation1\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit2\investigation1\reference\models\ReferenceSearch',
                                            'text' => 'منابع',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ب',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit2\investigation2\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ج',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit2\investigation3\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت د',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit2\investigation4\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ه',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit2\investigation5\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                            ]
                        ],
                        [
                            'text' => 'واحد 3',
                            'children' => [
                                [
                                    'text' => 'فعالیت الف',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit3\investigation1\source\models\SourceSearch',
                                            'text' => 'منشا',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit3\investigation1\proposal\models\ProposalSearch',
                                            'text' => 'پروپوزال',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit3\investigation1\report\models\ReportSearch',
                                            'text' => 'گزارش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit3\investigation1\method\models\MethodSearch',
                                            'text' => 'روش',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit3\investigation1\instruction\models\InstructionSearch',
                                            'text' => 'دستورالعمل',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit3\investigation1\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                        [
                                            'id' => 'nad\temporary\financial\unit3\investigation1\reference\models\ReferenceSearch',
                                            'text' => 'منابع',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ب',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit3\investigation2\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ج',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit3\investigation3\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت د',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit3\investigation4\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                                [
                                    'text' => 'فعالیت ه',
                                    'children' => [
                                        [
                                            'id' => 'nad\temporary\financial\unit3\investigation5\subject\models\SubjectSearch',
                                            'text' => 'سایرگزارشها',
                                            'icon' => 'fa fa-arrow-left',
                                        ],
                                    ]
                                ],
                            ]
                        ]
                    ]
                ],
                // [
                //     'text' => 'موقت',
                //     'children' => [
                //         [
                //             'text' => 'اداری',
                //             'children' => [
                //                 [
                //                     'text' => 'واحد 1',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit1\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit1\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit1\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit1\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit1\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit1\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit1\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit1\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit1\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit1\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit1\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ],
                //                 [
                //                     'text' => 'واحد 2',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit2\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit2\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit2\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit2\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit2\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit2\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit2\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit2\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit2\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit2\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit2\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ],
                //                 [
                //                     'text' => 'واحد 3',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit3\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit3\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit3\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit3\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit3\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit3\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit3\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit3\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit3\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit3\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\temporary\administrative\unit3\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ]
                //             ]
                //         ],
                //     ]
                // ],
                // [
                //     'text' => 'کارخانه',
                //     'children' => [
                //         [
                //             'text' => 'تولید',
                //             'children' => [
                //                 [
                //                     'text' => 'واحد 1',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit1\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit1\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit1\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit1\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit1\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit1\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit1\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit1\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit1\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit1\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit1\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ],
                //                 [
                //                     'text' => 'واحد 2',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit2\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit2\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit2\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit2\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit2\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit2\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit2\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit2\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit2\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit2\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit2\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ],
                //                 [
                //                     'text' => 'واحد 3',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit3\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit3\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit3\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit3\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit3\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit3\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit3\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit3\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit3\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit3\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit3\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ],
                //                 [
                //                     'text' => 'واحد 4',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit4\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit4\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit4\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit4\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit4\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit4\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit4\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit4\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit4\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit4\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit4\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ],
                //                 [
                //                     'text' => 'واحد 5',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit5\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit5\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit5\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit5\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit5\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit5\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\production\unit5\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit5\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit5\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit5\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\production\unit5\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ]
                //             ]
                //         ],
                //         [
                //             'text' => 'احداث',
                //             'children' => [
                //                 [
                //                     'text' => 'واحد 1',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit1\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit1\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit1\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit1\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit1\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit1\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit1\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit1\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit1\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit1\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit1\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ],
                //                 [
                //                     'text' => 'واحد 2',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit2\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit2\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit2\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit2\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit2\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit2\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit2\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit2\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit2\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit2\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit2\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ],
                //                 [
                //                     'text' => 'واحد 3',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit3\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit3\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit3\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit3\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit3\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit3\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\build\unit3\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit3\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit3\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit3\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\build\unit3\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ]
                //             ]
                //         ],
                //         [
                //             'text' => 'پشتیبانی',
                //             'children' => [
                //                 [
                //                     'text' => 'واحد 1',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit1\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit1\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit1\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit1\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit1\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit1\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit1\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit1\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit1\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit1\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit1\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ],
                //                 [
                //                     'text' => 'واحد 2',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit2\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit2\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit2\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit2\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit2\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit2\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit2\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit2\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit2\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit2\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit2\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ],
                //                 [
                //                     'text' => 'واحد 3',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit3\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit3\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit3\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit3\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit3\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit3\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\factory\support\unit3\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit3\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit3\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit3\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\factory\support\unit3\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ]
                //             ]
                //         ],
                //     ]
                // ],
                // [
                //     'text' => 'بندر',
                //     'children' => [
                //         [
                //             'text' => 'بندر',
                //             'children' => [
                //                 [
                //                     'text' => 'واحد 1',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit1\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit1\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit1\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit1\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit1\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit1\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit1\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit1\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit1\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit1\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit1\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ],
                //                 [
                //                     'text' => 'واحد 2',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit2\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit2\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit2\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit2\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit2\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit2\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit2\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit2\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit2\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit2\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit2\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ],
                //                 [
                //                     'text' => 'واحد 3',
                //                     'children' => [
                //                         [
                //                             'text' => 'فعالیت الف',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit3\investigation1\source\models\SourceSearch',
                //                                     'text' => 'منشا',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit3\investigation1\proposal\models\ProposalSearch',
                //                                     'text' => 'پروپوزال',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit3\investigation1\report\models\ReportSearch',
                //                                     'text' => 'گزارش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit3\investigation1\method\models\MethodSearch',
                //                                     'text' => 'روش',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit3\investigation1\instruction\models\InstructionSearch',
                //                                     'text' => 'دستورالعمل',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit3\investigation1\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit3\investigation1\reference\models\ReferenceSearch',
                //                                     'text' => 'منابع',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ب',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit3\investigation2\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ج',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit3\investigation3\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت د',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit3\investigation4\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                         [
                //                             'text' => 'فعالیت ه',
                //                             'children' => [
                //                                 [
                //                                     'id' => 'nad\seaport\wayside\unit3\investigation5\subject\models\SubjectSearch',
                //                                     'text' => 'سایرگزارشها',
                //                                     'icon' => 'fa fa-arrow-left',
                //                                 ],
                //                             ]
                //                         ],
                //                     ]
                //                 ]
                //             ]
                //         ],
                //     ]
                // ],
            ]
        ];
    }

    public static function getAllowedItemTypesForTree($allowedPreviews){
        $allItemTypes = self::getItemTypes();
        $finalAllowedTypes = $allItemTypes;

        // TODO filter the tree
        // foreach ($allItemTypes as $item) {
        //     # code...
        // }

        return $finalAllowedTypes;
    }


    // TODO This function is not used anymore, remove it asap
    public static function getCommonItemTypes(){
        return [
            'nad\common\modules\investigation\source\models\SourceSearch' => 'منشا',
            'nad\common\modules\investigation\proposal\models\ProposalSearch' => 'پروپوزال',
            'nad\common\modules\investigation\report\models\ReportSearch' => 'گزارش',
            'nad\common\modules\investigation\method\models\MethodSearch' => 'روش',
            'nad\common\modules\investigation\instruction\models\InstructionSearch' => 'دستورالعمل',
            'nad\common\modules\investigation\subject\models\SubjectSearch' => 'موضوع',
        ];
    }

    public static function removePotentialArchivedCondition($conditions){
        if(!isset($conditions))
            return null;

        $indexOfArchivedCondition = null;
        foreach ($conditions as $index => $item) {
            if(is_array($item) && isset($item['isArchived'])){
                $indexOfArchivedCondition = $index;
            }
        }

        if(isset($indexOfArchivedCondition)){
            unset($conditions[$indexOfArchivedCondition]);
        }

        return $conditions;
    }

    public static function getUsersList($seqAccessId){
        $rlaModels = RowLevelAccess::find()->where(['seq_access_id' => $seqAccessId])->all();
        $users = User::find()->where(['in', 'id', ArrayHelper::getColumn($rlaModels, 'user_id')])->all();

        $result = '';
        foreach ($users as $user) {
            $result .= $user->name . ' ' . $user->surname . ', ';
        }

        return trim($result, ', ');
    }

    /**
     * Generates list of hidden input tags for the given model attribute when the attribute's value is an array.
     *
     * @param Model $model
     * @param string $attribute
     * @param array $options
     * @return string
     */
    public static function activeHiddenInputList($model, $attribute, $options = [])
    {
        $str = '';
        $flattenedList = static::getflatInputNames($attribute, $model->$attribute);
        foreach ($flattenedList as $flattenAttribute) {
            $str.= Html::activeHiddenInput($model, $flattenAttribute, $options);
        }
        return $str;
    }

    /**
     * @param string $name
     * @param array $values
     * @return array
     */
    private static function getflatInputNames($name, array $values)
    {
        $flattened = [];
        foreach ($values as $key => $val) {
            $nameWithKey = $name . '[' . $key . ']';
            if (is_array($val)) {
                $flattened += static::getflatInputNames($nameWithKey, $val);
            } else {
                $flattened[] = $nameWithKey;
            }
        }
        return $flattened;
    }
}
