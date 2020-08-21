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
use modules\user\backend\models\User;
use theme\widgets\Button;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use nad\extensions\comment\widgets\commentList\CommentList;

/* @var $this yii\web\View */
/* @var $model nad\purchase\models\Form1 */

$this->title = 'درخواست خرید ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'درخواستهای خرید', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


    <?php Pjax::begin(['id' => 'form1-view-detailview-pjax']) ?>
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
                    'label' => 'لیست درخواستهای خرید'
                ]
            ]
        ]); ?>

    <hr>
    <h2 class="nad-page-title"><?= $this->title ?></h2>

<div class="form1-view">
<?php Panel::begin([
    'title' => 'مشخصات کلی درخواست',
    'showCollapseButton' => true
]) ?>
    <div class="row">
        <div class="col-md-12">
            <p>
            <i class="fa fa-hand-o-right"></i>
            جهت مشاهده یا درج اطلاعات در فرم بعدی روی عنوان آن در ردیف «آخرین اقدام» کلیک کنید.
            </p>
            <p>
            <i class="fa fa-hand-o-right"></i>
            در صورتی که جلوی عنوان آخرین اقدام، تیک سبز رنگ خورده باشد یعنی آن فرم توسط کارشناس پر شده است.
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
                    'createdAt:date',
                    'updatedAt:datetime',
                    [
                        'label' => 'آخرین اقدام',
                        'format' => 'html',
                        'value' => function($model){
                            return FormsLookup::getLastFormAsLink($model->nextFormId, $model->id, $model->nextExpertId, $model->id, $model::tableName());
                        }
                    ],
                    [
                        'label' => 'کارشناس آخرین اقدام',
                        'value' => function($model){
                            return FormsLookup::getLastExpertName($model);
                        }
                    ],
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-5">
            <?php Panel::begin([
                'title' => 'علت درخواست',
            ]) ?>
                <div class="well">
                    <?= $model->reason ?>
                </div>
            <?php Panel::end() ?>
        </div>
    </div>
<?php Panel::end() ?>
</div>

<?php if($model->nextFormId == null || $model->nextExpertId == null): ?>
    <hr/>
    <div class="form1-form">
        <?php Panel::begin([
            'title' => 'تعیین اقدام بعدی',
            'showCollapseButton' => true
            ]) ?>

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


<div class="forms-workflow-view">
    <?php Panel::begin([
        'title' => 'گردش کار',
        'showCollapseButton' => true
    ]) ?>
        <div class="row">
            <div class="col-md-12">
                <?php
                    $nextFormId = $model->nextFormId;
                    $prevRecordId = $model->id;
                    $prevFormId = 1; // Form1
                    if(isset($nextFormId)):
                        $currentExpertName = Expert::findOne($model->nextExpertId)->getFullName();
                ?>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php
                        $counter = 0;
                        while(isset($nextFormId)){
                            $nextFormLookup = FormsLookup::findOne($nextFormId);

                            $myClass = new \ReflectionClass($nextFormLookup->className);
                            $instanceModel = $myClass->newInstance();
                            $nextModel = $instanceModel::find()->where([
                                'prevRecordId' => $prevRecordId,
                                'prevFormId' => $prevFormId,
                            ])->one();

                            if (isset($nextModel)):
                        ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading<?= $counter ?>">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <h4 class="panel-title">
                                                    <?php
                                                    $panelTitle =
                                                    '<span class="badge bg-blue badge-menu">'
                                                    . ($counter + 1)
                                                    . '</span> '
                                                    . $nextFormLookup->title
                                                    . ' ('
                                                    . '<b>'
                                                    . 'از '
                                                    . '</b>'
                                                     . (($currentExpertName)?$currentExpertName:'مشخص نشده')
                                                     . '<b>'
                                                     . ' به '
                                                     . '</b>'
                                                     . (Expert::findOne($nextModel->nextExpertId)?Expert::findOne($nextModel->nextExpertId)->getFullName():'مشخص نشده')
                                                     . ')'
                                                     . ' - '
                                                     . ' تاریخ: '
                                                     . \Yii::$app->formatter->asDate(
                                                            $nextModel->createdAt,
                                                            'd-M-Y'
                                                     );
                                                    ?>
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $counter ?>" aria-expanded="true" aria-controls="collapse<?= $counter ?>">
                                                    <?= $panelTitle ?>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="col-md-2">
                                            <?= Html::a(
                                            'مشاهده جزییات' . '&nbsp; <i class="fa fa-eye"></i>',
                                                    [
                                                        $nextFormLookup->baseUrl . '/view',
                                                        'id' => $nextModel->id
                                                    ],
                                                    [
                                                        'target' => '_blank',
                                                        'class' => 'btn btn-primary'
                                                    ]
                                                )?>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapse<?= $counter ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $counter ?>">
                                        <div class="panel-body">
                                            <div class="col-md-12">
                                            <?= CommentList::widget([
                                                'readonly' => true,
                                                'showReceiver' => true,
                                                'model' => $nextModel,
                                                'moduleId' => 'dummy',
                                                'returnUrl' => Url::current()
                                            ]) ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                $nextFormId = $nextModel->nextFormId;
                                $prevRecordId = $nextModel->id;
                                $prevFormId = FormsLookup::find()->andWhere(['tableName' => $nextModel->tableName()])->one()->id;
                                if(isset($nextModel->nextExpertId))
                                    $currentExpertName = Expert::findOne($nextModel->nextExpertId)->getFullName();
                                else
                                    $currentExpertName = null;
                                ++$counter;
                            else:
                                $nextFormId = null;
                                $prevRecordId = null;
                                $prevFormId = null;
                            endif;
                        }
                        ?>

                    </div>
                <?php
                    else:
                        echo '<i class="fa fa-exclamation-triangle"></i>&nbsp;' . 'گردش کاری ثبت نشده است' . '<br><br>';
                    endif;
                ?>
            </div>
        </div>
    <?php Panel::end() ?>
</div>
