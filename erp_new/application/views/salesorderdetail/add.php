<form id="salesorderdetail-input" method="post" novalidate class="table_form" style="padding: 2px">
    <table width="100%" border="0">
        <tr>
            <td align="right"><label class="field_label">Customer Code :</label></td>
            <td><input type="text" name="customer_code" class="easyui-validatebox" style="width: 100%"/></td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code :</label></td>
            <td>
                <input type="text" name="modelid" id="sodetail_modelid" style="width: 100%" name="modelcategorycode" required="true"/>
                <script type="text/javascript">
                    $('#sodetail_modelid').combogrid({
                        panelWidth: 500,
                        mode: 'remote',
                        idField: 'modelid',
                        textField: 'code',
                        url: '<?php echo site_url('costing/product_price_list_get_open') ?>',
                        columns: [[
                                {field: 'code', title: 'Item Code', width: 80, halign: 'center', rowspan: 2},
                                {field: 'originalcode', title: 'Original<br/>Code', width: 80, halign: 'center', rowspan: 2},
                                {field: 'name', title: 'Item Name', width: 200, halign: 'center', rowspan: 2},
                                {title: 'Item Size', align: 'center', colspan: 3},
                                {title: 'Packing Size', align: 'center', colspan: 3},
                                {field: 'usd_price', title: 'USD PRICE', width: 80, halign: 'center', align: 'right', rowspan: 2, formatter: formatPrice},
                                {field: 'usd_optional_price', title: 'USD PRICE<br/>(Opt)', width: 80, halign: 'center', align: 'right', rowspan: 2, formatter: formatPrice},
                                {field: 'idr_price', title: 'IDR PRICE', width: 80, halign: 'center', align: 'right', rowspan: 2, formatter: formatPrice}
                            ], [
                                {field: 'itemsize_mm_w', title: 'W', width: 50, halign: 'center'},
                                {field: 'itemsize_mm_d', title: 'D', width: 50, halign: 'center'},
                                {field: 'itemsize_mm_h', title: 'W Code', width: 50, halign: 'center'},
                                {field: 'packagingsize_mm_w', title: 'W', width: 50, halign: 'center'},
                                {field: 'packagingsize_mm_d', title: 'D', width: 50, halign: 'center'},
                                {field: 'packagingsize_mm_h', title: 'W Code', width: 50, halign: 'center'},
                            ]],
                        onSelect: function (index, row) {
                            $('#sodetail_modename_').val(row.name);
                            var row_so = $('#salesorder').datagrid('getSelected');
                            if (row_so.currency == 'IDR') {
                                $('#salesorderdetail_unit_price_').numberbox('setValue', row.idr_price);
                            } else {
                                $('#salesorderdetail_unit_price_').numberbox('setValue', row.usd_price);
                            }
                        }
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Item Name :</label></td>
            <td><input type="text" name="name" id="sodetail_modename_" class="easyui-validatebox" readonly style="width: 100%"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input type="text" name="qty" class="easyui-numberbox" required="true" style="text-align: center;width: 50%" value=""/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Price :</label></td>
            <td><input type="text" name="unitprice" id="salesorderdetail_unit_price_" class="easyui-numberbox" style="text-align: right;width: 100%" precision="2" groupSeparator="," required="true" value="" min="0"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Discount :</label></td>
            <td><input type="text" name="discount" class="easyui-numberbox" style="text-align: right;width: 100%" precision="2" groupSeparator="," value=""/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Tax :</label></td>
            <td><input type="text" name="tax" class="easyui-numberbox" style="text-align: right;width: 100%" precision="2" groupSeparator=","  value=""/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark :</label></td>
            <td><textarea name="remark" id="sodetail_remark" class="easyui-validatebox" style="width: 100%;height: 40px"></textarea></td>
        </tr>            
    </table>        
</form>