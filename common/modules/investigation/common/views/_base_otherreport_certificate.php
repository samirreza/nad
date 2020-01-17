<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use core\helpers\Utility;
use yii\widgets\DetailView;
use nad\common\modules\investigation\otherreport\models\Otherreport;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<?php Panel::begin([
    'title' => 'گزارش',
    'showCollapseButton' => true
]) ?>
    <?= Html::a(
        '<span class="fa fa-external-link"></span>',
        [
            ($otherreport->isArchived == $otherreport::IS_SOURCE_ARCHIVED_YES) ? "$baseRoute/otherreport/manage/archived-view" : "$baseRoute/otherreport/manage/view",
            'id' => $otherreport->id
        ],
        [
            'class' => 'external-link',
            'title' => 'مشاهده گزارش',
            'target' => '_blank'
        ]
    ) ?>
    <?= DetailView::widget([
        'model' => $otherreport,
        'template' => "<tr><th class=\"attribute-label\">{label}</th><td class=\"attribute-value\">{value}</td></tr>",
        'attributes' => [
            [
                'attribute' => 'title',
                'label' => 'عنوان گزارش',
                'value' => $otherreport->title
            ],
            [
                'attribute' => 'englishTitle',
                'label' => 'عنوان انگلیسی گزارش',
                'value' => $otherreport->englishTitle
            ],
            [
                'attribute' => 'uniqueCode',
                'label' => 'شناسه گزارش',
                'value' => $otherreport->uniqueCode
            ],
            [
                'attribute' => 'createdBy',
                'label' => 'کارشناس نگارش گزارش',
                'value' => $otherreport->researcher->email
            ],
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'label' => 'تاریخ درج گزارش',
                'value' => $otherreport->createdAt
            ],
            [
                'label' => 'فایل گزارش',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->hasFile('otherreportDoc')) {
                        return Html::a(
                            'دانلود فایل',
                            $model->getFile('otherreportDoc')->getUrl(),
                            [
                                'data-pjax' => '0'
                            ]
                        );
                    }
                }
            ],
            [
                'label' => 'مدارک گزارش',
                'format' => 'raw',
                'value' => function ($model) {
                    if (!$model->hasFile('file')) {
                        return;
                    }
                    return Html::a(
                        'دانلود مدارک',
                        $model->getFile('file')->getUrl(),
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
            // [
            //     'attribute' => 'tags',
            //     'label' => 'کلید واژه‌ها گزارش',
            //     'value' => $otherreport->getTagsAsString()
            // ],
            [
                'attribute' => 'status',
                'label' => 'وضعیت گزارش',
                'value' => Otherreport::getStatusLables()[$otherreport->status]
            ],
            [
                'attribute' => 'abstract',
                'label' => 'چکیده گزارش',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($otherreport->abstract, 100)
            ],
            [
                'attribute' => 'description',
                'label' => 'توضیحات گزارش',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($otherreport->description, 100)
            ],
            [
                'attribute' => 'deliverToManagerDate',
                'format' => 'date',
                'label' => 'تاریخ تحویل گزارش به مدیر',
                'value' => $otherreport->deliverToManagerDate
            ],
            [
                'attribute' => 'sessionDate',
                'format' => 'date',
                'label' => 'تاریخ جلسه گزارش',
                'value' => $otherreport->sessionDate
            ],
            [
                'attribute' => 'proceedings',
                'label' => 'نتیجه جلسه گزارش',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($otherreport->proceedings, 100)
            ]
        ]
    ]) ?>
    <?php if ($otherreport->comments) : ?>
        <div class="col-md-12">
            <?= CommentList::widget([
                'model' => $otherreport,
                'moduleId' => $moduleId,
                'showCreateButton' => false,
                'showEditDeleteButton' => false
            ]) ?>
        </div>
    <?php endif; ?>
<?php Panel::end() ?>
