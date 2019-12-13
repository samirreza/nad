<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use core\helpers\Utility;
use yii\widgets\DetailView;
use nad\common\modules\investigation\method\models\Method;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<?php Panel::begin([
    'title' => 'روش',
    'showCollapseButton' => true
]) ?>
    <?= Html::a(
        '<span class="fa fa-external-link"></span>',
        [
            ($method->isArchived == $method::IS_SOURCE_ARCHIVED_YES) ? "$baseRoute/method/manage/archived-view" : "$baseRoute/method/manage/view",
            'id' => $method->id
        ],
        [
            'class' => 'external-link',
            'title' => 'مشاهده روش',
            'target' => '_blank'
        ]
    ) ?>
    <?= DetailView::widget([
        'model' => $method,
        'template' => "<tr><th class=\"attribute-label\">{label}</th><td class=\"attribute-value\">{value}</td></tr>",
        'attributes' => [
            [
                'attribute' => 'title',
                'label' => 'عنوان روش',
                'value' => $method->title
            ],
            [
                'attribute' => 'englishTitle',
                'label' => 'عنوان انگلیسی روش',
                'value' => $method->englishTitle
            ],
            [
                'attribute' => 'uniqueCode',
                'label' => 'شناسه روش',
                'value' => $method->uniqueCode
            ],
            [
                'attribute' => 'createdBy',
                'label' => 'کارشناس نگارش روش',
                'value' => $method->researcher->email
            ],
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'label' => 'تاریخ درج روش',
                'value' => $method->createdAt
            ],
            [
                'label' => 'فایل روش',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->hasFile('methodDoc')) {
                        return Html::a(
                            'دانلود فایل',
                            $model->getFile('methodDoc')->getUrl(),
                            [
                                'data-pjax' => '0'
                            ]
                        );
                    }
                }
            ],
            [
                'attribute' => 'categoryId',
                'label' => 'رده روش',
                'format' => 'raw',
                'value' => $method->category->htmlCodedTitle
            ],
            [
                'label' => 'مدارک روش',
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
            //     'label' => 'منابع روش',
            //     'format' => 'raw',
            //     'value' => function ($model) {
            //         return $model->getClickableReferencesAsString();
            //     }
            // ],
            // [
            //     'attribute' => 'tags',
            //     'label' => 'کلید واژه‌ها روش',
            //     'value' => $method->getTagsAsString()
            // ],
            [
                'attribute' => 'status',
                'label' => 'وضعیت روش',
                'value' => Method::getStatusLables()[$method->status]
            ],
            [
                'attribute' => 'abstract',
                'label' => 'چکیده روش',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($method->abstract, 100)
            ],
            [
                'attribute' => 'description',
                'label' => 'توضیحات روش',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($method->description, 100)
            ],
            [
                'attribute' => 'deliverToManagerDate',
                'format' => 'date',
                'label' => 'تاریخ تحویل روش به مدیر',
                'value' => $method->deliverToManagerDate
            ],
            [
                'attribute' => 'sessionDate',
                'format' => 'date',
                'label' => 'تاریخ جلسه روش',
                'value' => $method->sessionDate
            ],
            [
                'attribute' => 'proceedings',
                'label' => 'نتیجه جلسه روش',
                'format' => 'raw',
                'value' => Utility::makeStringShorten($method->proceedings, 100)
            ]
        ]
    ]) ?>
    <?php if ($method->comments) : ?>
        <div class="col-md-12">
            <?= CommentList::widget([
                'model' => $method,
                'moduleId' => $moduleId,
                'showCreateButton' => false,
                'showEditDeleteButton' => false
            ]) ?>
        </div>
    <?php endif; ?>
<?php Panel::end() ?>
