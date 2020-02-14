<?php

namespace nad\temporary\administrative\unit3\investigation1;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\temporary\administrative\unit3\investigation1\source\Module',
            'proposal' => 'nad\temporary\administrative\unit3\investigation1\proposal\Module',
            'report' => 'nad\temporary\administrative\unit3\investigation1\report\Module',
            'reference' => 'nad\temporary\administrative\unit3\investigation1\reference\Module',
            'method' => 'nad\temporary\administrative\unit3\investigation1\method\Module',
            'instruction' => 'nad\temporary\administrative\unit3\investigation1\instruction\Module',
            'subject' => 'nad\temporary\administrative\unit3\investigation1\subject\Module',
            'otherreport' => 'nad\temporary\administrative\unit3\investigation1\otherreport\Module',
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
                                'url' => ['/temporary/administrative/unit3/investigation1/source/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ منشاهای برنامه',
                                'url' => ['/temporary/administrative/unit3/investigation1/source/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های منشا',
                                'url' => ['/temporary/administrative/unit3/investigation1/source/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'منشاها',
                                'url' => ['/temporary/administrative/unit3/investigation1/source/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای منشا',
                                'url' => ['/temporary/administrative/unit3/investigation1/source/manage/index-history']
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
                                'url' => ['/temporary/administrative/unit3/investigation1/proposal/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ پروپوزالهای برنامه',
                                'url' => ['/temporary/administrative/unit3/investigation1/proposal/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های پروپوزال',
                                'url' => ['/temporary/administrative/unit3/investigation1/proposal/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'پروپوزالها',
                                'url' => ['/temporary/administrative/unit3/investigation1/proposal/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای پروپوزال',
                                'url' => ['/temporary/administrative/unit3/investigation1/proposal/manage/index-history']
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
                                'url' => ['/temporary/administrative/unit3/investigation1/report/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ گزارشهای برنامه',
                                'url' => ['/temporary/administrative/unit3/investigation1/report/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های گزارش',
                                'url' => ['/temporary/administrative/unit3/investigation1/report/category/index']
                            ],
                            [
                                'label' => 'گراف گزارشات',
                                'url' => ['/temporary/administrative/unit3/investigation1/report/manage/generate-graph']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'گزارشها',
                                'url' => ['/temporary/administrative/unit3/investigation1/report/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای گزارش',
                                'url' => ['/temporary/administrative/unit3/investigation1/report/manage/index-history']
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
                                'url' => ['/temporary/administrative/unit3/investigation1/method/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ روشهای برنامه',
                                'url' => ['/temporary/administrative/unit3/investigation1/method/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های روش',
                                'url' => ['/temporary/administrative/unit3/investigation1/method/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'روشها',
                                'url' => ['/temporary/administrative/unit3/investigation1/method/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای روش',
                                'url' => ['/temporary/administrative/unit3/investigation1/method/manage/index-history']
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
                                'url' => ['/temporary/administrative/unit3/investigation1/instruction/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ دستورالعملهای برنامه',
                                'url' => ['/temporary/administrative/unit3/investigation1/instruction/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های دستورالعمل',
                                'url' => ['/temporary/administrative/unit3/investigation1/instruction/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'دستورالعملها',
                                'url' => ['/temporary/administrative/unit3/investigation1/instruction/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای دستورالعمل',
                                'url' => ['/temporary/administrative/unit3/investigation1/instruction/manage/index-history']
                            ],
                        ]
                    ]
                ]
            ],
            [
                'label' => 'سایرگزارشها',
                'items' => [
                    [
                        'label' => 'برنامه',
                        'items' => [
                            [
                                'label' => 'افزودن موضوع',
                                'url' => ['/temporary/administrative/unit3/investigation1/subject/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ موضوعهای فعال',
                                'url' => ['/temporary/administrative/unit3/investigation1/subject/manage/index']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه',
                        'url' => ['/temporary/administrative/unit3/investigation1/subject/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/temporary/administrative/unit3/investigation1/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/temporary/administrative/unit3/investigation1/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
