<?php
use nad\common\modules\engineering\location\models\Location;

$locationModel = Location::findOne(['id' => Yii::$app->request->queryParams['DocumentSearch']['groupId']]);

$this->title = 'لیست مدارک';
$this->params['stageCategoriesIndex'] = ['/engineering/piping/stage/category/index'];
$this->params['groupsIndex'] = [
    '/engineering/piping/location/manage/index',
    'LocationSearch[categoryId]' => $locationModel->categoryId
];
$this->params['breadcrumbs'] = [
    'فنی',       
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']], 
    ['label' => 'لیست رده بندی مراحل', 'url' => ['/engineering/piping/stage/category']],
    ['label' => 'بسته مدارک', 'url' => $this->params['groupsIndex']],     
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/document/views/manage/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
