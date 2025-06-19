<form id="joborder_add_on_process-form" method="post" novalidate class="table_form" style="padding: 2px">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Process :</label></td>
            <td width="70%">
                <input type="hidden" value="<?php echo $joborderitemid ?>" name="joborderitemid" />
                <input type="hidden" value="<?php echo $modelid ?>" name="modelid" />
                <input type="text" name="modelprocessid" id="modelprocessid" mode="remote" style="width: 100%" required="true"/>
                <script type="text/javascript">
                    $('#modelprocessid').combogrid({
                        panelWidth: 300,
                        idField: 'id',
                        fitColumns: true,
                        textField: 'process',
                        pagination: false,
                        url: '<?php echo site_url('modelprocess/get_by_modelid/' . $modelid) ?>',
                        columns: [[
                                {field: 'process', title: 'Name', width: 160},
                                {field: 'stock', title: 'Stock', width: 50, align: 'center'}
                            ]],
                        onSelect: function (value, row, index) {
                            $('#model_processid_').val(row.processid);
                            $('#modelprocess_stock_').val(row.stock);
                        }
                    });
                </script>
                <input type="hidden" value="0" name="processid" id='model_processid_' />
                <input type="hidden" value="0" id='modelprocess_stock_' name="stock"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input type="text" class="easyui-numberbox" name="qty" validType="check_value['#modelprocess_stock_']" required="true" size="5" style="text-align: center;"/></td>
        </tr>
    </table>
</form>

<script>

    $.extend($.fn.validatebox.defaults.rules, {
        check_value: {
            validator: function (value, param) {
                return (parseInt(value) <= parseInt($(param[0]).val())) && (parseInt(value) > 0);
            },
            message: 'Out of available stock'
        }
    });
</script>