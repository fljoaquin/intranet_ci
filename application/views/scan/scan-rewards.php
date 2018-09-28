<script>

    $('.btn-to-scan').on('click', function(){
        //Disable textbox to prevent multiple submit
        $(this).parent().siblings('input.input-to-scan').prop("disabled", true);

        //Do Stuff, submit, etc..
        // Clear the box after submiting
        $(this).parent().siblings('input.input-to-scan').val("");
        // alert("You've pressed [ENTER] Key!");
        //Enable the textbox again if needed.
        $(this).parent().siblings('input.input-to-scan').prop("disabled", false);
    });
    $('input.input-to-scan').on('keypress', function (e) {

        if(e.which === 13){
            var id = $('#scan-reward-memberid').val();
            var snumber = $( this ).val();
            //alert(snumber);
            //Disable textbox to prevent multiple submit
            $( this ).prop("disabled", true);
            // Clear the box after submiting
            $( this ).val("");
            //Enable the textbox again if needed.
            $( this ).prop("disabled", false);
            $.post("<?php echo base_url() . 'scan/scanning'; ?>", {mid: id, rewardScan: snumber}, function(data){
                $('.modal-body').html(data);
            });
        }
    });
</script>

<div class="row">
    <div class="col-xs-4 scan-container input-group">
            <input type="text" autofocus tabindex="0" placeholder="Scan Reward" name="rewardScan" title="Scan for a Reward" id="reward_serial_number" class="form-control input-to-scan">
            <input type="hidden" name="memberid" id="scan-reward-memberid" value="<?php if(isset($mid)){ echo $mid; } ?>">
        <div class="input-group-btn">
            <button class="btn btn-default btn-to-scan" title="Scan"> <i class="glyphicon glyphicon-barcode"></i> </button>
        </div>
    </div>
    <div class="col-sm-4">

    </div>
</div>
<div class="row"><hr></div>

