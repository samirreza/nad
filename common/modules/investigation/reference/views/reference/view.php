<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use nad\common\modules\investigation\reference\models\Reference;

?>

<div class="row">
    <div class="col-md-8">
        <?php Panel::begin([
            'title' => 'اطلاعات منبع',
            'showCloseButton' => true
        ]) ?>
            <div class="reference-view">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'uniqueCode',
                        [
                            'attribute' => 'type',
                            'value' => function ($model) {
                                return Reference::getTypeLabels()[$model->type];
                            }
                        ],
                        'title',
                        'author',
                        'publishedYear:farsiNumber',
                        [
                            'attribute' => 'createdBy',
                            'value' => function ($model) {
                                return $model->researcher->fullName;
                            }
                        ],
                        [
                            'attribute' => 'tags',
                            'value' => function ($model) {
                                return $model->getTagsAsString();
                            }
                        ],
                        [
                            'label' => 'فایل',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a(
                                    'دانلود فایل',
                                    $model->getFile('resource')->getUrl(),
                                    [
                                        'data-pjax' => '0'
                                    ]
                                );
                            }
                        ],
                        [
                            'attribute' => 'createdAt',
                            'value' => function ($model) {
                                return Yii::$app->formatter->asDate(
                                    $model->createdAt,
                                    'Y-M-d'
                                );
                            }
                        ],
                        'description:raw'
                    ]
                ]) ?>
            </div>
        <?php Panel::end() ?>
    </div>
</div>
