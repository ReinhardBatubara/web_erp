<form id="stockout_add_from_nota" method="post" novalidate="" class="table_form" style="padding: 2px;">
    <table width="100%" border="0">            
        <tr>
            <td align="right" width="30%"><label class="field_label">Date :</label></td>
            <td>
                <input type="text" style="width: 250px;" class="easyui-datebox" required="true" name="date" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr> 
        <tr>
            <td align="right"><label class="field_label">NOTA NO :</label></td>
            <td>
                <input type="text" style="width: 250px;" name="nota_no" class="easyui-validatebox" required="true" />
            </td>
        </tr>           
        <tr>
            <td align="right"><label class="field_label">Request By :</label></td>
            <td>
                <input type="text" name="request_by" id="sto_request_by_228" mode="remote" style="width: 250px"/>
                <script type="text/javascript">
                    $('#sto_request_by_228').combogrid({
                        panelWidth: 400,
                        idField: 'id',
                        fitColumns:true,
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
            <td align="right"><span class="field_label">Dept / Sub Section : </span></td>
            <td>
                <input class="easyui-combobox" name="subsectionid" data-options="
                       url: '<?php echo site_url('subsection/get') ?>',
                       method: 'post',
                       valueField: 'id',
                       textField: 'name',
                       panelHeight: '200',
                       formatter: StockOutFormatSubSection"
                       style="width: 250px" required="true">
                <script type="text/javascript">
                    function StockOutFormatSubSection(row){
                        var s = '<span>Code: ' + row.code +'</span><br/>' +
                            '<span>Name: ' + row.name +'</span><br/>' +
                            '<span style="color:#888">Desc: ' + row.description + '</span>';
                        return s;
                    }
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