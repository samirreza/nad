<?php
namespace nad\common\modules\engineering\location\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait LocationSearchTrait
{
    public $stageCategoryId;

    public function attributes()
    {
        return array_merge(parent::attributes(), ['category.title']);
    }

    public function rules()
    {
        return [
            [['stageCategoryId', 'title', 'category.title', 'uniqueCode'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Location::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }
        
        $query->joinWith('category AS category');
        $query->leftJoin('nad_eng_location_stage', 'nad_eng_location_stage.locationId=nad_eng_location.id');
        $query->andFilterWhere(['=', 'nad_eng_location_stage.stageCategoryId', $this->stageCategoryId]);
        $query->andFilterWhere(['like', 'nad_eng_location.title', $this->title]);
        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);
        $query->andFilterWhere(
            ['like', 'category.title', $this->getAttribute('category.title')]
        );
        return $dataProvider;
    }
}
