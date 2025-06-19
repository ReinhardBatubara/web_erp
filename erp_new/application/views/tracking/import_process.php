<div id="tracking_import_process-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#tracking_import_process-button">
    <form id="tracking_import_process-input" method="post" novalidate class="table_form">
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">File :</label></td>
                <td width="70%"><input type="file" required="true" name="inputfile" id="inputfile" style="width: 100%"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Position Process :</label></td>
                <td>
                    <input type="text" name="tracking_process_id" id="tracking_process_id" mode="remote" style="width: 100%" required="true"/>
                    <script type="text/javascript">
                        $('#tracking_process_id').combogrid({
                            idField: 'id',
                            textField: 'name',
                            url: '<?php echo site_url('tracking/get_tracking_process_for_combo') ?>',
                            columns: [[
                                    {field: 'name', title: 'Name', width: 230}
                                ]]
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Date :</label></td>
                <td><input type="text" size="13" required="true" class="easyui-datebox" id="tracking_process_date" name="tracking_process_date" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>            
        </table>        
    </form>
</div>
<div id="tracking_import_process-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="tracking_do_import_process()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#tracking_import_process-form').dialog('close')">Cancel</a>
</div>

