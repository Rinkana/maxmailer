<?php
/**
 * User: Rinkana
 * Date: 9-11-13
 * Time: 18:50
 * @Author: Max Berends
 */
//WEBSITE CONFIG


define("GEN_LIBRARY_PATH","libraries/");
define("GEN_SESSION_NAME","TestSessie");
define("GEN_DEFAULT_TEMPLATE_PATH","Main/");
define("GEN_PUBLIC_PATH","public/");

//MVC CONFIG
define("MVC_CONTROLLER_PATH","controllers/");
define("MVC_MODEL_PATH","models/");
define("MVC_VIEW_PATH","views/");
define("MVC_DEFAULT_CONTROLLER","Index");

//DATABASE CONFIG
define("DB_NAME","mm_general");
define("DB_USERNAME","root");
define("DB_PASSWORD","");
define("DB_SERVER","localhost");

//SECURITY CONFIG
//NOTE: IF YOU CHANGE ANYTHING HERE CHANCES ARE THAT THE PASSWORDS WONT WORK
define("SEC_SALT_MIN_LENGTH",22);//min length needs to be at least 22 (and 22 is recommended)
define("SEC_SALT_MAX_LENGTH",30); //Max must always be higher then min
define("SEC_CRYPT_COST",10);//Needs to be between 5 and 30. The higher the more secure but slower
define("SEC_PEPPER","JSA2139SD2$2#");//Random set of letters and numbers for hashing.
define("SEC_PASSWORD_MIN_LENGTH",6);
define("SEC_PASSWORD_MAX_LENGTH",0);// 0 = no max (Keep it that way!)

//DEVELOPER CONFIG
define("DEV_DEBUG_LEVEL",2);//0 = NONE, 1 = ERRORS AND WARNING, 2 = EVERYTHING

?>