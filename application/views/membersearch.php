
<body>
<?php

/*if(isset($_GET['search']) && !empty($_GET['search']) || isset($_GET['page'])) {

    $name = $_GET['search'];

    $post = "AND name LIKE '" .$name. "%' OR memberid = '" .$name. "' OR lastname LIKE '" .$name. "%'";
    $query_total_rows = "SELECT id, enrollmentstatus, memberid, name, lastname FROM ptgeneralinfo WHERE enrollmentstatus = 'active' " . $post;
    $total_rows_result = $db->query($query_total_rows);
    if($total_rows_result-> num_rows){
        $total_rows_r = $total_rows_result-> num_rows;
    }
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 0;
    }
    $limit = 25;
    $querySelect = "SELECT * FROM ptgeneralinfo WHERE enrollmentstatus = 'active' " . $post . ' ORDER BY name ASC LIMIT ' . $page . ',' . $limit;
    $query = $db->query($querySelect);
}else {

    $name = '';
    $post = '';
}
*/


//echo '<pre>';
//print_r($total_rows_r);
//echo '</pre>';
?>

<div class="container">
    <div class="main-reward-container">
        <div class="notification-box">
            <?php if(isset($notification['success'])) { ?>
                <div class="notification-success text-success">
                    <?php
                    foreach($notification['success'] as $success){
                        ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong> <?php echo $success; ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php } ?>

            <?php if(isset($notification['notsuccess'])) { ?>
                <div class="notification-not-success text-danger">
                    <?php
                    foreach($notification['notsuccess'] as $not_success){
                        ?>
                        <div class="alert alert-danger">
                            <strong>Cannot add </strong> <?php echo $not_success; ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php } ?>
        </div>


    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div style="width: auto; height: 30px;">
                <div style="float: left;">
                    <form action="<?php echo base_url(). "memberSearch/Search"; ?>" method="GET">
                        <div class="input-group" style="width: 370px;">
                            <input type="text" name="search" tabindex="0" class="form-control" placeholder="Look for a patient name, last name or Member #">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit" tabindex="1"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div style="float: left; margin-left: 20px;">
                    <a href="<?php echo base_url(). "MemberSearch"; ?>" tabindex="1"> Reset Filter </a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="width: 100%;">
            <?php if(isset($selected_data) !== false){ ?>
                <table class="table table-bordered" border="1">
                    <thead>
                    <tr>
                        <th>Member #</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Points</th>
                        <th> Loyalty Level </th>
                        <th>YTD</th>
                        <th>Daily</th>

                        <th> Details </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                   // echo $this->db->last_query(); die;
                    $yearlyLimit = 75;
                    $dailyLimit = 15;
                   // $members = array();
                       // echo '<pre>';
                   // var_dump($this->_ci_cached_vars);
                      //print_r($YTD);
                      //  echo $selected_data['name'];
                       // echo '</pre>';
                        foreach($selected_data as $rowData) {

                            //$yearCashValue = selectCashValueYearlyTotal($db, $rowData['memberid']);
                           // $todayCashValue = selectCashValueDailyTotal($db, $rowData['memberid']);
                                ?>

                                <tr>
                                    <td class="align-middle"> <?php echo $rowData['unique_id']; ?> </td>
                                    <td class="align-middle"> <?php echo $rowData['name'] . ' ' . $rowData['lastname']; ?> </td>
                                    <td class="align-middle">
                                        <?php
                                            $dob = date_create($rowData['dob']);
                                            echo date_format($dob, 'm/d/Y');
                                        ?>
                                    </td>
                                    <td class="align-middle"> <?php echo $rowData['points']; ?> </td>
                                    <td class="align-middle"> <?php echo $rowData['level']; ?> </td>
                                    <td class="align-middle"> <span class="dollar-sign">$</span><span class="dollar-sign" style="color: <?php echo ($YTD[$rowData['unique_id']] < $yearlyLimit ? 'GREEN' : 'TOMATO'); ?>"><?php  echo $YTD[$rowData['unique_id']]; ?></span> </td>
                                    <td class="align-middle"> <span class="dollar-sign">$</span><span class="dollar-sign" style="color: <?php echo ($TDV[$rowData['unique_id']] < $dailyLimit ? 'GREEN' : 'TOMATO'); ?>"><?php echo $TDV[$rowData['unique_id']]; ?></span> </td>
                                    <td class="align-middle">
                                        <button class="btn btn-success more-info-btn" data-toggle="modal" data-target="#RewardsInfo" id="<?php echo $rowData['unique_id']; ?>" name="<?php echo $rowData['name'] . ' ' . $rowData['lastname']; ?>" title="Rewards History"> Rewards History </button>
                                        <button class="btn btn-primary more-info-btn-points" data-toggle="modal" data-target="#PointsInfo" id="<?php echo $rowData['unique_id']; ?>" name="<?php echo $rowData['name'] . ' ' . $rowData['lastname']; ?>" title="More Info"> Points History </button>
                                    </td>

                                </tr>


                                <?php

                        }

                    ?>
                    </tbody>
                </table>
                <?php } else { ?>
                    <div class="message"> <?php if(isset($patient_not_found)){ echo $patient_not_found; }else{ echo "Use the search bar to look for patients"; } ?> </div>
                <?php } ?>

        </div>
    </div>
    <div class="pagination-container">
        <?php
        if(isset($total_rows_r) && $total_rows_r > $limit) {
            //echo $total_rows_r;
             $total_pages = round($total_rows_r / $limit);
            ?>
            <ul class="pagination">
                <?php
                if(isset($page) && $page > 0){
                    $previous_page = $page-1;

                    ?>
                    <li><a href="?page=<?php echo $previous_page; ?>&search=<?php echo $search; ?>"> Previous </a></li>
                    <?php
                }
                ?>
                <li class="active"><a><?php if(isset($page) && $page > 0) { echo $page + 1; }else{ echo 1; } ?></a></li>
                <?php
                if(isset($page) && $page < $total_pages){
                    $next_page = $page+1;
                    ?>
                    <li><a href="?page=<?php echo $next_page; ?>&search=<?php echo $search; ?>"> Next </a></li>
                    <?php
                }
                ?>
            </ul>
            <?php
        }
        ?>
    </div>
    <div id="RewardsInfo" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                    <div class="print-btn"> <button class="glyphicon glyphicon-print printmeRewards" title="Print Screen"></button></div>
                </div>
                <div class="modal-body">
                    <div class="row" id="main-row"> <div class="loader"></div> </div>
                </div>
                <div class="modal-footer">
                    <form action="<?php echo base_url() . 'assignRewards/search'; ?>" method="get">
                        <input type="hidden" name="search" class="rewards-reports-search">
                        <button type="submit" class="btn btn-success assign-rewards-btn"> Assign Rewards  <span class="glyphicon glyphicon-plus"></span> </button>
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="PointsInfo" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                    <div class="print-btn"> <button class="glyphicon glyphicon-print printmePoints" title="Print Screen"></button></div>
                </div>
                <div class="modal-body">
                    <div class="row" id="main-row">

                    </div>
                </div>
                <div class="modal-footer">
                    <form action="addPoints.php" method="POST">
                        <input type="hidden" name="search" class="points-reports-search">
                        <button type="submit" class="btn btn-primary assign-rewards-btn"> Add Points <span class="glyphicon glyphicon-plus"></span> </button>
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('hide.bs.modal','.modal', function () {
        $(".modal-body").html('<div class="loader"></div>');
    });

    $('.more-info-btn').on('click', function(){
        var id = this.id;
        var name = this.name;
        $('.modal-title').html(name);
        $('#RewardsInfo').attr("data-id", id);
        $('#RewardsInfo').attr("dname", name);
        $.post("<?php echo base_url() . 'modalHistory/rewardsreportYearly'; ?>", {mid: id}, function(data){
            $('.modal-body').html(data);
            $('.rewards-reports-search').val(id);
        });
    });

    //more-info-btn-points
    $('.more-info-btn-points').on('click', function(){
        var id = this.id;
        var name = this.name;
        $('.modal-title').html(name);
        $('#PointsInfo').attr("data-id", id);
        $('#PointsInfo').attr("dname", name);
        $.post("<?php echo base_url() . 'modalHistory/pointsreportYearly'; ?>", {mid: id}, function(data){
            $('.modal-body').html(data);
            $('.points-reports-search').val(id);

        });
    });

    $(".notification-box").delay(3500).fadeOut( "slow" );

    $(".printmeRewards").click(function(){
        $("#RewardsInfo").printArea({ mode: 'iframe', popClose: false });
    });
    $(".printmePoints").click(function(){
        $("#PointsInfo").printArea({ mode: 'iframe', popClose: false });
    });

</script>
</body>
</html>