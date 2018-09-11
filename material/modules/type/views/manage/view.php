<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

?>
<div class="page-view">
<?php Panel::begin([
    'title' => 'مشاهده جزئیات',
    'showCloseButton' => true
]) ?>
    <div class="row">
        <div class="col-md-7">
            <?php Panel::begin([
                'title' => 'اطلاعات اصلی'
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'uniqueCode',
                    'title',
                    'titleEn',
                    'category.familyTreeTitle',
                    'createdAt:date',
                    'updatedAt:datetime',
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-5">
            <?php Panel::begin([
                'title' => 'توضیحات',
            ]) ?>
                <div class="well">
                    <?= $model->description ?>
                </div>
            <?php Panel::end() ?>
        </div>
    </div>
<?php Panel::end() ?>
</div>
