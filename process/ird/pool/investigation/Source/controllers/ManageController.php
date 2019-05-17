<?php

namespace nad\process\ird\pool\investigation\source\controllers;

use nad\process\ird\pool\investigation\source\models\Source;
use nad\process\ird\pool\investigation\source\models\SourceSearch;
use nad\common\modules\investigation\source\controllers\SourceController;

class ManageController extends SourceController
{
    public function init()
    {
        $this->modelClass = Source::class;
        $this->searchClass = SourceSearch::class;
    }
}
