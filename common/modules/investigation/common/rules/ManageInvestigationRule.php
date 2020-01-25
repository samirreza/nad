<?php

namespace nad\common\modules\investigation\common\rules;

use Yii;

class ManageInvestigationRule extends \yii\rbac\Rule
{
    public $name = 'isInvestigationOwner';

    public function execute($user, $item, $params)
    {
        if (isset($params['investigation'])) {
            if (
                ($params['investigation']->createdBy == $user)
                ||
                (
                    isset($params['allowSecondExpert'])
                    && $params['allowSecondExpert'] === true
                    && $params['investigation']->expertId == Yii::$app->user->identity->expert->id
                )
            ) {
                return true;
            }
        }

        return false;
    }
}
