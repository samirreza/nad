<?php

namespace nad\seaport\wayside\unit3\investigation4;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            // 'source' => 'nad\seaport\wayside\unit3\investigation4\source\Module',
            // 'proposal' => 'nad\seaport\wayside\unit3\investigation4\proposal\Module',
            // 'report' => 'nad\seaport\wayside\unit3\investigation4\report\Module',
            'reference' => 'nad\seaport\wayside\unit3\investigation4\reference\Module',
            // 'method' => 'nad\seaport\wayside\unit3\investigation4\method\Module',
            // 'instruction' => 'nad\seaport\wayside\unit3\investigation4\instruction\Module',
            'subject' => 'nad\seaport\wayside\unit3\investigation4\subject\Module',
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
            //                     'url' => ['/seaport/wayside/unit3/investigation4/source/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ منشاهای برنامه',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/source/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های منشا',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/source/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'منشاها',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/source/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای منشا',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/source/manage/index-history']
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
            //                     'url' => ['/seaport/wayside/unit3/investigation4/proposal/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ پروپوزالهای برنامه',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/proposal/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های پروپوزال',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/proposal/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'پروپوزالها',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/proposal/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای پروپوزال',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/proposal/manage/index-history']
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
            //                     'url' => ['/seaport/wayside/unit3/investigation4/report/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ گزارشهای برنامه',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/report/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های گزارش',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/report/category/index']
            //                 ],
            //                 [
            //                     'label' => 'گراف گزارشات',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/report/manage/generate-graph']
            //                 ]
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'گزارشها',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/report/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای گزارش',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/report/manage/index-history']
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
            //                     'url' => ['/seaport/wayside/unit3/investigation4/method/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ روشهای برنامه',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/method/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های روش',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/method/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'روشها',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/method/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای روش',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/method/manage/index-history']
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
            //                     'url' => ['/seaport/wayside/unit3/investigation4/instruction/manage/create']
            //                 ],
            //                 [
            //                     'label' => 'لیست‌ دستورالعملهای برنامه',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/instruction/manage/index']
            //                 ],
            //                 [
            //                     'label' => 'لیست رده های دستورالعمل',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/instruction/category/index']
            //                 ],
            //             ]
            //         ],
            //         [
            //             'label' => 'داده گاه ها',
            //             'items' => [
            //                 [
            //                     'label' => 'دستورالعملها',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/instruction/manage/archived-index']
            //                 ],
            //                 [
            //                     'label' => 'روندهای دستورالعمل',
            //                     'url' => ['/seaport/wayside/unit3/investigation4/instruction/manage/index-history']
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
                                'url' => ['/seaport/wayside/unit3/investigation4/subject/manage/create']
                            ],
                            [
                                'label' => 'لیست‌ موضوعهای فعال',
                                'url' => ['/seaport/wayside/unit3/investigation4/subject/manage/index']
                            ]
                        ]
                    ],
                    [
                        'label' => 'داده گاه',
                        'url' => ['/seaport/wayside/unit3/investigation4/subject/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/seaport/wayside/unit3/investigation4/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/seaport/wayside/unit3/investigation4/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
