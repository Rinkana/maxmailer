<?php
class LoginController extends Controller {
    function __construct(){
        parent::__construct();
        $this->oView->setTemplate("Login");
    }
    function index(){
        $this->oModel->login();
        if($this->oModel->checkLoggedIn()){
            if(Session::get("PreLoginURL")){
                header("location: ".Session::get("PreLoginURL"));
            }
        }
        $this->oView->render("Login");
    }
    function logout(){
        $this->oModel->logout();
    }
}
?>