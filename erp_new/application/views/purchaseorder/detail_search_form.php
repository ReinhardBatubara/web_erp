<table width="300" border="0">
    <tr>
        <td align="right" width="30%"><label class="field_label">Item : </label></td>
        <td>
            <input type="text" size="12" class="easyui-validatebox" id="purchaseorderdetail_code_s" onkeypress="if (event.keyCode === 13) {
                purchaseorderdetail_search();
            }" />
        </td>
    </tr>
    <tr>
        <td align="right"><label class="field_label">Description :</label></td>
        <td>
            <input type="text" class="easyui-validatebox" id="purchaseorderdetail_description_s" onkeypress="if (event.keyCode === 13) {
            purchaseorderdetail_search();
        }"/>
        </td>
    </tr>
    <tr>
        <td></td>
        <td style="padding-top: 10px">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="purchaseorderdetail_search()">Find</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="purchaseorderdetail_clear_search()" style="float: right">Clear</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="$('#purchaseorderdetail_menu_search').tooltip('hide');"  style="float: right">Close</a>
        </td>
    </tr>
</table>