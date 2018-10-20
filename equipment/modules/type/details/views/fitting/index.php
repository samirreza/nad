<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use modules\nad\equipment\modules\type\models\Type;

$type = Type::findOne(Yii::$app->request->get('typeId'));
$this->title = 'اتصالات تجهیز - '. $type->uniqueCode ;
$this->params['breadcrumbs'] = [
    'تجهیزات',
    ['label' => 'انواع', 'url' => ['../manage/index']],
    ['label' => $type->uniqueCode, 'url' => ['../manage/view', 'id' => $type->id]],
    $this->title
];
?>
<div class="fittings-index">
<?= ActionButtons::widget([
    'buttons' => [
        'create' => [
            'label' => 'اتصال جدید',
            'options' => [
                'class' => 'ajaxcreate',
                'data-gridpjaxid' => 'fittings-gridviewpjax',
                'data-typeId' => $type->id
            ]
        ],
        'ownerType' => [
            'label' => 'اطلاعات تجهیز',
            'url' => ['../manage/view', 'id' => $type->id],
            'type' => 'info',
            'icon' => 'info'
        ],
    ],
]); ?>

<div class="sliding-form-wrapper"></div>

<?php Panel::begin([
    'title' => 'لیست اتصالات'
]) ?>
<?php Pjax::begin([
    'id' => 'fittings-gridviewpjax',
    'enablePushState' => false,
]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'nad\common\code\CodeGridColumn',
                'isAjaxGrid' => true
            ],
            'code',
            [
                'class' => 'core\grid\TitleColumn',
                'isAjaxGrid' => true
            ],
            [
                'class' => 'core\grid\AjaxActionColumn'
            ]
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?php Panel::end() ?>
</div>
