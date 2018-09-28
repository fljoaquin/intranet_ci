    <div class="row col-font">
        <div class="col-sm-3"> Visit Date </div>
        <div class="col-sm-8"> Description </div>
    </div>
<?php
    foreach($points_history as $data){
?>
        <div class="row row-font">
            <div class="col-sm-3" style="background-color: lavenderblush;">
                <?php
                    $visit_date = date_create($data['visitdate']);
                    echo date_format($visit_date, 'm-d-Y');
                ?>

            </div>
            <div class="col-sm-8" style="background-color: lightgoldenrodyellow;"> <?php echo ( $data['description'] ); ?> </div>
        </div>
<?php
    }
?>