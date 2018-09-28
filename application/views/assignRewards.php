
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
                    <form action="<?php echo base_url() . 'assignRewards/search'; ?>" method="get">
                        <div class="input-group" style="width: 370px;">
                            <input type="text" name="search" tabindex="0" class="form-control" placeholder="Look for a patient name, last name or Member #">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit" tabindex="1"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div style="float: left; margin-left: 20px;">
                    <a href="<?php echo base_url() . 'assignRewards'; ?>" tabindex="1"> Reset Filter </a>
                </div>
            </div>
        </div>
        <div class="panel-body" style="width: 100%;">
            <?php if(isset($selected_data) !== false){ ?>
                <table class="table table-bordered" border="1">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Points</th>
                        <th> Loyalty Level </th>
                        <th>YTD</th>
                        <th>Daily</th>
                        <!--<th class="select-size-control"> Gold Reward </th>-->
                        <!--<th> Date Given (Gold) </th>-->
                        <!--<th class="select-size-control"> Diamond Reward </th>-->
                        <th> Details </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $yearlyLimit = 75;
                    $dailyLimit = 15;
                        $members = array();
                        foreach($selected_data as $key => $rowData) {
                            //$yearCashValue = selectCashValueYearlyTotal($db, $rowData['unique_id']);
                            //$todayCashValue = selectCashValueDailyTotal($db, $rowData['unique_id']);
                            if(strtolower($rowData['enrollmentstatus']) != 'inactive'){
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
                                        <button class="btn btn-success more-info-btn" data-toggle="modal" data-target="#RewardsInfo" id="<?php echo $rowData['unique_id']; ?>" name="<?php echo $rowData['name'] . ' ' . $rowData['lastname']; ?>" title="Scan for a Reward"> Scan Reward <i class="glyphicon glyphicon-barcode"></i></button>
                                    </td>

                                </tr>


                                <?php
                            }
                        }

                    ?>
                    </tbody>
                </table>
                <?php
            }else{
                ?>
                <div class="message"> <?php if(isset($patient_not_found)){ echo $patient_not_found; }else{ echo "Use the search bar to look for patients"; } ?> </div>
                <?php
            }
            ?>
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


    <div id="scanReward" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                    <div class="print-btn"> <button class="glyphicon glyphicon-print printme" title="Print Screen"></button></div>
                </div>
                <div class="modal-body">
                    <div class="row">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="RewardsInfo" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                    <div class="print-btn"> <button class="glyphicon glyphicon-print printme" title="Print Screen"></button></div>
                </div>
                <div class="modal-body">
                    <div class="row">

                    </div>
                </div>
                <div class="modal-footer">
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
        $.post("<?php echo base_url() . 'scan/scanRewardsAndHistory'; ?>", {mid: id}, function(data){
            $('#scan-reward-memberid').val(id);
            $('.rewards-reports-search').val(id);
            $('.modal-body').html(data);
        });
    });

    $('.selectpicker').on('click', function(){
        var giftcardOption = $('.gift-card');
        if(giftcardOption.prop('selected') == true){
            alert('JQUERY with PHP rules');
        }
    });
    $(".notification-box").delay(3500).fadeOut( "slow" );
    $(".printme").click(function(){
        $("#RewardsInfo").printArea({ mode: 'iframe', popClose: false });
    });
</script>