<?php

namespace nad\extensions\documentation\models;

use yii\data\ActiveDataProvider;

class Documentation extends \yii\db\ActiveRecord
{
    public function search()
    {
        $query = File::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['id']
            ]
        ]);

        $query->andFilterWhere([
            'documentationId' => $this->id
        ]);

        return $dataProvider;
    }

    public function getFiles()
    {
        return $this->hasMany(File::class, ['documentationId' => 'id']);
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        foreach ($this->files as $file) {
            $file->delete();
        }
        return true;
    }

    public static function tableName()
    {
        return 'module_documentation';
    }

    public static function find()
    {
        return parent::find()->with('files');
    }
}
