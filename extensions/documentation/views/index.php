<?php

use yii\helpers\Url;
use theme\widgets\ActionButtons;

?>

<div class="documentation-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'add-file' => [
                'label' => 'درج فایل',
                'icon' => 'plus',
                'type' => 'success',
                'url' => [
                    '/documentation/add-file',
                    'documentationId' => $documentation->id
                ],
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'documentation-index-gridviewpjax'
                ]
            ],
            'undo' => [
                'label' => 'بازگشت',
                'icon' => 'undo',
                'type' => 'info',
                'visible' => isset($modelId),
                'url' => [
                    'view',
                    'id' => $modelId,
                ]
            ],
            'delete-file' => [
                'label' => 'حذف مستندات',
                'icon' => 'trash',
                'type' => 'danger',
                'visible' => isset($modelId),
                'url' => [
                    '/documentation/delete',
                    'id' => $documentation->id,
                    'modelId' => $modelId,
                    'returnUrl' => urlencode(
                        Url::toRoute(['view', 'id' => $modelId])
                    )
                ],
                'options' => [
                    'class' => 'ajaxdelete',
                    'data' => [
                        'confirm' => 'آیا برای حذف مطمئن هستید؟',
                        'method' => 'post'
                    ]
                ]
            ]
        ]
    ]) ?>
    <div class="sliding-form-wrapper"></div>
    <?= $this->render('_grid', ['documentation' => $documentation]) ?>
</div>

