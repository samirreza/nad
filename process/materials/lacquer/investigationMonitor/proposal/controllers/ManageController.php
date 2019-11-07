<?php

namespace nad\process\materials\lacquer\investigationMonitor\proposal\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\materials\lacquer\investigationMonitor\proposal\models\Proposal;
use nad\process\materials\lacquer\investigationMonitor\proposal\models\ProposalSearch;
use nad\common\modules\investigation\proposal\controllers\ProposalController;

class ManageController extends ProposalController
{
    public function init()
    {
        $this->modelClass = Proposal::class;
        $this->searchClass = ProposalSearch::class;
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
                                'create'
                            ],
                            'roles' => ['lacquer.investigationMonitor']
                        ]
                    ]
                ]
            ]
        );
    }
}
