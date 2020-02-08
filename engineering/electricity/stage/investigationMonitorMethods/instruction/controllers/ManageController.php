<?php

namespace nad\engineering\electricity\stage\investigationMonitorMethods\instruction\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\electricity\stage\investigationMonitorMethods\instruction\models\Instruction;
use nad\engineering\electricity\stage\investigationMonitorMethods\instruction\models\InstructionArchived;
use nad\engineering\electricity\stage\investigationMonitorMethods\instruction\models\InstructionSearch;
use nad\engineering\electricity\stage\investigationMonitorMethods\instruction\models\InstructionArchivedSearch;
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
                            'roles' => ['stage.investigationMonitorMethods']
                        ]
                    ]
                ]
            ]
        );
    }
}