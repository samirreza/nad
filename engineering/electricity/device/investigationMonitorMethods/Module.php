<?php

namespace nad\engineering\electricity\device\investigationMonitorMethods;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\engineering\electricity\device\investigationMonitorMethods\source\Module',
            'proposal' => 'nad\engineering\electricity\device\investigationMonitorMethods\proposal\Module',
            'report' => 'nad\engineering\electricity\device\investigationMonitorMethods\report\Module',
            'reference' => 'nad\engineering\electricity\device\investigationMonitorMethods\reference\Module',
            'method' => 'nad\engineering\electricity\device\investigationMonitorMethods\method\Module',
            'instruction' => 'nad\engineering\electricity\device\investigationMonitorMethods\instruction\Module',
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
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/source/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ منشاهای برنامه',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/source/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های منشا',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/source/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'منشاها',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/source/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای منشا',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/source/manage/index-history']
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
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/proposal/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ پروپوزالهای برنامه',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/proposal/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های پروپوزال',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/proposal/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'پروپوزالها',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/proposal/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای پروپوزال',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/proposal/manage/index-history']
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
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/report/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ گزارشهای برنامه',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/report/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های گزارش',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/report/category/index']
                            ],
                            [
                                'label' => 'گراف گزارشات',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/report/manage/generate-graph']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'گزارشها',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/report/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای گزارش',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/report/manage/index-history']
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
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/method/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ روشهای برنامه',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/method/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های روش',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/method/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'روشها',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/method/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای روش',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/method/manage/index-history']
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
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/instruction/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ دستورالعملهای برنامه',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/instruction/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های دستورالعمل',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/instruction/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'دستورالعملها',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/instruction/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای دستورالعمل',
                                'url' => ['/engineering/electricity/device/investigationMonitorMethods/instruction/manage/index-history']
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
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
