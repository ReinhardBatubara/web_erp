<?php
if (!empty($attachment)) {
    $no = 1;
    foreach ($attachment as $result) {
        ?>
        <span class="title"><?php echo $no++ . ". " . $result->title ?></span><br/>
        ~ <?php echo $result->timeupload ?> |
        <a href="attachment/<?php echo $result->filename ?>" target='_blank' style="text-decoration: none;color: #ff993F">Download</a> | 
        <a href="javascript:void(0)" style="text-decoration: none;color: #ff993F" onclick="purchaserequest_attachment_delete(<?php echo $result->id . "," . $result->purchaserequestid . ",'" . $result->filename . "'" ?>)">Delete</a>
        <hr/>
        <?php
    }
} else {
    echo "No Attachment..ca!";
}