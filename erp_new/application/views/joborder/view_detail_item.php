<div id="jo_detail_item_toolbar" style="padding-bottom:0;">
    <form id="jo_detail_item_form_search" style="margin: 0">
        Serial :
        <input type="text" 
               class="easyui-validatebox" 
               size="15" 
               name="serial"
               onkeyup="if (event.keyCode == 13) {
                           joborder_detail_item_search()
                       }"
               />
        Item Code :
        <input type="text" 
               class="easyui-validatebox" 
               size="15" 
               name="itemcode"
               onkeyup="if (event.keyCode == 13) {
                           joborder_detail_item_search()
                       }"
               />
        Item Name :
        <input type="text" 
               class="easyui-validatebox" 
               size="15"
               name="itemname"
               onkeyup="if (event.keyCode == 13) {
                           joborder_detail_item_search()
                       }"
               />
        SO :
        <input type="text" 
               class="easyui-validatebox" 
               size="15" 
               name="so"
               onkeyup="if (event.keyCode == 13) {
                           joborder_detail_item_search()
                       }"
               />
        Status / Position
        <select name="status" data-options="onSelect:function(rec){joborder_detail_item_search()}" class="easyui-combobox" editable="false" style="width: 120px" panelWidth="200" panelHeight="auto">
            <option value="0">All</option>
            <?php
            foreach ($tracking_process as $result) {
                echo "<option value='$result->id'>" . $result->name . "</option>";
            }
            ?>
            <option value="8">Finish</option>
            <option value="9">Shipping</option>
        </select>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="joborder_detail_item_search()"></a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="joborder_edit_specification_item()">Edit Specification</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="$('#jo_detail_item').datagrid('reload')">Refresh</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-shipping" plain="true" onclick="joborder_item_shipment()">Shipment</a>
    </form>
</div>
<table id="jo_detail_item" data-options="
       url:'<?php echo site_url('joborder/get_detail_item/' . $joborderid) ?>',
       method:'post',
       border:false,
       singleSelect:false,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       pagination:false,
       striped:true,
       checkOnSelect: false,
       selectOnCheck: false,
       toolbar:'#jo_detail_item_toolbar'">
    <thead>
        <tr>
            <th field="jo_detail_item_chck" checkbox="true"></th>
            <th field="serial" width="60" align="center">Serial</th>
            <th field="sonumber" width="70" align="center">SO NO</th>            
            <th field="itemcode" width="80" align="center">Item Code</th>
            <th field="itemname" width="100" halign="center">Item Name</th>
            <th field="status" width="100" halign="center">Status/Position</th>
            <th field="finishing" width="100" halign="center">Finishing</th>
            <th field="material" width="120" halign="center">Material</th>
            <th field="top" width="80" halign="center">Top</th>
            <th field="mirrorglass" width="80" halign="center">Mirror / Glass</th>
            <th field="foam" width="80" halign="center">Foam</th>
            <th field="interliner" width="80" halign="center">Interliner</th>
            <th field="fabric" width="80" halign="center">Fabric</th>
            <th field="furring" width="80" halign="center">Furring</th>
            <th field="accessories" width="80" halign="center">Accessories</th>
            <th field="pillow" width="50" align="center">Pillow</th>
            <th field="hardware" width="50" align="center">Hardware</th>
            <th field="po_no" width="80" halign="center">PO NO</th>            
            <th field="customer" width="100" halign="center">Customer</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    var last_index_select = -1;
    $(function () {
        $('#jo_detail_item').datagrid({
            onCheckAll: function (rows) {
                for (var i = 0; i < rows.length; i++) {
                    if (rows[i].finish == 't' && rows[i].ship_date == null) {
                        $('#jo_detail_item').datagrid('checkRow', i);
                    } else {
                        $('#jo_detail_item').datagrid('uncheckRow', i);
                    }
                }
            },
            onCheck: function (index, row) {
                if (row.finish == 'f') {
                    $(this).datagrid('uncheckRow', index);
                    $.messager.alert('Action Interuption', 'This item not finish yet production', 'warning');
                } else {
                    if (row.ship_date != null) {
                        $.messager.confirm('Confirm', 'This item already Shipping. Click OK to replace shipping date or Cancel to skip', function (r) {
                            if (!r) {
                                $('#jo_detail_item').datagrid('uncheckRow', index);
                            }
                        });
                    }
                }
            },
            onSelect: function (index, row) {
                $(this).datagrid('unselectRow', last_index_select);
                last_index_select = index;
            }
        });
    });
</script>
