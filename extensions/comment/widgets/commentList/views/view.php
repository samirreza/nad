<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use theme\widgets\Button;
use nad\extensions\comment\widgets\commentList\assetbundles\CommentAsset;

CommentAsset::register($this);
$model = $this->context->model;

?>

<?php Panel::begin(['title' => 'نظر ها', 'showCollapseButton' => true]) ?>
    <div class="row">
        <div class="comments col-md-12">
            <?= Button::widget([
                'label' => 'درج نظر',
                'url' => [
                    '/comment/create',
                    'moduleId' => $this->context->moduleId,
                    'modelClassName' => get_class($model),
                    'modelId' => $model->id
                ],
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-sliding-form-id' => 'comment-sliding-form',
                    'data-gridpjaxid' => 'comment-list-gridviewpjax'
                ],
                'icon' => 'comment',
                'type' => 'success',
                'visible' => $this->context->showCreateButton
            ]) ?>
            <br><br>
            <div id="comment-sliding-form"></div>
            <?php Pjax::begin([
                'id' => 'comment-list-gridviewpjax'
            ]) ?>
                <?php foreach ($model->getComments($this->context->sort) as $comment) : ?>
                    <?php if ($comment->isSentByThisUser()) {
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
                                        'data-sliding-form-id' => 'comment-sliding-form'
                                    ]
                                ) . ' ' . Html::a(
                                    '<i class="glyphicon glyphicon-pencil"></i>',
                                    [
                                        '/comment/update',
                                        'id' => $comment->id
                                    ],
                                    [
                                        'title' => 'ویرایش نظر',
                                        'data-pjax' => '0',
                                        'class' => 'ajaxupdate',
                                        'data-sliding-form-id' => 'comment-sliding-form'
                                    ]
                                );
                            } ?>
                        </div>
                        <div class="comment-timestamp">
                            <?= Yii::$app->formatter->asDate($comment->insertedAt) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php Pjax::end() ?>
        </div>
    </div>
<?php Panel::end() ?>
