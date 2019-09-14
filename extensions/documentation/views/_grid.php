<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;

?>

<?php Panel::begin(['title' => 'فایل های مستندات']) ?>
    <?php Pjax::begin([
        'id' => 'documentation-index-gridviewpjax',
        'enablePushState' => false
    ]) ?>
        <?= GridView::widget([
            'dataProvider' => $documentation->search(),
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'لینک فایل',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a(
                            'لینک',
                            $model->getFile('file')->getUrl(),
                            [
                                'target' => '_blank',
                                'data-pjax' => '0'
                            ]
                        );
                    }
                ],
                'title',
                'createdAt:date',
                'updatedAt:date',
                [
                    'class' => 'core\grid\ActionColumn',
                    'controller' => '/documentation',
                    'options' => ['style' => 'width:7%'],
                    'template' => '{edit-file} {delete-file}',
                    'buttons' => [
                        'edit-file' => function ($url, $model, $key) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                $url,
                                [
                                    'title' => 'ویرایش فایل',
                                    'data-pjax' => '0',
                                    'class' => 'ajaxupdate'
                                ]
                            );
                        },
                        'delete-file' => function ($url, $model, $key) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span>',
                                $url,
                                [
                                    'title' => 'حذف فایل',
                                    'data-confirmmsg' => 'آیا از حذف فایل مطمئن هستید؟',
                                    'data-pjax' => '0',
                                    'class' => 'ajaxdelete'
                                ]
                            );
                        }
                    ]
                ]
            ]
        ]) ?>
    <?php Pjax::end() ?>
<?php Panel::end() ?>
