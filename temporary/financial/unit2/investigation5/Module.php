<?php

namespace nad\temporary\financial\unit2\investigation5;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            // 'source' => 'nad\temporary\financial\unit2\investigation5\source\Module',
            // 'proposal' => 'nad\temporary\financial\unit2\investigation5\proposal\Module',
            // 'report' => 'nad\temporary\financial\unit2\investigation5\report\Module',
            'reference' => 'nad\temporary\financial\unit2\investigation5\reference\Module',
            // 'method' => 'nad\temporary\financial\unit2\investigation5\method\Module',
            // 'instruction' => 'nad\temporary\financial\unit2\investigation5\instruction\Module',
            'subject' => 'nad\temporary\financial\unit2\investigation5\subject\Module',
        ];
        $this->horizontalMenuItems = [
            // [
            //     'label' => 'منشا',
            //     'items' => [
            //         [
            //             'label' => 'برنامه',
            //             'items' => [
            //                 [
            //                     'label' => 'افزودن منشا',
            //                     'url' => ['/temporary/financial/unit2/investigation5/source/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ منشاهای برنامه',
            //                     'url' => ['/temporary/financial/unit2/investigation5/source/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های منشا',
            //                     'url' => ['/temporary/financial/unit2/investigation5/source/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'منشاها',
            //                     'url' => ['/temporary/financial/unit2/investigation5/source/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای منشا',
            //                     'url' => ['/temporary/financial/unit2/investigation5/source/manage/index-history']
            //                 ],
            //             ]
            //         ]
            //     ]
            // ],
            // [
            //     'label' => 'پروپوزال',
            //     'items' => [
            //         [
            //             'label' => 'برنامه',
            //             'items' => [
            //                 [
            //                     'label' => 'افزودن پروپوزال',
            //                     'url' => ['/temporary/financial/unit2/investigation5/proposal/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ پروپوزالهای برنامه',
            //                     'url' => ['/temporary/financial/unit2/investigation5/proposal/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های پروپوزال',
            //                     'url' => ['/temporary/financial/unit2/investigation5/proposal/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'پروپوزالها',
            //                     'url' => ['/temporary/financial/unit2/investigation5/proposal/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای پروپوزال',
            //                     'url' => ['/temporary/financial/unit2/investigation5/proposal/manage/index-history']
            //                 ],
            //             ]
            //         ]
            //     ]
            // ],
            // [
            //     'label' => 'گزارش',
            //     'items' => [
            //         [
            //             'label' => 'برنامه',
            //             'items' => [
            //                 [
            //                     'label' => 'افزودن گزارش',
            //                     'url' => ['/temporary/financial/unit2/investigation5/report/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ گزارشهای برنامه',
            //                     'url' => ['/temporary/financial/unit2/investigation5/report/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های گزارش',
            //                     'url' => ['/temporary/financial/unit2/investigation5/report/category/index']
            //                 ],
            //                 [
            //                     'label' => 'گراف گزارشات',
            //                     'url' => ['/temporary/financial/unit2/investigation5/report/manage/generate-graph']
            //                 ]
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'گزارشها',
            //                     'url' => ['/temporary/financial/unit2/investigation5/report/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای گزارش',
            //                     'url' => ['/temporary/financial/unit2/investigation5/report/manage/index-history']
            //                 ],
            //             ]
            //         ]
            //     ]
            // ],
            // [
            //     'label' => 'روش',
            //     'items' => [
            //         [
            //             'label' => 'برنامه',
            //             'items' => [
            //                 [
            //                     'label' => 'افزودن روش',
            //                     'url' => ['/temporary/financial/unit2/investigation5/method/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ روشهای برنامه',
            //                     'url' => ['/temporary/financial/unit2/investigation5/method/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های روش',
            //                     'url' => ['/temporary/financial/unit2/investigation5/method/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'روشها',
            //                     'url' => ['/temporary/financial/unit2/investigation5/method/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای روش',
            //                     'url' => ['/temporary/financial/unit2/investigation5/method/manage/index-history']
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
            //                     'url' => ['/temporary/financial/unit2/investigation5/instruction/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ دستورالعملهای برنامه',
            //                     'url' => ['/temporary/financial/unit2/investigation5/instruction/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های دستورالعمل',
            //                     'url' => ['/temporary/financial/unit2/investigation5/instruction/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'دستورالعملها',
            //                     'url' => ['/temporary/financial/unit2/investigation5/instruction/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای دستورالعمل',
            //                     'url' => ['/temporary/financial/unit2/investigation5/instruction/manage/index-history']
            //                 ],
            //             ]
            //         ]
            //     ]
            // ],
            [
                'label' => 'سایرگزارشها',
                'items' => [
                    [
                        'label' => 'برنامه',
                        'items' => [
                            [
                                'label' => 'افزودن موضوع',
                                'url' => ['/temporary/financial/unit2/investigation5/subject/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ موضوعهای فعال',
                                'url' => ['/temporary/financial/unit2/investigation5/subject/manage/index']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه',
                        'url' => ['/temporary/financial/unit2/investigation5/subject/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/temporary/financial/unit2/investigation5/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/temporary/financial/unit2/investigation5/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
