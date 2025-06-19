<form id="stockoutdetail_edit-input" method="post" novalidate class="table_form" style="padding: 2px">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="25%"><label class="field_label">Item :</label></td>
            <td width="75%"><input type="text" readonly name="itemcode" class="easyui-validatebox"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Description :</label></td>
            <td><textarea readonly name="itemdescription" class="easyui-validatebox" style="width: 90%;height: 40px"></textarea></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input type="text" name="qty" class="easyui-numberbox" precision="4" style="text-align: center" size="5" required="true"/></td>
        </tr>  
        <tr>
            <td align="right"><label class="field_label">Remark : </label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width: 90%;height: 40px"></textarea>
            </td>
        </tr>
    </table>
</form>