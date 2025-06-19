<form id="stockout-input" method="post" novalidate onsubmit="return false;">
    <table width="98%" border="0" align="center">
        <tr>
            <td width="15%" align="right"><label class="field_label">MW NO:</label></td>
            <td width="25%">
                <input type="text" size="20" name="stockout_mw_id" id="stockout_mw_id_" required="true"/>
                <script>
                    $('#stockout_mw_id_').combogrid({
                        panelWidth: 450,
                        idField: 'id',
                        mode: 'remote',
                        textField: 'number',
                        url: '<?php echo site_url('materialwithdraw/get_available_warehouse') ?>',
                        columns: [[
                                {field: 'id', hidden: true},
                                {field: 'number', title: 'MW NO', width: 120},
                                {field: 'date_modify', title: 'Date', width: 100},
                                {field: 'department', title: 'Department', width: 100},
                                {field: 'employeerequest', title: 'Request By', width: 100}
                            ]],
                        onSelect: function (rowIndex, rowData) {
                            $('#request_by').val(rowData.employeerequest);
                            $('#department').val(rowData.department);
                            $('#list_item_to_out').datagrid('reload', {
                                materialwithdrawid: rowData.id
                            });
                        }
                    });
                </script>
            </td>
            <td width="20%">&nbsp;</td>
            <td width="15%" align="right"><label class="field_label">Date :</label></td>
            <td width="25%"><input type="text" size="15" class="easyui-datebox" required="true" name="stockout_date" id="stockout_date_" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Department :</label></td>
            <td><input type="text" class="easyui-validatebox" readonly name="department" id="department_" size="30"/></td>
            <td>&nbsp;</td>
            <td align="right"><label class="field_label">Request By :</label></td>
            <td><input type="text" class="easyui-validatebox" readonly id="request_by_" name="request_by" /></td>
        </tr>
        <tr>
            <td colspan="5" height="200" width="100%">
                <table id="list_item_to_out" 
                       url='<?php echo site_url('materialwithdrawdetail/get_available_to_out_by_warehouse') ?>'
                       method ='post'
                       title = 'List Item'
                       method = 'post'
                       border = 'true'
                       singleSelect = 'true'
                       fit ='true'
                       rownumbers = 'true'
                       fitColumns = 'true'
                       idField= 'id'>
                </table>
                <script type="text/javascript">
                    var stockout_lastIndex = -1;
                    var _qty_out = null;
                    var _warehouse = null;
                    $(function () {
                        $('#list_item_to_out').datagrid({
                            columns: [[
                                    {field: 'id', hidden: true},
                                    {field: 'itemcode', title: 'Item', width: 100, halign: 'center'},
                                    {field: 'itemdescription', title: 'Description', width: 300, halign: 'center'},
                                    {field: 'unitcode', title: 'Unit', width: 50, align: 'center'},
                                    {field: 'qty', title: 'Order', width: 100, align: 'center'},
                                    {field: 'qty_ots', title: 'Outstanding', width: 100, align: 'center'},
                                    {field: 'warehouseid', title: 'Out From', width: 120, halign: 'center',
                                        formatter: function (value, row) {
                                            return row.warehousename;
                                        }, editor: {
                                            type: 'combobox',
                                            options: {
                                                valueField: 'warehouseid',
                                                textField: 'warehousename',
                                                panelHeight: 'auto',
                                                panelWidth: '100',
                                                onSelect: function (my_row) {
                                                    _qty_out.target.numberbox('setValue', '');
                                                }
                                            }
                                        }},
                                    {field: 'qty_out', title: 'Out', width: 100, halign: 'center', editor: {type: 'numberbox', options: {precision: 2, min: 0}}}

                                ]],
                            onDblClickRow: function (rowIndex, row) {
                                //if (lastIndex !== rowIndex) {
                                //$('#list_item_receive').datagrid('endEdit', lastIndex);
                                $('#list_item_to_out').datagrid('beginEdit', rowIndex);
                                //}
                                _warehouse = $(this).datagrid('getEditor', {index: rowIndex, field: 'warehouseid'});
                                _warehouse.target.combobox('reload', base_url + 'item/get_warehouse/' + row.itemid + '/' + row.unitcode);


                                _qty_out = $(this).datagrid('getEditor', {index: rowIndex, field: 'qty_out'});
                                _qty_out.target.bind('change', function () {
                                    var _warehouseid = _warehouse.target.combobox('getValue');
                                    if (_warehouseid !== '') {
                                        var _qty_ots = parseFloat(row.qty_ots);
                                        var n_qty_out = parseFloat(_qty_out.target.val());
                                        if (n_qty_out > _qty_ots) {
                                            _qty_out.target.numberbox('setValue', '');
                                            $.messager.alert('Out of Outstanding', 'Out of Outstanding Qty', 'error');
                                        } else {
                                            $.get(base_url + 'itemwarehousestock/get_stock/' + row.itemid + '/' + row.unitcode + '/' + _warehouseid, function (value) {
                                                var i_stock = parseFloat(value);
                                                if (n_qty_out > i_stock) {
                                                    _qty_out.target.numberbox('setValue', '');
                                                    $.messager.alert('Out of Stock', 'Out of Stock\nStock Available is ' + value, 'error');
                                                }
                                            });
                                        }
                                    } else {
                                        $.messager.alert('No Warehouse Selected', 'Please Choose Warehouse', 'error');
                                        _qty_out.target.numberbox('setValue', '');
                                    }
                                });
                                stockout_lastIndex = rowIndex;
                            },
                            onClickRow: function () {

                                var ed = $(this).datagrid('getEditor', {index: stockout_lastIndex, field: 'warehouseid'});
                                if (ed !== null) {
                                    var warehousename = $(ed.target).combobox('getText');
                                    $(this).datagrid('getRows')[stockout_lastIndex]['warehousename'] = warehousename;
                                }
                                $('#list_item_to_out').datagrid('endEdit', stockout_lastIndex);
                            }
                        });
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td width="15%" align="right"><label class="field_label">Remark :</label></td>
            <td colspan="4" width="85%">
                <textarea id="stockout_remark" style="width: 100%;height: 50px;"></textarea>
            </td>
        </tr>
    </table>
</form>

