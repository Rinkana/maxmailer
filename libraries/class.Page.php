<?php
/**
 * User: Rinkana
 * Date: 10-11-13
 * Time: 12:17
 * @Author: Max Berends
 */class Page {

    private $iID = 0;
    private $oDB;
    private $sPageTitle = '';
    private $sPageContent = '';
    private $iPageUnderPage = 0;
    private $iPageTemplate = 0;
    private $sPageLocation = "";
    private $iPageActive = 0;
    private $iPageInMenu = 0;
    public function __construct($iID){
        if(is_numeric($iID) && $iID > 0){
            $this->iID = $iID;
            $this->oDB = new Database();
            $this->load();
        }elseif(is_numeric($iID) && $iID == -1){
            $this->iID = $iID;
            $this->oDB = new Database();
        }else{
            throw new Exception("ID is unvalid");
        }
    }
    private function load(){
        $SQL = "
            SELECT
                pageTitle,
                pageContent,
                pageUnderPage,
                pageTemplate,
                pageLocation,
                pageActive,
                pageInMenu
            FROM
                tblpages
            WHERE
                pageID = ".$this->iID;
        $aResult = $this->oDB->FetchSingleArray($SQL);
        if(is_array($aResult)){
            $this->setTitle($aResult["pageTitle"]);
            $this->setContent($aResult["pageContent"]);
            $this->setActive($aResult["pageActive"]);
            $this->setLocation($aResult["pageLocation"]);
        }else{
            throw new Exception("Page not found",404);
        }
    }
    public function deletePage(){
        $SQL = "DELETE FROM tblpages WHERE pageID = :pageid";
        return $this->oDB->Delete($SQL, array(":pageid" => $this->iID));
    }
    public function save(){
        if($this->iID == -1){
            //new
            $sSQL = "
                INSERT INTO
                  tblpages
                  (
                    pageTitle,
                    pageContent,
                    pageActive,
                    pageTemplate
                  )
                VALUES
                  (
                    :title,
                    :content,
                    :active,
                    :template
                  )
            ";
            $aValues = array(
                ":title" => $this->sPageTitle,
                ":content" => $this->sPageContent,
                ":active" => $this->iPageActive,
                ":template" => 1
            );
            $iNewValue = $this->oDB->Insert($sSQL, $aValues);
            return $iNewValue;
        }elseif($this->iID > 0){
            //save
            $sSQL = "
                UPDATE
                    tblpages
                SET
                    pageTitle = :title,
                    pageContent = :content,
                    pageActive = :active
                WHERE
                    pageID = :ID
            ";
            $aValues = array(
                ":title" => $this->sPageTitle,
                ":content" => $this->sPageContent,
                ":active" => $this->iPageActive,
                ":ID" => $this->iID
            );
            $bUpdate = $this->oDB->Update($sSQL, $aValues);
            if($bUpdate){
                return true;
            }
        }else{
            //no id given
            return false;
        }
    }
    public function setID($iID){
        if(is_numeric($iID) && $iID > 0){
            $this->iID = $iID;
        }else{
            throw new Exception("Given ID is not valid");
        }
    }
    public function getID(){
        return $this->iID;
    }
    public function setTitle($sTitle){
        $this->sPageTitle = $sTitle;
    }
    public function getTitle(){
        return $this->sPageTitle;
    }
    public function setLocation($sLocation){
        $this->sPageLocation = $sLocation;
    }
    public function getLocation(){
        return $this->sPageLocation;
    }
    public function setContent($sContent){
        $this->sPageContent = $sContent;
    }
    public function getContent(){
        return $this->sPageContent;
    }
    public function setActive($biActive){
        if($biActive){
            $this->iPageActive = 1;
        }else{
            $this->iPageActive = 0;
        }
    }
    public function getActive(){
        if($this->iPageActive){
            return true;
        }
        return false;
    }
}
?>