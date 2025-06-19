<?php
if (!empty($approval)) {
    ?>
    <table border='0' cellpadding="2" cellspacing="2">
        <tr>    
            <?php
            foreach ($approval as $result) {
                ?>
                <td width="200" valign="top">
                    <?php
                    echo $result->employee_name . "(" . $result->employeeid . ")<br/>";
                    if (in_array($result->status, array(1, 2, 3))) {
                        $app_status = array(1=>"<span style='color:blue'>Approve</span>",2=>"<span style='color:#c3a209'>Pending</span>",3=>"<span style='color:red'>Reject</span>");
                        echo $app_status[$result->status]."<br>at: ".date('d/m/Y h:i',  strtotime($result->timeapprove))."<br/>";
                    }
                    if ($result->outstanding == 't') {
                        ?>
                        <button style="cursor: pointer" onclick="purchaserequest_approval_action_approve(1)">Approve</button>
                        <button style="cursor: pointer" onclick="purchaserequest_approval_action_approve(2)">Pending</button>
                        <button style="cursor: pointer" onclick="purchaserequest_approval_action_approve(3)">Reject</button>
                        <?php
                    }
                    ?>
                    <br/><br/>
                </td>
                <?php
            }
            ?>
        </tr>
    </table>
    <?php
} else {
    echo "Prepare";
}
?>

