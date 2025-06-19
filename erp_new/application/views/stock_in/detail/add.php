<form id="stock_in_detail-input" method="post" novalidate class="table_form" style="padding: 2px">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code : </label></td>
            <td width="70%">
                <input type="text" id="stock_in_detail_itemid" required="true" name="itemid" style="width: 180px"/>
                <script type="text/javascript">
                    $(function () {
                        $('#stock_in_detail_itemid').combobox({
                            url: '<?php echo site_url('item/get_for_combo') ?>',
                            method: 'post',
                            valueField: 'id',
                            textField: 'code',
                            panelHeight: '200',
                            mode: 'remote',
                            panelWidth: '250',
                            formatter: formatStokInAddItemFormat,
                            onSelect: function (row) {
                                $('#stock_in_detail_description').val(row.description);
                                $('#sto_unitcode521').val(row.unitcode);
                                if ($('#stock_in_detail_warehouseid').length > 0) {
                                    $('#stock_in_detail_warehouseid').combobox('clear');
                                    $('#stock_in_detail_warehouseid').combobox('reload', base_url + 'item/get_warehouse/' + row.id + '/' + row.unitcode)
                                }
                                $('#stock_in_detail_unitcode').combobox('clear');
                                $('#stock_in_detail_unitcode').combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row.id);
                                $('#stock_in_detail_unitcode').combobox('setValue', row.unitcode);
                            }
                        });
                    });
                    function formatStokInAddItemFormat(row) {
                        var s = '<span style="font-weight:bold">' + row.code + '</span><br/>' +
                                '<span style="color:#888;font-size:7.5pt">Desc: ' + row.description + '</span><br/>' +
                                '<span>Unit Code: ' + row.unitcode + '</span><br/>';
                        return s;
                    }
                    $('#stock_in_detail_itemid').focus();
                </script>
            </td>
        </tr>            
        <tr>
            <td align="right"><label class="field_label">Description : </label></td>
            <td>
                <textarea name="itemdescription" readonly id="stock_in_detail_description" class="easyui-validatebox" style="width: 90%;height: 40px"></textarea>
            </td>
        </tr>
        <?php if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') { ?>
            <tr>
                <td align="right"><label class="field_label">Store To : </label></td>
                <td>
                    <input type="text"
                           name="warehouseid" 
                           id="stock_in_detail_warehouseid" 
                           class="easyui-combobox" 
                           data-options="
                           valueField: 'warehouseid',
                           textField: 'warehousename'
                           " 
                           style="width: 100px" 
                           panelHeight="auto"
                           required="true" >
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td align="right"><label class="field_label">Unit Code : </label></td>
            <td>
                <input id="stock_in_detail_unitcode" name="unitcode" class="easyui-combobox" panelHeight="auto" editable="false" data-options="valueField:'id',textField:'text'" required="true" style="width: 100px;">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input unit="text" precision="4" name="qty" style="text-align: center;width: 100px" class="easyui-numberbox" required="true" value=""/></td>
        </tr>
    </table>      
</form>