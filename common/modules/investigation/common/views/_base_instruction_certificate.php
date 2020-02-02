<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use core\helpers\Utility;
use yii\widgets\DetailView;
use nad\common\modules\investigation\instruction\models\Instruction;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<?php Panel::begin([
    'title' => 'دستورالعمل',
    'showCollapseButton' => true
]) ?>
    <?= Html::a(
        '<span class="fa fa-external-link"></span>',
        [
            ($instruction->isArchived == $instruction::IS_SOURCE_ARCHIVED_YES) ? "$baseRoute/instruction/manage/archived-view" : "$baseRoute/instruction/manage/view",
            'id' => $instruction->id
        ],
        [
            'class' => 'external-link',
            'title' => 'مشاهده دستورالعمل',
            'target' => '_blank'
        ]
    ) ?>
    <?= DetailView::widget([
        'model' => $instruction,
        'template' => "<tr><th class=\"attribute-label\">{label}</th><td class=\"attribute-value\">{value}</td></tr>",
        'attributes' => [
            [
                'label' => 'دسترسی به دستورالعمل',
                'format' => 'html',
                'value' => function ($model) use ($baseRoute) {
                    return '<b>' . Html::a(
                        $model->title,
                        [
                            ($model->isArchived == $model::IS_SOURCE_ARCHIVED_YES) ? "$baseRoute/instruction/manage/archived-view" : "$baseRoute/instruction/manage/view",
                            'id' => $model->id
                        ],
                        [
                            'data-pjax' => '0',
                            'style' => 'margin:5px'
                        ]) . '</b>';
                }
            ],
            [
                'attribute' => 'englishTitle',
                'label' => 'عنوان انگلیسی دستورالعمل',
                'value' => $instruction->englishTitle
            ],
            [
                'attribute' => 'uniqueCode',
                'label' => 'شناسه دستورالعمل',
                'value' => $instruction->uniqueCode
            ],
            [
                'attribute' => 'createdBy',
                'label' => 'کارشناس نگارش دستورالعمل',
                'value' => $instruction->researcher->email
            ],
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'label' => 'تاریخ درج دستورالعمل',
                'value' => $instruction->createdAt
            ],
            [
                'label' => 'فایل دستورالعمل',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->hasFile('instructionDoc')) {
                        return Html::a(
                            'دانلود فایل',
                            $model->getFile('instructionDoc')->getUrl(),
                            [
                                'data-pjax' => '0'
                            ]
                        );
                    }
                }
            ],
            [
                'attribute' => 'categoryId',
                'label' => 'رده دستورالعمل',
                'format' => 'raw',
                'value' => $instruction->category->htmlCodedTitle
            ],
            [
                'label' => 'مدارک دستورالعمل',
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
            //     'label' => 'منابع دستورالعمل',
            //     'format' => 'raw',
            //     'value' => function ($model) {
            //         return $model->getClickableReferencesAsString();
            //     }
            // ],
            // [
            //     'attribute' => 'tags',
            //     'label' => 'کلید واژه‌ها دستورالعمل',
            //     'value' => $instruction->getTagsAsString()
            // ],
            [
                'attribute' => 'status',
                'label' => 'وضعیت دستورالعمل',
                'value' => Instruction::getStatusLables()[$instruction->status]
            ],
            [
                'attribute' => 'abstract',
                'label' => 'چکیده دستورالعمل',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($instruction->abstract, 100)
            ],
            [
                'attribute' => 'description',
                'label' => 'توضیحات دستورالعمل',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($instruction->description, 100)
            ],
            [
                'attribute' => 'deliverToManagerDate',
                'format' => 'date',
                'label' => 'تاریخ تحویل دستورالعمل به مدیر',
                'value' => $instruction->deliverToManagerDate
            ],
            [
                'attribute' => 'sessionDate',
                'format' => 'date',
                'label' => 'تاریخ جلسه دستورالعمل',
                'value' => $instruction->sessionDate
            ],
            [
                'attribute' => 'proceedings',
                'label' => 'نتیجه جلسه دستورالعمل',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($instruction->proceedings, 100)
            ]
        ]
    ]) ?>
    <?php if ($instruction->comments) : ?>
        <div class="col-md-12">
            <?= CommentList::widget([
                'model' => $instruction,
                'moduleId' => $moduleId,
                'showCreateButton' => false,
                'showEditDeleteButton' => false
            ]) ?>
        </div>
    <?php endif; ?>
<?php Panel::end() ?>
