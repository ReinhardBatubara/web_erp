<div id="users-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#users-button">
    <form id="users-input" method="post" novalidate>
        <table width="100%" border="0">           
            <tr>
                <td align="right"><span class="field_label">ID/Name  : </label></td>
                <td>
                    <input type="text" name="id_name" id="id_name" mode="remote" style="width: 150px" required="true"/>
                    <script type="text/javascript">
                        $('#id_name').combogrid({
                            panelWidth: 450,
                            idField: 'id',
                            textField: 'name',
                            url: '<?php echo site_url('employee/get_remote_data') ?>',
                            columns: [[
                                    {field: 'id', title: 'ID', width: 60},
                                    {field: 'name', title: 'Name', width: 100},
                                    {field: 'department', title: 'Department', width: 100},
                                    {field: 'jobtitle', title: 'Job Title', width: 100}
                                ]],
                            onSelect: function(value, row, index) {
                                if (row.departmentid === '9') {
                                    $('#optiondata').show();
                                } else {
                                    $('#optiondata').hide();
                                }
                            }
                        });
                    </script>
                </td>
            </tr>
            <tr style="display: none;" id="optiondata">
                <td align="right"><span class="field_label">Allow For : </span></td>
                <td>
                    <select id="optiongroup"  name="optiongroup" class="easyui-combo" style="width: 150px" >
                        <option value="NULL">Normal User</option>
                        <option value='-1'>Full Access</option>
                        <?php
                        foreach ($warehouse as $result) {
                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">Password  :</label></td>
                <td><input type="password" name="password" id="u-password" class="easyui-validatebox" required="true" value=""/></td>
            </tr>
            <tr>
                <td align="right"><span class="field_label">Re-Password  :</label></td>
                <td><input type="password" name="re-password" id="u-re-password" class="easyui-validatebox" required="true" value=""/></td>
            </tr>
        </table>        
    </form>
</div>
<div id="users-button"> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="users_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#users-form').dialog('close')">Cancel</a>
</div>