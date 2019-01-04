<?php

namespace nad\common;

use Yii;

class SideMenu extends \theme\widgets\Menu
{
    protected function getMenuItems()
    {
        $user = Yii::$app->user;
        return [
            [
                'label' => 'پژوهش',
                'icon' => 'flask',
                'items' => [
                    [
                        'label' => 'بررسی',
                        'items' => [
                            [
                                'label' => 'منشا',
                                'url' => ['/research/source/manage/index'],
                                'visible' => $user->canAccessAny([
                                    'research.expert',
                                    'research.manage'
                                ])
                            ],
                            [
                                'label' => 'پروپوزال',
                                'url' => ['/research/proposal/manage/index'],
                                'visible' => $user->canAccessAny([
                                    'research.expert',
                                    'research.manage'
                                ])
                            ],
                            [
                                'label' => 'گزارش',
                                'url' => ['/research/project/manage/index'],
                                'visible' => $user->canAccessAny([
                                    'research.expert',
                                    'research.manage'
                                ])
                            ],
                            [
                                'label' => 'دستور العمل بهره برداری',
                                'url' => '#'
                            ],
                            [
                                'label' => 'منابع',
                                'url' => ['/research/investigation-resource'],
                                'visible' => $user->canAccessAny([
                                    'research.expert',
                                    'research.manage'
                                ])
                            ]
                        ]
                    ],
                    [
                        'label' => 'کنترل',
                        'items' => [
                            [
                                'label' => 'گزارشات تولیدی',
                                'url' => '#',
                            ],
                            [
                                'label' => 'گزارشات اندازه گیری',
                                'url' => '#',
                            ],
                            [
                                'label' => 'گزارشات تجربی',
                                'url' => '#',
                            ],
                            [
                                'label' => 'مواد و کالای فرایندی',
                                'url' => ['/research/material/manage/index'],
                                'visible' => $user->can('research.material')
                            ],
                            [
                                'label' => 'تامین کنندگان',
                                'url' => '#',
                            ]
                        ]
                    ],
                    [
                        'label' => 'آزمایشگاه',
                        'items' => [
                            [
                                'label' => 'دستور العمل ها',
                                'url' => '#',
                            ],
                            [
                                'label' => 'گزارشات ازمایش ها و اندازه گیری ها',
                                'url' => '#',
                            ],
                            [
                                'label' => 'تجهیزات، کالا، مواد',
                                'url' => ['/research/lab/manage/index'],
                                'visible' => $user->can('research.manage')
                            ],
                            [
                                'label' => 'تامین کنندگان',
                                'url' => '#',
                            ],
                            [
                                'label' => 'نقاط نمونه گیری و اندازه گیری',
                                'url' => '#',
                            ],
                        ]
                    ],
                    [
                        'label' => 'گزارش های مدیریتی',
                        'items' => [
                            [
                                'label' => 'منشا',
                                'url' => ['/research/source/manage/report'],
                                'visible' => $user->can('manager')
                            ],
                            [
                                'label' => 'پروپوزال',
                                'url' => ['/research/proposal/manage/report'],
                                'visible' => $user->can('manager')
                            ]
                        ]
                    ]
                ]
            ],
            [
                'label' => 'فنی',
                'icon' => 'wrench',
                'items' => [
                    [
                        'label' => 'منابع',
                        'icon' => 'tag',
                        'url' => ['/engineering/resource/manage/index']
                    ],
                    [
                        'label' => 'پلانت ها',
                        'icon' => 'tag',
                        'url' => ['/engineering/plant/manage/index']
                    ],
                    [
                        'label' => 'مکان ها',
                        'icon' => 'tag',
                        'url' => ['/engineering/location/manage/index']
                    ],
                    [
                        'label' => 'مدارک ، نقشه ها و اسناد پلانت ها',
                        'icon' => 'tag',
                        'url' => ['/engineering/document/manage/index']
                    ],
                    [
                        'label' => 'شناسه تجهیزات',
                        'icon' => 'tag',
                        'url' => ['/engineering/equipment/type/manage/index'],
                        'visible' => $user->can('equipment.type')
                    ]
                ]
            ],
            [
                'label' => 'تجهیزات',
                'icon' => 'cogs',
                'items' => [
                    [
                        'label' => 'ابزار',
                        'url' => ['/equipment/tool/manage/index']
                    ],
                    [
                        'label' => 'مدل',
                        'url' => ['/equipment/model/manage/index']
                    ],
                    [
                        'label' => 'نمونه‌های مورد نیاز برای ساخت',
                        'url' => ['/equipment/sample/manage/index']
                    ],
                    [
                        'label' => 'مواد سرویس ونگهداری',
                        'url' => ['/equipment/material/manage/index']
                    ]
                ]
            ],
            [
                'label' => 'بازرگانی',
                'icon' => 'briefcase',
                'items' => [
                    [
                        'label' => 'داده گاه تامین کنندگان',
                        'icon' => 'database',
                        'url' => ['/supplier/manage/index'],
                        'visible' => $user->canAccessAny(['supplier.create', 'supplier.delete', 'supplier.update'])
                    ]
                ]
            ],
            [
                'label' => 'پشتیبانی',
                'icon' => 'wrench'
            ],
            [
                'label' => 'آی تی',
                'icon' => 'laptop',
                'items' => [
                    [
                        'label' => 'شناسه تجهیزات',
                        'icon' => 'tag',
                        'url' => ['/it/equipment/type/manage/index'],
                        'visible' => $user->can('it.equipment-type'),
                    ],
                    [
                        'label' => 'گزارش های مدیریتی',
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
                'icon' => 'wrench'
            ],
            [
                'label' => 'اداری',
                'icon' => 'wrench',
                'items' => [
                    [
                        'label' => 'کارشناسان',
                        'url' => ['/office/expert/manage/index'],
                        'visible' => $user->can('office.manageExpert')
                    ]
                ]
            ],
            [
                'label' => 'بندر',
                'icon' => 'wrench'
            ],
            [
                'label' => 'کاربران',
                'url' => ['/user/manage/index'],
                'icon' => 'user',
                'visible' => $user->can('superuser')
            ],
            [
                'label' => 'تنظیمات سیستم',
                'url' => ['/setting/manage/index'],
                'icon' => 'cog',
                'visible' =>  $user->can('superuser')
            ],
            [
                'label' => 'تاریخچه تغییرات',
                'url' => ['/changelog/manage/list'],
                'icon' => 'calendar',
                'visible' => $user->can('superuser')
            ]
        ];
    }
}
