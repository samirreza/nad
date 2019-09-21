<?php
namespace nad\common\grid;

use yii\helpers\Html;
use yii\grid\DataColumn;

/**
 * A child class to customize filter input search of Yii's DataColumn.
 */
class Column extends DataColumn
{
    /**
     * Renders the filter cell content appended by a "search icon".
     * Overrides parent function.      
     * @return string the rendering result
     */
    protected function renderFilterCellContent()
    {
        return '<div class="input-group">'
        . parent::renderFilterCellContent()
        . '<div class="input-group-addon glyphicon glyphicon-search"></div>'
        . '</div>';
    }
}
