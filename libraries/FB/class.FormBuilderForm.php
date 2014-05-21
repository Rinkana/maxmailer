<?php
/**
 * User: Rinkana
 * Date: 1-12-13
 * Time: 22:58
 * @Author: Max Berends
 */

class FormBuilderForm extends FormBuilderBase{
    protected $aElements = array();
    protected $aValues = array();
    protected $aAttributes = array();
    protected $oTemplate;

    protected $aErrors = array();

    public function __construct($sID, $oTemplate, $sMethod = "POST", $sAction = RequestPath){
        $aConfig = array(
            "id" => $sID,
            "method" => $sMethod,
            "action" => $sAction
        );
        if($oTemplate instanceof FormBuilderTemplate){
            $this->oTemplate = $oTemplate;
        }else{
            throw new Exception("No valid template");
        }
        $this->setConfig($aConfig);
    }


    public function setValues($aValues){
        if(is_array($aValues)){
            $this->aValues = array_merge($this->aValues, $aValues);
        }
    }

    public function addElement(FormBuilderElement $oElement){
        $oElement->setForm($this);
        $this->aElements[] = $oElement;
    }

    public function setElementValues(){
        foreach($this->aElements as $oElement){
            $sName = $oElement->getAttribute("name");
            if(isset($this->aValues[$sName])){
                $oElement->addAttribute("value", $this->aValues[$sName],true);
            }
        }
    }
    public function saveToSession(){
        Session::init();
        Session::set("Form".$this->getAttribute("id"), serialize($this));
    }
    public static function loadFromSession($sID){
        Session::init();
        if(Session::get("Form".$sID)){
            return unserialize(Session::get("Form".$sID));
        }else{
            return false;
        }
    }

    public static function getSendValues($sID){
        $oForm = self::loadFromSession($sID);
        switch($_SERVER["REQUEST_METHOD"]){
            case "POST":
                $aData = $_POST;
                break;
            default:
                $aData = $_GET;
                break;
        }
        $aValues = array();
        foreach($oForm->aElements as $oElement){
            $sElementName = $oElement->getAttribute("Name");
            $Value = null;
            if(isset($aData[$sElementName])){
                $Value = $aData[$sElementName];
            }
            $aValues[$sElementName] = $Value;
        }
        return $aValues;
    }

    public static function validateForm($sID){
        $bIsValid = true;
        $oForm = self::loadFromSession($sID);

        switch($_SERVER["REQUEST_METHOD"]){
            case "POST":
                $aData = $_POST;
                break;
            default:
                $aData = $_GET;
                break;
        }

        if(!empty($oForm)){

            if(!empty($oForm->aElements)){

                foreach($oForm->aElements as $oElement){

                    $sElementName = $oElement->getAttribute("Name");
                    $Value = null;
                    if(isset($aData[$sElementName])){

                        $Value = $aData[$sElementName];
                        if(is_array($Value)){

                            for($i = 0; $i < count($Value); $i++){
                                $Value[$i] = stripslashes($Value[$i]);
                            }
                        }else{

                            $Value = stripslashes($Value);
                        }
                    }
                    if(!$oElement->validate($Value)){

                        $bIsValid = false;
                    }
                }
            }else{
                $bIsValid = false;
            }
        }else{
            $bIsValid = false;
        }
        return $bIsValid;
    }

    public function build($bLoadFromRequest = false){
        if($this->oTemplate instanceof FormBuilderTemplate){
            $aValues = false;
            if($bLoadFromRequest){
                $aValues = self::getSendValues($this->getAttribute("id"));
            }
            if(is_array($aValues)){
                $this->setValues($aValues);
                $this->setElementValues();
            }
            $sHTML = "<form ".$this->getAttributes().">";
            $sHTML .= $this->oTemplate->render($this->aElements);
            $sHTML .= "</form>";
            $this->saveToSession();
            return $sHTML;
        }
        return false;
    }
}
?>