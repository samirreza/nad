<?php

use themes\admin360\widgets\Panel;
use yii\widgets\DetailView;
use themes\admin360\widgets\ActionButtons;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'لیست تامین کنندگان', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="supplier-view">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'update' => ['label' => 'ویرایش'],
            'delete' => ['label' => 'حذف'],
            'index' => ['label' => 'لیست تامین کنندگان'],
            'phonebook' => [
                'label' => 'دفترچه تلفن',
                'url' => ['/supplier/phonebook/list', 'supplierId' => $model->id],
                'icon' => 'phone',
                'type' => 'success',
            ],
        ]
    ]) ?>
    <div class="row">
        <div class="col-md-5">
            <?php Panel::begin([
                'title' => 'اطلاعات تامین کننده',
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'email',
                    'website',
                    [
                        'attribute' => 'isForeign',
                        'value' => function ($model) {
                            return $model->isForeign ? 'خارجی' : 'داخلی';
                        }
                    ],
                    [
                        'attribute' => 'kind',
                        'value' => $model->getKind()
                    ],
                    [
                        'attribute' => 'paymentType',
                        'value' => $model->setPaymentType()

                    ],
                    'createdAt:date',
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-7">
            <?php Panel::begin(['title' => 'آدرس مغازه / دفتر']) ?>
            <div class="well">
                <?= $model->shopAddress ?>
            </div>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-7">
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
