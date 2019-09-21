<?php

namespace nad\common\modules\engineering\stage\models;

use yii\data\ActiveDataProvider;

class CategorySearch extends Category
{
    public $titleOrCode;

    public function rules()
    {
        return [
            [['title', 'code', 'depth', 'titleOrCode'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Category::find()->orderBy(['code' => SORT_ASC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>false
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'code' => $this->code,
            'depth' => $this->depth,
        ]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['or', ['like', 'title', $this->titleOrCode], ['like', 'code', $this->titleOrCode]]);        
        return $dataProvider;
    }
}
