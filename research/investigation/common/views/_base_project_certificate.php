<?php

use yii\helpers\Html;
use core\helpers\Utility;
use yii\widgets\DetailView;
use nad\research\investigation\project\models\Project;

?>

<hr class="hr-text" data-content="گزارش">
<?= Html::a(
    '<span class="fa fa-external-link"></span>',
    [
        '/research/project/manage/view',
        'id' => $project->id
    ],
    [
        'class' => 'external-link',
        'title' => 'مشاهده گزارش',
        'target' => '_blank'
    ]
) ?>
<?= DetailView::widget([
    'model' => $project,
    'template' => "<tr><th class=\"attribute-label\">{label}</th><td class=\"attribute-value\">{value}</td></tr>",
    'attributes' => [
        [
            'attribute' => 'title',
            'label' => 'عنوان گزارش',
            'value' => $project->title
        ],
        [
            'attribute' => 'englishTitle',
            'label' => 'عنوان انگلیسی گزارش',
            'value' => $project->englishTitle
        ],
        [
            'attribute' => 'uniqueCode',
            'label' => 'شناسه گزارش',
            'value' => $project->uniqueCode
        ],
        [
            'attribute' => 'createdBy',
            'label' => 'کارشناس نگارش گزارش',
            'value' => $project->researcher->email
        ],
        [
            'label' => 'تاریخ تحویل گزارش به کارشناس',
            'format' => 'date',
            'value' => $project->proposal->deliveryToExpertTime
        ],
        [
            'attribute' => 'createdAt',
            'format' => 'date',
            'label' => 'تاریخ درج گزارش',
            'value' => $project->createdAt
        ],
        [
            'label' => 'فایل گزارش',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a(
                    'دانلود فایل',
                    $model->getFile('report')->getUrl(),
                    [
                        'data-pjax' => '0'
                    ]
                );
            }
        ],
        [
            'attribute' => 'categoryId',
            'label' => 'رده گزارش',
            'format' => 'raw',
            'value' => $project->category->htmlCodedTitle
        ],
        [
            'attribute' => 'resources',
            'label' => 'منابع گزارش',
            'format' => 'raw',
            'value' => $project->getClickableResourcesAsString()
        ],
        [
            'label' => 'مدارک گزارش',
            'format' => 'raw',
            'value' => function ($model) {
                if (!$model->getFile('doc')) {
                    return;
                }
                return Html::a(
                    'دانلود مدارک',
                    $model->getFile('doc')->getUrl(),
                    [
                        'data-pjax' => '0'
                    ]
                );
            }
        ],
        [
            'attribute' => 'tags',
            'label' => 'کلید واژه‌ها گزارش',
            'value' => $project->getTagsAsString()
        ],
        [
            'attribute' => 'deliverToManagerDate',
            'format' => 'date',
            'label' => 'تاریخ تحویل گزارش به مدیر',
            'value' => $project->deliverToManagerDate
        ],
        [
            'attribute' => 'sessionDate',
            'format' => 'date',
            'label' => 'تاریخ جلسه توجیهی گزارش',
            'value' => $project->sessionDate
        ],
        [
            'attribute' => 'status',
            'label' => 'وضعیت گزارش',
            'value' => Project::getStatusLables()[$project->status]
        ],
        [
            'attribute' => 'abstract',
            'label' => 'چکیده گزارش',
            'format' => 'raw',
            'value' => Utility::makeStringShorten($project->abstract, 100)
        ],
        [
            'attribute' => 'proceedings',
            'label' => 'نتیجه برگزاری جلسه توجیهی گزارش',
            'format' => 'raw',
            'value' => Utility::makeStringShorten($project->proceedings, 100)
        ]
    ]
]) ?>
