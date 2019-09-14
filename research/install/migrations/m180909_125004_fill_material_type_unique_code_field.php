<?php

use yii\db\Migration;
use modules\nad\research\modules\material\models\Type;

class m180909_125004_fill_material_type_unique_code_field extends Migration
{
    public function safeUp()
    {
        $this->renameColumn('nad_material_type', 'derivedCode', 'uniqueCode');

        foreach (Type::find()->all() as $type) {
            $type->setUniqueCode();
            $type->save(false);
        }
    }

    public function safeDown()
    {
        echo "m180909_125004_fill_material_type_unique_code_field cannot be reverted.\n";

        return false;
    }
}
