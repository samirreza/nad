<?php

namespace nad\process\ird\introduction\investigation;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\ird\introduction\investigation\source\Module',
            'proposal' => 'nad\process\ird\introduction\investigation\proposal\Module',
            'report' => 'nad\process\ird\introduction\investigation\report\Module',
            'reference' => 'nad\process\ird\introduction\investigation\reference\Module',
            'method' => 'nad\process\ird\introduction\investigation\method\Module',
            'instruction' => 'nad\process\ird\introduction\investigation\instruction\Module',
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
                                'url' => ['/introduction/investigation/source/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ منشاهای برنامه',
                                'url' => ['/introduction/investigation/source/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های منشا',
                                'url' => ['/introduction/investigation/source/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'منشاها',
                                'url' => ['/introduction/investigation/source/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای منشا',
                                'url' => ['/introduction/investigation/source/manage/index-history']
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
                                'url' => ['/introduction/investigation/proposal/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ پروپوزالهای برنامه',
                                'url' => ['/introduction/investigation/proposal/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های پروپوزال',
                                'url' => ['/introduction/investigation/proposal/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'پروپوزالها',
                                'url' => ['/introduction/investigation/proposal/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای پروپوزال',
                                'url' => ['/introduction/investigation/proposal/manage/index-history']
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
                                'url' => ['/introduction/investigation/report/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ گزارشهای برنامه',
                                'url' => ['/introduction/investigation/report/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های گزارش',
                                'url' => ['/introduction/investigation/report/category/index']
                            ],
                            [
                                'label' => 'گراف گزارشات',
                                'url' => ['/introduction/investigation/report/manage/generate-graph']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'گزارشها',
                                'url' => ['/introduction/investigation/report/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای گزارش',
                                'url' => ['/introduction/investigation/report/manage/index-history']
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
                                'url' => ['/introduction/investigation/method/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ روشهای برنامه',
                                'url' => ['/introduction/investigation/method/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های روش',
                                'url' => ['/introduction/investigation/method/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'روشها',
                                'url' => ['/introduction/investigation/method/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای روش',
                                'url' => ['/introduction/investigation/method/manage/index-history']
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
                                'url' => ['/introduction/investigation/instruction/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ دستورالعملهای برنامه',
                                'url' => ['/introduction/investigation/instruction/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های دستورالعمل',
                                'url' => ['/introduction/investigation/instruction/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'دستورالعملها',
                                'url' => ['/introduction/investigation/instruction/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای دستورالعمل',
                                'url' => ['/introduction/investigation/instruction/manage/index-history']
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
                        'url' => ['/introduction/investigation/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/introduction/investigation/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
