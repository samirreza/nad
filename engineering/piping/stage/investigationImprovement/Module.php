<?php

namespace nad\engineering\piping\stage\investigationImprovement;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\engineering\piping\stage\investigationImprovement\source\Module',
            'proposal' => 'nad\engineering\piping\stage\investigationImprovement\proposal\Module',
            'report' => 'nad\engineering\piping\stage\investigationImprovement\report\Module',
            'reference' => 'nad\engineering\piping\stage\investigationImprovement\reference\Module',
            'method' => 'nad\engineering\piping\stage\investigationImprovement\method\Module',
            'instruction' => 'nad\engineering\piping\stage\investigationImprovement\instruction\Module',
            'subject' => 'nad\engineering\piping\stage\investigationImprovement\subject\Module',
            'otherreport' => 'nad\engineering\piping\stage\investigationImprovement\otherreport\Module',
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
                                'url' => ['/engineering/piping/stage/investigationImprovement/source/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ منشاهای برنامه',
                                'url' => ['/engineering/piping/stage/investigationImprovement/source/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های منشا',
                                'url' => ['/engineering/piping/stage/investigationImprovement/source/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'منشاها',
                                'url' => ['/engineering/piping/stage/investigationImprovement/source/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای منشا',
                                'url' => ['/engineering/piping/stage/investigationImprovement/source/manage/index-history']
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
                                'url' => ['/engineering/piping/stage/investigationImprovement/proposal/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ پروپوزالهای برنامه',
                                'url' => ['/engineering/piping/stage/investigationImprovement/proposal/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های پروپوزال',
                                'url' => ['/engineering/piping/stage/investigationImprovement/proposal/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'پروپوزالها',
                                'url' => ['/engineering/piping/stage/investigationImprovement/proposal/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای پروپوزال',
                                'url' => ['/engineering/piping/stage/investigationImprovement/proposal/manage/index-history']
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
                                'url' => ['/engineering/piping/stage/investigationImprovement/report/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ گزارشهای برنامه',
                                'url' => ['/engineering/piping/stage/investigationImprovement/report/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های گزارش',
                                'url' => ['/engineering/piping/stage/investigationImprovement/report/category/index']
                            ],
                            [
                                'label' => 'گراف گزارشات',
                                'url' => ['/engineering/piping/stage/investigationImprovement/report/manage/generate-graph']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'گزارشها',
                                'url' => ['/engineering/piping/stage/investigationImprovement/report/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای گزارش',
                                'url' => ['/engineering/piping/stage/investigationImprovement/report/manage/index-history']
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
                                'url' => ['/engineering/piping/stage/investigationImprovement/method/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ روشهای برنامه',
                                'url' => ['/engineering/piping/stage/investigationImprovement/method/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های روش',
                                'url' => ['/engineering/piping/stage/investigationImprovement/method/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'روشها',
                                'url' => ['/engineering/piping/stage/investigationImprovement/method/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای روش',
                                'url' => ['/engineering/piping/stage/investigationImprovement/method/manage/index-history']
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
                                'url' => ['/engineering/piping/stage/investigationImprovement/instruction/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ دستورالعملهای برنامه',
                                'url' => ['/engineering/piping/stage/investigationImprovement/instruction/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های دستورالعمل',
                                'url' => ['/engineering/piping/stage/investigationImprovement/instruction/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'دستورالعملها',
                                'url' => ['/engineering/piping/stage/investigationImprovement/instruction/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای دستورالعمل',
                                'url' => ['/engineering/piping/stage/investigationImprovement/instruction/manage/index-history']
                            ],
                        ]
                    ]
                ]
            ],
            [
                'label' => 'سایرگزارشها',
                'items' => [
                    [
                        'label' => 'برنامه موضوع',
                        'items' => [
                            [
                                'label' => 'افزودن موضوع',
                                'url' => ['/engineering/piping/stage/investigationImprovement/subject/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ موضوعها',
                                'url' => ['/engineering/piping/stage/investigationImprovement/subject/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های موضوع',
                                'url' => ['/engineering/piping/stage/investigationImprovement/subject/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'برنامه گزارش',
                        'items' => [
                            [
                                'label' => 'افزودن گزارش',
                                'url' => ['/engineering/piping/stage/investigationImprovement/otherreport/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ گزارشها',
                                'url' => ['/engineering/piping/stage/investigationImprovement/otherreport/manage/index']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'گزارشها',
                                'url' => ['/engineering/piping/stage/investigationImprovement/otherreport/manage/archived-index']
                            ],
                            [
                                'label' => 'روندها',
                                'url' => ['/engineering/piping/stage/investigationImprovement/otherreport/manage/index-history']
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
                        'url' => ['/engineering/piping/stage/investigationImprovement/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/engineering/piping/stage/investigationImprovement/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
