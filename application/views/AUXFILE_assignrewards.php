<td class="align-middle select-size-control">
    <?php
    if(isset($memberid) && $memberid == $rowData['unique_id'] && isset($rewardnotfoundS) == true){
        ?>
        <span style="color: tomato;"> Reward not Found in Data base </span>
        <?php
    }
    ?>

    <form action="" method="post">
        <input type="text" tabindex="0" placeholder="Scan a Silver Reward" name="rewardsilver" title="Scan a Silver Reward" id="<?php echo $rowData['unique_id']; ?>" class="input-to-scan silver-field-to-scan">
        <input type="hidden" name="addSilver">
        <input type="hidden" name="reward" value="silverreward">
        <input type="hidden" name="level" value="silver">
        <input type="hidden" name="search" value="<?php if(isset($_POST['search'])){ echo $_POST['search']; }?>">
        <input type="hidden" name="memberid" value="<?php echo $rowData['unique_id']; ?>">
    </form>
</td>

<?php
if($rowData['points'] < 200 ) {
    ?>
    <td class="not-qualify">
        Patient does not qualify for a Gold Reward
    </td>
    <?php
}else{

    ?>
    <td class="align-middle select-size-control">
        <?php
        if(isset($memberid) && $memberid == $rowData['unique_id'] && isset($rewardnotfoundG) == true){
            ?>
            <span style="color: tomato;"> Reward not Found in Data base </span>
            <?php
        }
        ?>
        <form action="" method="post">
            <input type="text" tabindex="0" placeholder="Scan a Gold Reward" name="rewardgold" title="Scan a Gold Reward" id="<?php echo $rowData['unique_id']; ?>" class="input-to-scan">
            <input type="hidden" name="addGold">
            <input type="hidden" name="reward" value="goldreward">
            <input type="hidden" name="level" value="gold">
            <input type="hidden" name="search" value="<?php if(isset($_POST['search'])){ echo $_POST['search']; }?>">
            <input type="hidden" name="memberid" value="<?php echo $rowData['unique_id']; ?>">
        </form>

    </td>
<?php } ?>

<?php
if($rowData['points'] < 300) {
    ?>
    <td class="not-qualify">
        Patient does not qualify for a Diamond Reward
    </td>
    <?php
}else{

    ?>
    <td class="align-middle select-size-control">
        <?php
        if(isset($memberid) && $memberid == $rowData['unique_id'] && isset($rewardnotfoundD) == true){
            ?>
            <span style="color: tomato;"> Reward not Found in Data base </span>
            <?php
        }
        ?>
        <form action="" method="post">
            <input type="text" tabindex="0" placeholder="Scan a Diamond Reward" name="rewarddiamond" title="Scan a Diamond Reward" id="<?php echo $rowData['unique_id']; ?>" class="input-to-scan">
            <input type="hidden" name="addDiamond">
            <input type="hidden" name="reward" value="diamondreward">
            <input type="hidden" name="level" value="diamond">
            <input type="hidden" name="search" value="<?php if(isset($_POST['search'])){ echo $_POST['search']; }?>">
            <input type="hidden" name="memberid" value="<?php echo $rowData['unique_id']; ?>">
        </form>

    </td>


    <?php
}
