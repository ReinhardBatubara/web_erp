<div id="productionreturn-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#productionreturn-button">
    <form id="productionreturn-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Date : </label></td>
                <td><input type="text" size="15" name="date" class="easyui-datebox" id="date" data-options="formatter:myformatter,parser:myparser" required="true"/></td>
            </tr>   
            <tr>
                <td align="right"><label class="field_label">Return By : </label></td>
                <td>
                    <input type="text" name="returnby" id="employeeid" mode="remote" style="width: 150px" required="true"/>
                    <script type="text/javascript">
                        $('#employeeid').combogrid({
                            panelWidth: 450,
                            idField: 'id',
                            textField: 'name',
                            url: '<?php echo site_url('employee/get_remote_data') ?>',
                            columns: [[
                                    {field: 'id', title: 'ID', width: 60},
                                    {field: 'name', title: 'Name', width: 100},
                                    {field: 'department', title: 'Department', width: 100},
                                    {field: 'jobtitle', title: 'Job Title', width: 100}
                                ]]
                        });
                    </script>
                </td>
            </tr>
            <tr valign="top">
                <td align="right"><label class="field_label">Remark : </label></td>
                <td>
                    <textarea name="remark" class="easyui-validatebox" style="width: 95%;height: 50px"></textarea>
                </td>
            </tr>            
        </table>        
    </form>
</div>
<div id="productionreturn-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="productionreturn_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#productionreturn-form').dialog('close')">Cancel</a>
</div>