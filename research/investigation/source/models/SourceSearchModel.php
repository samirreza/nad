<?php

namespace nad\research\investigation\source\models;

class SourceSearchModel extends \yii\base\Model
{
    public $title;
    public $tags;

    public function rules()
    {
        return [
            [['title', 'tags'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'tags' => 'کلید‌واژه‌ها'
        ];
    }
}
