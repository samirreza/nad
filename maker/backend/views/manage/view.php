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
            ]
        ]
    ]) ?>

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
