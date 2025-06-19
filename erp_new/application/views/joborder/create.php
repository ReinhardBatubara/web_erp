<div id="joborder-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#joborder-button">
    <form id="joborder-input" method="post" novalidate class="table_form" style="padding: 2px">
        <table width="100%" border="0">
<!--            <tr>
                <td align="right" width="30%"><label class="field_label">Project No. :</label></td>
                <td width="70%"><input type="text" name="project_no" class="easyui-validatebox" required="true" value=""/></td>
            </tr>-->
            <tr>
                <td align="right" width="30%"><label class="field_label">Project Name :</label></td>
                <td width="70%"><input type="text" class="easyui-validatebox" name="project_name" required="true" style="width: 100%"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Week :</label></td>
                <td><input type="text" class="easyui-numberbox" name="week" required="true" style="width: 60px;text-align: center"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Order Type :</label></td>
                <td>
                    <select name="order_type" class="easyui-combobox" id="joborder_type50" required="true" style="width: 100%;" panelHeight="auto" editable="false">
                        <option value="Order">Order</option>
                        <option value="Stock/Sample">Stock/Sample</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Remark :</label></td>
                <td><textarea style="width: 100%;height: 40px" name="remark"></textarea></td>
            </tr>
        </table>        
    </form>
</div>
<div id="joborder-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="joborder_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#joborder-form').dialog('close')">Cancel</a>
</div>  