<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use theme\widgets\Panel;
use yii\widgets\Pjax;
use theme\widgets\ActionButtons;
use nad\purchase\models\FormsLookup;
use nad\office\modules\expert\models\Expert;
use yii\widgets\ActiveForm;
use core\widgets\select2\Select2;
use theme\widgets\Button;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model nad\purchase\models\Form2 */

$this->title = 'بررسی فنی ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'بررسیهای فنی', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


    <?php Pjax::begin(['id' => 'form2-view-detailview-pjax']) ?>
        <?= ActionButtons::widget([
            'modelID' => $model->id,
            'buttons' => [
                'update' => [
                    'type' => 'warning',
                ],
                'delete' => [
                    'type' => 'warning',
                ],
                'index' => [
                    'type' => 'success',
                    'label' => 'لیست درخواستهای خرید',
                    'url' => ['form1/index']
                ]
            ]
        ]); ?>

    <hr>
    <h2 class="nad-page-title"><?= $this->title ?></h2>

<div class="form2-view">
<?php Panel::begin([
    'title' => 'مشاهده جزئیات',
    // 'showCloseButton' => true
]) ?>
    <div class="row">
        <div class="col-md-12">
            <p>
            <i class="fa fa-hand-o-right"></i>
            جهت مشاهده یا درج اطلاعات در فرم بعدی روی عنوان آن کلیک کنید.
            </p>
            <p>
            <i class="fa fa-hand-o-right"></i>
            در صورتی که جلوی عنوان فرم بعدی، تیک سبز رنگ خورده باشد یعنی آن فرم توسط کارشناس پر شده است.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <?php Panel::begin([
                'title' => 'اطلاعات اصلی'
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'title',
                    'productIdentifier',
                    'proposal:html',
                    'createdAt:date',
                    'updatedAt:datetime',
                    [
                        'attribute' => 'prevFormId',
                        'format' => 'html',
                        'value' => function($model){
                            return FormsLookup::getPrevFormAsLink($model->prevFormId, $model->purchaseGlobalId, $model->prevExpertId);
                        }
                    ],
                    [
                        'attribute' => 'prevExpertId',
                        'value' => function($model){
                            return FormsLookup::getPrevExpertName($model);
                        }
                    ],
                    [
                        'attribute' => 'nextFormId',
                        'format' => 'html',
                        'value' => function($model){
                            return FormsLookup::getNextFormAsLink($model->nextFormId, $model->purchaseGlobalId, $model->createdBy, $model::tableName());
                        }
                    ],
                    [
                        'attribute' => 'nextExpertId',
                        'value' => function($model){
                            return FormsLookup::getNextExpertName($model);
                        }
                    ],
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-5">
            <?php Panel::begin([
                'title' => 'نام کالا',
            ]) ?>
                <div class="well">
                    <?= $model->productName ?>
                </div>
            <?php Panel::end() ?>
        </div>
    </div>
<?php Panel::end() ?>
</div>
<?php if($model->nextFormId == null || $model->nextExpertId == null): ?>
    <hr/>
    <div class="form2-form">
        <?php Panel::begin(['title' => 'تعیین فرم بعدی']) ?>

        <?php $form = ActiveForm::begin([
            'action' => ['update', 'id' => $model->id],
        ]); ?>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'nextFormId')->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(
                                    FormsLookup::find()->all(),
                                    'id',
                                    'title'
                                ),
                                'options' => [
                                    'placeholder' => 'انتخاب کنید'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]
                        ) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'nextExpertId')->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(
                                    Expert::getExpertsByPermission('expert'),
                                    'id',
                                    'user.fullName'
                                ),
                                'options' => [
                                    'placeholder' => 'انتخاب کنید'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]
                        ) ?>
                </div>
                <div class="col-md-3 col-md-offset-1">
                    <br>
                        <?= Html::submitButton('ذخیره', [
                            'class' => 'btn btn-xs btn-warning',
                            'style' => 'padding-left:30px; padding-right:30px'
                        ]) ?>
                </div>
            </div>
            <br/>
            <br/>
        <?php ActiveForm::end(); ?>
        <?php Panel::end() ?>
    </div>
<?php endif; ?>