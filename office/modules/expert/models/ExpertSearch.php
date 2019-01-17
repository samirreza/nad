<?php

namespace nad\office\modules\expert\models;

use yii\data\ActiveDataProvider;

class ExpertSearch extends Expert
{
    public $name;
    public $surname;

    public function rules()
    {
        return [
            [['userId', 'departmentId'], 'integer'],
            [['name', 'surname'], 'string']
        ];
    }

    public function search($params)
    {
        $query = Expert::find()->joinWith('user');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'createdAt'
                ],
                'defaultOrder' => [
                    'createdAt' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'userId' => $this->userId,
            'departmentId' => $this->departmentId
        ]);

        $query->andFilterWhere(['like', 'user.name', $this->name])
            ->andFilterWhere(['like', 'user.surname', $this->surname]);

        return $dataProvider;
    }
}
