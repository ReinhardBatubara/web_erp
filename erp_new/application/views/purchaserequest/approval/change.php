<div id="purchaserequest_approval_change" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#purchaserequest_approval_change-button">
    <form id="purchaserequest_approval_change-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%">Employee  :</td>
                <td>
                    <input type="text" name="employeeid" id="employeeid" mode="remote" style="width: 150px" required="true"/>
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
        </table>
    </form>
</div>
<div id="purchaserequest_approval_change-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="purchaserequest_approval_do_change()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#purchaserequest_approval_change').dialog('close')">Cancel</a>
</div>