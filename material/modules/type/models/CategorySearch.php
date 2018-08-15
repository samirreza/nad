<?php

namespace modules\nad\material\modules\type\models;

use yii\data\ActiveDataProvider;

class CategorySearch extends Category
{
    public $nestedTitle;

    public function rules()
    {
        return [
            [['nestedTitle', 'code'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Category::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'tree' => SORT_DESC,
                    'lft' => SORT_ASC,
                ]
            ],
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'code' => $this->code
        ]);
        $query->andFilterWhere(['like', 'title', $this->nestedTitle]);
        return $dataProvider;
    }
}
