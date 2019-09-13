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
        return 'Lookup';
    }    

    /**
     * Returns the items for the specified type.
     * @param string item type.
     * @return array item names indexed by item code. The items are order by their order values.
     * An empty array is returned if the item type does not exist.
     */
    public static function items($type)
    {
        if (!isset(self::$_items[$type])) {
            self::loadItems($type);
        }
        return self::$_items[$type];
    }
    /**
     * Returns the item name for the specified type and code.
     * @param string the item type.
     * @param integer the item code (corresponding to the 'code' column value)
     * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
     */
    public static function item($type, $code)
    {
        if (!isset(self::$_items[$type])) {
            self::loadItems($type);
        }
        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
    }
    /**
     * Loads the lookup items for the specified type from the database.
     * @param string the item type
     */
    private static function loadItems($type)
    {
        self::$_items[$type] = array();
        $models = self::find()
            ->where([
                'type' => $type,                
            ])
            ->orderBy('position')
            ->all();
        foreach ($models as $model) {
            self::$_items[$type][$model->code] = $model->name;
        }
    }
}
