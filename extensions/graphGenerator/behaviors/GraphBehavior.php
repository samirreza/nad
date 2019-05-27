<?php

namespace nad\extensions\graphGenerator\behaviors;

use yii;
use yii\db\Query;
use yii\validators\Validator;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;

class GraphBehavior extends Behavior
{
    public $graphTableName = null;

    private $_thingLinks;
    public function getThingLinks()
    {
        $this->_thingLinks = (new Query())->select(['parent_id'])
            ->from($this->graphTableName)
            ->where(['=', 'child_id', $this->owner->id])
            ->column();

        return $this->_thingLinks;
    }
    public function setThingLinks($value)
    {                
        $this->_thingLinks = $value;
    }

    public function init()
	{
		if ( empty($this->graphTableName)) {
			throw new InvalidConfigException(
				'graphTableName property must be set.'
			);

		}        

		parent::init();
	}

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'insertThingLinks',
            ActiveRecord::EVENT_AFTER_UPDATE => 'insertThingLinks',            
        ];
    }

    public function attach($owner){
        parent::attach($owner);

        $this->owner->validators[] = Validator::createValidator('safe', $this->owner, 'thingLinks');
    }

    public function insertThingLinks()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if(!$this->owner->isNewRecord)
                Yii::$app->db->createCommand()->delete($this->graphTableName, 'child_id = '.$this->owner->id)->execute();

            foreach ($this->_thingLinks as $link) {
                Yii::$app->db->createCommand()->insert($this->graphTableName, [
                    'parent_id' => $link,
                    'child_id' => $this->owner->id,
                ])->execute();
            }

            $transaction->commit();

        }catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    public function hasLinks()
    {
        // TODO
        return true;
    }

    public function getGraphLinks()
    {
        $query = new Query();
        $links = $query->select(['p1.title AS src', 'p2.title AS dest'])
            ->from($this->owner->tableName().' AS p1')
            ->innerJoin($this->graphTableName.' AS g', 'p1.id = g.parent_id')
            ->innerJoin($this->owner->tableName().' AS p2', 'p2.id = g.child_id')
            //->limit(100)
            ->all();

        return $links;
    }

    public function getGraphNodes()
    {
        $subquery1 = (new Query())->select('parent_id')
            ->from($this->graphTableName);
        $subquery2 = (new Query())->select('child_id')
            ->from($this->graphTableName);

        $nodes = (new Query())->select(['title'])
            ->from($this->owner->tableName())
            ->where(["in", "id", $subquery1])
            ->orWhere(["in", "id", $subquery2])
            ->all();

        return array_map(function($node) {
                return $node['title'];
            }, $nodes);
    }

    public function getAllThings(){        
        return $this->owner->find()->all();        
    }

    public function getFormattedThingLinks(){
        $query = new Query();
        $links = $query->select(['p1.title AS parent'])
            ->from($this->owner->tableName().' AS p1')
            ->innerJoin($this->graphTableName.' AS g', 'p1.id = g.parent_id')
            ->innerJoin($this->owner->tableName().' AS p2', 'p2.id = '.$this->owner->id)            
            ->column();

            return implode(' , ', $links);
    }
}
