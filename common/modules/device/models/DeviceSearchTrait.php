<?php
namespace nad\common\modules\device\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait DeviceSearchTrait
{
    public function attributes()
    {
        return array_merge(parent::attributes(), ['category.title', 'category.id', 'category.familyTreeTitle']);
    }

    public function rules()
    {
        return [
            [['categoryId', 'title', 'code', 'category.title', 'category.familyTreeTitle' , 'uniqueCode'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = parent::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('category');
        $query->andFilterWhere(['=', 'category.id', $this->categoryId]);
        $query->andFilterWhere(['like', 'nad_eng_device.title', $this->title]);
        $query->andFilterWhere(['like', 'nad_eng_device.code', $this->code]);
        $query->andFilterWhere(['like', 'nad_eng_device.uniqueCode', $this->uniqueCode]);
        $query->andFilterWhere(
            ['like', 'category.title', $this->getAttribute('category.title')]
        );

        return $dataProvider;
    }
}
