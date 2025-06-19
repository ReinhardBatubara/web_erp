<div id="carvingsubmission_list_item_input_dialog" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:450px; padding: 2px 2px" closed="true" buttons="#carvingsubmission_list_item_input_button">
    <form id="carvingsubmission_list_item_input_form" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="150"><label class="field_label">Product Barcode/Serial :</label></td>
                <td width="280">
                    <input type="text" size="20" name="trackingid" id="carvingsubmission_list_item_trackingid" required="true" style="width: 280px"/>
                    <script>
                        $('#carvingsubmission_list_item_trackingid').combogrid({
                            panelWidth: 450,
                            idField: 'id',
                            mode: 'remote',
                            textField: 'serial',
                            url: '<?php echo site_url('carvingsubmission/get_available') ?>',
                            columns: [[
                                    {field: 'serial', title: 'Item Code', width: 100, rowspan: 2},
                                    {field: 'code', title: 'Item Code', width: 100, rowspan: 2},
                                    {field: 'name', title: 'Item Name', width: 100, rowspan: 2},
                                    {title: 'Item Size', width: 100, colspan: 3},
                                    {field: 'price', title: 'Price', width: 100, rowspan: 2}
                                ], [
                                    {field: 'itemsize_mm_w', title: 'W', width: 50, align: 'center'},
                                    {field: 'itemsize_mm_d', title: 'D', width: 50, align: 'center'},
                                    {field: 'itemsize_mm_h', title: 'H', width: 50, align: 'center'}
                                ]],
                            onSelect: function (index, row) {
                                $('#cv_sub_remark').val(row.remark);
                                $('#cv_sub_price').numberbox('setValue', row.price);
                                $('#carvingsubmission_list_item_serial').val(row.serial);
                            }
                        });
                    </script>
                    <input type="hidden" name="serial" id="carvingsubmission_list_item_serial" required="true" style="width: 280px"/>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Price :</label></td>
                <td><input type="text" name="price" class="easyui-numberbox" id="cv_sub_price" precision="2" groupSeparator="," required="true" value="" style="width: 180px;text-align: right"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Status :</label></td>
                <td>
                    <select class="easyui-combobox" name="status" panelHeight="auto" style="width: 200px" required="true">
                        <option></option>
                        <option value="Complete">Complete</option>
                        <option value="Not Complete">Not Complete</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Remark :</label></td>
                <td><textarea type="tex" class="easyui-validatebox" id="cv_sub_remark" name="remark" style="width: 280px;height: 50px"></textarea></td>
            </tr>
        </table>        
    </form>
</div>
<div id="carvingsubmission_list_item_input_button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="carvingsubmission_list_item_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#carvingsubmission_list_item_input_dialog').dialog('close')">Cancel</a>
</div>