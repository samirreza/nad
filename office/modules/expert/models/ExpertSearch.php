<?php

namespace nad\office\modules\expert\models;

use yii\data\ActiveDataProvider;
use modules\user\backend\models\User;

class ExpertSearch extends Expert
{
    public $name;
    public $surname;
    public $email;

    public function rules()
    {
        return [
            ['departmentId', 'integer'],
            [['name', 'surname', 'email'], 'string']
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

        $query->andFilterWhere(['departmentId' => $this->departmentId]);

        $query->andFilterWhere(['like', 'user.name', $this->name])
            ->andFilterWhere(['like', 'user.surname', $this->surname])
            ->andFilterWhere(['like', 'user.email', $this->email]);

        $query->andWhere(['<>', 'user.status', User::STATUS_SOFT_DELETED]);

        return $dataProvider;
    }
}
