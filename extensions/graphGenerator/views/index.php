<?php
use nad\extensions\graphGenerator\widgets\familyTree\FamilyTree;
?>
<?= FamilyTree::widget([
    "nodes" => $nodes,
    "links" => $links,
    ]) ?>
