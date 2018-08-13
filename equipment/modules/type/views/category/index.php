<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = 'لیست دسته ها';
$this->params['breadcrumbs'] = [
    'تجهیزات',
    ['label' => 'انواع', 'url' => ['manage/index']],
    $this->title
];
?>
<div class="categories-index">
<?= ActionButtons::widget([
    'buttons' => [
        'create' => [
            'label' => 'دسته جدید',
            'options' => [
                'class' => 'ajaxcreate',
                'data-gridpjaxid' => 'categories-gridviewpjax'
            ]
        ],
        'equipments' => [
            'label' => 'انواع تجهیزات',
            'url' => ['manage/index'],
            'type' => 'info',
            'icon' => 'list'
        ],
    ],
]); ?>

<div class="sliding-form-wrapper"></div>

<?php Panel::begin([
    'title' => 'لیست دسته ها'
]) ?>
<?php Pjax::begin([
    'id' => 'categories-gridviewpjax',
    'enablePushState' => false,
]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'code',
            [
                'class' => 'core\grid\TitleColumn',
                'isAjaxGrid' => true
            ],
            [
                'class' => 'core\grid\AjaxActionColumn',
                'template' => '{view} {update}'
            ]
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?php Panel::end() ?>
</div>
