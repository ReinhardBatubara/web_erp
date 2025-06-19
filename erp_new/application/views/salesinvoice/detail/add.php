<form id="salesinvoice-detail-input" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code : </label></td>
            <td>
                <input type="text" name="salesorderdetailid" id="si_salesorderdetailid" size="20" required="true"/>
                <script>
                    $('#si_salesorderdetailid').combogrid({
                        panelWidth: 450,
                        idField: 'id',
                        mode: 'remote',
                        textField: 'modelcode',
                        url: '<?php echo site_url('salesorder/get_available_detail_by_customer/' . $id . '/' . $customerid . '/' . $salesorderdetailid) ?>',
                        columns: [[
                                {field: 'id', hidden: true},
                                {field: 'modelcode', title: 'Item Code', width: 100},
                                {field: 'modelname', title: 'Description', width: 100},
                                {field: 'sonumber', title: 'SO', width: 80},
                                {field: 'invoice_ots', title: 'Ots Qty', width: 50,align:'center'},
                                {field: 'unitprice', title: 'U/Price', width: 100,halign:'center',align:'right'},
                                {field: 'discount', title: 'Discount', width: 100,halign:'center',align:'right'},
                                {field: 'tax', title: 'Tax', width: 100,halign:'center',align:'right'},
                            ]],
                        onSelect: function(index, row) {                            
                            $('#si_qty').numberbox('setValue',row.invoice_ots);
                            $('#si_unitprice').numberbox('setValue',row.unitprice);
                            $('#si_discount').numberbox('setValue',row.discount);
                            $('#si_tax').numberbox('setValue',row.tax);
                            $('#si_temp_ots').val(row.invoice_ots);
                            si_calculate();
                        }
                    });
                    
                    function si_calculate(){
                        var si_qty = parseFloat($('#si_qty').numberbox('getValue'));
                        var si_unitprice = parseFloat($('#si_unitprice').numberbox('getValue'));
                        var si_discount = parseFloat($('#si_discount').numberbox('getValue'));
                        var si_tax = parseFloat($('#si_tax').numberbox('getValue'));
                        var si_amount = (si_qty * si_unitprice) + si_tax - si_discount; 
                        $('#si_amount').numberbox('setValue',si_amount);
                    }
                    $.extend($.fn.validatebox.defaults.rules, {
                        si_check_value: {
                            validator: function (value, param) {
                                return (parseInt(value) <= parseInt($(param[0]).val())) && (parseInt(value) > 0);
                            },
                            message: 'Not allowed negative number and ensure not out of Outstanding'
                        }
                    });
                </script>
                <input type="hidden" id="si_temp_ots" name="si_temp_ots" value=""/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input type="text" name="qty" id="si_qty" class="easyui-numberbox" required="true" validType="si_check_value['#si_temp_ots']" size="5" style="text-align: center" data-options="onChange:function(n,o)(si_calculate())"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Price :</label></td>
            <td><input type="text" name="unitprice" id="si_unitprice" class="easyui-numberbox" required="true" style="text-align: right" precision="2" data-options="onChange:function(n,o)(si_calculate())"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Discount :</label></td>
            <td><input type="text" name="discount" id="si_discount" class="easyui-numberbox" style="text-align: right" precision="2" data-options="onChange:function(n,o)(si_calculate())"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Tax :</label></td>
            <td><input type="text" name="tax" id="si_tax" class="easyui-numberbox" style="text-align: right" precision="2" data-options="onChange:function(n,o)(si_calculate())"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Amount :</label></td>
            <td>
                <input type="text" name="amount" id="si_amount" readonly class="easyui-numberbox" required="true" style="text-align: right" precision="2"  value=""/>
                <input type="checkbox" checked id="si_check" onclick="if($(this).is(':checked')){$('#si_amount').prop('readonly',false)}else{$('#si_amount').prop('readonly',false)}"/> Uncheck to Change Amount
            </td>
        </tr>
    </table>        
</form>