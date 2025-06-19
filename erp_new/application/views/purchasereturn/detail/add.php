<form id="purchasereturndetail-input" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code : </label></td>
            <td width="70%">
                <input type="text" id="prt_itemid" name="itemid" style="width: 270px"/>
                <script type="text/javascript">
                    $(function () {
                        $('#prt_itemid').combobox({
                            url: '<?php echo site_url('item/get_for_combo') ?>',
                            method: 'post',
                            valueField: 'id',
                            textField: 'code',
                            panelHeight: '200',
                            mode: 'remote',
                            formatter: PurchaseReturnItemFormat,
                            onSelect: function (row) {
                                $('#prt_unit').combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row.id);
                                $('#prt_unit').combobox('setValue', row.unitcode);
                                if ($('#prt_detail_warehouseid')) {
                                    $('#prt_detail_warehouseid').combobox('clear');
                                    $('#prt_detail_warehouseid').combobox('reload', base_url + 'item/get_warehouse/' + row.id + '/' + row.unitcode)
                                }
                            }
                        });
                    });
                    function PurchaseReturnItemFormat(row) {
                        var s = '<span style="font-weight:bold">' + row.code + '</span><br/>' +
                                '<span style="color:#888;font-size:7.5pt">Desc: ' + row.description + '</span><br/>' +
                                '<span>Unit Code: ' + row.unitcode + '</span><br/>';
                        return s;
                    }
                </script>
            </td>
        </tr>      
        <tr>
            <td align="right"><label class="field_label">UoM :</label></td>
            <td>
                <input id="prt_unit" name="unitcode" required panelHeight="auto" editable="false" class="easyui-combobox" data-options="valueField:'id',textField:'text',panelHeight:'auto'" style="width: 120px;">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty sa:</label></td>
            <td><input type="text" name="qty" style="text-align: center" class="easyui-numberbox" size="5" required="true" value="" precision="2"/></td>
        </tr>
        <?php if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') { ?>
            <tr>
                <td align="right"><label class="field_label">Return From : </label></td>
                <td>
                    <input type="text"
                           name="warehouseid" 
                           id="prt_detail_warehouseid" 
                           class="easyui-combobox" 
                           data-options="
                           valueField: 'warehouseid',
                           textField: 'warehousename'
                           " 
                           style="width: 120px" 
                           panelHeight="auto"
                           required="true" >
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td align="right"><label class="field_label">Type :</label></td>
            <td>
                <select class="easyui-combobox" name="type" panelHeight="auto" style="width: 100px">
                    <option value="1">Fixed Stock</option>
                    <option value="2">Update Stock</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark : </label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width: 90%;height: 40px"></textarea>
            </td>
        </tr>
    </table>      
</form>