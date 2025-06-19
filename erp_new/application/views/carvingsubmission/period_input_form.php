<div id="carvingsubmission_period_input_dialog" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#carvingsubmission_period_button">
    <form id="period_input_form" method="post" novalidate>
        <table width="100%" border="0">            
            <tr>
                <td align="right" width="25%"><label class="field_label">Start Date :</label></td>
                <td>
                    <input type="text" name="startdate" id="cp_start_date" class="easyui-datebox" size="14" required="true" style="text-align: center;width: 200px" data-options="formatter:myformatter,parser:myparser"/>                    
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Stop Date :</label></td>
                <td>
                    <input type="text" name="stopdate" id="cp_stop_date" class="easyui-datebox" size="14" required="true" style="text-align: center;width: 200px" data-options="formatter:myformatter,parser:myparser"/>                    
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Week :</label></td>
                <td>
                    <select name="week" id="week" class="easyui-combobox" panelHeight="auto" required="true" style="width: 100px">
                        <option></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Remark :</label></td>
                <td>
                    <textarea name="remark" class="easyui-validatebox" style="width: 90%;height: 50px"></textarea>
                </td>
            </tr>            
        </table>        
    </form>
</div>
<div id="carvingsubmission_period_button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="carvingsubmission_period_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#carvingsubmission_period_input_dialog').dialog('close')">Cancel</a>
</div>