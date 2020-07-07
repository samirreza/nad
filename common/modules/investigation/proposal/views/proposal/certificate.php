<h2 class="nad-page-title">شناسنامه</h2>
<?= $this->render('@nad/common/modules/investigation/common/views/_base_certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'reports' => $report,
    'moduleId' => $moduleId,
    'baseRoute' => $baseRoute
]) ?>
