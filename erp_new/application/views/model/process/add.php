<div id="process-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:350px; padding: 5px 5px" closed="true" buttons="#process-button">
    <form id="process-input" method="post" novalidate>
        <table width="100%" border="0">            
            <tr>
                <td align="right" width="30%"><label class="field_label">Process Name :</label></td>
                <td width="70%">
                    <input type="text" name="processid" id="processid" mode="remote" style="width: 150px" required="true"/>
                    <script type="text/javascript">
                        $('#processid').combogrid({
                            panelWidth: 210,
                            idField: 'id',
                            textField: 'name',
                            url: '<?php echo site_url('tracking/get_tracking_process_for_combo') ?>',
                            columns: [[
                                    {field: 'name', title: 'Name', width: 200}
                                ]]
                        });
                    </script>
                </td>
            </tr>
<!--            <tr>
                <td align="right"><label class="field_label">Material Group:</label></td>
                <td>
                    <input class="easyui-combobox"
                           name="materialgroupid[]"
                           data-options="
                           url:'<?php echo site_url('model/get_material_group_for_combo') ?>',
                           method:'get',
                           valueField:'id',
                           textField:'name',
                           multiple:true,
                           panelHeight:'auto',
                           editable:false" 
                           style="width: 200px;" 
                           required="true">
                </td>
            </tr>-->
            <tr>
                <td align="right"><label class="field_label">Stock :</label></td>
                <td>
                    <input id="stock" name="stock" class="easyui-numberbox" panelHeight="auto" editable="false" size="8" style="text-align: center">
                </td>
            </tr>

        </table>        
    </form>
</div>
<div id="process-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="process_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#process-form').dialog('close')">Cancel</a>
</div>
