<!DOCTYPE html>
<html>
<head>
<!-- CALENDAR -->
	<link href='<?php echo base_url();?>assets/calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
	<link href='<?php echo base_url();?>assets/calendar/fullcalendar.min.css' rel='stylesheet' media='print' />
	<script src='<?php echo base_url();?>assets/calendar/moment.min.js'></script>
	<script src='<?php echo base_url();?>assets/calendar/jquery.min.js'></script>
	<script src='<?php echo base_url();?>assets/calendar/fullcalendar.min.js'></script>

    <link rel='shortcut icon' type='image/png' href="<?php echo base_url() . 'src/favicon.png'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/general.css'; ?>">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

   
	
	

	
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <style>

     .imgcontainer:hover{transition-timing-function: ease-in-out;}
 </style>
    <script>
        $(document).ready(function(){
            var header = $('.imgcontainer');

            var backgrounds = new Array(
                'url(<?php echo base_url() . "src/callcenter.png"; ?>)',
                'url(<?php echo base_url() . "src/nurse.png"; ?>)'
            );

            var current = 0;

            function nextBackground() {
                current++;
                current = current % backgrounds.length;
                header.fadeIn(1000).css('background-image', backgrounds[current]);
            }
            setInterval(nextBackground, 3000);

            header.css('background-image', backgrounds[0]);
        });
    </script>
</head>
