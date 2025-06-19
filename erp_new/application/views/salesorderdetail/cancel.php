<form id="salesorderdetail_cancel-form" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right"><label class="field_label">Outstanding :</label></td>
            <td><input class="easyui-numberbox" size="5" readonly="true" name="ots" id="salesorderdetail_ots" style="text-align: center" value="<?php echo $salesorderdetail->ots ?>"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input class="easyui-numberbox" size="5" style="text-align: center" name="qty" required="true" validType="check_value['#salesorderdetail_ots']"/></td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">Reason :</label></td>
            <td width="70%">
                <input type="hidden" value="<?php echo $salesorderdetailid ?>" name="salesorderdetailid" />
                <textarea name="reason_to_cancel" id="reason_to_cancel" class="easyui-validatebox" style="width: 90%;height: 50px" required="true"></textarea>
            </td>
        </tr>
    </table>
</form>
<script>
    $.extend($.fn.validatebox.defaults.rules, {
        check_value: {
            validator: function (value, param) {
                return (parseInt(value) <= parseInt($(param[0]).val())) && (parseInt(value) > 0);
            },
            message: 'Invalid out of outstanding qty or negative number'
        }
    });
</script>