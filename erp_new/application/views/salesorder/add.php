<form id="salesorder-input" method="post" style="padding: 2px" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Date :</label></td>
            <td width="70%"><input type="text" size="15" name="date" class="easyui-datebox" id="date" data-options="formatter:myformatter,parser:myparser" required="true"/></td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">PO NO :</label></td>
            <td><input type="text" name="po_no" class="easyui-validatebox" required="true" value="" style="width: 100%"/></td>
        </tr>
        <tr valign="top">
            <td align="right" style="padding-top: 5px"><label class="field_label">Order By :</label></td>
            <td>
                <input class="easyui-combobox" name="orderby" id="orderby" data-options="
                       url: '<?php echo site_url('customer/get') ?>',
                       method: 'post',
                       valueField: 'id',
                       textField: 'name',
                       panelHeight: '200',
                       mode: 'remote',
                       formatter: format_order_by"
                       style="width: 100%" 
                       required="true">
                <script type="text/javascript">
                    function format_order_by(row) {
                        return '<span>' + row.name + '/' + row.code + '</span><br/>';
                    }
                    $(function () {
                        $('#orderby').combobox({
                            onSelect: function (row) {
                                console.log(row.id);
                                $('#shipto').combobox('setValue', row.id);
                                $.get(base_url + 'customer/get_address/' + row.id, function (content) {
                                    $('#address_orderby').val(content);
                                    $('#address_shipto').val(content);
                                });
                            }
                        });
                    });
                </script>
                <textarea name="address_orderby" id="address_orderby" class="easyui-validatebox" style="width: 100%;height: 50px"></textarea>
            </td>
        </tr>
        <tr valign="top">
            <td align="right" style="padding-top: 5px"><label class="field_label">Ship To :</label></td>
            <td>

                <input class="easyui-combobox" name="shipto" id="shipto" data-options="
                       url: '<?php echo site_url('customer/get') ?>',
                       method: 'post',
                       valueField: 'id',
                       textField: 'name',
                       panelHeight: '200',
                       mode: 'remote',
                       formatter: format_order_by"
                       style="width: 100%" 
                       required="true">         
                <script type="text/javascript">
                    $(function () {
                        $('#shipto').combobox({
                            onSelect: function (row) {
                                console.log(row.id);
                                $('#shipto').combobox('setValue', row.id);
                                $.get(base_url + 'customer/get_address/' + row.id, function (content) {
                                    $('#address_shipto').val(content);
                                });
                            }
                        });
                    });
                </script>
                <textarea name="address_shipto" id="address_shipto" class="easyui-validatebox" style="width: 100%;height: 50px"></textarea>
            </td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">Exp. Delivery Date :</label></td>
            <td><input type="text" size="15" class="easyui-datebox" id="shipdate" name="shipdate" data-options="formatter:myformatter,parser:myparser" required="true"/></td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">Ship Via  :</label></td>
            <td>
                <input type="text" class="easyui-validatebox" name="shipvia"  style="width: 100%" />
            </td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">Pay To :</label></td>
            <td>
                <input class="easyui-combobox" name="bankaccountid" id="bankaccountid" data-options="
                       url: '<?php echo site_url('bankaccount/get') ?>',
                       method: 'post',
                       valueField: 'id',
                       textField: 'account_number',
                       panelHeight: '200',
                       panelWidth: '300',
                       mode: 'remote',
                       formatter: format_bankaccount_in_so"
                       style="width: 100%" 
                       required="true">
                <script type="text/javascript">
                    function format_bankaccount_in_so(row) {
                        return '<span>Account Number : ' + row.account_number + '</span><br/>' +
                                '<span>Account Name : ' + row.account_name + '</span><br/>' +
                                '<span>Bank : ' + row.bank + '</span><br/>' +
                                '<span>Currency : ' + row.currency + '</span>';
                    }
                </script>
            </td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">Terms  :</label></td>
            <td><input type="text" name="terms" class="easyui-validatebox" value="" style="width: 100%"/></td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">Salesman  :</label></td>
            <td><input type="text" name="salesman" class="easyui-validatebox" value="" style="width: 100%"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Description :</label></td>
            <td><textarea name="description" id="description" class="easyui-validatebox" style="width: 100%;height: 45px"></textarea></td>
        </tr>
    </table>        
</form>