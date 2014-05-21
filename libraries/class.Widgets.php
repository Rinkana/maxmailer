<?php
/**
 * User: Rinkana
 * Date: 30-11-13
 * Time: 10:48
 * @Author: Max Berends
 */
//This will handle all the widgets
class Widgets {
    private $oDB;

    private $sTable;
    private $sPrimaryKey;
    private $iID;
    private $aFields;

    private $sWidgets;

    private $oTempWidget;

    private $aErrors = array();

    private $aData;


    function __construct($sTable, $sPrimaryKey, $iID, $aFields){
        if(is_numeric($iID) && count($aFields) > 0){
            $this->sTable = $sTable;
            $this->sPrimaryKey = $sPrimaryKey;
            $this->iID = $iID;
            $this->aFields = $aFields;

            //Create database
            $this->oDB = new Database();

            $this->loadData();
        }else{
            $this->aErrors[] = "No id given";
        }

    }

    public function saveData(){
        if($this->iID > 0){
            return $this->updateData();
        } else{
            return $this->insertData();
        }
    }

    private function updateData(){
        $aValues = array();
        $SQL = "
            UPDATE
                {$this->sTable}
            SET
        ";
        $i = 0;
        foreach($this->aFields as $sColumnName => $aColumnOptions){
            $i++;
            if(!isset($_POST[$sColumnName])){
                $_POST[$sColumnName] = null;
            }
            $sWidgetName = $aColumnOptions["Type"];
            $this->oTempWidget = new $sWidgetName($sColumnName);
            $this->oTempWidget->setOptions($aColumnOptions["Options"]);
            $SQL .= " ".$sColumnName." = :".$sColumnName." ";
            $aValues[":".$sColumnName] = $this->oTempWidget->validateValue($_POST[$sColumnName]);
            if($i < count($this->aFields)){
                $SQL .= ",";
            }
            $this->oTempWidget = null;

        }
        $SQL .= " WHERE ".$this->sPrimaryKey." = ".$this->iID;

        return $this->oDB->Update($SQL,$aValues);
    }

    private function insertData(){
        $aValues = array();
        $aColumns = array();
        $aData = array();
        $SQL = "
            INSERT INTO
              {$this->sTable}
              (:Columns:)
              VALUES
              (:Data:)
        ";

        foreach($this->aFields as $sColumnName => $aColumnOptions){
            if(!isset($_POST[$sColumnName])){
                $_POST[$sColumnName] = null;
            }
            $sWidgetName = $aColumnOptions["Type"];
            $this->oTempWidget = new $sWidgetName($sColumnName);
            $this->oTempWidget->setOptions($aColumnOptions["Options"]);
            $aColumns[] = $sColumnName;
            $aData[] = ":".$sColumnName;
            $aValues[":".$sColumnName] = $this->oTempWidget->validateValue($_POST[$sColumnName]);
            $this->oTempWidget = null;
        }

        $SQL = str_replace(":Columns:",implode(", ",$aColumns),$SQL);
        $SQL = str_replace(":Data:",implode(", ",$aData),$SQL);
        return $this->oDB->Insert($SQL,$aValues);
    }

    public function deleteData(){
        $SQL = "DELETE FROM {$this->sTable} WHERE {$this->sPrimaryKey} = :pageid";
        return $this->oDB->Delete($SQL, array(":pageid" => $this->iID));
    }

    public function loadData(){
        if($this->iID > 0){
            $sFields = implode(",",array_keys($this->aFields));
            $SQL = "
                SELECT
                    {$sFields}
                FROM
                    {$this->sTable}
                WHERE
                    {$this->sPrimaryKey} = :ID
                LIMIT
                    1
            ";

            $aValues = array(":ID" => $this->iID);

            $aResult = $this->oDB->FetchSingleArray($SQL,$aValues);

            if($aResult){
                $this->aData = $aResult;
            }else{
                $this->aErrors[] = "The returned result was not valid";
            }
        }
    }

    public function createWidgets(){
        foreach($this->aFields as $sColumnName => $ColumnConfig){
            $this->addWidget($ColumnConfig["Type"],$sColumnName,$ColumnConfig["Options"]);
        }
    }

    private function addWidget($sWidgetName, $sColumnName, $aOptions = array()){

        if($this->checkWidgetName($sWidgetName)){
            try{
                $this->oTempWidget = new $sWidgetName($sColumnName);
                if(!$this->iID > 0 || $this->iID == -1){
                    $this->oTempWidget->setValue("");
                }elseif(isset($this->aData[$sColumnName])){
                    $this->oTempWidget->setValue($this->aData[$sColumnName]);
                }else{
                    $this->aErrors[] = "Database column not found ".$this->iID;
                }

                $this->oTempWidget->setOptions($aOptions);
                $this->sWidgets .= $this->oTempWidget->render();
            }catch (Exception $e){
                $this->aErrors[] = $e->getMessage();
            }
        }

    }

    private function checkWidgetName($sWidgetName){
        if(defined("ADM_AVALIBLE_WIDGETS")){
            $aAvalibleWidgets = explode(",",ADM_AVALIBLE_WIDGETS);
            if(in_array($sWidgetName,$aAvalibleWidgets)){
                return true;
            }
            $this->aErrors[] = "Widget not avalible";
        }
        $this->aErrors[] = "Constant 'ADM_AVALIBLE_WIDGETS' is not set";
    }

    public function getWidgets(){
        $this->sWidgets .= "<input type='hidden' name='id' value='".$this->iID."'>";
        return $this->sWidgets;
    }

    public function getErrors(){
        return Debug::Dump($this->aErrors);
    }
}
?>