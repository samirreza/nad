<?php

use theme\widgets\Panel;

?>

<h2 class="nad-page-title">شناسنامه</h2>
<?= $this->render('@nad/common/modules/investigation/common/views/_base_certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'moduleId' => $moduleId,
    'baseRoute' => $baseRoute
]) ?>

<?php if ($report->methods) : ?>
    <?php foreach ($report->methods as $index => $method) : ?>
    <?php
    // TODO find a better way than this shit
    $method->referenceClassName = $report->referenceClassName;
    ?>
        <?php Panel::begin(['title' => 'روش ' . Yii::$app->formatter->asFarsiNumber($index + 1)]) ?>
            <?= $this->render('@nad/common/modules/investigation/common/views/_base_method_certificate', [
                'method' => $method,
                'moduleId' => $moduleId,
                'baseRoute' => $baseRoute
            ]) ?>
        <?php Panel::end() ?>
    <?php endforeach; ?>
<?php endif; ?>
