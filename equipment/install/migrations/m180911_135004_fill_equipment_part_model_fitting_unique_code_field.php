<?php

use yii\db\Migration;
use modules\nad\equipment\modules\type\details\models\Part;
use modules\nad\equipment\modules\type\details\models\Model;
use modules\nad\equipment\modules\type\details\models\Fitting;

class m180911_135004_fill_equipment_part_model_fitting_unique_code_field extends Migration
{
    public function safeUp()
    {
        $this->addColumn('nad_equipment_type_part', 'uniqueCode', $this->string());
        $this->addColumn('nad_equipment_type_part_model', 'uniqueCode', $this->string());
        $this->addColumn('nad_equipment_type_fitting', 'uniqueCode', $this->string());

        foreach (Part::find()->all() as $part) {
            $part->setUniqueCode();
            $part->save(false);
        }

        foreach (Model::find()->all() as $model) {
            $model->setUniqueCode();
            $model->save(false);
        }

        foreach (Fitting::find()->all() as $fitting) {
            $fitting->setUniqueCode();
            $fitting->save(false);
        }
    }

    public function safeDown()
    {
        echo "m180911_135004_fill_equipment_part_model_fitting_unique_code_field cannot be reverted.\n";

        return false;
    }
}
