<div id="materialwithdraw-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#materialwithdraw-button">
    <form id="materialwithdraw-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Date :</label></td>
                <td width="70%"><input type="text" size="10" class="easyui-datebox" id="mw_date" style="width: 100px" name="date" data-options="formatter:myformatter,parser:myparser" required="true"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Must Receive At :</label></td>
                <td><input type="text" size="10" class="easyui-datebox" id="mw_must_receive_at" style="width: 100px" name="must_receive_at" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Job Order :</label></td>
                <td>
                    <input type="text" name="joborderid" id="joborderid_" style="width: 250px"/>
                    <script>
                        $('#joborderid_').combogrid({
                            idField: 'id',
                            mode: 'remote',
                            textField: 'joborder_no',
                            fitColumns:true,
                            url: '<?php echo site_url('joborder/get_final_mrp') ?>',
                            columns: [[
                                    {field: 'id', hidden: true},
                                    {field: 'joborder_no', title: 'JO NO', width: 80},
                                    {field: 'project_name', title: 'Project Name', width: 120}
                                ]]
                        });
                    </script>
                </td>
            </tr>
            <tr valign="top">
                <td align="right"><label class="field_label">Remark :</label></td>
                <td>
                    <textarea name="remark" class="easyui-validatebox" id="mw_remark" style="width: 250px;height: 40px"></textarea>
                </td>
            </tr>            
        </table>        
    </form>
</div>
<div id="materialwithdraw-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="materialwithdraw_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#materialwithdraw-form').dialog('close')">Cancel</a>
</div>