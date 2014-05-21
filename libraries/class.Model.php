<?php
/**
 * User: Rinkana
 * Date: 9-11-13
 * Time: 18:05
 * @Author: Max Berends
 */class Model {
    protected $oDB;
    function __construct(){
        $this->oDB = new Database();
    }
}
?>