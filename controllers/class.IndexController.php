<?php
/**
 * User: Rinkana
 * Date: 9-11-13
 * Time: 19:11
 * @Author: Max Berends
 */
class IndexController extends Controller {
    function __construct(){
        parent::__construct();
    }
    function index(){
        $this->oView->render("Index");
    }
}
?>