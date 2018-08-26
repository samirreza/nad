<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;
use modules\nad\equipment\modules\type\models\Type;

$type = Type::findOne(Yii::$app->request->get('typeId'));
$this->title = 'قطعات تجهیز - '. $type->compositeCode ;
$this->params['breadcrumbs'] = [
    'تجهیزات',
    ['label' => 'انواع', 'url' => ['../manage/index']],
    ['label' => $type->compositeCode, 'url' => ['../manage/view', 'id' => $type->id]],
    $this->title
];
?>
<div class="parts-index">
<?= ActionButtons::widget([
    'buttons' => [
        'create' => [
            'label' => 'قطعه جدید',
            'options' => [
                'class' => 'ajaxcreate',
                'data-gridpjaxid' => 'parts-gridviewpjax',
                'data-typeId' => $type->id
            ]
        ],
        'ownerType' => [
            'label' => 'اطلاعات تجهیز',
            'url' => ['../manage/view', 'id' => $type->id],
            'type' => 'info',
            'icon' => 'info'
        ],
        'models' => [
            'label' => 'مدل های قطعات',
            'url' => ['model/index', 'typeId' => $type->id],
            'type' => 'warning',
            'icon' => 'codepen'
        ],
    ],
]); ?>

<div class="sliding-form-wrapper"></div>

<?php Panel::begin([
    'title' => 'لیست قطعات'
]) ?>
<?php Pjax::begin([
    'id' => 'parts-gridviewpjax',
    'enablePushState' => false,
]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'compositeCode',
            'code',
            [
                'class' => 'core\grid\TitleColumn',
                'isAjaxGrid' => true
            ],
            [
                'label' => 'تعداد مدل ها',
                'format' => 'farsiNumber',
                'value' => function ($model) {
                    return $model->getModels()->count();
                }
            ],
            [
                'class' => 'core\grid\AjaxActionColumn'
            ]
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?php Panel::end() ?>
</div>
