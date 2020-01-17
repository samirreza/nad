<h3 class="nad-page-title">شناسنامه</h3>
<?= $this->render('@nad/common/modules/investigation/common/views/_base_otherreport_certificate', [
    'subject' => $subject,
    'otherreport' => $otherreport,
    'moduleId' => $moduleId,
    'baseRoute' => $baseRoute
]) ?>
