<?php

namespace nad\rla\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class RowLevelAccessRequestSearch extends RowLevelAccessRequest
{
    public function rules()
    {
        return [
            [['description', 'type', 'status', 'is_read'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = RowLevelAccessRequest::find();

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

        if(!Yii::$app->user->can('superuser')){
            $query->andFilterWhere([
                'createdBy' => Yii::$app->user->id
            ]);
        }

        $query->andFilterWhere([
            'status' => $this->status,
            'is_read' => $this->is_read,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}