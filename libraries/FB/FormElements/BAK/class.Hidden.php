<?php
/**
 * User: Rinkana
 * Date: 10-11-13
 * Time: 11:44
 * @Author: Max Berends
 */
class Hidden{
    private $sName = NULL;
    private $Value = NULL;
    public function __construct($sName){
        if(strlen($sName) > 0){
            $this->sName = $sName;
        }else{
            throw new Exception("Name not long enough");
        }
    }
    public function setValue($Value){
        //Set the value
        $this->validateValue($Value); //Check if the given value is correct
    }
    public function setOptions($aOptions){
        /*
         * Example:
         * $aOptions = array(
                "Label" => "test",
                "Width" => 100,
                "Height" => 200,
                "Attributes" => array("Readonly","Disabled")
            );
         */

        foreach($aOptions as $aOption => $optionData){
            $sFunctionName = "set".$aOption;
            $this->$sFunctionName($optionData);
        }
    }
    public function validateValue($Value){
        //Optional validation. For now it just applies it.
        $this->Value = $Value;

        return $this->Value;
    }
    public function render($WithDiv = false){
        if(!is_null($this->sName)){
            $HTMLElement = "";
            if($WithDiv){
                $HTMLElement .= "<div class='FormElement hidden'>";
            }
            $HTMLElement = "<input name='".$this->sName."' type='hidden' ";
            $HTMLElement .= "value='".$this->Value."' ";
            $HTMLElement .= " />";
            if($WithDiv){
                $HTMLElement .= "</div>";
            }
            return $HTMLElement;
        }else{
            throw new Exception("No name given");
        }
    }
}
?>