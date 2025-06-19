<form id="quotation-input" method="post" novalidate style="padding: 2px" class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="25%"><label class="field_label">Date : </label></td>
            <td width="75%"><input type="text" style="width: 50%" name="date" class="easyui-datebox" id="date" data-options="formatter:myformatter,parser:myparser" required="true"/></td>
        </tr>   
        <tr>
            <td align="right" ><label class="field_label">To : </label></td>
            <td><input type="text" name="to" class="easyui-validatebox" required="true" value="" style="width: 100%;"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Customer :</label></td>
            <td>
                <input class="easyui-combobox" name="customerid" id="quo_customerid" data-options="
                       url: '<?php echo site_url('customer/get') ?>',
                       method: 'post',
                       valueField: 'id',
                       textField: 'name',
                       panelHeight: '200',
                       mode: 'remote',
                       formatter: format_order_by"
                       style="width: 100%">
                <script type="text/javascript">
                    function format_order_by(row) {
                        return '<span>' + row.name + '/' + row.code + '</span><br/>';
                    }
                    $(function () {
                        $('#quo_customerid').combobox({
                            onSelect: function (row) {
                                $('#quo_company').val(row.name);
                            }
                        });
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Company : </label></td>
            <td><input type="text" style="width: 100%" name="company" id="quo_company" class="easyui-validatebox" required="true" value=""/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Currency : </label></td>
            <td>
                <input class="easyui-combobox" name="currency" id="quo_customerid" data-options="
                       url: '<?php echo site_url('currency/get') ?>',
                       method: 'post',
                       valueField: 'code',
                       textField: 'code',
                       panelHeight: 'auto',
                       panelWidth:'200',
                       mode: 'remote',
                       formatter: quo_format_currency_by"
                       style="width: 250px">
                <script type="text/javascript">
                    function quo_format_currency_by(row) {
                        return '<span>' + row.code + ': ' + row.description + '</span><br/>';
                    }
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Project : </label></td>
            <td><input type="text" name="project" class="easyui-validatebox" value="" style="width: 100%"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">REF : </label></td>
            <td><input type="text" name="ref" class="easyui-validatebox" value="" style="width: 100%"/></td>
        </tr>
        <tr valign="top">
            <td align="right"><label class="field_label">Note : </label></td>
            <td>
                <textarea name="note" id="quo_notes" class="easyui-validatebox" style="width: 100%;height: 40px"></textarea>
            </td>
        </tr>            
    </table>        
</form>