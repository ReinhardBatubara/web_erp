<form id="transferstockdetail-input" method="post" novalidate class="table_form" style="padding: 2px">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code : </label></td>
            <td width="70%">
                <input type="hidden" id="transferstockdetail_itemid_last" value="0" />
                <input type="hidden" id="transferstockdetail_stock_input" value="0" />
                <input type="text" id="transferstockdetail_itemid" required="true" name="itemid" style="width: 250px"/>
                <script type="text/javascript">
                    $(function() {
                        $('#transferstockdetail_itemid').combobox({
                            url: '<?php echo site_url('item/get_in_warehouse/' . $fromwarehouseid . "/" . $towarehouseid) ?>',
                            method: 'post',
                            valueField: 'id',
                            textField: 'code',
                            panelHeight: '200',
                            mode: 'remote',
                            panelWidth:'250',
                            formatter: formatTransferStockItemFormat,
                            onSelect:function(row){
                                $('#transferstockdetail_description').val(row.description);
                                $('#transferstockdetail_unitcode').combobox('clear');
                                $('#transferstockdetail_unitcode').combobox('reload', base_url + 'itemunitprice/get_all_unit/' + row.id);                                
                            }
                        });
                    });
                    function formatTransferStockItemFormat(row){
                        var s = '<span style="font-weight:bold">' + row.code +'</span><br/>' +
                            '<span style="color:#888;font-size:7.5pt">Desc: ' + row.description + '</span><br/>';
                        return s;
                    }
                    $.extend($.fn.numberbox.defaults.rules, {
                        transferstockdetail_check_stock_qty: {
                            validator: function(value,param){
                                return (parseFloat(value) <= parseFloat($(param[0]).val())) && (parseFloat(value) > 0);
                            },
                            message: 'Out of Stock'
                        }
                    });
                </script>                    
            </td>
        </tr>            
        <tr>
            <td align="right"><label class="field_label">Description : </label></td>
            <td>
                <textarea name="itemdescription" readonly id="transferstockdetail_description" class="easyui-validatebox" style="width: 90%;height: 40px"></textarea>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code : </label></td>
            <td>
                <input id="transferstockdetail_unitcode" 
                       name="unitcode" 
                       class="easyui-combobox" 
                       panelHeight="auto" editable="false" 
                       data-options="valueField:'id',textField:'text'" 
                       required="true" 
                       style="width: 80px;">
                <script>
                    $('#transferstockdetail_unitcode').combobox({
                        onSelect: function(row){
                            var _itemid = $('#transferstockdetail_itemid').combobox('getValue');
                            $.get(base_url+'itemwarehousestock/get_stock/'+_itemid+'/'+row.id+'/'+ <?php echo $fromwarehouseid ?>,function(content){
                                var last_itemid_y_2 = $('#transferstockdetail_itemid_last').val();                                
                                if(_itemid == last_itemid_y_2){
                                    var new_stock = parseFloat($('#transferstockdetail_stock_input').val()) + parseFloat(content);
                                    $('#transferstockdetail_item_stock_qty521').val(new_stock);
                                }else{
                                    $('#transferstockdetail_item_stock_qty521').val(content);
                                }
                                
                            });
                        }
                    });
                </script>
                <label class="field_label">Stock :</label>
                <input type="text" 
                       id="transferstockdetail_item_stock_qty521"                        
                       readonly 
                       value="0"
                       style="text-align: center;width: 50px;border: none;background: none;"
                       />                
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input type="text" 
                       name="qty" 
                       style="text-align: center" 
                       class="easyui-numberbox" 
                       size="5" 
                       required="true" 
                       precision="4"
                       validType="transferstockdetail_check_stock_qty['#transferstockdetail_item_stock_qty521']"
                       /></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark :</label></td>
            <td>
                <textarea name="remark" id="transferstockdetail_remark" class="easyui-validatebox" style="width: 90%;height: 40px"></textarea>
            </td>
        </tr>
    </table>      
</form>