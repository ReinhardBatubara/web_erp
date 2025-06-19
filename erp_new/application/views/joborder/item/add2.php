<form id="joborder_item_add2-input" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code: </label></td>
            <td>
                <input type="text" id="modelid" style="width: 250px" name="modelid" required="true"/>
                <script type="text/javascript">
                    $('#modelid').combogrid({
                        panelWidth: 350,
                        mode: 'remote',
                        idField: 'id',
                        textField: 'code',
                        url: '<?php echo site_url('model/get_open') ?>',
                        columns: [[
                                {field: 'code', title: 'Item Code', width: 100, halign: 'center'},
                                {field: 'name', title: 'Item Name', width: 200, halign: 'center'}
                            ]],
                        onSelect:function(index,row){
                            $('#jo_item_model_name').val(row.name);
                            $('#modelprocessid509').combobox('clear');
                            $('#modelprocessid509').combobox('reload', base_url + 'modelprocess/get_for_combo/' + row.id);
                        }
                    });
                </script>   
            </td>
        </tr>            
        <tr valign="top">
            <td align="right"><label class="field_label">Item Name : </label></td>
            <td>
                <textarea name="itemname" id="jo_item_model_name" readonly class="easyui-validatebox" style="width: 250px;height: 40px"></textarea>
            </td>
        </tr>  
        <tr>
            <td align="right"><label class="field_label">Qty : </label></td>
            <td><input foam="text" name="qty" class="easyui-numberbox" required="true" size="8" style="text-align: center;"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Type : </label></td>
            <td>
                <select name="order_type" class="easyui-combobox" id="joborder_type50" required="true" style="width: 150px;" panelHeight="auto" editable="false">
                    <option value="Stock">Stock</option>
                    <option value="Sample">Sample</option>
                </select>
            </td>
        </tr>

        <tr>
            <td align="right" width="30%"><label class="field_label">Stock/Sample In : </label></td>
            <td>                
                <input class="easyui-combobox" id="modelprocessid509" name="final_processid" data-options="
                       method: 'post',
                       valueField: 'processid',
                       textField: 'process',
                       panelHeight: 'auto'"
                       style="width: 250px" 
                       required="true" 
                       editable="false">
            </td>
        </tr>
    </table>        
</form>