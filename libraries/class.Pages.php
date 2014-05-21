<?php
/**
 * User: Rinkana
 * Date: 10-11-13
 * Time: 12:07
 * @Author: Max Berends
 */
class Pages{
    private $oDB;
    public function __construct() {
        $this->oDB = new Database();
    }
    public function getPageList(){
        $SQL = "SELECT pageID FROM tblpages ORDER BY pageOrder DESC";
        $aPages = array();
        foreach($this->oDB->FetchArray($SQL) as $aPage){
            $aPages[$aPage["pageID"]] = new Page($aPage["pageID"]);
        }
        return $aPages;
    }
    public function getFirstItem(){
        $SQL = "SELECT pageID FROM tblpages LIMIT 1";
        $SelectedPage = $this->oDB->FetchSingle($SQL);
        return $SelectedPage;
    }
    public function switchPageOrder($Page1, $Page2){
        $SQL = "SELECT pageOrder FROM tblpages WHERE pageID = ".$Page1;
        $PageOrder1 = $this->oDB->FetchSingle($SQL);
        $SQL = "SELECT pageOrder FROM tblpages WHERE pageID = ".$Page2;
        $PageOrder2 = $this->oDB->FetchSingle($SQL);
        if($PageOrder1 > 0 && $PageOrder2 > 0){
            $SQL = "UPDATE
                        tblpages
                    SET
                        pageOrder = :pageOrder1
                    WHERE
                        pageID = :pageID2;
                    UPDATE
                        tblpages
                    SET
                        pageOrder = :pageOrder2
                    WHERE
                        pageID = :pageID1;";
            $this->oDB->Update($SQL, array(":pageOrder1" => $PageOrder1, ":pageOrder2" => $PageOrder2, "pageID1" => $Page1,"pageID2" => $Page2));
        }
    }
}
?>