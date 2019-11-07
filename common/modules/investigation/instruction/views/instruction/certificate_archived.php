<h3 class="nad-page-title">شناسنامه</h3>
<?= $this->render('@nad/common/modules/investigation/common/views/_base_certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'method' => $method,
    'instruction' => $instruction,
    'moduleId' => $moduleId,
    'baseRoute' => $baseRoute
]) ?>
