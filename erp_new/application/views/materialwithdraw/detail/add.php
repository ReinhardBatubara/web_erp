<div id="materialwithdrawdetail-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:450px; padding: 5px 5px" closed="true" buttons="#dialog-button">
    <form id="materialwithdrawdetail-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Item Code :</label></td>
                <td>
                    <input type="hidden" id="mwdetail_itemid" required="true" name="itemid" class="easyui-validatebox"/>
                    <input materialwithdrawdetail="text" name="code" id="mwdetail_code" class="easyui-validatebox" required="true" value="" style="text-align: center" readonly/>
                    <a href="javascript:void(0)" class="button" onclick="item_dialogsearch('mwdetail_itemid', 'mwdetail_code', 'mwdetail_description', 'mwdetail_unitcode', 'mwdetail_warehouseid')">Select</a>
                </td>
            </tr>            
            <tr>
                <td align="right"><label class="field_label">Description :</label></td>
                <td>
                    <textarea name="description" id="mwdetail_description" class="easyui-validatebox" style="width: 90%;height: 50px"></textarea>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Unit Code :</label></td>
                <td>
                    <input id="mwdetail_unitcode" name="unitcode" class="easyui-combobox" panelHeight="auto" data-options="valueField:'id',textField:'text'" required="true" style="width: 80px;">
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Qty :</label></td>
                <td><input unit="text" name="qty" id='mwdetail_qty' style="text-align: center" class="easyui-numberbox" size="5" required="true" value=""/></td>
            </tr>
        </table>       
    </form>
</div>
<div id="dialog-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="materialwithdrawdetail_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#materialwithdrawdetail-form').dialog('close')">Cancel</a>
</div>