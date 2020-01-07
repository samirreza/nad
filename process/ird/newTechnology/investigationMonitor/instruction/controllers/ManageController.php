<?php

namespace nad\process\ird\newTechnology\investigationMonitor\instruction\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\ird\newTechnology\investigationMonitor\instruction\models\Instruction;
use nad\process\ird\newTechnology\investigationMonitor\instruction\models\InstructionArchived;
use nad\process\ird\newTechnology\investigationMonitor\instruction\models\InstructionSearch;
use nad\process\ird\newTechnology\investigationMonitor\instruction\models\InstructionArchivedSearch;
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
                            'roles' => ['newTechnology.investigation']
                        ]
                    ]
                ]
            ]
        );
    }
}