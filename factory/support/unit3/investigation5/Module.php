<?php

namespace nad\factory\support\unit3\investigation5;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            // 'source' => 'nad\factory\support\unit3\investigation5\source\Module',
            // 'proposal' => 'nad\factory\support\unit3\investigation5\proposal\Module',
            // 'report' => 'nad\factory\support\unit3\investigation5\report\Module',
            'reference' => 'nad\factory\support\unit3\investigation5\reference\Module',
            // 'method' => 'nad\factory\support\unit3\investigation5\method\Module',
            // 'instruction' => 'nad\factory\support\unit3\investigation5\instruction\Module',
            'subject' => 'nad\factory\support\unit3\investigation5\subject\Module',
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
            //                     'url' => ['/factory/support/unit3/investigation5/source/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ منشاهای برنامه',
            //                     'url' => ['/factory/support/unit3/investigation5/source/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های منشا',
            //                     'url' => ['/factory/support/unit3/investigation5/source/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'منشاها',
            //                     'url' => ['/factory/support/unit3/investigation5/source/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای منشا',
            //                     'url' => ['/factory/support/unit3/investigation5/source/manage/index-history']
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
            //                     'url' => ['/factory/support/unit3/investigation5/proposal/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ پروپوزالهای برنامه',
            //                     'url' => ['/factory/support/unit3/investigation5/proposal/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های پروپوزال',
            //                     'url' => ['/factory/support/unit3/investigation5/proposal/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'پروپوزالها',
            //                     'url' => ['/factory/support/unit3/investigation5/proposal/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای پروپوزال',
            //                     'url' => ['/factory/support/unit3/investigation5/proposal/manage/index-history']
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
            //                     'url' => ['/factory/support/unit3/investigation5/report/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ گزارشهای برنامه',
            //                     'url' => ['/factory/support/unit3/investigation5/report/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های گزارش',
            //                     'url' => ['/factory/support/unit3/investigation5/report/category/index']
            //                 ],
            //                 [
            //                     'label' => 'گراف گزارشات',
            //                     'url' => ['/factory/support/unit3/investigation5/report/manage/generate-graph']
            //                 ]
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'گزارشها',
            //                     'url' => ['/factory/support/unit3/investigation5/report/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای گزارش',
            //                     'url' => ['/factory/support/unit3/investigation5/report/manage/index-history']
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
            //                     'url' => ['/factory/support/unit3/investigation5/method/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ روشهای برنامه',
            //                     'url' => ['/factory/support/unit3/investigation5/method/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های روش',
            //                     'url' => ['/factory/support/unit3/investigation5/method/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'روشها',
            //                     'url' => ['/factory/support/unit3/investigation5/method/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای روش',
            //                     'url' => ['/factory/support/unit3/investigation5/method/manage/index-history']
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
            //                     'url' => ['/factory/support/unit3/investigation5/instruction/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ دستورالعملهای برنامه',
            //                     'url' => ['/factory/support/unit3/investigation5/instruction/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های دستورالعمل',
            //                     'url' => ['/factory/support/unit3/investigation5/instruction/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'دستورالعملها',
            //                     'url' => ['/factory/support/unit3/investigation5/instruction/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای دستورالعمل',
            //                     'url' => ['/factory/support/unit3/investigation5/instruction/manage/index-history']
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
                                'url' => ['/factory/support/unit3/investigation5/subject/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ موضوعهای فعال',
                                'url' => ['/factory/support/unit3/investigation5/subject/manage/index']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه',
                        'url' => ['/factory/support/unit3/investigation5/subject/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/factory/support/unit3/investigation5/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/factory/support/unit3/investigation5/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
