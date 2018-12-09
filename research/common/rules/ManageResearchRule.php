<?php

namespace modules\nad\research\common\rules;

use yii\rbac\Rule;

class ManageResearchRule extends Rule
{
    public $name = 'isResearchOwner';

    public function execute($user, $item, $params)
    {
        return isset($params['research']) ? $params['research']->createdBy == $user
            : false;
    }
}
