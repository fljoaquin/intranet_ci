<div id="user-bar">
<div id="header-menu" class="left"> 
		<ul>	
			<li><a href=""> Home </a></li>
			<li><a href=""> Company Directory </a></li>
			<li><a href=""> Associate Directory </a></li>
			<li><a href=""> Announcements </a></li>
			<li><a href="<?php echo base_url(); ?>CompanyCalendar"> Company Calendar </a></li>
		</ul>
	</div>   
   <?php if($this->session->userdata('fname')){ ?><div id="logout" class="right"> <a href="<?php echo base_url() . 'logout';?>"> Logout </a> </div><?php }else{?> <div id="logout" class="right"> <a href="<?php echo base_url() . 'login';?>"> Login </a> </div> <?php } ?>
    <div id="user-info" class="right"> <p id="user-name"> <?php   echo $this->session->userdata('fname') . " " . $this->session->userdata("lname"); ?> </p> </div>
	
</div>