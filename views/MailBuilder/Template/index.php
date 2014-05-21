<div class="ContentWrapper">
	<form action="" method="POST">
		<?php
		$aClasses = array("Available","Disabled","Selected");
		for($i = 0; $i <= 20; $i++){

			?>
			<div class="Template Available">
				<input type="radio" name="templateSelect" value="<?php echo $i?>"/>
				<img src="<?php echo HttpPath.GEN_PUBLIC_PATH?>Images/exTemplate.jpg" alt="Template"/>
			</div>
			<?php
		}
		?>
	</form>
</div>