<form id="cuttinglist-input" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right"><label class="field_label">Date :</label></td>
            <td><input type="text" name="date" class="easyui-datebox" size="13" required="true" style="text-align: center" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>            
            <td align="right" width="30%"><label class="field_label">JO : </label></td>
            <td>
                <input type="text"
                       id="cuttinglist_joborderid"
                       name="joborderid"
                       style="width: 200px" 
                       required="true" 
                       />
                <script type="text/javascript">
                    $(function(){
                        $('#cuttinglist_joborderid').combogrid({
                            panelWidth: 350,
                            mode: 'remote',
                            idField: 'id',
                            textField: 'joborder_no',
                            url: '<?php echo site_url('joborder/get') ?>',
                            columns: [[
                                    {field:'joborder_no',title:'JO NO',width:80,halign:'center'},
                                    {field:'project_name',title:'Project Name',width:120,halign:'center'},
                                    {field:'order_type',title:'Order Type',width:80,halign:'center'}
                                ]],
                            onSelect:function(index,row){
                                $('#cuttinglist_joborderitemid').combobox('reload',base_url+'joborder/item_get_distinct/'+row.id);
                            }
                        });
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Item : </label></td>
            <td>
                <input class="easyui-combobox" id="cuttinglist_joborderitemid" name="modelid" data-options="
                       url: '<?php echo site_url('joborder/item_get_distinct') ?>',
                       method: 'post',
                       valueField: 'modelid',
                       textField: 'modelcode',
                       panelHeight: '200',
                       formatter: formatCuttinglist_joborderitemid"
                       style="width: 200px" 
                       required="true">
                <script type="text/javascript">
                    function formatCuttinglist_joborderitemid(row){
                        var s = '<span>Item Code: ' + row.modelcode +'</span><br/>' +
                            '<span>Item Name: ' + row.modelname +'</span><br/>' +
                            '<span style="color:#888">W : ' + row.itemsize_mm_w + ', D : ' + row.itemsize_mm_d + ', H : ' + row.itemsize_mm_h + '</span>';
                        return s;
                    }
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty</label></td>
            <td>
                <input type="text" 
                       name="qty" 
                       class="easyui-numberbox" 
                       required="true" 
                       size="5"
                       style="text-align: center"
                       min="1"
                       />
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Wood Category</label></td>
            <td>
                <input type="text" 
                       name="woodcategory" 
                       class="easyui-combobox"
                       url="<?php echo site_url('cuttinglist/get_woodcategory') ?>"
                       method="post"
                       panelHeight="200"
                       valueField="woodcategory"
                       textField="woodcategory"
                       style="width: 200px" 
                       required="true"
                       />
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Final Size</label></td>
            <td>
                <input type="text" 
                       name="final_size" 
                       class="easyui-numberbox" 
                       precision="4" 
                       required="true"                            
                       size="10"
                       style="text-align: right"
                       /> M3
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Raw Size</label></td>
            <td>
                <input type="text" 
                       name="raw_size" 
                       class="easyui-numberbox" 
                       precision="4" 
                       required="true"                            
                       size="10"
                       style="text-align: right"
                       /> M3
            </td>
        </tr>
    </table>        
</form>