<?php

namespace nad\engineering\instrument\investigation\proposal\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\instrument\investigation\proposal\models\Proposal;
use nad\engineering\instrument\investigation\proposal\models\ProposalSearch;
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
                            'roles' => ['nad.engineering.instrument.investigation']
                        ]
                    ]
                ]
            ]
        );
    }
}
