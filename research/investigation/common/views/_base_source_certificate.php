<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use core\helpers\Utility;
use yii\widgets\DetailView;
use nad\research\investigation\source\models\Source;

?>

<?php Panel::begin([
    'title' => 'منشا',
    'showCollapseButton' => true,
    'closed' => true
]) ?>
    <?= Html::a(
        '<span class="fa fa-external-link"></span>',
        [
            '/research/investigation/source/manage/view',
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
                'value' => $source->researcher->fullName
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
            [
                'attribute' => 'resources',
                'format' => 'raw',
                'label' => 'منابع منشا',
                'value' => $source->getClickableResourcesAsString()
            ],
            [
                'attribute' => 'tags',
                'label' => 'کلید واژه‌ها منشا',
                'value' => $source->getTagsAsString()
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
                'label' => 'تاریخ جلسه توجیهی منشا',
                'value' => $source->sessionDate
            ],
            [
                'attribute' => 'experts',
                'label' => 'کارشناسان نگارش پروپوزال',
                'value' => $source->getExpertFullNamesAsString()
            ],
            [
                'attribute' => 'status',
                'label' => 'وضعیت منشا',
                'value' => Source::getStatusLables()[$source->status]
            ],
            [
                'attribute' => 'reason',
                'label' => 'دلایل طرح موضوع منشا',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($source->reason, 100)
            ],
            [
                'attribute' => 'necessity',
                'label' => 'ضرورت‌های طرح موضوع منشا',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($source->necessity, 100)
            ],
            [
                'attribute' => 'proceedings',
                'label' => 'نتیجه برگزاری جلسه توجیهی منشا',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($source->proceedings, 100)
            ]
        ]
    ]) ?>
<?php Panel::end() ?>
