<?php
namespace nad\common\modules\device\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

trait DevicePartSearchTrait
{
    public function attributes()
    {
        return array_merge(parent::attributes(), ['device.title', 'device.id']);
    }

    public function rules()
    {
        return [
            [['title', 'group', 'deviceId', 'code', 'uniqueCode', 'device.title'], 'safe'],
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

        $query->joinWith('device');
        $query->andFilterWhere(['=', 'deviceId', $this->deviceId]);
        $query->andFilterWhere(['like', 'nad_eng_device_part.title', $this->title]);
        $query->andFilterWhere(['like', 'nad_eng_device_part.group', $this->group]);
        $query->andFilterWhere(['like', 'nad_eng_device_part.code', $this->code]);
        $query->andFilterWhere(['like', 'nad_eng_device_part.uniqueCode', $this->uniqueCode]);

        return $dataProvider;
    }
}
