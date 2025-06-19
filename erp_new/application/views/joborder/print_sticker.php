<form id="joborder_print_sticker-input" method="post" novalidate>
    <table width="100%" border="0">            
        <tr>
            <td align="right" width="35%"><label class="field_label">Customer :</label></td>
            <td width="65%">
                <input class="easyui-combobox" name="customerid" id="joborder_print_sticker_customerid" data-options="
                       url: '<?php echo site_url('joborder/get_customer/' . $joborderid) ?>',
                       method: 'post',
                       valueField: 'id',
                       textField: 'name',
                       panelHeight: '200',
                       mode: 'remote',
                       formatter: joborder_print_sticker_format_customer"
                       style="width: 200px" 
                       required="true">
                <script type="text/javascript">
                    function joborder_print_sticker_format_customer(row){
                        return '<span>'+row.name+'/'+row.code +'</span><br/>';
                    }
                </script>
            </td>
        </tr>        
        <tr>
            <td align="right"><label class="field_label">View Logo :</label></td>
            <td>
                <select name="companylogo" panelHeight="auto" class="easyui-combobox" editable="false" style="width: 100px">
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Display Made In :</label></td>
            <td>
                <select name="madein" panelHeight="auto" class="easyui-combobox" editable="false" style="width: 100px">
                    <option value="false">No</option>
                    <option value="true">Yes</option>
                </select>
            </td>
        </tr>            
    </table>
</form>