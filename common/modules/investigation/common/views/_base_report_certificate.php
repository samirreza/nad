<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use core\helpers\Utility;
use yii\widgets\DetailView;
use nad\common\modules\investigation\report\models\Report;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<?php Panel::begin([
    'title' => 'گزارش',
    'showCollapseButton' => true
]) ?>
    <?= Html::a(
        '<span class="fa fa-external-link"></span>',
        [
            "$baseRoute/report/manage/view",
            'id' => $report->id
        ],
        [
            'class' => 'external-link',
            'title' => 'مشاهده گزارش',
            'target' => '_blank'
        ]
    ) ?>
    <?= DetailView::widget([
        'model' => $report,
        'template' => "<tr><th class=\"attribute-label\">{label}</th><td class=\"attribute-value\">{value}</td></tr>",
        'attributes' => [
            [
                'attribute' => 'title',
                'label' => 'عنوان گزارش',
                'value' => $report->title
            ],
            [
                'attribute' => 'englishTitle',
                'label' => 'عنوان انگلیسی گزارش',
                'value' => $report->englishTitle
            ],
            [
                'attribute' => 'uniqueCode',
                'label' => 'شناسه گزارش',
                'value' => $report->uniqueCode
            ],
            [
                'attribute' => 'createdBy',
                'label' => 'کارشناس نگارش گزارش',
                'value' => $report->researcher->email
            ],
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'label' => 'تاریخ درج گزارش',
                'value' => $report->createdAt
            ],
            [
                'label' => 'فایل گزارش',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->hasFile('report')) {
                        return Html::a(
                            'دانلود فایل',
                            $model->getFile('report')->getUrl(),
                            [
                                'data-pjax' => '0'
                            ]
                        );
                    }
                }
            ],
            [
                'attribute' => 'categoryId',
                'label' => 'رده گزارش',
                'format' => 'raw',
                'value' => $report->category->htmlCodedTitle
            ],
            [
                'label' => 'مدارک گزارش',
                'format' => 'raw',
                'value' => function ($model) {
                    if (!$model->hasFile('doc')) {
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
            // [
            //     'attribute' => 'references',
            //     'label' => 'منابع گزارش',
            //     'format' => 'raw',
            //     'value' => function ($model) {
            //         return $model->getClickableReferencesAsString();
            //     }
            // ],
            [
                'attribute' => 'tags',
                'label' => 'کلید واژه‌ها گزارش',
                'value' => $report->getTagsAsString()
            ],
            [
                'attribute' => 'status',
                'label' => 'وضعیت گزارش',
                'value' => Report::getStatusLables()[$report->status]
            ],
            [
                'attribute' => 'abstract',
                'label' => 'چکیده گزارش',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($report->abstract, 100)
            ],
            [
                'attribute' => 'description',
                'label' => 'توضیحات گزارش',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($report->description, 100)
            ],
            [
                'attribute' => 'deliverToManagerDate',
                'format' => 'date',
                'label' => 'تاریخ تحویل گزارش به مدیر',
                'value' => $report->deliverToManagerDate
            ],
            [
                'attribute' => 'sessionDate',
                'format' => 'date',
                'label' => 'تاریخ جلسه گزارش',
                'value' => $report->sessionDate
            ],
            [
                'attribute' => 'proceedings',
                'label' => 'نتیجه جلسه گزارش',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($report->proceedings, 100)
            ],
            [
                'attribute' => 'negotiationResult',
                'label' => 'نتیجه مذاکره گزارش',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($report->negotiationResult, 100)
            ]
        ]
    ]) ?>
    <?php if ($report->comments) : ?>
        <div class="col-md-12">
            <?= CommentList::widget([
                'model' => $report,
                'moduleId' => $moduleId,
                'showCreateButton' => false,
                'showEditDeleteButton' => false
            ]) ?>
        </div>
    <?php endif; ?>
<?php Panel::end() ?>
