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
            ($source->isArchived == $source::IS_SOURCE_ARCHIVED_YES) ? "$baseRoute/source/manage/archived-view" : "$baseRoute/source/manage/view",
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
                'label' => 'علت طرح موضوع منشا',
                'value' => $source->mainReason->title
            ],
            // TODO remove 'reasons' asap
            // [
            //     'attribute' => 'reasons',
            //     'label' => 'علل فرعی منشا',
            //     'value' => $source->reasons
            // ],
            [
                'attribute' => 'references',
                'label' => 'منابع منشا',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getClickableReferencesAsString();
                }
            ],
            [
                'attribute' => 'tags',
                'label' => 'کلید واژه‌ها منشا',
                'value' => $source->getTagsAsString()
            ],
            [
                'attribute' => 'status',
                'label' => 'وضعیت منشا',
                'value' => function($model){
                    // TODO move it to a state in "Source::getUserHolderLables()"
                    if($model->hasAnyExpert() && $model->status != Source::STATUS_IN_NEXT_STEP && $model->status != Source::STATUS_LOCKED){
                        return 'منتظر ارسال جهت نگارش پروپوزال';
                    }
                    return Source::getStatusLables()[$model->status];
                }
            ],
            [
                'attribute' => 'reasonForGenesis',
                'label' => 'سابقه پیدایش منشا',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($source->reasonForGenesis, 100)
            ],
            [
                'attribute' => 'necessity',
                'label' => 'شرح عنوان منشا',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($source->necessity, 100)
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
