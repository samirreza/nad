<?php

use yii\db\Migration;

class m181217_170705_change_material_type_permission extends Migration
{
    public function safeUp()
    {
        Yii::$app->db->createCommand()->update(
            'auth_item',
            ['name' => 'research.material'],
            ['name' => 'material.type']
        )->execute();
    }

    public function safeDown()
    {
        echo "m181217_170705_change_material_type_permission cannot be reverted.\n";
        return false;
    }
}
