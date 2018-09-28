	<div class="row col-font">
		<div class="col-sm-2"> Date </div>
		<div class="col-sm-4"> Reward Serial Number </div>
		<div class="col-sm-4"> Reward </div>
	</div>
<?php		
			foreach($rewards_history as $data){
?>
				<div class="row row-font">
					<div class="col-sm-2" style="background-color: lavender;"> 
						<?php 
							$date = date_create($data['date']);
								echo date_format($date, 'm/d/Y');
						?> 
					</div>
					<div class="col-sm-4" style="background-color: lavenderblush;"> <?php echo ( $data['rewardid'] ); ?> </div>
					<div class="col-sm-4" style="background-color: lightgoldenrodyellow;"> <?php echo ( $data['reward'] ); ?> </div>
				</div>
<?php
			}
?>