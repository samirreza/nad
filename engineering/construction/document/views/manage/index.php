<?php
use nad\common\modules\engineering\location\models\Location;

$locationModel = Location::findOne(['id' => Yii::$app->request->queryParams['DocumentSearch']['groupId']]);

$this->title = 'لیست مدارک';
$this->params['stageCategoriesIndex'] = ['/engineering/construction/stage/category/index'];
$this->params['groupsIndex'] = [
    '/engineering/construction/location/manage/index',
    'LocationSearch[categoryId]' => $locationModel->categoryId
];
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مراحل', 'url' => ['/engineering/construction/stage/manage/start']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/construction/stage/category']],
    ['label' => 'بسته مدارک', 'url' => $this->params['groupsIndex']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/document/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'locationModel' => $locationModel
]);
