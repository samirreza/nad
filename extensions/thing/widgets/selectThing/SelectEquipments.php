<?php

namespace nad\extensions\thing\widgets\selectThing;

use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use modules\nad\equipment\models\Type;

class SelectEquipments extends Select2
{
    public function init()
    {
        if (!isset($this->data)) {
            $this->data = ArrayHelper::map(
                Type::find()->all(),
                'id',
                'title'
            );
        }
        if (!isset($this->options['placeholder'])) {
            $this->options['placeholder'] = 'تجهیزات را انتخاب کنید ...';
        }
        if (!isset($this->options['multiple'])) {
            $this->options['multiple'] = true;
        }
        if (!isset($this->pluginOptions['allowClear'])) {
            $this->pluginOptions['allowClear'] = true;
        }
        parent::init();
    }
}
