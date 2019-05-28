<?php

namespace nad\common\modules\investigation\common\rules;

class ManageInvestigationRule extends \yii\rbac\Rule
{
    public $name = 'isInvestigationOwner';

    public function execute($user, $item, $params)
    {
        return isset($params['investigation']) ? $params['investigation']->createdBy == $user
            : false;
    }
}
