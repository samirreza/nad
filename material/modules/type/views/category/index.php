<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = 'لیست دسته ها';
$this->params['breadcrumbs'] = [
    'مواد',
    ['label' => 'انواع مواد', 'url' => ['manage/index']],
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
        'materials' => [
            'label' => 'انواع مواد',
            'url' => ['manage/index'],
            'type' => 'warning',
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
            'compositeCode',
            [
                'class' => 'core\grid\TitleColumn',
                'attribute' => 'nestedTitle',
                'isAjaxGrid' => true
            ],
            'code',
            [
                'class' => 'core\grid\AjaxActionColumn',
                'template' => '{view} {update}'
            ]
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?php Panel::end() ?>
</div>
