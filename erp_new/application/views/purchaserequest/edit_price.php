<div id="purchaserequest_edit_price-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#dialog-button">
    <form id="edit_price_form-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Sub Total : </label></td>
                <td><input type="text" name="total" class="easyui-numberbox" precision="2" id="edit_price_total" size="25" style="text-align: right" readonly/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Discount : </label></td>
                <td><input type="text" name="discount" class="easyui-numberbox" onkeyup="purchaserequest_calculate()" precision="2" id="edit_price_discount" size="25"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Tax : </label></td>
                <td><input type="text" name="tax" class="easyui-numberbox" onkeyup="purchaserequest_calculate()" precision="2" id="edit_price_tax" size="25" style="text-align: right"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Amount: </label></td>
                <td><input type="text" name="amount" class="easyui-numberbox" precision="2" id="edit_price_amount" size="25" style="text-align: right;" readonly/></td>
            </tr>
        </table>
    </form>
</div>
<div id="dialog-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="purchaserequest_update_price()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#purchaserequest_edit_price-form').dialog('close')">Cancel</a>
</div>

