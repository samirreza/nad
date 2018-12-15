<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$this->title = 'منابع';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="resource-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'منبع جدید',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'resource-index-gridviewpjax'
                ]
            ]
        ]
    ]) ?>
    <div class="sliding-form-wrapper"></div>
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'resource-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'title',
                    [
                        'header' => 'فایل',
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
                    'createdAt:dateTime',
                    [
                        'class' => 'core\grid\AjaxActionColumn'
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
