<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use core\helpers\Utility;
use yii\widgets\DetailView;
use nad\office\modules\expert\models\Expert;
use nad\extensions\comment\widgets\commentList\CommentList;
use nad\common\modules\investigation\proposal\models\Proposal;

?>

<?php Panel::begin([
    'title' => 'پورپوزال',
    'showCollapseButton' => true
]) ?>
    <?= Html::a(
        '<span class="fa fa-external-link"></span>',
        [
            ($proposal->isArchived == $proposal::IS_SOURCE_ARCHIVED_YES) ? "$baseRoute/proposal/manage/archived-view" : "$baseRoute/proposal/manage/view",
            'id' => $proposal->id
        ],
        [
            'class' => 'external-link',
            'title' => 'مشاهده پروپوزال',
            'target' => '_blank'
        ]
    ) ?>
    <?= DetailView::widget([
        'model' => $proposal,
        'template' => "<tr><th class=\"attribute-label\">{label}</th><td class=\"attribute-value\">{value}</td></tr>",
        'attributes' => [
            [
                'attribute' => 'title',
                'label' => 'عنوان پروپوزال',
                'value' => $proposal->title
            ],
            [
                'attribute' => 'englishTitle',
                'label' => 'عنوان انگلیسی پروپوزال',
                'value' => $proposal->englishTitle
            ],
            [
                'attribute' => 'uniqueCode',
                'label' => 'شناسه پروپوزال',
                'value' => $proposal->uniqueCode
            ],
            [
                'attribute' => 'createdBy',
                'label' => 'کارشناس نگارش پروپوزال',
                'value' => $proposal->researcherTitle
            ],
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'label' => 'تاریخ درج پروپوزال',
                'value' => $proposal->createdAt
            ],
            [
                'label' => 'مدارک پروپوزال',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->hasFile('documents')) {
                        return Html::a(
                            'دانلود مدارک',
                            $model->getFile('documents')->getUrl(),
                            [
                                'data-pjax' => '0'
                            ]
                        );
                    }
                }
            ],
            [
                'attribute' => 'partners',
                'label' => 'همکاران در نگارش پروپوزال',
                'value' => $proposal->getPartnerFullNamesAsString()
            ],
            // [
            //     'attribute' => 'references',
            //     'label' => 'منابع پروپوزال',
            //     'format' => 'raw',
            //     'value' => $proposal->getClickableReferencesAsString()
            // ],
            // [
            //     'attribute' => 'tags',
            //     'label' => 'کلید واژه‌ها پروپوزال',
            //     'value' => $proposal->getTagsAsString()
            // ],
            [
                'attribute' => 'status',
                'label' => 'وضعیت پروپوزال',
                'value' => Proposal::getStatusLables()[$proposal->status]
            ],
            [
                'attribute' => 'reasonForGenesis',
                'label' => 'علت پیدایش پروپوزال',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($proposal->reasonForGenesis, 100)
            ],
            [
                'attribute' => 'necessity',
                'label' => 'ضرورت‌های طرح موضوع پروپوزال',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($proposal->necessity, 100)
            ],
            [
                'attribute' => 'description',
                'label' => 'توضیحات پروپوزال',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($proposal->description, 100)
            ],
            [
                'attribute' => 'deliverToManagerDate',
                'format' => 'date',
                'label' => 'تاریخ تحویل پروپوزال به مدیر',
                'value' => $proposal->deliverToManagerDate
            ],
            [
                'attribute' => 'sessionDate',
                'format' => 'date',
                'label' => 'تاریخ جلسه پروپوزال',
                'value' => $proposal->sessionDate
            ],
            [
                'attribute' => 'proceedings',
                'label' => 'نتیجه جلسه پروپوزال',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($proposal->proceedings, 100)
            ],
            [
                'attribute' => 'projectExpertId',
                'label' => 'کارشناس نگارش گزارش',
                'value' => $proposal->reportExpertId ?
                    Expert::findOne($proposal->reportExpertId)->user->fullName : null
            ]
        ]
    ]) ?>
    <?php if ($proposal->comments) : ?>
        <div class="col-md-12">
            <?= CommentList::widget([
                'model' => $proposal,
                'moduleId' => $moduleId,
                'showCreateButton' => false,
                'showEditDeleteButton' => false
            ]) ?>
        </div>
    <?php endif; ?>
<?php Panel::end() ?>
