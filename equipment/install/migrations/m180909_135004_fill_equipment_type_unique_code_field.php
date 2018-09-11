<?php

use yii\db\Migration;
use modules\nad\equipment\modules\type\models\Type;

class m180909_135004_fill_equipment_type_unique_code_field extends Migration
{
    public function safeUp()
    {
        $this->renameColumn('nad_equipment_type', 'derivedCode', 'uniqueCode');

        foreach (Type::find()->all() as $type) {
            $type->setUniqueCode();
            $type->save(false);
        }
    }

    public function safeDown()
    {
        echo "m180909_135004_fill_equipment_type_unique_code_field cannot be reverted.\n";

        return false;
    }
}
