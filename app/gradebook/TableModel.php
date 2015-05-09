<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 17.04.15
 * Time: 16:42
 */

namespace app\Gradebook;


class TableModel {
    public $tableHeadColumns = [];
    public $tableRows = [];
    public $tableActions = [];
    public $modelName;
    public $modelNamePlural;

    public function __construct($pModelName, $pModelNamePlural)
    {
        $this->modelName = $pModelName;
        $this->modelNamePlural = $pModelNamePlural;
    }

    public function addHeadColumn($content, $icon = null)
    {
        array_push($this->tableHeadColumns, ['content' => $content, 'icon' => $icon]);
    }

    public function addRow()
    {

    }
}