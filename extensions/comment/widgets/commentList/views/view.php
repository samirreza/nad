<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use theme\widgets\Button;
use nad\extensions\comment\widgets\commentList\assetbundles\CommentAsset;

CommentAsset::register($this);
$model = $this->context->model;
$createUrl = '';
if($showReceiver){
    $createUrl = [
        '/comment/create',
        'moduleId' => $this->context->moduleId,
        'modelClassName' => get_class($model),
        'modelId' => $model->id,
        'returnUrl' => $this->context->returnUrl,
        'showReceiver' => 'T'
    ];
}else{
    $createUrl = [
        '/comment/create',
        'moduleId' => $this->context->moduleId,
        'modelClassName' => get_class($model),
        'modelId' => $model->id,
        'returnUrl' => $this->context->returnUrl
    ];
}
?>

<?php if(!$readonly): ?>
<?php Panel::begin(['title' => 'نظر ها', 'showCollapseButton' => true]) ?>
<?php endif; ?>
    <div class="row">
        <div class="comments col-md-12">
            <?php if(!$readonly): ?>
                <div class="col-sm-12">
                    <?= Button::widget([
                        'label' => 'افزودن نظر',
                        'url' => $createUrl,
                        'options' => [
                            'class' => 'ajaxcreate insert-comment',
                            'data-sliding-form-wrapper-id' => 'comment-sliding-form-wrapper'
                        ],
                        'useDefaultCssClass' => false,
                        'icon' => false,
                        'type' => 'info',
                        'visible' => $this->context->showCreateButton
                    ]) ?>
                </div>
                <br><br>
                <div id="comment-sliding-form-wrapper"></div>
            <?php endif; ?>
            <?php Pjax::begin([
                'id' => 'comment-list-gridviewpjax'
            ]) ?>
                <?php if(empty($comments)){
                    echo '<i class="fa fa-exclamation-triangle"></i>&nbsp;' . 'نظری ثبت نشده است' . '<br><br>';
                }
                ?>
                <?php foreach ($comments as $comment) : ?>
                    <?php
                    {
                        $updateUrl = '';
                        if ($showReceiver) {
                            $updateUrl = [
                                '/comment/update',
                                'id' => $comment->id,
                                'showReceiver' => 'T'
                            ];
                        }else{
                            $updateUrl = [
                                '/comment/update',
                                'id' => $comment->id,
                                'showReceiver' => 'F'
                            ];
                        }
                        if ($comment->isSecret == "T" && !\Yii::$app->user->can('superuser') && $comment->receiverId != null && $comment->receiverId != \Yii::$app->user->identity->expert->id) {
                            continue;
                        }
                    }

                    if ($comment->isSentByThisUser()) {
                        $class = 'comment-send';
                    } else {
                        $class = 'comment-receive';
                    } ?>
                    <div class=<?= $class ?>>
                        <p class="comment-content">
                            <?= $comment->content ?>
                        </p>
                        <div class="comment-delete">
                            <?php if (
                                $this->context->showEditDeleteButton &&
                                $comment->isSentByThisUser()
                            ) {
                                echo Html::a(
                                    '<i class="glyphicon glyphicon-trash"></i>',
                                    [
                                        '/comment/delete',
                                        'id' => $comment->id
                                    ],
                                    [
                                        'title' => 'حذف نظر',
                                        'data-pjax' => '0',
                                        'class' => 'ajaxrequest',
                                        'data-sliding-form-wrapper-id' => 'comment-sliding-form-wrapper',
                                    ]
                                ) . ' ' . Html::a(
                                    '<i class="glyphicon glyphicon-pencil"></i>',
                                    $updateUrl,
                                    [
                                        'title' => 'ویرایش نظر',
                                        'data-pjax' => '0',
                                        'class' => 'ajaxupdate',
                                        'data-sliding-form-wrapper-id' => 'comment-sliding-form-wrapper',
                                    ]
                                );
                            } ?>
                        </div>
                        <div class="comment-timestamp">
                            <?php if($showReceiver): ?>
                                از
                                <?= ' ' . $comment->author->fullName ?>
                                به
                                <?= ' ' . (($comment->receiver)?$comment->receiver->fullName:'همه کارشناسان') . ' ' ?>
                            <?php else: ?>
                                <?= ' ' . $comment->author->fullName . ' ' ?>
                                -
                                <?= ' ' . Yii::$app->formatter->asDateTime($comment->insertedAt) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php Pjax::end() ?>
        </div>
    </div>
<?php if(!$readonly): ?>
<?php Panel::end() ?>
<?php endif; ?>
