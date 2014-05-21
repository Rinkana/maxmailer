<div class="ContentWrapper">
	<?php
	$aGroups = array();
	$aGroups[] = array("Name" => "Website", "Count" => rand(500,20000));
	$aGroups[] = array("Name" => "Import 22/1", "Count" => rand(500,20000));
	$aGroups[] = array("Name" => "Default", "Count" => rand(500,20000));
	?>
	<table class="ReceiverSelection" >
		<thead>
			<tr>
				<th><input class="checkall" type="checkbox" name="receivers[]" value="all"/></th>
				<th>Group name</th>
				<th>Amount of people</th>
			</tr>
		</thead>	
		<tbody>
			
			<?php
			foreach ($aGroups as $iID => $aData) {
				?>
				<tr>
					<td><input type="checkbox" name="receivers[]" value="<?php echo iID?>"/></td>
					<td><?php echo $aData["Name"]?></td>
					<td><?php echo $aData["Count"]?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>