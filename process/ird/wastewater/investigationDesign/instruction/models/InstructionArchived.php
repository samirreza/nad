<?php

namespace nad\process\ird\wastewater\investigationDesign\instruction\models;

use nad\process\ird\wastewater\investigationDesign\instruction\models\Instruction;
use nad\process\ird\wastewater\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\instruction\models\InstructionArchived as BaseInstructionArchived;

class InstructionArchived extends BaseInstructionArchived
{
    const CONSUMER_CODE = Instruction::CONSUMER_CODE;

    public $moduleId = 'wastewater';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/wastewater/investigationDesign/instruction/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_instruction.consumer' => self::CONSUMER_CODE]);
    }
}
