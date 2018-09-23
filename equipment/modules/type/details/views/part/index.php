<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use modules\nad\equipment\modules\type\models\Type;
use modules\nad\equipment\modules\type\details\models\Part;

$type = Type::findOne(Yii::$app->request->get('typeId'));
$this->title = 'قطعات تجهیز - '. $type->uniqueCode ;
$this->params['breadcrumbs'] = [
    'تجهیزات',
    ['label' => 'انواع', 'url' => ['../manage/index']],
    ['label' => $type->uniqueCode, 'url' => ['../manage/view', 'id' => $type->id]],
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
            [
                'class' => 'modules\nad\common\grid\CodeColumn',
                'isAjaxGrid' => true
            ],
            'code',
            [
                'class' => 'core\grid\TitleColumn',
                'isAjaxGrid' => true
            ],
            [
                'attribute' => 'kind',
                'filter' => Part::getKindsList(),
                'value' => function ($model) {
                    return $model->getkindLabel();
                }
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
