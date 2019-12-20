<?php
namespace nad\common\helpers;

/**
 *
 * The followings are the available columns in table 'lookup':
 * @property integer $id
 * @property string $name
 * @property integer $code
 * @property string $type
 * @property integer $position
 */
class Lookup extends \yii\db\ActiveRecord
{
    private static $_items = [];

    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'lookup';
    }

    public function getCodedName($useExtraAsCode = false){
        if ($useExtraAsCode) {
            if (!isset($this->extra) || empty($this->extra)) {
                return 'فاقد کد' . ' - ' . $this->name;
            }else {
                return $this->extra . ' - ' . $this->name;
            }
        }

        return $this->code . '. ' . $this->name;
    }

    /**
     * Returns the items for the specified type.
     * @param string item type.
     * @param boolean useCodedNames.
     * @return array item names indexed by item code. The items are order by their order values.
     * An empty array is returned if the item type does not exist.
     */
    public static function items($type, $useCodedNames = false)
    {
        if (!isset(self::$_items[$type])) {
            self::loadItems($type, $useCodedNames);
        }
        return self::$_items[$type];
    }
    /**
     * Returns the item name for the specified type and code.
     * @param string the item type.
     * @param integer the item code (corresponding to the 'code' column value)
     * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
     */
    public static function item($type, $code, $useCodedName = false)
    {
        if (!isset(self::$_items[$type])) {
            self::loadItems($type, $useCodedName);
        }
        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
    }
    /**
     * Loads the lookup items for the specified type from the database.
     * @param string the item type.
     * @param boolean useCodedNames.
     */
    private static function loadItems($type, $useCodedNames = false)
    {
        self::$_items[$type] = array();
        $models = self::find()
            ->where([
                'type' => $type,
            ])
            ->orderBy('position')
            ->all();

        foreach ($models as $model) {
            self::$_items[$type][$model->code] = (($useCodedNames) ? $model->getCodedName() : $model->name);
        }
    }

    public static function extras($type, $useCodedNames = false)
    {
        if (!isset(self::$_items[$type])) {
            self::loadExtras($type, $useCodedNames);
        }
        return self::$_items[$type];
    }

    private static function loadExtras($type, $useCodedNames = false)
    {
        self::$_items[$type] = array();
        $models = self::find()
            ->where([
                'type' => $type,
            ])
            ->orderBy('position')
            ->all();

        foreach ($models as $model) {
            self::$_items[$type][$model->code] = (($useCodedNames) ? $model->getCodedName(true) : $model->extra);
        }
    }
}
