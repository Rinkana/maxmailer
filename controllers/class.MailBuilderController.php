<?php
/**
 * User: Rinkana
 * Date: 9-11-13
 * Time: 19:11
 * @Author: Max Berends
 */
class MailBuilderController extends Controller {
    function __construct(){
        parent::__construct();
        Session::init();
        $this->oView->setTemplate("MailBuilder");
    }
    function index(){
        $this->oView->render("MailBuilder");
    }
    function general(){
        Session::set("BuildStatus",0);
    	$this->oView->render("MailBuilder/General");
    }
    function template(){
        Session::set("BuildStatus",1);
        $this->oView->render("MailBuilder/Template");
    }
    function text(){
        Session::set("BuildStatus",2);
        $this->oView->render("MailBuilder/Text");
    }
    function receivers(){
        Session::set("BuildStatus",3);
        $this->oView->render("MailBuilder/Receivers");
    }
    function send(){
        Session::set("BuildStatus",4);
        $this->oView->render("MailBuilder/Send");
    }
}
?>