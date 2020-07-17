<?php
namespace nad\common\modules\site\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait SiteSearchTrait
{
    public function attributes()
    {
        return array_merge(parent::attributes(), ['stage.title', 'stage.id', 'stage.familyTreeTitle']);
    }

    public function rules()
    {
        return [
            [['coordinates', 'stageCategoryId', 'code', 'deviceTitle', 'deviceCode', 'stage.title', 'stage.familyTreeTitle' , 'uniqueCode'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = static::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('stage AS stage');
        $query->andFilterWhere(['=', 'stage.id', $this->stageCategoryId]);
        $query->andFilterWhere(['like', 'nad_eng_site.deviceTitle', $this->deviceTitle]);
        $query->andFilterWhere(['like', 'nad_eng_site.deviceCode', $this->deviceCode]);
        $query->andFilterWhere(['like', 'nad_eng_site.code', $this->code]);
        $query->andFilterWhere(['like', 'uniqueCode', $this->uniqueCode]);
        $query->andFilterWhere(
            ['like', 'stage.title', $this->getAttribute('stage.title')]
        );

        return $dataProvider;
    }
}
