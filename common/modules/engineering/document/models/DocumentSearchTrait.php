<?php
namespace nad\common\modules\engineering\document\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait DocumentSearchTrait
{
    public function rules()
    {
        return [
            [['groupId', 'code', 'title', 'uniqueCode'], 'safe'],
        ];
    }

    public function search($params)
    {        
        $query = Parent::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
                               
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'code', $this->code]);
        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);
        $query->andFilterWhere(['like', 'groupId', $this->groupId]);
        return $dataProvider;
    }    
}
