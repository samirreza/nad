<?php

use theme\widgets\Panel;

?>

<h3 class="nad-page-title">شناسنامه</h3>
<div class="source-certificate">
    <?= $this->render('@nad/common/modules/investigation/common/views/_base_source_certificate', [
        'source' => $source,
        'moduleId' => $moduleId,
        'baseRoute' => $baseRoute
    ]) ?>
    <?php if ($source->proposals) : ?>
        <?php foreach ($source->proposals as $index => $proposal) : ?>
        <?php
        // TODO find a better way than this shit
        $proposal->referenceClassName = $source->referenceClassName;
        ?>
            <?php Panel::begin(['title' => 'پوپوزال / گزارش ' . Yii::$app->formatter->asFarsiNumber($index + 1)]) ?>
                <?= $this->render('@nad/common/modules/investigation/common/views/_base_proposal_certificate', [
                    'proposal' => $proposal,
                    'moduleId' => $moduleId,
                    'baseRoute' => $baseRoute
                ]) ?>
                <?php if ($proposal->report) : ?>
                    <?= $this->render('@nad/common/modules/investigation/common/views/_base_report_certificate', [
                        'report' => $proposal->report,
                        'moduleId' => $moduleId,
                        'baseRoute' => $baseRoute
                    ]) ?>
                <?php endif; ?>
            <?php Panel::end() ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php $this->registerCss('
    .attribute-label {
        width: 20%;
    }
    .attribute-value {
        width: 80%;
    }
    .hr-text {
        line-height: 1em;
        position: relative;
        outline: 0;
        border: 0;
        color: black;
        text-align: center;
        height: 1.5em;
        opacity: 20;
      }
      .hr-text:before {
        content: "";
        background: linear-gradient(to right, transparent, #818078, transparent);
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
      }
      .hr-text:after {
        content: attr(data-content);
        position: relative;
        display: inline-block;
        color: black;
        padding: 0 0.5em;
        line-height: 1.5em;
        color: #818078;
        background-color: #fcfcfa;
    }
    .external-link {
        font-size: 20px;
        font-weight: bold;
        float: left;
    }
') ?>

