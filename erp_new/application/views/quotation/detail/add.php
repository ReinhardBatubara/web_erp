<form id="quotationdetail-input" method="post" novalidate class="table_form" style="padding: 2px">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code : </label></td>
            <td>
                <input type="text" name="modelid" id="q_t_modelid" mode="remote" style="width: 250px" required="true"/>
                <script type="text/javascript">
                    $('#q_t_modelid').combogrid({
                        panelWidth: 500,
                        mode: 'remote',
                        idField: 'id',
                        textField: 'code',
                        url: '<?php echo site_url('model/get_open') ?>',
                        columns: [[
                                {field: 'code', title: 'Item Code', width: 100, halign: 'center', rowspan: 2},
                                {field: 'name', title: 'Item Name', width: 200, halign: 'center', rowspan: 2},
                                {field: 'originalcode', title: 'Original Code', width: 100, halign: 'center', rowspan: 2},
                                {field: 'mastercode', title: 'Master Code', width: 100, halign: 'center', rowspan: 2},
                                {title: 'Item Size', align: 'center', colspan: 3},
                                {title: 'Packing Size', align: 'center', colspan: 3},
                                {field: 'final_selling_price', title: 'Selling Price', width: 100, halign: 'center', align: 'right', rowspan: 2}
                            ], [
                                {field: 'itemsize_mm_w', title: 'W', width: 50, halign: 'center'},
                                {field: 'itemsize_mm_d', title: 'D', width: 50, halign: 'center'},
                                {field: 'itemsize_mm_h', title: 'W Code', width: 50, halign: 'center'},
                                {field: 'packagingsize_mm_w', title: 'W', width: 50, halign: 'center'},
                                {field: 'packagingsize_mm_d', title: 'D', width: 50, halign: 'center'},
                                {field: 'packagingsize_mm_h', title: 'W Code', width: 50, halign: 'center'},
                            ]],
                        onSelect: function (index, row) {
                            $('#quo_model_price').numberbox('setValue', row.final_selling_price);
                            $('#quo_finishingcode').combogrid('setValue', row.finishingcode);
                        }
                    });
                </script>
            </td>
        </tr>            
        <tr>
            <td align="right"><label class="field_label">Finishing : </label></td>
            <td>
                <input type="text" id="quo_finishingcode" style="width: 250px" name="finishingcode"/>
                <script type="text/javascript">
                    $('#quo_finishingcode').combogrid({
                        panelWidth: 350,
                        mode: 'remote',
                        idField: 'code',
                        textField: 'description',
                        url: '<?php echo site_url('finishing/get_remote_data') ?>',
                        columns: [[
                                {field: 'code', title: 'Code', width: 100, halign: 'center'},
                                {field: 'description', title: 'Description', width: 200, halign: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Price :</label></td>
            <td><input type="text" name="price" id="quo_model_price" class="easyui-numberbox" style="text-align: right;width: 250px" precision="2" groupSeparator="," required="true" value=""/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark : </label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width: 250px;height: 50px"></textarea>
            </td>
        </tr> 
    </table>      
</form>