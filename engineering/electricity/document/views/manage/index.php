<?php
use nad\common\modules\engineering\location\models\Location;

$locationModel = Location::findOne(['id' => Yii::$app->request->queryParams['DocumentSearch']['groupId']]);

$this->title = 'لیست مدارک';
$this->params['stageCategoriesIndex'] = ['/engineering/electricity/stage/category/index'];
$this->params['groupsIndex'] = [
    '/engineering/electricity/location/manage/index',
    'LocationSearch[categoryId]' => $locationModel->categoryId
];
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/stage/manage/start']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/electricity/stage/category']],
    ['label' => 'بسته مدارک', 'url' => $this->params['groupsIndex']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/document/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'locationModel' => $locationModel
]);
