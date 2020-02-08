<?php

namespace nad\engineering\control\device\investigationMonitorMethods;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\engineering\control\device\investigationMonitorMethods\source\Module',
            'proposal' => 'nad\engineering\control\device\investigationMonitorMethods\proposal\Module',
            'report' => 'nad\engineering\control\device\investigationMonitorMethods\report\Module',
            'reference' => 'nad\engineering\control\device\investigationMonitorMethods\reference\Module',
            'method' => 'nad\engineering\control\device\investigationMonitorMethods\method\Module',
            'instruction' => 'nad\engineering\control\device\investigationMonitorMethods\instruction\Module',
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'برنامه',
                        'items' => [
                            [
                                'label' => 'افزودن منشا',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/source/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ منشاهای برنامه',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/source/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های منشا',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/source/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'منشاها',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/source/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای منشا',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/source/manage/index-history']
                            ],
                        ]
                    ]
                ]
            ],
            [
                'label' => 'پروپوزال',
                'items' => [
                    [
                        'label' => 'برنامه',
                        'items' => [
                            [
                                'label' => 'افزودن پروپوزال',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/proposal/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ پروپوزالهای برنامه',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/proposal/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های پروپوزال',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/proposal/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'پروپوزالها',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/proposal/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای پروپوزال',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/proposal/manage/index-history']
                            ],
                        ]
                    ]
                ]
            ],
            [
                'label' => 'گزارش',
                'items' => [
                    [
                        'label' => 'برنامه',
                        'items' => [
                            [
                                'label' => 'افزودن گزارش',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/report/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ گزارشهای برنامه',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/report/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های گزارش',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/report/category/index']
                            ],
                            [
                                'label' => 'گراف گزارشات',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/report/manage/generate-graph']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'گزارشها',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/report/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای گزارش',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/report/manage/index-history']
                            ],
                        ]
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'برنامه',
                        'items' => [
                            [
                                'label' => 'افزودن روش',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/method/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ روشهای برنامه',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/method/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های روش',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/method/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'روشها',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/method/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای روش',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/method/manage/index-history']
                            ],
                        ]
                    ]
                ]
            ],
            [
                'label' => 'دستورالعمل',
                'items' => [
                    [
                        'label' => 'برنامه',
                        'items' => [
                            [
                                'label' => 'افزودن دستورالعمل',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/instruction/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ دستورالعملهای برنامه',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/instruction/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های دستورالعمل',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/instruction/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'دستورالعملها',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/instruction/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای دستورالعمل',
                                'url' => ['/engineering/control/device/investigationMonitorMethods/instruction/manage/index-history']
                            ],
                        ]
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/engineering/control/device/investigationMonitorMethods/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/engineering/control/device/investigationMonitorMethods/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
