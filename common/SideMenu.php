<?php

namespace nad\common;

use Yii;
use extensions\notification\models\Notification;

class SideMenu extends \theme\widgets\Menu
{
    protected function getMenuItems()
    {
        $user = Yii::$app->user;
        return [
            [
                'label' => 'اعلانات',
                'icon' => 'bullhorn',
                'badge' => Notification::getUnreadNotificationsCountForUser(),
                'url' => ['/notif/index']
            ],
            [
                'label' => 'فرایند',
                'items' => [
                    [
                        'label' => 'بررسی، پایش و طراحی',
                        'items' => [
                            [
                                'label' => 'استخر',
                                'url' => ['/pool']
                            ]
                        ]
                    ]
                ]
            ],
            [
                'label' => 'پژوهش',
                'icon' => 'flask',
                'items' => [
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
                                'url' => '#',
                                // 'visible' => $user->can('research.material')
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
                                'url' => '#'
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
                        'label' => 'تجهیزات (شناسه و سوابق)',
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
                        'label' => 'ابزار و لوازم مصرفی',
                        'url' => ['/equipment/tool/manage/index']
                    ],
                    [
                        'label' => 'مدل',
                        'url' => ['/equipment/model/manage/index']
                    ],
                    [
                        'label' => 'نمونه‌ها',
                        'url' => ['/equipment/sample/manage/index']
                    ],
                    [
                        'label' => 'مواد سرویس ونگهداری',
                        'url' => ['/equipment/material/manage/index']
                    ]
                ]
            ],
            [
                'label' => 'احداث',
                'icon' => 'cogs',
                'items' => [
                    [
                        'label' => 'مصالح ساختمانی',
                        'url' => ['/build/material/manage/index']
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
