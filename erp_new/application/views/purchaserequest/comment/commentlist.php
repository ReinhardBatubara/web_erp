<?php
foreach ($commentlist as $result) {
    ?>
    <div style="background: #E6EEF8;border-radius: 2px;padding: 3px;margin: 3px;font-size: 14px;width: 95%;">
        <b style="color: #0000FF;margin-bottom: 2px"><?php echo $result->employee ?></b>&nbsp;&nbsp;|&nbsp;
        <a href="javascript:void(0)" onclick="purchaserequest_comment_delete(<?php echo $result->id.",".$result->purchaserequestid ?>)">Delete</a>
        <br/>
        <div style="padding: 5px">
            <?php echo $result->content ?>            
        </div>
        <div style="font-size: 10px;color: #ce6700;"> ~ <?php echo date('d/m/Y h:i:s', strtotime($result->time)) ?></div>
    </div>
    <?php
}