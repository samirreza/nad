<?php
namespace nad\common\modules\device\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait PartInstanceSearchTrait
{
    public $partTitle;

    public function attributes()
    {
        return array_merge(parent::attributes(), ['partTitle']);
    }

    public function rules()
    {
        return [
            [['partId', 'code', 'deviceInstanceId', 'uniqueCode', 'partTitle'], 'safe'],
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

        $query->joinWith('part as part');
        $query->andFilterWhere(['=', 'partId', $this->partId]);
        $query->andFilterWhere(['like', 'nad_eng_device_part_instance.code', $this->code]);
        $query->andFilterWhere(['like', 'nad_eng_device_part_instance.uniqueCode', $this->uniqueCode]);
        $query->andFilterWhere(['like', 'nad_eng_device_part_instance.deviceInstanceId', $this->deviceInstanceId]);
        $query->andFilterWhere(['like', 'part.title', $this->partTitle]);

        return $dataProvider;
    }
}
