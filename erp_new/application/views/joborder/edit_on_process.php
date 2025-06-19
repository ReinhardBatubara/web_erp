<form id="joborder_edit_on_process-form" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Process :</label></td>
            <td width="70%">
                <input type="hidden" value="<?php echo $id ?>" name="id" />
                <input type="hidden" value="<?php echo $joborderitemprocess->joborderitemid ?>" name="joborderitemid" />
                <input type="hidden" value="<?php echo $modelid ?>" name="modelid" />
                <input type="text" name="modelprocessid" id="modelprocessid" mode="remote" style="width: 150px" required="true"/>
                <script type="text/javascript">
                    $('#modelprocessid').combogrid({
                        panelWidth: 300,
                        idField: 'id',
                        fitColumns: true,
                        textField: 'process',
                        pagination: true,
                        url: '<?php echo site_url('modelprocess/get_by_modelid/' . $modelid) ?>',
                        columns: [[
                                {field: 'process', title: 'Name', width: 160},
                                {field: 'stock', title: 'Stock', width: 50, align: 'center'}
                            ]],
                        onSelect: function (value, row, index) {
                            $('#model_processid_e').val(row.processid);
                            $('#modelprocess_stock_e').val(row.stock);
                        }
                    });
                    $('#modelprocessid').combogrid('setValue',<?php echo $joborderitemprocess->modelprocessid ?>);
                    $.extend($.fn.validatebox.defaults.rules, {
                        check_value: {
                            validator: function (value, param) {
                                return (parseInt(value) <= parseInt($(param[0]).val())) && (parseInt(value) > 0);
                            },
                            message: 'Not allowed negative number and ensure the stock enough'
                        }
                    });
                </script>
                <input type="hidden" value="<?php echo $joborderitemprocess->processid ?>" name="processid" id='model_processid_e' />
                <input type="hidden" value="<?php echo ($joborderitemprocess->qty + $joborderitemprocess->stock) ?>" id='modelprocess_stock_e' name="stock"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input type="text" class="easyui-numberbox" value="<?php echo $joborderitemprocess->qty ?>" name="qty" validType="check_value['#modelprocess_stock_e']" required="true" size="5" style="text-align: center;"/></td>
        </tr>
    </table>
</form>