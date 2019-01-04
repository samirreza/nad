<?php

use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;

$this->title = $model->title;
$this->params['breadcrumbs'] = [
    'تجهیزات',
    ['label' => 'انواع', 'url' => ['index']],
    $model->category->title,
    $model->title
];

?>

<div class="page-view">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'update' => ['label' => 'ویرایش'],
            'delete' => ['label' => 'حذف'],
            'index' => ['label' => 'انواع تجهیزات'],
            'parts' => [
                'label' => 'لیست قطعات',
                'url' => ['details/part/index', 'typeId' => $model->id],
                'type' => 'warning',
                'icon' => 'cog'
            ],
            'fittings' => [
                'label' => 'لیست اتصالات',
                'url' => ['details/fitting/index', 'typeId' => $model->id],
                'type' => 'success',
                'icon' => 'chain'
            ],
            'documents' => [
                'label' => 'لیست اسناد',
                'color' => 'blue',
                'icon' => 'file',
                'url' => [
                    '/engineering/equipment/document/manage/index',
                    'equipmentTypeId' => $model->id
                ],
                'visibleFor' => ['equipment.document']
            ]
        ]
    ]) ?>
    <div class="row">
        <div class="col-md-7">
            <?php Panel::begin(['title' => 'اطلاعات اصلی']) ?>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'uniqueCode',
                        'category.title',
                        'title',
                        [
                            'label' => 'تعداد قطعات',
                            'value' => $model->getParts()->count(),
                            'format' => 'farsiNumber'
                        ],
                        [
                            'label' => 'تعداد اتصالات',
                            'value' => $model->getFittings()->count(),
                            'format' => 'farsiNumber'
                        ],
                        [
                            'label' => 'تعداد اسناد',
                            'value' => $model->getDocuments()->count(),
                            'format' => 'farsiNumber'
                        ],
                        'createdAt:date',
                        'updatedAt:datetime'
                    ]
                ]) ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-5">
            <?php Panel::begin(['title' => 'توضیحات']) ?>
                <div class="well">
                    <?= $model->description ?>
                </div>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
