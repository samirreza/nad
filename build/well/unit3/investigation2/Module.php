<?php

namespace nad\build\well\unit3\investigation2;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            // 'source' => 'nad\build\well\unit3\investigation2\source\Module',
            // 'proposal' => 'nad\build\well\unit3\investigation2\proposal\Module',
            // 'report' => 'nad\build\well\unit3\investigation2\report\Module',
            'reference' => 'nad\build\well\unit3\investigation2\reference\Module',
            // 'method' => 'nad\build\well\unit3\investigation2\method\Module',
            // 'instruction' => 'nad\build\well\unit3\investigation2\instruction\Module',
            'subject' => 'nad\build\well\unit3\investigation2\subject\Module',
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
            //                     'url' => ['/build/well/unit3/investigation2/source/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ منشاهای برنامه',
            //                     'url' => ['/build/well/unit3/investigation2/source/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های منشا',
            //                     'url' => ['/build/well/unit3/investigation2/source/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'منشاها',
            //                     'url' => ['/build/well/unit3/investigation2/source/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای منشا',
            //                     'url' => ['/build/well/unit3/investigation2/source/manage/index-history']
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
            //                     'url' => ['/build/well/unit3/investigation2/proposal/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ پروپوزالهای برنامه',
            //                     'url' => ['/build/well/unit3/investigation2/proposal/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های پروپوزال',
            //                     'url' => ['/build/well/unit3/investigation2/proposal/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'پروپوزالها',
            //                     'url' => ['/build/well/unit3/investigation2/proposal/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای پروپوزال',
            //                     'url' => ['/build/well/unit3/investigation2/proposal/manage/index-history']
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
            //                     'url' => ['/build/well/unit3/investigation2/report/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ گزارشهای برنامه',
            //                     'url' => ['/build/well/unit3/investigation2/report/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های گزارش',
            //                     'url' => ['/build/well/unit3/investigation2/report/category/index']
            //                 ],
            //                 [
            //                     'label' => 'گراف گزارشات',
            //                     'url' => ['/build/well/unit3/investigation2/report/manage/generate-graph']
            //                 ]
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'گزارشها',
            //                     'url' => ['/build/well/unit3/investigation2/report/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای گزارش',
            //                     'url' => ['/build/well/unit3/investigation2/report/manage/index-history']
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
            //                     'url' => ['/build/well/unit3/investigation2/method/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ روشهای برنامه',
            //                     'url' => ['/build/well/unit3/investigation2/method/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های روش',
            //                     'url' => ['/build/well/unit3/investigation2/method/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'روشها',
            //                     'url' => ['/build/well/unit3/investigation2/method/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای روش',
            //                     'url' => ['/build/well/unit3/investigation2/method/manage/index-history']
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
            //                     'url' => ['/build/well/unit3/investigation2/instruction/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ دستورالعملهای برنامه',
            //                     'url' => ['/build/well/unit3/investigation2/instruction/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های دستورالعمل',
            //                     'url' => ['/build/well/unit3/investigation2/instruction/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'دستورالعملها',
            //                     'url' => ['/build/well/unit3/investigation2/instruction/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای دستورالعمل',
            //                     'url' => ['/build/well/unit3/investigation2/instruction/manage/index-history']
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
                                'url' => ['/build/well/unit3/investigation2/subject/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ موضوعهای فعال',
                                'url' => ['/build/well/unit3/investigation2/subject/manage/index']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه',
                        'url' => ['/build/well/unit3/investigation2/subject/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/build/well/unit3/investigation2/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/build/well/unit3/investigation2/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
