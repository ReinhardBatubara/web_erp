<form id='so_rev-input' method='post' novalidate>
    <table width='100%'>
        <tr>
            <td width='30%' align='right'><label class='field_label'>Remark : </label></td>
            <td width='70%'>
                <textarea name='remark' id='so_rev_remark' class='easyui-validatebox' style='width: 90%;height: 60px' required='true'></textarea></td>
        <input type='hidden' name='salesorderid' value="<?php echo $salesorderid ?>">
        </tr>
    </table>
</form>