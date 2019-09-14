<?php

namespace modules\nad\supplier\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class SupplierSearch extends Supplier
{
    public function rules()
    {
        return [
            [['name', 'isForeign', 'type', 'isActive', 'equipments', 'materials','parts'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Supplier::find();

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
            'isForeign' => $this->isForeign,
            'isActive' => $this->isActive,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        if (!empty($this->equipments)) {
            $query->joinWith('equipTypes as equipment');
            $query->andFilterWhere(['like', 'equipment.title', $this->equipments]);
        }
        if (!empty($this->materials)) {
            $query->joinWith('matTypes as material');
            $query->andFilterWhere(['like', 'material.title', $this->materials]);
        }
        if (!empty($this->parts)) {
            $query->joinWith('partsRelation as part');
            $query->andFilterWhere(['like', 'part.title', $this->parts]);
        }

        return $dataProvider;
    }
}