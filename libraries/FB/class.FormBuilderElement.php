<?php
/**
 * User: Rinkana
 * Date: 1-12-13
 * Time: 20:57
 * @Author: Max Berends
 */

abstract class FormBuilderElement extends FormBuilderBase{
    protected $aAttributes = array();

    protected $aValidation = array();

    protected $oForm;

    protected $sName;
    protected $sLabel;
    protected $sDescription;

    protected $aErrors = array();

    public function __construct($sName, $sLabel, $aOptions = array()){
        $aOptions["Name"] = $sName;
        $aOptions["ID"] = $sName;
        $aOptions["Label"] = $sLabel;
        $this->setConfig($aOptions);
    }

    public function setForm(FormBuilderForm $oForm){
        $this->oForm = $oForm;
    }

    public function setDescription($sDescription){
        $this->sDescription = $sDescription;
    }

    public function getDescription(){
        return $this->sDescription;
    }

    public function getErrors(){
        return $this->aErrors;
    }

    public function setRequired($bRequired){
        if($bRequired){
            $this->aValidation[] = new FBRequired();
        }
    }

    public function setValidation($Rules){

        if(is_array($Rules)){
            foreach($Rules as $oRule){
                if($oRule instanceof FormBuilderValidation){
                    $this->aValidation[] = $oRule;
                }
            }
        }elseif($Rules instanceof FormValidation){
            $this->aValidation[] = $Rules;
        }
    }
    public function getFieldName(){
        if(strlen($this->sLabel) > 0){
            $sFieldName = $this->sLabel;
        }elseif(isset($this->aAttributes["placeholder"])){
            $sFieldName = $this->aAttributes["placeholder"];
        }elseif(strlen($this->sName) > 0){
            $sFieldName = $this->sName;
        }else{
            $sFieldName = 'undifined';
        }
        return $sFieldName;
    }
    public function validate($Value){
        $bValid = true;

        if(count($this->aValidation) > 0){
            $sFieldName = $this->getFieldName();
            foreach($this->aValidation as $oRule){
                if(!$oRule->isValid($Value)){
                    $this->aErrors = str_replace("%field%",$sFieldName, $oRule->getError());
                    $bValid = false;
                }
            }
        }
        return $bValid;
    }


    public function render(){

        return "<input ".$this->getAttributes()." />";
    }
    public function getHTMLLabel(){
        $sHTML = "<label for='".$this->getAttribute("ID")."'>";
        $sHTML .= $this->getAttribute("Label");
        $sHTML .= "</label>";
        return $sHTML;

    }
}
?>