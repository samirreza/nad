<?php

namespace nad\common\modules\investigation\source\models;

use yii\data\ActiveDataProvider;

trait CategorySearchTrait
{
    public function rules()
    {
        return [
            ['title', 'string'],
            ['depth', 'integer']
        ];
    }

    public function search($params)
    {
        $query = parent::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'tree' => SORT_DESC,
                    'lft' => SORT_ASC
                ]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['depth' => $this->depth]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
