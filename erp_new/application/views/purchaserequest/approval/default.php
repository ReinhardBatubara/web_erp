<form id="purchaserequest_approval_default-input" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Approval 1  :</label></td>
            <td>
                <input type="text" name="checked" id="checked" mode="remote" style="width: 250px"/>
                <script type="text/javascript">
                    $('#checked').combogrid({
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
        <tr>
            <td align="right"><label class="field_label">Approval 2  :</label></td>
            <td>
                <input type="text" id="acknowledge" name="acknowledge" mode="remote" style="width: 250px"/>
                <script type="text/javascript">
                    $('#acknowledge').combogrid({
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
        <tr>
            <td align="right"><label class="field_label">Approval 3  :</label></td>
            <td>
                <input type="text" id="approved" name="approved" mode="remote" style="width: 250px"/>
                <script type="text/javascript">
                    $('#approved').combogrid({
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