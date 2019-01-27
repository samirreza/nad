<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use core\helpers\Utility;
use yii\widgets\DetailView;
use nad\office\modules\expert\models\Expert;
use nad\research\investigation\proposal\models\Proposal;

?>

<?php Panel::begin([
    'title' => 'پورپوزال',
    'showCollapseButton' => true,
    'closed' => true
]) ?>
    <?= Html::a(
        '<span class="fa fa-external-link"></span>',
        [
            '/research/proposal/manage/view',
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
                'value' => $proposal->researcher->fullName
            ],
            [
                'label' => 'تاریخ تحویل پروپوزال به کارشناس',
                'format' => 'date',
                'value' => $proposal->source->deliverForProposalDate
            ],
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'label' => 'تاریخ درج پروپوزال',
                'value' => $proposal->createdAt
            ],
            [
                'attribute' => 'resources',
                'label' => 'منابع پروپوزال',
                'format' => 'raw',
                'value' => $proposal->getClickableResourcesAsString()
            ],
            [
                'label' => 'مدارک پروپوزال',
                'format' => 'raw',
                'value' => function ($model) {
                    if (!$model->getFile('documents')) {
                        return;
                    }
                    return Html::a(
                        'دانلود مدارک',
                        $model->getFile('documents')->getUrl(),
                        [
                            'data-pjax' => '0'
                        ]
                    );
                }
            ],
            [
                'attribute' => 'partners',
                'label' => 'همکاران در نگارش پروپوزال',
                'value' => $proposal->getPartnerFullNamesAsString()
            ],
            [
                'attribute' => 'tags',
                'label' => 'کلید واژه‌ها پروپوزال',
                'value' => $proposal->getTagsAsString()
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
                'label' => 'تاریخ جلسه توجیهی پروپوزال',
                'value' => $proposal->sessionDate
            ],
            [
                'attribute' => 'projectExpertId',
                'label' => 'کارشناس نگارش گزارش',
                'value' => Expert::findOne($proposal->projectExpertId)->email ??
                    null
            ],
            [
                'attribute' => 'status',
                'label' => 'وضعیت پروپوزال',
                'value' => Proposal::getStatusLables()[$proposal->status]
            ],
            [
                'attribute' => 'necessity',
                'label' => 'ضرورت اجرای طرح پروپوزال',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($proposal->necessity, 100)
            ],
            [
                'attribute' => 'mainPurpose',
                'label' => 'هدف اصلی پروپوزال',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($proposal->mainPurpose, 100)
            ],
            [
                'attribute' => 'secondaryPurpose',
                'label' => 'هدف فرعی پروپوزال',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($proposal->secondaryPurpose, 100)
            ],
            [
                'attribute' => 'proceedings',
                'label' => 'نتیجه برگزاری جلسه توجیهی پروپوزال',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($proposal->proceedings, 100)
            ]
        ]
    ]) ?>
<?php Panel::end() ?>
