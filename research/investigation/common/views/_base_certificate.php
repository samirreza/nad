<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use core\helpers\Utility;
use yii\widgets\DetailView;
use nad\office\modules\expert\models\Expert;
use nad\research\investigation\source\models\Source;
use nad\research\investigation\project\models\Project;
use nad\research\investigation\proposal\models\Proposal;

?>

<div class="research-investigation-certificate">
    <?php Panel::begin(['title' => $this->title]) ?>
        <hr class="hr-text" data-content="منشا">
        <?= Html::a(
            '<span class="fa fa-external-link"></span>',
            [
                '/research/source/manage/view',
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
        <hr class="hr-text" data-content="پروپوزال">
        <?php if ($proposal) : ?>
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
        <?php endif; ?>
        <hr class="hr-text" data-content="گزارش">
        <?php if ($project) : ?>
            <?= Html::a(
                '<span class="fa fa-external-link"></span>',
                [
                    '/research/project/manage/view',
                    'id' => $project->id
                ],
                [
                    'class' => 'external-link',
                    'title' => 'مشاهده گزارش',
                    'target' => '_blank'
                ]
            ) ?>
            <?= DetailView::widget([
                'model' => $project,
                'template' => "<tr><th class=\"attribute-label\">{label}</th><td class=\"attribute-value\">{value}</td></tr>",
                'attributes' => [
                    [
                        'attribute' => 'title',
                        'label' => 'عنوان گزارش',
                        'value' => $project->title
                    ],
                    [
                        'attribute' => 'englishTitle',
                        'label' => 'عنوان انگلیسی گزارش',
                        'value' => $project->englishTitle
                    ],
                    [
                        'attribute' => 'uniqueCode',
                        'label' => 'شناسه گزارش',
                        'value' => $project->uniqueCode
                    ],
                    [
                        'attribute' => 'createdBy',
                        'label' => 'کارشناس نگارش گزارش',
                        'value' => $project->researcher->email
                    ],
                    [
                        'label' => 'تاریخ تحویل گزارش به کارشناس',
                        'format' => 'date',
                        'value' => $project->proposal->deliveryToExpertTime
                    ],
                    [
                        'attribute' => 'createdAt',
                        'format' => 'date',
                        'label' => 'تاریخ درج گزارش',
                        'value' => $project->createdAt
                    ],
                    [
                        'label' => 'فایل گزارش',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a(
                                'دانلود فایل',
                                $model->getFile('report')->getUrl(),
                                [
                                    'data-pjax' => '0'
                                ]
                            );
                        }
                    ],
                    [
                        'attribute' => 'categoryId',
                        'label' => 'رده گزارش',
                        'format' => 'raw',
                        'value' => $project->category->htmlCodedTitle
                    ],
                    [
                        'attribute' => 'resources',
                        'label' => 'منابع گزارش',
                        'format' => 'raw',
                        'value' => $project->getClickableResourcesAsString()
                    ],
                    [
                        'label' => 'مدارک گزارش',
                        'format' => 'raw',
                        'value' => function ($model) {
                            if (!$model->getFile('doc')) {
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
                    [
                        'attribute' => 'tags',
                        'label' => 'کلید واژه‌ها گزارش',
                        'value' => $project->getTagsAsString()
                    ],
                    [
                        'attribute' => 'deliverToManagerDate',
                        'format' => 'date',
                        'label' => 'تاریخ تحویل گزارش به مدیر',
                        'value' => $project->deliverToManagerDate
                    ],
                    [
                        'attribute' => 'sessionDate',
                        'format' => 'date',
                        'label' => 'تاریخ جلسه توجیهی گزارش',
                        'value' => $project->sessionDate
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'وضعیت گزارش',
                        'value' => Project::getStatusLables()[$project->status]
                    ],
                    [
                        'attribute' => 'abstract',
                        'label' => 'چکیده گزارش',
                        'format' => 'raw',
                        'value' => Utility::makeStringShorten($project->abstract, 100)
                    ],
                    [
                        'attribute' => 'proceedings',
                        'label' => 'نتیجه برگزاری جلسه توجیهی گزارش',
                        'format' => 'raw',
                        'value' => Utility::makeStringShorten($project->proceedings, 100)
                    ]
                ]
            ]) ?>
        <?php endif; ?>
    <?php Panel::end() ?>
</div>

<?php $this->registerCss('
    .attribute-label {
        width: 20%;
    }
    .attribute-value {
        width: 80%;
    }
    .hr-text {
        line-height: 1em;
        position: relative;
        outline: 0;
        border: 0;
        color: black;
        text-align: center;
        height: 1.5em;
        opacity: 20;
      }
      .hr-text:before {
        content: "";
        background: linear-gradient(to right, transparent, #818078, transparent);
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
      }
      .hr-text:after {
        content: attr(data-content);
        position: relative;
        display: inline-block;
        color: black;
        padding: 0 0.5em;
        line-height: 1.5em;
        color: #818078;
        background-color: #fcfcfa;
    }
    .external-link {
        font-size: 20px;
        font-weight: bold;
        float: left;
    }
') ?>
