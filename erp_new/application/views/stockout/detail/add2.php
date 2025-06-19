<form id="sto_add_item2-input" method="post" novalidate class="table_form" style="padding: 2px">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code :</label></td>
            <td>
                <input type="text" name="mrpid" id="sto_mrpid51" style="width: 180px" required="true" value=""/>
                <script>
                    $('#sto_mrpid51').combogrid({
                        panelWidth: 450,
                        idField: 'id',
                        mode: 'remote',
                        textField: 'item_code',
                        url: '<?php echo site_url('stockout/get_mrp_outstanding_withdraw_by_joborderid/' . $joborderid) ?>',
                        columns: [[
                                {field: 'id', hidden: true},
                                {field: 'item_code', title: 'Item Code', halign: 'center', width: 80},
                                {field: 'item_description', title: 'Item Description', halign: 'center', width: 200},
                                {field: 'unit_code', title: 'Unit', align: 'center', width: 60},
                                {field: 'ots_withdraw', title: 'Ots Withdraw', width: 80, align: 'center'}
                            ]],
                        onSelect: function (index, row) {
                            $('#sto_item_description51').val(row.item_description);
                            $('#sto_unitcode51').val(row.unit_code);
                            $('#sto_itemid51').val(row.itemid);
                            $('#ots_mw_qty51').val(row.ots_withdraw);
                            if ($('#sto_warehouseid51').length > 0) {
                                $('#sto_warehouseid51').combobox('clear');
                                $('#sto_warehouseid51').combobox('reload', base_url + 'item/get_warehouse/' + row.itemid + '/' + row.unit_code)
                            }
                        }
                    });
                </script>
                <input type="hidden" id="sto_itemid51" name="itemid" />
                <label class="field_label">Outstanding :</label>
                <input type="text" 
                       name="ots_mw_qty51" 
                       class="easyui-validatebox" 
                       id="ots_mw_qty51"                        
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
                          id="sto_item_description51" 
                          class="easyui-validatebox" 
                          style="width: 90%;height: 40px" readonly>                    
                </textarea>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code : </label></td>
            <td>
                <input id="sto_unitcode51" 
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
                        <input id="sto_warehouseid51" 
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
                       id="sto_qty51" 
                       precision="4" 
                       class="easyui-numberbox" 
                       validType="check_ots_mw_qty['#ots_mw_qty51']" 
                       size="10" 
                       required="true"
                       />
            </td>
        </tr>            
    </table>        
</form>
<script type="text/javascript">
    $.extend($.fn.numberbox.defaults.rules, {
        check_ots_mw_qty: {
            validator: function (value, param) {
                return (parseFloat(value) <= parseFloat($(param[0]).val())) && (parseFloat(value) > 0);
            },
            message: 'Out of Outsanding'
        }
    });
</script>
