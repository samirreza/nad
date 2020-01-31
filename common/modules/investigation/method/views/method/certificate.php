<h2 class="nad-page-title">شناسنامه</h2>
<?= $this->render('@nad/common/modules/investigation/common/views/_base_certificate', [
    'source' => $source,
    'proposal' => $proposal,
    'report' => $report,
    'method' => $method,
    'moduleId' => $moduleId,
    'baseRoute' => $baseRoute
]) ?>


<?php if ($method->instructions) : ?>
    <?php foreach ($method->instructions as $index => $instruction) : ?>
    <?php
    // TODO find a better way than this shit
    $instruction->referenceClassName = $instruction->referenceClassName;
    ?>
        <?php Panel::begin(['title' => 'دستورالعمل ' . Yii::$app->formatter->asFarsiNumber($index + 1)]) ?>
            <?= $this->render('@nad/common/modules/investigation/common/views/_base_instruction_certificate', [
                'instruction' => $instruction,
                'moduleId' => $moduleId,
                'baseRoute' => $baseRoute
            ]) ?>
        <?php Panel::end() ?>
    <?php endforeach; ?>
<?php endif; ?>