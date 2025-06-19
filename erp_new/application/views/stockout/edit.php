<div id="stockout_edit-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#stockout_edit-button">
    <form id="stockout_edit-input" method="post" novalidate onsubmit="return false;">
        <table width="97%" border="0">
            <tr>
                <td width="30%" align="right"><label class="field_label">STO NO: </label></td>
                <td width="70%"><input type="text" class="easyui-validatebox" disabled id="stockout_number" name="number" required="true" size="15"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Date : </label></td>
                <td ><input type="text" size="15" class="easyui-datebox" required="true" name="date" id="stockout_date" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">MW NO : </label></td>
                <td>
                    <input type="text" size="20" disabled name="mw_number" id="stockout_mw_id" required="true"/>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Request By : </label></td>
                <td><input type="text" class="easyui-validatebox" readonly id="request_by" name="employee_requestby" /></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Remark : </label></td>
                <td>
                    <textarea id="stockout_remark" name="remark" style="width: 95%;height: 50px;"></textarea>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="stockout_edit-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="stockout_update()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#stockout_edit-form').dialog('close')">Cancel</a>
</div>

