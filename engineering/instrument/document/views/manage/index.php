<?php
use nad\common\modules\engineering\location\models\Location;

$locationModel = Location::findOne(['id' => Yii::$app->request->queryParams['DocumentSearch']['groupId']]);

$this->title = 'لیست مدارک';
$this->params['stageCategoriesIndex'] = ['/engineering/instrument/stage/category/index'];
$this->params['groupsIndex'] = [
    '/engineering/instrument/location/manage/index',
    'LocationSearch[categoryId]' => $locationModel->categoryId
];
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مراحل', 'url' => ['/engineering/instrument/stage/manage/start']],
    ['label' => 'لیست مراحل', 'url' => ['/engineering/instrument/stage/category']],
    ['label' => 'بسته مدارک', 'url' => $this->params['groupsIndex']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/document/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'locationModel' => $locationModel
]);
