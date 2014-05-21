<?php
$aBuildstatus = array();
$aBuildstatus[] = array("Name" => "General data","Location" => HttpPath."MailBuilder/general");
$aBuildstatus[] = array("Name" => "Template","Location" => HttpPath."MailBuilder/template");
$aBuildstatus[] = array("Name" => "Text","Location" => HttpPath."MailBuilder/text");
$aBuildstatus[] = array("Name" => "Receivers","Location" => HttpPath."MailBuilder/receivers");
$aBuildstatus[] = array("Name" => "Send time and date","Location" => HttpPath."MailBuilder/send");
?>
<div class="StatusBar">
	<ul>
		<?php
		$iCurrentBuildStatus = Session::get("BuildStatus");
		foreach($aBuildstatus as $iStatusID => $aData){
			$sClass = "Disabled";
			if($iCurrentBuildStatus == $iStatusID){
				$sClass = "Active";
			}
			if($iCurrentBuildStatus > $iStatusID){
				$sClass = "Done";
			}
			if(($iCurrentBuildStatus + 1) == $iStatusID){
				$sClass = "Available";
			}
			?>
			<li class="<?php echo $sClass?>"><a href="<?php echo $aData["Location"]?>"><?php echo $aData["Name"]?></a></li>
			<?php
		}
		?>
	</ul>
	<span class="LastSave">
		Last save: 04-04-2014 23:28
	</span>
</div>