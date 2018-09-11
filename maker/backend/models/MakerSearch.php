<?php

namespace modules\nad\maker\backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class MakerSearch extends Maker
{
    public function rules()
    {
        return [
            [['title', 'isLegal', 'isActive'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Maker::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'createdAt' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'isLegal' => $this->isLegal,
            'isActive' => $this->isActive,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}