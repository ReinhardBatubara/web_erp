
<form id="create_stock_out_form" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Date :</label></td>
            <td width="70%"><input type="text" name="date" class="easyui-datebox" size="15" required="true" value="" style="text-align: center" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Model :</label></td>
            <td>
                <input id="create_stock_out_modelid" name="modelid" style="width: 150px" required="true"/>
                <script type="text/javascript">
                    $('#create_stock_out_modelid').combogrid({
                        panelWidth: 300,
                        idField: 'id',
                        fitColumns: true,
                        textField: 'code',
                        pagination: true,
                        url: '<?php echo site_url('model/get_ready') ?>',
                        columns: [[
                                {field: 'code', title: 'Item Code', width: 100},
                                {field: 'name', title: 'Item Description', width: 150}
                            ]],
                        onSelect:function(index,row){
                            $('#create_stock_out_proessid_').combobox('reload',base_url + 'modelprocess/get_for_combo/'+row.id);
                        }
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Process :</label></td>
            <td>  
                <input class="easyui-combobox" 
                       id="create_stock_out_proessid_" 
                       style="width: 150px"
                       name="processid"
                       data-options="valueField:'processid',textField:'process',panelWidth: 250,panelHeight:'auto'">
            </td>
        </tr>

        <tr>
            <td align="right"><label class="field_label">Job Order :</label></td>
            <td>  
                <input style="width:150px" 
                       id="create_stock_out_joborderid"
                       name="joborderid">

                <script type="text/javascript">
                    $('#create_stock_out_joborderid').combogrid({
                        panelWidth: 300,
                        idField: 'id',
                        fitColumns: true,
                        textField: 'joborder_no',
                        pagination: false,
                        url: '<?php echo site_url('joborder/get_available') ?>',
                        columns: [[
                                {field:'joborder_no',title:'JO No.',width:120},
                                {field:'project_no',title:'Project No.',width:80},
                                {field:'week',title:'Week',width:80,align:'right'},
                                {field:'project_name',title:'Project Name',width:150}
                            ]]
                    });
                </script>
            </td>
        </tr>

        <tr>
            <td align="right"><label class="field_label">Qty : </label></td>
            <td><input unit="text" name="qty" style="text-align: center" class="easyui-numberbox" size="5" required="true" value=""/></td>
        </tr>
        <tr valign="top">
            <td align="right"><label class="field_label">Remark :</label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width: 90%;height: 50px"></textarea>
            </td>
        </tr>            
    </table>        
</form>