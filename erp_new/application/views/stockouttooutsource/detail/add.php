<form id="sto_os_detail-input" method="post" novalidate class="table_form" style="padding: 2px">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code : </label></td>
            <td>
                <input type="text" id="sto_os_detail_itemid" name="itemid" required style="width: 250px"/>
                <script type="text/javascript">
                    $(function () {
                        $('#sto_os_detail_itemid').combobox({
                            url: '<?php echo site_url('item/get_for_combo') ?>',
                            method: 'post',
                            valueField: 'id',
                            textField: 'code',
                            panelHeight: '200',
                            mode: 'remote',
                            formatter: stockOutToOutSourceItemFormat,
                            onSelect: function (row) {
                                $('#sto_os_detail_description').val(row.description);
                                $('#sto_os_detail_unitcode').combobox('clear');
                                $('#sto_os_detail_unitcode').combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row.id);
                                $('#sto_os_detail_unitcode').combobox('setValue', row.unitcode);
                                if ($('#sto_os_detail_warehouseid').length > 0) {
                                    $('#sto_os_detail_warehouseid').combobox('clear');
                                    $('#sto_os_detail_warehouseid').combobox('reload', base_url + 'item/get_warehouse/' + row.id + '/' + row.unitcode)
                                }
                            }
                        });
                    });
                    function stockOutToOutSourceItemFormat(row) {
                        var s = '<span style="font-weight:bold">' + row.code + '</span><br/>' +
                                '<span style="color:#888;font-size:7.5pt">Desc: ' + row.description + '</span><br/>' +
                                '<span>Unit Code: ' + row.unitcode + '</span><br/>';
                        return s;
                    }
                </script>

            </td>
        </tr>            
        <tr>
            <td align="right"><label class="field_label">Description : </label></td>
            <td>
                <textarea name="itemdescription" readonly id="sto_os_detail_description" class="easyui-validatebox" style="width: 250px;height: 40px"></textarea>
            </td>
        </tr>
        <?php if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') { ?>
            <tr>
                <td align="right"><label class="field_label">Out From : </label></td>
                <td>
                    <input type="text"
                           name="warehouseid" 
                           id="sto_os_detail_warehouseid" 
                           class="easyui-combobox" 
                           data-options="
                           valueField: 'warehouseid',
                           textField: 'warehousename'
                           " 
                           style="width: 80px" 
                           panelHeight="auto"
                           required="true" >
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td align="right"><label class="field_label">Unit Code : </label></td>
            <td>
                <input id="sto_os_detail_unitcode" name="unitcode" class="easyui-combobox" panelHeight="auto" editable="false" data-options="valueField:'id',textField:'text'" required="true" style="width: 80px;">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input unit="text" name="qty" style="text-align: center" precision="4" class="easyui-numberbox" size="5" required="true" value=""/></td>
        </tr>
    </table>      
</form>