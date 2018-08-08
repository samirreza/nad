<?php

namespace modules\nad\equipment\modules\type\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CategorySearch extends Category
{
    public function rules()
    {
        return [
            [['title', 'code'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Category::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'code', $this->code]);
        return $dataProvider;
    }
}
