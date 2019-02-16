<?php

use theme\widgets\Button;

$this->title = 'بررسی';
$this->params['breadcrumbs'] = [
    'پژوهش',
    $this->title
];

?>

<div class="investigation-home">
    <br><br><br>
    <div class="col-md-10 col-md-offset-2">
        <div class="col-md-6">
            <?= Button::widget([
                'label' => 'منشا',
                'icon' => false,
                'type' => 'info',
                'url' => ['/research/investigation/source/manage/index'],
                'options' => [
                    'style' => 'width:50%; padding: 15% 0;'
                ]
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= Button::widget([
                'label' => 'پروپوزال',
                'icon' => false,
                'type' => 'info',
                'url' => ['/research/investigation/proposal/manage/index'],
                'options' => [
                    'style' => 'width:50%; padding: 15% 0;'
                ]
            ]) ?>
        </div>
    </div>
    <div class="col-md-10 col-md-offset-2" style="padding-top: 5%">
        <div class="col-md-6">
            <?= Button::widget([
                'label' => 'گزارش',
                'icon' => false,
                'type' => 'info',
                'url' => ['/research/investigation/project/manage/index'],
                'options' => [
                    'style' => 'width:50%; padding: 15% 0;'
                ]
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= Button::widget([
                'label' => 'منابع',
                'icon' => false,
                'type' => 'info',
                'url' => ['/research/investigation/resource'],
                'options' => [
                    'style' => 'width:50%; padding: 15% 0;'
                ]
            ]) ?>
        </div>
    </div>
</div>

<?php $this->registerJs('
    $("ul.horizontal-menu").empty();
') ?>
