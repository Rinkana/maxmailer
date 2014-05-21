<?php
/**
 * User: Rinkana
 * Date: 9-11-13
 * Time: 19:11
 * @Author: Max Berends
 */
class AjaxController extends Controller {
    function __construct(){
        parent::__construct();
    }
    function index(){
        $this->oView->render("Ajax",true);
    }
    function editableTemplate($iTemplateID){
    	$this->oView->render("Ajax-Template",true);
    }
}
?>