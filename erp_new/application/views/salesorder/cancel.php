<form id="salesorder_cancel-form" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Reason :</label></td>
            <td width="70%">
                <input type="hidden" value="<?php echo $salesorderid ?>" name="salesorderid" />
                <textarea name="reason_to_cancel" id="reason_to_cancel" class="easyui-validatebox" style="width: 90%;height: 50px" required="true"></textarea>
            </td>
        </tr>
    </table>
</form>