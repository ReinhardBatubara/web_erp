<form id="stockout_form_2" method="post" class="table_form" style="padding: 2px">
    <table width="100%" border="0">            
        <tr>
            <td align="right" width="30%"><label class="field_label">Date :</label></td>
            <td>
                <input type="text" style="width: 250px" class="easyui-datebox" required="true" name="date" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr> 
        <tr>
            <td align="right"><label class="field_label">JO NO :</label></td>
            <td>
                <input type="text" name="joborderid" id="sto_joborderid_2" required="true" style="width: 250px"/>
                <script>
                    $('#sto_joborderid_2').combogrid({
                        panelWidth: 300,
                        idField: 'id',
                        mode: 'remote',
                        textField: 'joborder_no',
                        url: '<?php echo site_url('joborder/get_final_mrp') ?>',
                        columns: [[
                                {field: 'id', hidden: true},
                                {field: 'joborder_no', title: 'J.O No.', width: 120},
                                {field: 'project_name', title: 'Project Name', width: 150}
                            ]]
                    });
                </script>
            </td>
        </tr>           
        <tr>
            <td align="right"><label class="field_label">Request By :</label></td>
            <td>
                <input type="text" name="request_by" id="sto_request_by_2" mode="remote" style="width: 250px" required="true"/>
                <script type="text/javascript">
                    $('#sto_request_by_2').combogrid({
                        panelWidth: 400,
                        idField: 'id',
                        fitColumns: true,
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
            <td align="right"><label class="field_label">Remark :</label></td>
            <td>
                <textarea id="stockout_remark" name="remark" style="width: 250px;height: 50px;"></textarea>
            </td>
        </tr>
    </table> 
</form>