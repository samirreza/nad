<?php

namespace nad\process\ird\hydraulic\investigation;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\ird\hydraulic\investigation\source\Module',
            'proposal' => 'nad\process\ird\hydraulic\investigation\proposal\Module',
            'report' => 'nad\process\ird\hydraulic\investigation\report\Module',
            'reference' => 'nad\process\ird\hydraulic\investigation\reference\Module',
            'method' => 'nad\process\ird\hydraulic\investigation\method\Module',
            'instruction' => 'nad\process\ird\hydraulic\investigation\instruction\Module',
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
                                'url' => ['/hydraulic/investigation/source/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ منشاهای برنامه',
                                'url' => ['/hydraulic/investigation/source/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های منشا',
                                'url' => ['/hydraulic/investigation/source/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'منشاها',
                                'url' => ['/hydraulic/investigation/source/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای منشا',
                                'url' => ['/hydraulic/investigation/source/manage/index-history']
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
                                'url' => ['/hydraulic/investigation/proposal/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ پروپوزالهای برنامه',
                                'url' => ['/hydraulic/investigation/proposal/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های پروپوزال',
                                'url' => ['/hydraulic/investigation/proposal/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'پروپوزالها',
                                'url' => ['/hydraulic/investigation/proposal/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای پروپوزال',
                                'url' => ['/hydraulic/investigation/proposal/manage/index-history']
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
                                'url' => ['/hydraulic/investigation/report/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ گزارشهای برنامه',
                                'url' => ['/hydraulic/investigation/report/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های گزارش',
                                'url' => ['/hydraulic/investigation/report/category/index']
                            ],
                            [
                                'label' => 'گراف گزارشات',
                                'url' => ['/hydraulic/investigation/report/manage/generate-graph']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'گزارشها',
                                'url' => ['/hydraulic/investigation/report/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای گزارش',
                                'url' => ['/hydraulic/investigation/report/manage/index-history']
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
                                'url' => ['/hydraulic/investigation/method/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ روشهای برنامه',
                                'url' => ['/hydraulic/investigation/method/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های روش',
                                'url' => ['/hydraulic/investigation/method/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'روشها',
                                'url' => ['/hydraulic/investigation/method/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای روش',
                                'url' => ['/hydraulic/investigation/method/manage/index-history']
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
                                'url' => ['/hydraulic/investigation/instruction/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ دستورالعملهای برنامه',
                                'url' => ['/hydraulic/investigation/instruction/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های دستورالعمل',
                                'url' => ['/hydraulic/investigation/instruction/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'دستورالعملها',
                                'url' => ['/hydraulic/investigation/instruction/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای دستورالعمل',
                                'url' => ['/hydraulic/investigation/instruction/manage/index-history']
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
                        'url' => ['/hydraulic/investigation/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/hydraulic/investigation/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
