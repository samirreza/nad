<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use core\helpers\Utility;
use yii\widgets\DetailView;
use nad\common\helpers\Lookup;
use nad\common\modules\investigation\subject\models\Subject;
use nad\extensions\comment\widgets\commentList\CommentList;
use nad\common\modules\investigation\subject\models\SubjectCommon;

?>

<?php Panel::begin([
    'title' => 'گزارش',
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
            'title' => 'مشاهده',
            'target' => '_blank'
        ]
    ) ?>
    <?= DetailView::widget([
        'model' => $subject,
        // 'template' => "<tr><th class=\"attribute-label\">{label}</th><td class=\"attribute-value\">{value}</td></tr>",
        'attributes' => [
            [
                'attribute' => 'title',
                'label' => 'عنوان',
                'value' => $subject->title
            ],
            [
                'attribute' => 'englishTitle',
                'label' => 'عنوان انگلیسی',
                'value' => $subject->englishTitle
            ],
            [
                'attribute' => 'uniqueCode',
                'label' => 'شناسه',
                'value' => $subject->uniqueCode,
                'contentOptions' => [
                    'style' => 'direction: ltr; text-align: right'
                ]
            ],
            [
                'attribute' => 'createdBy',
                'value' => $subject->researcher->fullName
            ],
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'label' => 'تاریخ درج',
                'value' => $subject->createdAt
            ],
            [
                'label' => 'فایل موضوع',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->hasFile('subjectFile')) {
                        return Html::a(
                            'دانلود فایل',
                            $model->getFile('subjectFile')->getUrl(),
                            [
                                'data-pjax' => '0'
                            ]
                        );
                    }
                    return null;
                },
                'visible' => !$subject->isReport()
            ],
            [
                'label' => 'فایل گزارش',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->hasFile('reportFile')) {
                        return Html::a(
                            'دانلود فایل',
                            $model->getFile('reportFile')->getUrl(),
                            [
                                'data-pjax' => '0'
                            ]
                        );
                    }
                    return null;
                },
                'visible' => $subject->isReport()
            ],
            [
                'label' => 'مدارک گزارش',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->hasFile('reportFile2')) {
                        return Html::a(
                            'دانلود فایل',
                            $model->getFile('reportFile2')->getUrl(),
                            [
                                'data-pjax' => '0'
                            ]
                        );
                    }
                    return null;
                },
                'visible' => $subject->isReport()
            ],
            [
                'attribute' => 'text',
                'label' => 'متن',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($subject->text, 100)
            ],
            [
                'attribute' => 'description',
                'label' => 'توضیحات',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($subject->description, 100)
            ],
            [
                'attribute' => 'tags',
                'value' => function ($subject) {
                    return $subject->getTagsAsString();
                },
                'visible' => $subject->isReport()
            ],
            [
                'attribute' => 'partners',
                'value' => function ($subject) {
                    return $subject->getPartnerFullNamesAsString();
                },
                'visible' => $subject->isReport()
            ],
            [
                'attribute' => 'references',
                'format' => 'raw',
                'value' => function ($subject) {
                    return $subject->getClickableReferencesAsString();
                },
                'visible' => $subject->isReport()
            ],
            [
                'attribute' => 'missionObjective',
                'visible' => $subject->isReport()
            ],
            [
                'attribute' => 'missionPlace',
                'visible' => $subject->isReport() && $subject->isMissionNeeded == Subject::IS_MISSION_NEEDED_YES
            ],
            [
                'attribute' => 'missionDate',
                'format' => 'date',
                'visible' => $subject->isReport() && $subject->isMissionNeeded == Subject::IS_MISSION_NEEDED_YES
            ],
            [
                'attribute' => 'reportDeadlineDate',
                'format' => 'date',
                'visible' => $subject->isReport() && $subject->isMissionNeeded == Subject::IS_MISSION_NEEDED_YES
            ],
            [
                'attribute' => 'missionType',
                'value' => function($model){
                    return Lookup::item(SubjectCommon::LOOKUP_MISSION_TYPE, $model->missionType);
                },
                'visible' => $subject->isReport() && $subject->isMissionNeeded == Subject::IS_MISSION_NEEDED_YES
            ],
            [
                'attribute' => 'status',
                'label' => 'وضعیت',
                'value' => Subject::getStatusLables()[$subject->status]
            ],
            [
                'attribute' => 'deliverToManagerDate',
                'format' => 'date',
                'label' => 'تاریخ تحویل به مدیر',
                'value' => $subject->deliverToManagerDate
            ],
            [
                'attribute' => 'sessionDate',
                'format' => 'date',
                'label' => 'تاریخ جلسه',
                'value' => $subject->sessionDate
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
