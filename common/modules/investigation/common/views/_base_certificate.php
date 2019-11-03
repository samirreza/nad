

<div class="research-investigation-certificate">
    <?= $this->render('_base_source_certificate', [
        'source' => $source,
        'moduleId' => $moduleId,
        'baseRoute' => $baseRoute
    ]) ?>
    <?php if (isset($proposal)) : ?>
        <?= $this->render('_base_proposal_certificate', [
            'proposal' => $proposal,
            'moduleId' => $moduleId,
            'baseRoute' => $baseRoute
        ]) ?>
    <?php endif; ?>
    <?php if (isset($report)) : ?>
        <?= $this->render('_base_report_certificate', [
            'report' => $report,
            'moduleId' => $moduleId,
            'baseRoute' => $baseRoute
        ]) ?>
    <?php endif; ?>
    <?php if (isset($method)) : ?>
        <?= $this->render('_base_method_certificate', [
            'method' => $method,
            'moduleId' => $moduleId,
            'baseRoute' => $baseRoute
        ]) ?>
    <?php endif; ?>
    <?php if (isset($instruction)) : ?>
        <?= $this->render('_base_instruction_certificate', [
            'instruction' => $instruction,
            'moduleId' => $moduleId,
            'baseRoute' => $baseRoute
        ]) ?>
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
