<?php
    $currentFile = $_SERVER["PHP_SELF"];
    $parts = Explode('/', $currentFile);
    $current_file_name = $parts[count($parts) - 1];
    $page_title = Explode('.', $current_file_name);
    $page_title = $page_title[count($page_title) - 1];
    $page_title = preg_replace('/(\w+)([A-Z])/U', '\\1 \\2', $page_title);
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!--<div class="navbar-header">
            <a class="navbar-brand" href="#"></a>
        </div>-->
        <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url() . 'home'; ?>">Home</a></li>

            <li class="<?php if($current_file_name == 'memberSearch.php'){ echo 'active'; }else{ echo 'inactive'; }?>"><a href="<?php echo base_url() . 'memberSearch'; ?>"> Member Search <span class="glyphicon glyphicon-search"></span></a></li>
            <li class="<?php if($current_file_name == 'assignRewards.php'){ echo 'active'; }else{ echo 'inactive'; }?>"><a href="<?php echo base_url() . 'assignRewards'; ?>"> Assign a Reward </a></li>
            <li class="<?php if($current_file_name == 'addPoints.php'){ echo 'active'; }else{ echo 'inactive'; }?>"><a href="addPoints.php"> Add Points </a></li>

            <li class="dropdown <?php if($current_file_name == 'activitiesImportUI.php' || $current_file_name == 'enrollmentDisenrollmentUI.php' || $current_file_name == 'rewardsFulfillmentImportUI.php'){ echo 'active'; }else{ echo 'inactive'; }?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Import Forms
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="activitiesImportUI.php"> Activities Import </a></li>
                    <li><a href="enrollmentDisenrollmentUI.php"> Enrollment / Disenrollment </a></li>
                    <li><a href="rewardsFulfillmentImportUI.php"> Rewards Fulfillment (Upload) </a></li>
                </ul>
            </li>
            <li class="dropdown <?php if($current_file_name == 'newMemberReport.php' || $current_file_name == 'rewardsFulfillmentUI.php'){ echo 'active'; }else{ echo 'inactive'; }?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reports
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="newMemberReport.php"> New Member Report </a></li>
                    <li><a href="rewardsFulfillmentUI.php"> Rewards Fulfillment Report </a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>