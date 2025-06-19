<form id="sto_add_item_from_nota" method="post" novalidate class="table_form" style="padding: 2px">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code :</label></td>
            <td width="70%">
                <input type="text" 
                       id="sto_add_item_from_nota_itemid"
                       required="true"
                       name="itemid"                           
                       style="width: 180px"
                       />
                <script type="text/javascript">
                    $(function () {
                        $('#sto_add_item_from_nota_itemid').combobox({
                            url: '<?php echo site_url('item/get_for_combo') ?>',
                            method: 'post',
                            valueField: 'id',
                            textField: 'code',
                            panelHeight: '200',
                            mode: 'remote',
                            panelWidth: '250',
                            formatter: formatStoAddItemFormat,
                            onSelect: function (row) {
                                $('#sto_item_description521').val(row.description);
                                $('#sto_unitcode521').val(row.unitcode);
                                if ($('#sto_warehouseid521').length > 0) {
                                    $('#sto_warehouseid521').combobox('clear');
                                    $('#sto_warehouseid521').combobox('reload', base_url + 'item/get_warehouse/' + row.id + '/' + row.unitcode)
                                }
                                $.get(base_url + 'item/get_stock_by_unit_code/' + row.id + '/' + row.unitcode, function (content) {
                                    $('#sto_item_stock_qty521').val(content);
                                });
                            }
                        });
                    });
                    function formatStoAddItemFormat(row) {
                        var s = '<span style="font-weight:bold">' + row.code + '</span><br/>' +
                                '<span style="color:#888;font-size:7.5pt">Desc: ' + row.description + '</span><br/>' +
                                '<span>Unit Code: ' + row.unitcode + '</span><br/>';
                        return s;
                    }

                    $.extend($.fn.numberbox.defaults.rules, {
                        check_ots_mw_qty_nt: {
                            validator: function (value, param) {
                                return (parseFloat(value) <= parseFloat($(param[0]).val())) && (parseFloat(value) > 0);
                            },
                            message: 'Out of Stock'
                        }
                    });
                </script>
                <label class="field_label">Stock :</label>
                <input type="text" 
                       name="ots_mw_qty"
                       id="sto_item_stock_qty521"                        
                       readonly 
                       value="0"
                       style="text-align: center;width: 50px;border: none;background: none;"
                       />    
            </td>
        </tr>            
        <tr>
            <td align="right"><label class="field_label">Item Description : </label></td>
            <td>
                <textarea name="description" 
                          id="sto_item_description521" 
                          class="easyui-validatebox" 
                          style="width: 90%;height: 40px" readonly></textarea>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code : </label></td>
            <td>
                <input id="sto_unitcode521" 
                       name="unitcode" 
                       class="easyui-validatebox"
                       style="width: 50px;text-align: center;"
                       readonly>
            </td>
        </tr>
        <?php
        if ($this->session->userdata('department') == 9) {
            if ($this->session->userdata('optiongroup') == -1) {
                ?>
                <tr>
                    <td align="right"><label class="field_label">Out From : </label></td>
                    <td>
                        <input id="sto_warehouseid521" 
                               name="warehouseid" 
                               class="easyui-combobox"
                               style="width: 80px;" panelHeight="auto" required="true" 
                               valueField="warehouseid"
                               textField="warehousename"
                               />
                    </td>
                </tr>
                <?php
            } else {
                ?>
                <input type="hidden" id="warehouseid" name="warehouseid" value="<?php echo $this->session->userdata('optiongroup') ?>" />
                <?php
            }
        }
        ?>
        <tr>
            <td align="right"><label class="field_label">Qty : </label></td>
            <td>
                <input type="text" 
                       name="qty" 
                       id="sto_qty521" 
                       precision="10" 
                       class="easyui-numberbox" 
                       validType="check_ots_mw_qty_nt['#sto_item_stock_qty521']" 
                       size="10" 
                       required="true"
                       style="text-align: center"
                       />
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