<form id="materialrequisition-input" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Date : </label></td>
            <td width="70%"><input type="text" size="13" class="easyui-datebox" name="date" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">JO : </label></td>
            <td>
                <input type="text" name="joborderid" id="joborderid_52" style="width: 250px"/>
                <script>
                    $('#joborderid_52').combogrid({
                        idField: 'id',
                        mode: 'remote',
                        textField: 'joborder_no',
                        fitColumns:true,
                        url: '<?php echo site_url('joborder/get_final_mrp') ?>',
                        columns: [[
                                {field: 'id', hidden: true},
                                {field: 'joborder_no', title: 'J.O No.', width: 80},
                                {field: 'project_name', title: 'Project Name', width: 120}
                            ]],
                        onSelect: function(rowIndex, rowData) {
                            $('#jo_no_').val(rowData.joborder_no);
                            $('#project_name_').val(rowData.project_name);
                            $('#project_no_').val(rowData.project_no);
                        },
                        onChange:function(newValue, oldValue){
                                                       
                            if(newValue === ''){
                                $('#jo_no_').val('');
                                $('#project_name_').val('');
                                $('#project_no_').val('');
                            }
                        }
                    });
                </script>
                <input type="hidden" name="job_no" id="jo_no_" class="easyui-validatebox" size="20"/>
            </td>
        </tr>
<!--        <tr>
            <td align="right"><label class="field_label">Project No.  : </label></td>
            <td><input type="text" name="project_no" id="project_no_" class="easyui-validatebox" readonly size="40"/></td>
        </tr>-->
        <tr>
            <td align="right"><label class="field_label">Project Name  : </label></td>
            <td><input type="text" name="project_name" id="project_name_" readonly class="easyui-validatebox" size="40"/></td>
        </tr>            
        <tr>
            <td align="right"><label class="field_label">Required Date  : </label></td>
            <td><input type="text" size="13" class="easyui-datebox" name="required_date" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark : </label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width: 90%;height: 70px"></textarea>
            </td>
        </tr>            
    </table>        
</form>