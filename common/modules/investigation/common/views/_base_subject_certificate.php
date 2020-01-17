<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use core\helpers\Utility;
use yii\widgets\DetailView;
use nad\common\modules\investigation\subject\models\Subject;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<?php Panel::begin([
    'title' => 'موضوع',
    'showCollapseButton' => true
]) ?>
    <?= Html::a(
        '<span class="fa fa-external-link"></span>',
        [
            ($subject->isArchived == $subject::IS_SOURCE_ARCHIVED_YES) ? "$baseRoute/subject/manage/archived-view" : "$baseRoute/subject/manage/view",
            'id' => $subject->id
        ],
        [
            'class' => 'external-link',
            'title' => 'مشاهده موضوع',
            'target' => '_blank'
        ]
    ) ?>
    <?= DetailView::widget([
        'model' => $subject,
        'template' => "<tr><th class=\"attribute-label\">{label}</th><td class=\"attribute-value\">{value}</td></tr>",
        'attributes' => [
            [
                'attribute' => 'title',
                'label' => 'عنوان موضوع',
                'value' => $subject->title
            ],
            [
                'attribute' => 'englishTitle',
                'label' => 'عنوان انگلیسی موضوع',
                'value' => $subject->englishTitle
            ],
            [
                'attribute' => 'uniqueCode',
                'label' => 'شناسه موضوع',
                'value' => $subject->uniqueCode
            ],
            [
                'attribute' => 'createdBy',
                'label' => 'کارشناس نگارش موضوع',
                'value' => $subject->researcher->email
            ],
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'label' => 'تاریخ درج موضوع',
                'value' => $subject->createdAt
            ],
            [
                'label' => 'فایل موضوع',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->hasFile('file')) {
                        return Html::a(
                            'دانلود فایل',
                            $model->getFile('file')->getUrl(),
                            [
                                'data-pjax' => '0'
                            ]
                        );
                    }
                    return null;
                }
            ],
            [
                'attribute' => 'categoryId',
                'label' => 'رده موضوع',
                'format' => 'raw',
                'value' => $subject->category->htmlCodedTitle
            ],
            // [
            //     'attribute' => 'references',
            //     'label' => 'منابع موضوع',
            //     'format' => 'raw',
            //     'value' => function ($model) {
            //         return $model->getClickableReferencesAsString();
            //     }
            // ],
            // [
            //     'attribute' => 'tags',
            //     'label' => 'کلید واژه‌ها موضوع',
            //     'value' => $subject->getTagsAsString()
            // ],
            [
                'attribute' => 'status',
                'label' => 'وضعیت موضوع',
                'value' => Subject::getStatusLables()[$subject->status]
            ],
            [
                'attribute' => 'text',
                'label' => 'متن موضوع',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($subject->text, 100)
            ],
            [
                'attribute' => 'description',
                'label' => 'توضیحات موضوع',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($subject->description, 100)
            ],
            [
                'attribute' => 'deliverToManagerDate',
                'format' => 'date',
                'label' => 'تاریخ تحویل موضوع به مدیر',
                'value' => $subject->deliverToManagerDate
            ],
            [
                'attribute' => 'sessionDate',
                'format' => 'date',
                'label' => 'تاریخ جلسه موضوع',
                'value' => $subject->sessionDate
            ],
            [
                'attribute' => 'proceedings',
                'label' => 'نتیجه جلسه موضوع',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($subject->proceedings, 100)
            ]
        ]
    ]) ?>
    <?php if ($subject->comments) : ?>
        <div class="col-md-12">
            <?= CommentList::widget([
                'model' => $subject,
                'moduleId' => $moduleId,
                'showCreateButton' => false,
                'showEditDeleteButton' => false
            ]) ?>
        </div>
    <?php endif; ?>
<?php Panel::end() ?>
