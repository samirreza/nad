<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'لیست تامین کنندگان', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="supplier-view">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'update' => [
                'label' => 'ویرایش',
                'visibleFor' => ['supplier.update']
            ],
            'delete' => [
                'label' => 'حذف',
                'visibleFor' => ['supplier.delete']
            ],
            'index' => [
                'label' => 'لیست تامین کنندگان',
                'visibleFor' => ['supplier.create']
            ],
            'phonebook' => [
                'label' => 'دفترچه تلفن',
                'url' => ['phonebook/manage/list', 'supplierId' => $model->id],
                'icon' => 'phone',
                'type' => 'success',
                'visibleFor' => ['supplier.create']
            ]
        ]
    ]) ?>

    <div class="row">
        <div class="col-md-4">
            <?php Panel::begin([
                'title' => 'تجهیزات تامین کننده',
            ]) ?>
            <?php
            if (count($model->equipTypes) != 0) {
                foreach ($model->equipTypes as $equipment) {
                    echo DetailView::widget([
                        'model' => $equipment,
                        'attributes' => [
                            [
                                'attribute' => 'عنوان',
                                'value' => $equipment->title,
                            ],
                            [
                                'attribute' => 'شناسه یکتا',
                                'value' => $equipment->uniqueCode,
                            ],
                        ],
                        'options' => [
                            'class' => 'table table-striped table-bordered detail-view',
                            'style' => 'table-layout: fixed; font-size:14px;'
                        ]
                    ]);
                }
            } else {
                echo Html::tag('p', 'هنوز تجهیزاتی برای این تامین کننده ثبت نگردیده است.', [
                    'style' => 'font-weight: bold; text-align: center'
                ]);
            }
            ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
            <?php Panel::begin([
                'title' => 'مواد تامین کننده',
            ]) ?>
            <?php
            if (count($model->matTypes) != 0) {
                foreach ($model->matTypes as $material) {
                    echo DetailView::widget([
                        'model' => $material,
                        'attributes' => [
                            [
                                'attribute' => 'عنوان',
                                'value' => $material->title,
                            ],
                            [
                                'attribute' => 'شناسه یکتا',
                                'value' => $material->uniqueCode,
                            ],
                        ],
                        'options' => [
                            'class' => 'table table-striped table-bordered detail-view',
                            'style' => 'table-layout: fixed; font-size:14px;'
                        ]
                    ]);
                }
            } else {
                echo Html::tag('p', 'هنوز موادی برای این تامین کننده ثبت نگردیده است.', [
                    'style' => 'font-weight: bold; text-align: center'
                ]);
            }
            ?>

            <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
            <?php Panel::begin([
                'title' => 'قطعات تامین کننده',
            ]) ?>
            <?php
            if (count($model->partsRelation) != 0) {
                foreach ($model->partsRelation as $part) {
                    echo DetailView::widget([
                        'model' => $part,
                        'attributes' => [
                            [
                                'attribute' => 'عنوان',
                                'value' => $part->title,
                            ],
                            [
                                'attribute' => 'شناسه یکتا',
                                'value' => $part->uniqueCode,
                            ],
                        ],
                        'options' => [
                            'class' => 'table table-striped table-bordered detail-view',
                            'style' => 'font-size:14px;'
                        ]
                    ]);
                }
            } else {
                echo Html::tag('p', 'هنوز قطعه ای برای این تامین کننده ثبت نگردیده است.', [
                    'style' => 'font-weight: bold; text-align: center'
                ]);
            }
            ?>

            <?php Panel::end() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'اطلاعات تامین کننده',
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'phone',
                    'fax',
                    'email',
                    'website',
                    'isActive:boolean',
                    [
                        'attribute' => 'isForeign',
                        'value' => function ($model) {
                            return $model->isForeign ? 'خارجی' : 'داخلی';
                        }
                    ],
                    [
                        'attribute' => 'type',
                        'value' => $model->getType()
                    ],
                    [
                        'attribute' => 'paymentType',
                        'value' => $model->getPaymenttype()

                    ],
                    'createdAt:date',
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'شماره تماس های تامین کننده',
            ]) ?>
            <?php
            if (count($model->phonesAsArray) != 0) {
                foreach ($model->phonesAsArray as $phone) {
                    echo DetailView::widget([
                        'model' => $phone,
                        'attributes' => [
                            [
                                'attribute' => 'نام',
                                'value' => $phone['name'],
                            ],
                            [
                                'attribute' => 'سمت',
                                'value' => $phone['job'],
                            ],
                            [
                                'attribute' => 'شماره تماس',
                                'value' => $phone['phone'],
                            ],
                        ],
                        'options' => [
                            'class' => 'table table-striped table-bordered detail-view',
                            'style' => 'table-layout: fixed'
                        ]
                    ]);
                }
            } else {
                echo Html::tag('p', 'هنوز شماره تماسی برای این تامین کننده ثبت نگردیده است.', [
                    'style' => 'font-weight: bold; text-align: center'
                ]);
            }
            ?>
            <?php Panel::end() ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <?php Panel::begin(['title' => 'آدرس مغازه / دفتر']) ?>
            <div class="well">
                <?= $model->shopAddress ?>
            </div>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-6">
            <?php if ($model->factoryAddress != null) : ?>
                <?php Panel::begin(['title' => 'ادرس کارخانه']) ?>
                <div class="well">
                    <?= $model->factoryAddress ?>
                </div>
                <?php Panel::end() ?>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php if ($model->description != null) : ?>
                <?php Panel::begin(['title' => 'توضیحات']) ?>
                <div class="well">
                    <?= $model->description ?>
                </div>
                <?php Panel::end() ?>
            <?php endif ?>
        </div>
    </div>


</div>
