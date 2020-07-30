<?php

namespace nad\common;

use Yii;
use extensions\notification\models\Notification;
use nad\rla\models\RowLevelAccessRequest;

class SideMenu extends \theme\widgets\Menu
{
    protected function getMenuItems()
    {
        $user = Yii::$app->user;
        return [
            [
                'label' => 'اعلانات',
                'icon' => 'angle-right',
                'badge' => Notification::getUnreadNotificationsCountForUser(),
                'url' => ['/notif/index']
            ],
            [
                'label' => 'مدیریت',
                'icon' => 'angle-right',
                'items' => [
                    [
                        'label' => 'هماهنگی',
                        'icon' => 'angle-right',
                        'url' => ['/coordination/manage/index']
                    ],
                    [
                        'label' => 'راهبری',
                        'icon' => 'angle-right',
                        'url' => ['/general/manage/manager-actions'],
                        'visible' =>  $user->can('superuser'),
                    ]
                ]
            ],
            [
                'label' => 'فرایند',
                'icon' => 'angle-right',
                'items' => [
                    [
                        'label' => 'فرایند‌ها',
                        'icon' => 'angle-right',
                        'items' => [
                            // [
                            //     'label' => 'استخر',
                            //     'icon' => 'angle-right',
                            //     'url' => ['/pool']
                            // ],
                            [
                                'label' => 'آشنایی',
                                'icon' => 'angle-right',
                                'url' => ['/process/ird/introduction']
                            ],
                            [
                                'label' => 'ته نشینی',
                                'icon' => 'angle-right',
                                'url' => ['/process/ird/sedimentation']
                            ],
                            [
                                'label' => 'فیلتر شنی',
                                'icon' => 'angle-right',
                                'url' => ['/process/ird/filter']
                            ],
                            [
                                'label' => 'کارتریج',
                                'icon' => 'angle-right',
                                'url' => ['/process/ird/cartridge']
                            ],
                            [
                                'label' => 'آر او',
                                'icon' => 'angle-right',
                                'url' => ['/process/ird/ro']
                            ],
                            [
                                'label' => 'پساب',
                                'icon' => 'angle-right',
                                'url' => ['/process/ird/wastewater']
                            ],
                            [
                                'label' => 'میکروبیولوژی',
                                'icon' => 'angle-right',
                                'url' => ['/process/ird/microbial']
                            ],
                            [
                                'label' => 'گرافن',
                                'icon' => 'angle-right',
                                'url' => ['/process/ird/graphene']
                            ],
                            [
                                'label' => 'تکنولوژی های نو',
                                'icon' => 'angle-right',
                                'url' => ['/process/ird/newTechnology']
                            ],
                            [
                                'label' => 'هیدرولیک',
                                'icon' => 'angle-right',
                                'url' => ['/process/ird/hydraulic']
                            ],
                            [
                                'label' => 'انتقال حرارت',
                                'icon' => 'angle-right',
                                'url' => ['/process/ird/heattransfer']
                            ]

                        ]
                    ],
                    [
                        'label' => 'مواد',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'گندزدا',
                                'icon' => 'angle-right',
                                'url' => ['/process/materials/disinfectant']
                            ],
                            [
                                'label' => 'منعقدکننده',
                                'icon' => 'angle-right',
                                'url' => ['/process/materials/coagulant']
                            ],
                            [
                                'label' => 'شوینده قلیایی',
                                'icon' => 'angle-right',
                                'url' => ['/process/materials/alkalineWasher']
                            ],
                            [
                                'label' => 'شوینده اسیدی',
                                'icon' => 'angle-right',
                                'url' => ['/process/materials/acidicWasher']
                            ],
                            [
                                'label' => 'جی آر اس',
                                'icon' => 'angle-right',
                                'url' => ['/process/materials/grs']
                            ],
                            [
                                'label' => 'ضدرسوب',
                                'icon' => 'angle-right',
                                'url' => ['/process/materials/antisediment']
                            ],
                            [
                                'label' => 'ضدمیکروب',
                                'icon' => 'angle-right',
                                'url' => ['/process/materials/antimicrobial']
                            ],
                            [
                                'label' => 'رنگ ها',
                                'icon' => 'angle-right',
                                'url' => ['/process/materials/colors']
                            ],
                            [
                                'label' => 'لاک بیرنگ',
                                'icon' => 'angle-right',
                                'url' => ['/process/materials/lacquer']
                            ],
                        ],
                    ],
                    [
                        'label' => 'آزمایشگاه',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'آزمایش های بهره برداری',
                                'icon' => 'angle-right',
                                'url' => ['/process/laboratory/unit1']
                            ],
                            [
                                'label' => 'ارزیابی مواد مصرفی',
                                'icon' => 'angle-right',
                                'url' => ['/process/laboratory/unit2']
                            ],
                            [
                                'label' => 'تجهیزات آزمایشگاهی',
                                'icon' => 'angle-right',
                                'url' => ['/process/laboratory/unit3']
                            ],
                        ]
                    ]
                ]
            ],
            // [
            //     'label' => 'پژوهش',
            //     'icon' => 'angle-right',
            //     'items' => [
            //         [
            //             'label' => 'کنترل',
            //             'items' => [
            //                 [
            //                     'label' => 'گزارشات تولیدی',
            //                     'url' => '#',
            //                 ],
            //                 [
            //                     'label' => 'گزارشات اندازه گیری',
            //                     'url' => '#',
            //                 ],
            //                 [
            //                     'label' => 'گزارشات تجربی',
            //                     'url' => '#',
            //                 ],
            //                 [
            //                     'label' => 'مواد و کالای فرایندی',
            //                     'url' => '#',
            //                     // 'visible' => $user->can('research.material')
            //                 ],
            //                 [
            //                     'label' => 'تامین کنندگان',
            //                     'url' => '#',
            //                 ]
            //             ]
            //         ],
            //         [
            //             'label' => 'آزمایشگاه',
            //             'items' => [
            //                 [
            //                     'label' => 'دستور العمل ها',
            //                     'url' => '#',
            //                 ],
            //                 [
            //                     'label' => 'گزارشات ازمایش ها و اندازه گیری ها',
            //                     'url' => '#',
            //                 ],
            //                 [
            //                     'label' => 'تجهیزات، کالا، مواد',
            //                     'url' => '#'
            //                 ],
            //                 [
            //                     'label' => 'تامین کنندگان',
            //                     'url' => '#',
            //                 ],
            //                 [
            //                     'label' => 'نقاط نمونه گیری و اندازه گیری',
            //                     'url' => '#',
            //                 ],
            //             ]
            //         ]
            //     ]
            // ],
            [
                'label' => 'فنی',
                'icon' => 'angle-right',
                'items' => [
                    [
                        'label' => 'کلی',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'ابزار و لوازم مصرفی',
                                'url' => ['/equipment/tool/manage/index'],
                                'icon' => 'angle-right'
                            ],
                            [
                                'label' => 'مواد سرویس ونگهداری',
                                'url' => ['/equipment/material/manage/index'],
                                'icon' => 'angle-right'
                            ],
                            [
                                'label' => 'مدل',
                                'url' => ['/equipment/model/manage/index'],
                                'icon' => 'angle-right'
                            ],
                            [
                                'label' => 'نمونه‌ها',
                                'url' => ['/equipment/sample/manage/index'],
                                'icon' => 'angle-right',
                            ]
                        ]
                    ],
                    [
                        'label' => 'لوله کشی',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'مراحل',
                                'icon' => 'angle-right',
                                'url' => ['/engineering/piping/stage']
                            ],
                            [
                                'label' => 'دستگاه ها',
                                'icon' => 'angle-right',
                                'url' => ['/engineering/piping/device']
                            ]
                        ]
                    ],
                    [
                        'label' => 'مکانیک',
                        'icon' => 'angle-right',
                        'items' => [
                            // [
                            //     'label' => 'مراحل',
                            //     'icon' => 'angle-right',
                            //     'url' => ['/engineering/mechanics/stage']
                            // ],
                            [
                                'label' => 'دستگاه ها',
                                'icon' => 'angle-right',
                                'url' => ['/engineering/mechanics/device']
                            ]
                        ]
                    ],
                    [
                        'label' => 'برق',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'مراحل',
                                'icon' => 'angle-right',
                                'url' => ['/engineering/electricity/stage']
                            ],
                            [
                                'label' => 'دستگاه ها',
                                'icon' => 'angle-right',
                                'url' => ['/engineering/electricity/device']
                            ]
                        ]
                    ],
                    [
                        'label' => 'ابزاردقیق',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'مراحل',
                                'icon' => 'angle-right',
                                'url' => ['/engineering/instrument/stage']
                            ],
                            [
                                'label' => 'دستگاه ها',
                                'icon' => 'angle-right',
                                'url' => ['/engineering/instrument/device']
                            ]
                        ]
                    ],
                    [
                        'label' => 'کنترل',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'مراحل',
                                'icon' => 'angle-right',
                                'url' => ['/engineering/control/stage']
                            ],
                            [
                                'label' => 'دستگاه ها',
                                'icon' => 'angle-right',
                                'url' => ['/engineering/control/device']
                            ]
                        ]
                    ],
                    [
                        'label' => 'ساختمان',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'مراحل',
                                'icon' => 'angle-right',
                                'url' => ['/engineering/construction/stage']
                            ],
                            // [
                            //     'label' => 'دستگاه ها',
                            //     'icon' => 'angle-right',
                            //     'url' => ['/engineering/construction/device']
                            // ]
                        ]
                    ],
                    [
                        'label' => 'ژئوتکنیک',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'مراحل',
                                'icon' => 'angle-right',
                                'url' => ['/engineering/geotechnics/stage']
                            ],
                            // [
                            //     'label' => 'دستگاه ها',
                            //     'icon' => 'angle-right',
                            //     'url' => ['/engineering/geotechnics/device']
                            // ]
                        ]
                    ],
                    // [
                    //     'label' => 'منابع',
                    //     'icon' => 'angle-right',
                    //     'url' => ['/engineering/resource/manage/index']
                    // ],
                    // [
                    //     'label' => 'پلانت ها',
                    //     'icon' => 'angle-right',
                    //     'url' => ['/engineering/plant/manage/index']
                    // ],
                    // [
                    //     'label' => 'مدارک ، نقشه ها و اسناد پلانت ها',
                    //     'icon' => 'angle-right',
                    //     'url' => ['/engineering/document/manage/index']
                    // ],
                    // [
                    //     'label' => 'تجهیزات (شناسه و سوابق)',
                    //     'icon' => 'angle-right',
                    //     'url' => ['/engineering/equipment/type/manage/index'],
                    //     'visible' => $user->can('equipment.type')
                    // ]
                ]
            ],
            [
                'label' => 'بهره برداری',
                'icon' => 'angle-right',
                'items' => [
                    [
                        'label' => 'تولید',
                        'icon' => 'angle-right',
                        'url' => '#'
                    ],
                    [
                        'label' => 'تعمیرات',
                        'icon' => 'angle-right',
                        'url' => '#'
                    ],
                    [
                        'label' => 'انبار',
                        'icon' => 'angle-right',
                        'url' => '#'
                    ],
                    [
                        'label' => 'پشتیبانی',
                        'icon' => 'angle-right',
                        'url' => '#'
                    ]
                ]
            ],
            [
                'label' => 'احداث',
                'icon' => 'angle-right',
                'items' => [
                    [
                        'label' => 'ساختمان',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'واحد 1',
                                'icon' => 'angle-right',
                                'url' => ['/build/construction/unit1']
                            ],
                            [
                                'label' => 'واحد 2',
                                'icon' => 'angle-right',
                                'url' => ['/build/construction/unit2']
                            ],
                            [
                                'label' => 'واحد 3',
                                'icon' => 'angle-right',
                                'url' => ['/build/construction/unit3']
                            ],
                        ]
                    ],
                    [
                        'label' => 'تجهیزات',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'واحد 1',
                                'icon' => 'angle-right',
                                'url' => ['/build/equipment/unit1']
                            ],
                            [
                                'label' => 'واحد 2',
                                'icon' => 'angle-right',
                                'url' => ['/build/equipment/unit2']
                            ],
                            [
                                'label' => 'واحد 3',
                                'icon' => 'angle-right',
                                'url' => ['/build/equipment/unit3']
                            ],
                        ]
                    ],
                    [
                        'label' => 'چاه',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'واحد 1',
                                'icon' => 'angle-right',
                                'url' => ['/build/well/unit1']
                            ],
                            [
                                'label' => 'واحد 2',
                                'icon' => 'angle-right',
                                'url' => ['/build/well/unit2']
                            ],
                            [
                                'label' => 'واحد 3',
                                'icon' => 'angle-right',
                                'url' => ['/build/well/unit3']
                            ],
                        ]
                    ],
                ]
            ],
            [
                'label' => 'ساخت',
                'icon' => 'angle-right',
                'url' => '#'
            ],
            [
                'label' => 'تامین',
                'icon' => 'angle-right',
                'items' => [
                    [
                        'label' => 'خرید',
                        'icon' => 'angle-right',
                        'url' => ['/temporary/supply/unit1']
                    ],
                    [
                        'label' => 'ساخت و تعمیر',
                        'icon' => 'angle-right',
                        'url' => ['/temporary/supply/unit2']
                    ],
                    [
                        'label' => 'جابجایی',
                        'icon' => 'angle-right',
                        'url' => ['/temporary/supply/unit3']
                    ],
                    [
                        'label' => 'داده گاه تامین کنندگان',
                        'icon' => 'angle-right',
                        'url' => ['/supplier/manage/index'],
                        'visible' => $user->canAccessAny(['supplier.create', 'supplier.delete', 'supplier.update'])
                    ]
                ]
            ],
            [
                'label' => 'آی تی',
                'icon' => 'angle-right',
                'items' => [
                    [
                        'label' => 'واحد 1',
                        'icon' => 'angle-right',
                        'url' => ['/temporary/informationtech/unit1']
                    ],
                    [
                        'label' => 'واحد 2',
                        'icon' => 'angle-right',
                        'url' => ['/temporary/informationtech/unit2']
                    ],
                    [
                        'label' => 'واحد 3',
                        'icon' => 'angle-right',
                        'url' => ['/temporary/informationtech/unit3']
                    ],
                    [
                        'label' => 'شناسه تجهیزات',
                        'icon' => 'angle-right',
                        'url' => ['/it/equipment/type/manage/index'],
                        'visible' => $user->can('it.equipment-type'),
                    ],
                    [
                        'label' => 'گزارش های مدیریتی',
                        'icon' => 'angle-right',
                        'items' => [
                            [
                                'label' => 'شناسه تجهیزات',
                                'url' => ['/it/equipment/type/manage/report'],
                                'visible' => $user->can('manager')
                            ]
                        ]
                    ]
                ]
            ],
            [
                'label' => 'مالی',
                'icon' => 'angle-right',
                'items' => [
                    [
                        'label' => 'واحد 1',
                        'icon' => 'angle-right',
                        'url' => ['/temporary/financial/unit1']
                    ],
                    [
                        'label' => 'واحد 2',
                        'icon' => 'angle-right',
                        'url' => ['/temporary/financial/unit2']
                    ],
                    [
                        'label' => 'واحد 3',
                        'icon' => 'angle-right',
                        'url' => ['/temporary/financial/unit3']
                    ],
                ]
            ],
            [
                'label' => 'پشتیبانی',
                'icon' => 'angle-right',
                'items' => [
                    [
                        'label' => 'مرکز',
                        'icon' => 'angle-right',
                        'url' => '#'
                    ],
                    [
                        'label' => 'منظقه',
                        'icon' => 'angle-right',
                        'url' => '#'
                    ]
                ]
            ],
            // [
            //     'label' => 'موقت',
            //     'icon' => 'angle-right',
            //     'items' => [
            //         [
            //             'label' => 'اداری',
            //             'icon' => 'angle-right',
            //             'items' => [
            //                 [
            //                     'label' => 'واحد 1',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/temporary/administrative/unit1']
            //                 ],
            //                 [
            //                     'label' => 'واحد 2',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/temporary/administrative/unit2']
            //                 ],
            //                 [
            //                     'label' => 'واحد 3',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/temporary/administrative/unit3']
            //                 ],
            //             ]
            //         ],
            //     ]
            // ],
            // [
            //     'label' => 'کارخانه',
            //     'icon' => 'angle-right',
            //     'items' => [
            //         [
            //             'label' => 'تولید',
            //             'icon' => 'angle-right',
            //             'items' => [
            //                 [
            //                     'label' => 'فنی',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/factory/production/unit1']
            //                 ],
            //                 [
            //                     'label' => 'آزمایشگاه',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/factory/production/unit2']
            //                 ],
            //                 [
            //                     'label' => 'تولید',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/factory/production/unit3']
            //                 ],
            //                 [
            //                     'label' => 'تعمیرات و نگهداری',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/factory/production/unit4']
            //                 ],
            //                 [
            //                     'label' => 'انبار',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/factory/production/unit5']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'احداث',
            //             'icon' => 'angle-right',
            //             'items' => [
            //                 [
            //                     'label' => 'واحد 1',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/factory/build/unit1']
            //                 ],
            //                 [
            //                     'label' => 'واحد 2',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/factory/build/unit2']
            //                 ],
            //                 [
            //                     'label' => 'واحد 3',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/factory/build/unit3']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'پشتیبانی',
            //             'icon' => 'angle-right',
            //             'items' => [
            //                 [
            //                     'label' => 'واحد 1',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/factory/support/unit1']
            //                 ],
            //                 [
            //                     'label' => 'واحد 2',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/factory/support/unit2']
            //                 ],
            //                 [
            //                     'label' => 'واحد 3',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/factory/support/unit3']
            //                 ],
            //             ]
            //         ],
            //     ]
            // ],
            // [
            //     'label' => 'اداری',
            //     'icon' => 'angle-right',
            //     'items' => [
            //         [
            //             'label' => 'کارشناسان',
            //             'url' => ['/office/expert/manage/index'],
            //             'visible' => $user->can('office.manageExpert')
            //         ]
            //     ]
            // ],
            // [
            //     'label' => 'بندر',
            //     'icon' => 'angle-right',
            //     'items' => [
            //         [
            //             'label' => 'بندر',
            //             'icon' => 'angle-right',
            //             'items' => [
            //                 [
            //                     'label' => 'واحد 1',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/seaport/wayside/unit1']
            //                 ],
            //                 [
            //                     'label' => 'واحد 2',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/seaport/wayside/unit2']
            //                 ],
            //                 [
            //                     'label' => 'واحد 3',
            //                     'icon' => 'angle-right',
            //                     'url' => ['/seaport/wayside/unit3']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'مالی',
            //             'icon' => 'angle-right',
            //         ],
            //         [
            //             'label' => 'پشتیبانی',
            //             'icon' => 'angle-right',
            //         ]
            //     ]
            // ],
            [
                'label' => 'پیش نمایش داده گاه ها',
                'url' => ['/rla/manage/preview'],
                'icon' => 'angle-right',
                'visible' =>  !$user->can('superuser'),
            ],
            [
                'label' => 'درخواست دسترسی',
                'icon' => 'angle-right',
                'visible' =>  !$user->can('superuser'),
                'items' => [
                    [
                        'label' => 'درخواست پیش نمایش',
                        'url' => ['/rla/request/index', 'RowLevelAccessRequestSearch[type]' => '1'],
                        'icon' => 'angle-right',
                    ],
                    [
                        'label' => 'درخواست مدرک',
                        'url' => ['/rla/request/index', 'RowLevelAccessRequestSearch[type]' => '2'],
                        'icon' => 'angle-right',
                    ],
                ]
            ],
            // [
            //     'label' => 'تاریخچه تغییرات',
            //     'url' => ['/changelog/manage/list'],
            //     'icon' => 'angle-right',
            //     'visible' => $user->can('superuser')
            // ]
        ];
    }
}
