<?php

use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use nad\common\modules\investigation\reference\models\Reference;

?>

<div class="reference-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'منبع جدید',
                'type' => 'success',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'resource-index-gridviewpjax'
                ]
            ]
        ]
    ]) ?>
    <div class="sliding-form-wrapper"></div>
    <?php Panel::begin(['title' => 'منابع']) ?>
        <?php Pjax::begin(['id' => 'resource-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'uniqueCode',
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'جست‌و‌جو شناسه'
                        ]
                    ],
                    [
                        'attribute' => 'title',
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'جست‌و‌جو عنوان'
                        ]
                    ],
                    [
                        'attribute' => 'type',
                        'value' => function ($model) {
                            return Reference::getTypeLabels()[$model->type];
                        },
                        'filter' => Reference::getTypeLabels()
                    ],
                    // 'author',
                    // 'publishedYear:farsiNumber',
                    // [
                    //     'attribute' => 'createdBy',
                    //     'value' => function ($model) {
                    //         return $model->researcher->fullName;
                    //     }
                    // ],
                    // [
                    //     'attribute' => 'tags',
                    //     'value' => function ($model) {
                    //         return $model->getTagsAsString();
                    //     }
                    // ],
                    // [
                    //     'header' => 'فایل',
                    //     'format' => 'raw',
                    //     'value' => function ($model) {
                    //         return Html::a(
                    //             'دانلود فایل',
                    //             $model->getFile('resource')->getUrl(),
                    //             [
                    //                 'data-pjax' => '0'
                    //             ]
                    //         );
                    //     }
                    // ],
                    [
                        'attribute' => 'createdAt',
                        'value' => function ($model) {
                            return Yii::$app->formatter->asDate(
                                $model->createdAt,
                                'Y-M-d'
                            );
                        }
                    ],
                    [
                        'header' => 'دسترسی',
                        'class' => 'core\grid\AjaxActionColumn'
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
