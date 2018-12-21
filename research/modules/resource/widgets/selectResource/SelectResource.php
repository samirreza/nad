<?php

namespace nad\research\modules\resource\widgets\SelectResource;

use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\research\modules\resource\models\Resource;

class SelectResource extends Select2
{
    public function init()
    {
        if (!isset($this->data)) {
            $this->data = ArrayHelper::map(
                Resource::find()->all(),
                'id',
                'codedTitle'
            );
        }
        if (!isset($this->options['placeholder'])) {
            $this->options['placeholder'] = 'عنوان منبع را وارد کنید ...';
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
