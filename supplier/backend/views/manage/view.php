<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

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
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'تجهیزات تامین کننده',
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'equipments',
                        'value' => function ($model) {
                            return !empty($model->getEquipments()) ? $model->getEquipments() : 'ثبت نشده';
                        },
                    ]
                ],
            ]) ?>
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
            <?php Panel::begin(['title' => 'ادرس کارخانه']) ?>
            <div class="well">
                <?= $model->factoryAddress ?>
            </div>
            <?php Panel::end() ?>
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
