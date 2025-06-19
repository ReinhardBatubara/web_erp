<div id="itemunitrelation-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#dialog-button">
    <form id="itemunitrelation-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="40%"><label class="field_label">Unit From :</label></td>
                <td>
                    <input id="unitfrom" name="unitfrom" class="easyui-combobox" data-options="valueField:'id',textField:'text'" required="true" panelHeight="auto" style="width: 80px;">
                </td>
            </tr>
            <tr>
                <td align="right" width="40%"><label class="field_label">Unit To:</label></td>
                <td>
                    <input id="unitto" name="unitto" class="easyui-combobox" data-options="valueField:'id',textField:'text'" required="true"  panelHeight="auto" style="width: 80px;">
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Rate :</label></td>
                <td><input type="tex" name="value" id="value" size="5" style="text-align: center;" class="easyui-numberbox" precision="2"  required="true"/></td>
            </tr>            
        </table>
    </form>
</div>
<div id="dialog-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="itemunitrelation_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#itemunitrelation-form').dialog('close')">Cancel</a>
</div>