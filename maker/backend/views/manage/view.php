<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'لیست سازندگان', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="maker-view">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'update' => [
                'label' => 'ویرایش',
                'visibleFor' => ['maker.update']
            ],
            'delete' => [
                'label' => 'حذف',
                'visibleFor' => ['maker.delete']
            ],
            'index' => [
                'label' => 'لیست سازندگان',
                'visibleFor' => ['maker.create']
            ],
            'phonebook' => [
                'label' => 'دفترچه تلفن',
                'url' => ['phonebook/manage/list', 'makerId' => $model->id],
                'icon' => 'phone',
                'type' => 'success',
                'visibleFor' => ['maker.create']
            ]
        ]
    ]) ?>

    <div class="row">
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'تجهیزات سازنده',
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
                echo Html::tag('p', 'هنوز تجهیزاتی برای این سازنده ثبت نگردیده است.', [
                    'style' => 'font-weight: bold; text-align: center'
                ]);
            }
            ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'قطعات سازنده',
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
                echo Html::tag('p', 'هنوز قطعه ای برای این سازنده ثبت نگردیده است.', [
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
                'title' => 'اطلاعات سازنده',
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'title',
                    [
                        'attribute' => 'works',
                        'value' => $model->getWorksAsString()

                    ],
                    'phone',
                    'fax',
                    'email',
                    'website',
                    'isActive:boolean',
                    [
                        'attribute' => 'isLegal',
                        'value' => function ($model) {
                            return $model->isLegal ? 'حقوقی' : 'حقیقی';
                        }
                    ],
                    [
                        'attribute' => 'paymentType',
                        'value' => $model->getPaymenttype()

                    ],
                    'satisfaction',
                    'createdAt:date',
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'شماره تماس های سازنده',
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
                echo Html::tag('p', 'هنوز شماره تماسی برای این سازنده ثبت نگردیده است.', [
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
                <?php Panel::begin(['title' => 'توضیحات پرداخت']) ?>
                <div class="well">
                    <?= $model->description ?>
                </div>
                <?php Panel::end() ?>
            <?php endif ?>
        </div>
    </div>


</div>
