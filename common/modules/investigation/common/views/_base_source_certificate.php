<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use core\helpers\Utility;
use yii\widgets\DetailView;
use nad\common\modules\investigation\source\models\Source;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<?php Panel::begin([
    'title' => 'منشا',
    'showCollapseButton' => true
]) ?>
    <?= Html::a(
        '<span class="fa fa-external-link"></span>',
        [
            "$baseRoute/source/manage/view",
            'id' => $source->id
        ],
        [
            'class' => 'external-link',
            'title' => 'مشاهده منشا',
            'target' => '_blank'
        ]
    ) ?>
    <?= DetailView::widget([
        'model' => $source,
        'template' => "<tr><th class=\"attribute-label\">{label}</th><td class=\"attribute-value\">{value}</td></tr>",
        'attributes' => [
            [
                'attribute' => 'title',
                'label' => 'عنوان منشا',
                'value' => $source->title
            ],
            [
                'attribute' => 'englishTitle',
                'label' => 'عنوان انگلیسی منشا',
                'value' => $source->englishTitle
            ],
            [
                'attribute' => 'uniqueCode',
                'label' => 'شناسه منشا',
                'value' => $source->uniqueCode
            ],
            [
                'attribute' => 'createdBy',
                'label' => 'کارشناس نگارش منشا',
                'value' => $source->researcherTitle
            ],
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'label' => 'تاریخ درج منشا',
                'value' => $source->createdAt
            ],
            [
                'attribute' => 'mainReasonId',
                'label' => 'علت اصلی منشا',
                'value' => $source->mainReason->title
            ],
            [
                'attribute' => 'reasons',
                'label' => 'علل فرعی منشا',
                'value' => $source->reasons
            ],
            // [
            //     'attribute' => 'references',
            //     'label' => 'منابع منشا',
            //     'format' => 'raw',
            //     'value' => function ($model) {
            //         return $model->getClickableReferencesAsString();
            //     }
            // ],
            [
                'attribute' => 'tags',
                'label' => 'کلید واژه‌ها منشا',
                'value' => $source->getTagsAsString()
            ],
            [
                'attribute' => 'status',
                'label' => 'وضعیت منشا',
                'value' => Source::getStatusLables()[$source->status]
            ],
            [
                'attribute' => 'reasonForGenesis',
                'label' => 'علت پیدایش منشا',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($source->reasonForGenesis, 100)
            ],
            [
                'attribute' => 'necessity',
                'label' => 'ضرورت‌های طرح موضوع منشا',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($source->necessity, 100)
            ],
            [
                'attribute' => 'description',
                'label' => 'توضیحات منشا',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($source->description, 100)
            ],
            [
                'attribute' => 'deliverToManagerDate',
                'format' => 'date',
                'label' => 'تاریخ تحویل منشا به مدیر',
                'value' => $source->deliverToManagerDate
            ],
            [
                'attribute' => 'sessionDate',
                'format' => 'date',
                'label' => 'تاریخ جلسه منشا',
                'value' => $source->sessionDate
            ],
            [
                'attribute' => 'proceedings',
                'label' => 'نتیجه جلسه منشا',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($source->proceedings, 100)
            ],
            [
                'attribute' => 'negotiationResult',
                'label' => 'نتیجه مذاکره منشا',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($source->negotiationResult, 100)
            ],
            [
                'attribute' => 'experts',
                'label' => 'کارشناسان نگارش پروپوزال',
                'value' => $source->getExpertFullNamesAsString()
            ]
        ]
    ]) ?>
    <?php if ($source->comments) : ?>
        <div class="col-md-12">
            <?= CommentList::widget([
                'model' => $source,
                'moduleId' => $moduleId,
                'showCreateButton' => false,
                'showEditDeleteButton' => false
            ]) ?>
        </div>
    <?php endif; ?>
<?php Panel::end() ?>
