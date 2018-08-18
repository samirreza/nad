<?php

namespace modules\nad\supplier\backend\modules\phonebook\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PhonebookSearch extends Phonebook
{
    public function rules()
    {
        return [
            [['name', 'phone', 'email', 'jobId'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Phonebook::find();
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
            'jobId' => $this->jobId,
            'supplierId' => $params['supplierId'],
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
