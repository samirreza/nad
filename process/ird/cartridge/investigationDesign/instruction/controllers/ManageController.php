<?php

namespace nad\process\ird\cartridge\investigationDesign\instruction\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\ird\cartridge\investigationDesign\instruction\models\Instruction;
use nad\process\ird\cartridge\investigationDesign\instruction\models\InstructionArchived;
use nad\process\ird\cartridge\investigationDesign\instruction\models\InstructionSearch;
use nad\process\ird\cartridge\investigationDesign\instruction\models\InstructionArchivedSearch;
use nad\common\modules\investigation\instruction\controllers\InstructionController;

class ManageController extends InstructionController
{
    public function init()
    {
        $this->archivedClassName = InstructionArchived::class;
        $this->archivedSearchClassName = InstructionArchivedSearch::class;
        $this->modelClass = Instruction::class;
        $this->searchClass = InstructionSearch::class;
    }

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'view',
                                'create',
                                'certificate',
                                'view-history',
                                'index-history'
                            ],
                            'roles' => ['@']
                            //'roles' => ['cartridge.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }
}