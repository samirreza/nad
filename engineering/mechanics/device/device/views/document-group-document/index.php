<?php
use nad\common\modules\device\models\DocumentGroup;

$groupModel = DocumentGroup::findOne(['id' => Yii::$app->request->queryParams['DocumentGroupDocumentSearch']['groupId']]);

$this->title = 'لیست مدارک';
$this->params['deviceIndex'] = ['/engineering/mechanics/device/device/manage/index'];
$this->params['groupsIndex'] = [
    '/engineering/mechanics/device/device/document-group/index',
    'DocumentGroupSearch[deviceId]' => $groupModel->device->id
];
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/mechanics/device/manage/index']],
    ['label' => 'لیست تجهیزات', 'url' => ['/engineering/mechanics/device/device/manage/index']],
    ['label' => 'بسته مدارک', 'url' => $this->params['groupsIndex']],
    $this->title
];

?>

<?= $this->render('@nad/common/modules/device/views/document-group-document/index', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'groupModel' => $groupModel
]);
