<form id="pritem_edit_item_form" method="post" novalidate>
    <table width="99%" border="0" class="table_form" style="margin: 2px">
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code : </label></td>
            <td width="70%"><input type="text" name="itemcode" class="easyui-validatebox" required="true" readonly style="width: 250px"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Item Description : </label></td>
            <td><input type="text" name="itemdescription" class="easyui-validatebox" required="true" readonly style="width: 250px"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code : </label></td>
            <td><input type="text" name="unitcode" class="easyui-validatebox" readonly  style="width: 100px;"/></td>
        </tr>
        <tr valign="top">
            <td align="right"><label class="field_label">Qty : </label></td>
            <td>
                <input type="text" name="qty" precision='2' class="easyui-numberbox" style="width: 100px;" required/>
            </td>
        </tr>            
    </table>        
</form>