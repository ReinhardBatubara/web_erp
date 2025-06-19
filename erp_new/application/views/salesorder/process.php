<form id="salesorder_process-form" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td colspan="2" align="center"><p style="color: #0077b3">Please Choose Approval for SO if you sure to process!</p></td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">Approved By  :</label></td>
            <td>
                <input type="hidden" value="<?php echo $salesorderid ?>" name="salesorderid" />
                <input type="text" name="approved_by" id="employeeid" mode="remote" style="width: 150px" required="true"/>
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