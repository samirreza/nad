<?php

namespace nad\engineering\geotechnics\stage\investigationDesign;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\engineering\geotechnics\stage\investigationDesign\source\Module',
            'proposal' => 'nad\engineering\geotechnics\stage\investigationDesign\proposal\Module',
            'report' => 'nad\engineering\geotechnics\stage\investigationDesign\report\Module',
            'reference' => 'nad\engineering\geotechnics\stage\investigationDesign\reference\Module',
            // 'method' => 'nad\engineering\geotechnics\stage\investigationDesign\method\Module',
            // 'instruction' => 'nad\engineering\geotechnics\stage\investigationDesign\instruction\Module',
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
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/source/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ منشاهای برنامه',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/source/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های منشا',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/source/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'منشاها',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/source/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای منشا',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/source/manage/index-history']
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
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/proposal/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ پروپوزالهای برنامه',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/proposal/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های پروپوزال',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/proposal/category/index']
                            ],
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'پروپوزالها',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/proposal/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای پروپوزال',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/proposal/manage/index-history']
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
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/report/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ گزارشهای برنامه',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/report/manage/index']
                            ],
                            [
                                'label' => 'لیست رده های گزارش',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/report/category/index']
                            ],
                            [
                                'label' => 'گراف گزارشات',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/report/manage/generate-graph']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه ها',
                        'items' => [
                            [
                                'label' => 'گزارشها',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/report/manage/archived-index']
                            ],
                            [
                                'label' => 'روندهای گزارش',
                                'url' => ['/engineering/geotechnics/stage/investigationDesign/report/manage/index-history']
                            ],
                        ]
                    ]
                ]
            ],
            // [
            //     'label' => 'روش',
            //     'items' => [
            //         [
            //             'label' => 'برنامه',
            //             'items' => [
            //                 [
            //                     'label' => 'افزودن روش',
            //                     'url' => ['/engineering/geotechnics/stage/investigationDesign/method/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ روشهای برنامه',
            //                     'url' => ['/engineering/geotechnics/stage/investigationDesign/method/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های روش',
            //                     'url' => ['/engineering/geotechnics/stage/investigationDesign/method/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'روشها',
            //                     'url' => ['/engineering/geotechnics/stage/investigationDesign/method/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای روش',
            //                     'url' => ['/engineering/geotechnics/stage/investigationDesign/method/manage/index-history']
            //                 ],
            //             ]
            //         ]
            //     ]
            // ],
            // [
            //     'label' => 'دستورالعمل',
            //     'items' => [
            //         [
            //             'label' => 'برنامه',
            //             'items' => [
            //                 [
            //                     'label' => 'افزودن دستورالعمل',
            //                     'url' => ['/engineering/geotechnics/stage/investigationDesign/instruction/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ دستورالعملهای برنامه',
            //                     'url' => ['/engineering/geotechnics/stage/investigationDesign/instruction/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های دستورالعمل',
            //                     'url' => ['/engineering/geotechnics/stage/investigationDesign/instruction/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'دستورالعملها',
            //                     'url' => ['/engineering/geotechnics/stage/investigationDesign/instruction/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای دستورالعمل',
            //                     'url' => ['/engineering/geotechnics/stage/investigationDesign/instruction/manage/index-history']
            //                 ],
            //             ]
            //         ]
            //     ]
            // ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/engineering/geotechnics/stage/investigationDesign/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/engineering/geotechnics/stage/investigationDesign/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
