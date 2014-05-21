<?php
class Debug {
    private static $errorConstants = array(
        1       => 'Error',
        2       => 'Warning',
        4       => 'Parse error',
        8       => 'Notice',
        16      => 'Core Error',
        32      => 'Core Warning',
        256     => 'User Error',
        512     => 'User Warning',
        1024    => 'User Notice',
        2048    => 'Strict',
        4096    => 'Recoverable Error',
        8192    => 'Deprecated',
        16384   => 'User Deprecated',
        32767   => 'All'
    );
	private static $DebugErrors = array();

    public function __construct(){
        set_error_handler(array($this, 'ErrorHandler'));
        set_exception_handler(array($this, 'ExceptionHandler'));
    }

    public static function ExceptionHandler($exception, $Return = false){
    	$Debugstring = "<div style='background-color:#ffffff; border:1px solid #000000; color:#000000; padding:20px;z-index:99999'>";
		$Debugstring .= "<span style='text-transform:uppercase;color:#ff0000; font-weight:bold; font-size:20px; display:block;'>EXCEPTION:</span>";
		$Debugstring .= "<strong>Message:</strong> ".$exception->getMessage().' [code: '.$exception->getCode().']<br/>';
		$Debugstring .= "<strong>In file:</strong> ". $exception->getFile()."<br/>";
		$Debugstring .= "<strong>On line:</strong> ". $exception->getLine();
		$Debugstring .= "</div>";
		self::$DebugErrors[] = $Debugstring;
		if($Return){
			return $Debugstring;
		}else{
			echo $Debugstring;
		}
		
    }
    public static function ErrorHandler($Number, $String, $File, $Line){
        $errString = (array_key_exists($Number, self::$errorConstants))? self::$errorConstants[$Number] : $Number;
		
		$Debugstring = "<div style='background-color:#ffffff; border:1px solid #000000; color:#000000; padding:20px;z-index:99999'>";
		$Debugstring .= "<span style='text-transform:uppercase;color:#ff0000; font-weight:bold; font-size:20px; display:block;'>".$errString.":</span>";
		$Debugstring .= $String.' in '.$File.' on line '.$Line;
		$Debugstring .= "</div>";
		self::$DebugErrors[] = $Debugstring;
		echo $Debugstring;
        //echo ''.$errString.': '.$String.'';
        //error_log($errString.' ['.$Number.']: '.$String.' in '.$File.' on line '.$Line);
    }
	public static function Dump($Var = "21398123_EMPTY_21312515_STRING", $SaveInHistory = false){
		$Debugstring = "<div style='overflow:auto;background-color:#ffffff; border:1px solid #000000; color:#000000; padding:20px;z-index:99999'>";
		$Debugstring .= "<span style='text-transform:uppercase;color:#ff0000; font-weight:bold; font-size:20px; display:block;'>DUMP:</span>";
		$Debugstring .= "<ul style='padding-left:40px;'>";
		$Debugstring .= "<li>";
		$Debugstring .= self::switchDebug($Var);
		$Debugstring .= "</li>";
		$Debugstring .= "</ul>";
		$Debugstring .= "</div>";

        if($SaveInHistory){
            self::$DebugErrors[] = $Debugstring;
        }else{
            echo($Debugstring);
        }
	}
	public static function DumpPrivate($Var = "21398123_EMPTY_21312515_STRING",$SaveInHistory = false){
		$Debugstring = "<div style='overflow:auto;background-color:#ffffff; border:1px solid #000000; color:#000000; padding:20px;z-index:99999'>";
		$Debugstring .= "<span style='text-transform:uppercase;color:#ff0000; font-weight:bold; font-size:20px; display:block;'>DUMP:</span>";
		$Debugstring .= "<ul style='padding-left:40px;'>";
		$Debugstring .= "<li>";
		$Debugstring .= self::switchDebug($Var, true);
		$Debugstring .= "</li>";
		$Debugstring .= "</ul>";
		$Debugstring .= "</div>";

        if($SaveInHistory){
            self::$DebugErrors[] = $Debugstring;
        }else{
            echo($Debugstring);
        }

	}
	private static function switchDebug($Var, $ShowPrivate = false){
		if ( is_object($Var) ){
			if(get_class($Var) == "Exception"){
				return self::ExceptionHandler($Var, true);
			}else{
				return self::debugObject($Var, $ShowPrivate);
			}
			
		}
		else if ( is_array($Var) ){
			return self::debugArray($Var);
		}
		else if ( is_numeric($Var) ){
			return self::debugNumeric($Var);
		}
		else if ( is_string($Var) ){
			//CHECK IF THERE IS SOMETHING GIVEN TO THE DEBUG CLASS
			if($Var == "21398123_EMPTY_21312515_STRING"){
				return "Dude, atleast send some data to debug -_-'";
			}else{
				return self::debugString($Var);
			}
		}
		else if ( is_bool($Var) ){
			return self::debugBool($Var);
		}
		else if ( is_null($Var) ){
			return self::debugNull($Var);
		}
	}
	
	private static function debugObject($Var, $ShowPrivate = false){
		if($ShowPrivate){
			$objectVars = (array)$Var;
		}else{
			$objectVars = get_object_vars($Var);
		}
		
		$ReturnString = "(Object): ";
		$ReturnString .= "<ul style='padding-left:40px;'>";
		if(count($objectVars) > 0){
			foreach($objectVars as $objectVarKey => $objectVarValue){
				$ReturnString .= "<li>";
				$ReturnString .= "(Variable): ".preg_replace("/^([^".get_class($Var)."]+)".get_class($Var)."/", "", $objectVarKey)."<br/>";
				$ReturnString .= "(Value): ".self::switchDebug($objectVarValue);
				$ReturnString .= "</li>";
			}
		}else{
			$ReturnString .= "<li style='color:#ff0000;'>No public variables found</li>";
		}
		$ReturnString .= "</ul>";
		return $ReturnString;
	}
	
	private static function debugArray($Var){
		$ReturnString = "(Array)(".count($Var)."): ";
		$ReturnString .= "<ul style='margin:0;padding-left:40px;'>";
		foreach($Var as $arrayKey => $Value){
			$ReturnString .= "<li>";
			if(isset($Value)){
				$ReturnString .= "(Key): ".$arrayKey."<br/>";
				$ReturnString .= "(Value): ".self::switchDebug($Value);
			}else{
				$ReturnString .= self::switchDebug($arrayKey);
			}
			$ReturnString .= "</li>";
		}
		$ReturnString .= "</ul>";
		return $ReturnString;
	}
	
	private static function debugNumeric($Var){
		$ReturnString = "(Numeric): ";
		$ReturnString .= "<span style='color:#7D26CD;font-weight:bold;'>".$Var."</span>";
		return $ReturnString;
	}
	
	private static function debugString($Var){
		$aTextlines = explode("\n",$Var);
		$ReturnString = "(String)(".strlen($Var)."): ";
		$ReturnString .= "<span style='overflow: auto; color:#00aa00; margin:0;'>";
		$aTextlines = array_diff($aTextlines, array('', ' ')); //REMOVE EMPTY LINES
		$aTextlines = array_filter($aTextlines);
		$TabSetIsSet = false;
		$TabCount = 0;
		$ReturnString .= "<pre style='overflow: auto; color:#00aa00; margin:0;'>";
		foreach ($aTextlines as $TextLine) {
			/*if(preg_replace('/\s+/', '', $TextLine) == ''){
				//$ReturnString .= "TRUE";
			}elseif($TabSetIsSet == false){
				$TabCount = strspn($TextLine, "\t");
				$TabSetIsSet = true;
			}
			$ReturnString .= preg_replace('/\s+/', "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", preg_replace('/^\t{'.($TabCount).'}/', "", $TextLine)) . "<br/>";*/
			$ReturnString .= $TextLine . "<br/>";
		}
		$ReturnString .= "</pre>";
		$ReturnString .= "</span>";
		//$ReturnString .= "<div style='clear:both;'></div>";
		return $ReturnString;
	}
	
	private static function debugBool($Var){
		$ReturnString = "(Boolean): ";
		if($Var){
			$ReturnString .= "<span style='color:#00aa00;font-weight:bold;'>TRUE</span>";
		}else{
			$ReturnString .= "<span style='color:#aa0000;font-weight:bold;'>FALSE</span>";
		}
		return $ReturnString;
	}
	
	private static function debugNull($Var){
		$ReturnString = "(NULL): ";
		$ReturnString .= "<span style='color:#aa0000;font-weight:bold;'>NULL</span>";
		return $ReturnString;
	}
	
	public static function getDebug(){
		//return $this->DebugErrors;
		foreach(self::$DebugErrors as $DebugDiv){
			echo $DebugDiv;
		}
	}
	public static function giveAlert($Var = 'Ik ben een alert met zonder tekst.'){
		echo "<script type='text/javascript'>window.onload=function(){alert('".(string)$Var."')}</script>";
	}
}

?>