<form id="po_plan_edit_form" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Supplier / Vendor : </label></td>
            <td>
                <input id="text" 
                       name="vendorid" 
                       class="easyui-combobox" 
                       data-options="
                       valueField: 'id',
                       textField: 'text',
                       url: '<?php echo site_url('vendor/get_remote_data') ?>'" 
                       mode="remote" 
                       required="true"
                       style="width: 300px"
                       readonly>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Currency : </label></td>
            <td>
                <select class="easyui-combobox"
                        name='currency'
                        required='true' panelHeight="50" style="width: 100px" readonly='true'>
                    <option></option>
                    <?php
                    foreach ($currency as $result) {
                        echo "<option value='" . $result->code . "'>" . $result->code . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
<!--        <tr>
            <td align="right" width="30%"><label class="field_label">Sub Total : </label></td>
            <td>
                <input type="text" name="sub_total" id='po_plan_sub_total' readonly class="easyui-numberbox" precision="2" size="25" decimalSeparator="." groupSeparator = ","/>
            </td>
        </tr>-->
<!--        <tr>
            <td align="right" width="30%">
                <label class="field_label">Discount&nbsp;
                    <input type="text" style="width: 40px;text-align: center" precision='2' maxlength="5" max='100' min='0' 
                           name="discount_percent" class="easyui-numberbox" id='po_plan_discount_percent'
                           data-options='onChange:function(n,o){calculate_sub_total_min_discount()}'/> %
                    :   
                </label>
            </td>
            <td>

                <input type="text" name="discount" id='po_plan_discount' readonly class="easyui-numberbox" precision="2" decimalSeparator="." groupSeparator = "," size="25"/>
            </td>
        </tr>-->
<!--        <tr>
            <td align="right" width="30%"><label class="field_label">Sub Total - Discount : </label></td>
            <td>
                <input type="text" name="sub_total_discount" id='po_plan_sub_total_discount' class="easyui-numberbox" precision="2" decimalSeparator="." groupSeparator = "," size="25" readonly/>
            </td>
        </tr>-->
<!--        <tr>
            <td align="right" width="30%">
                <label class="field_label">Ppn (10%)</label>
                <input type='checkbox' name='ppn_check' id='ppn_check'  style="vertical-align: middle" /> 
                <strong> : </strong>
                <script>

                    function calculate_sub_total_min_discount() {
                        var discount_percent_temp = $('#po_plan_discount_percent').numberbox('getValue');
                        var discount_percent = (discount_percent_temp === '') ? 0 : parseFloat(discount_percent_temp);

                        var sub_total = parseFloat($('#po_plan_sub_total').numberbox('getValue'));
                        var discount = (discount_percent * sub_total) / 100;

                        $('#po_plan_discount').numberbox('setValue', discount);
                        $('#po_plan_sub_total_discount').numberbox('setValue', (sub_total - discount));

                        calculate_tax();
                        calculate_total_amount();
                    }

                    $('#ppn_check').click(function () {
                        calculate_tax();
                    });
                    function calculate_tax() {
                        var sub_total_discount = parseFloat($('#po_plan_sub_total_discount').numberbox('getValue'));
                        if ($('#ppn_check').is(':checked')) {
                            var tax = (sub_total_discount * 10) / 100;
                            console.log('Sub Total - DIscount: ' + sub_total_discount);
                            console.log('Tax: ' + tax);
                            $('#po_plan_tax').numberbox('setValue', tax);
                        } else {
                            $('#po_plan_tax').numberbox('setValue', 0);
                        }
                        calculate_total_amount();
                    }
                    function calculate_total_amount() {
                        var sub_total_discount = parseFloat($('#po_plan_sub_total_discount').numberbox('getValue'));
                        var po_plan_tax_temp = $('#po_plan_tax').numberbox('getValue');
                        var po_plan_tax = (po_plan_tax_temp === '') ? 0 : parseFloat(po_plan_tax_temp);
                        console.log('Tax : ' + po_plan_tax);
                        $('#po_plan_total_amount').numberbox('setValue', (sub_total_discount + po_plan_tax));
                    }
                </script>
            </td>
            <td>
                <input type="text" name="tax" readonly id='po_plan_tax' class="easyui-numberbox" min='0' precision="2" size="25" decimalSeparator="." groupSeparator = ","/>
            </td>
        </tr>-->
<!--        <tr>
            <td align="right" width="30%"><label class="field_label">Grand Total : </label></td>
            <td><input type="text" name="total_amount" id='po_plan_total_amount' class="easyui-numberbox" precision="2" decimalSeparator="." groupSeparator = "," size="25" readonly/></td>
        </tr>-->
        <tr>
            <td align="right"><label class="field_label">Expected Delivery Date : </label></td>
            <td><input type="text" name="expected_delivery_date" class="easyui-datebox" size="15" value="" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Payment Terms : </label></td>
            <td>
                <select class="easyui-combobox" name="payment_terms" panelHeight="auto" editable="false">
                    <option value="Cash">Cash</option>
                    <option value="COD">COD</option>
                    <option value="7 days">7 days</option>
                    <option value="14 days">14 days</option>
                    <option value="30 days">30 days</option>
                </select>
            </td>
        </tr> 
        <tr>
            <td align="right"><label class="field_label">Description : </label></td>
            <td>
                <textarea name="description" style="width: 100%;height: 40px"></textarea>
            </td>
        </tr>    
    </table>
</form>