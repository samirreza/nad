<h2 class="nad-page-title">شناسنامه</h2>
<?= $this->render('@nad/common/modules/investigation/common/views/_base_otherreport_certificate', [
    'subject' => $subject,
    'otherreport' => $otherreport,
    'moduleId' => $moduleId,
    'baseRoute' => $baseRoute
]) ?>
