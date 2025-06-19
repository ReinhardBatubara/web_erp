<form id="costing_set_to_model-input" method="post" novalidate enctype="multipart/form-data">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="40%"><label class="field_label">Date  :</label></td>
            <td><input type="tex" class="easyui-datebox" name="date" id="set_to_model_date" size="13" required="true" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Costing for Model :</label></td>
            <td>
                <input type="hidden" name="costingid" id="set_to_model_costing_id"/>
                <input type="text" size="20" name="modelid" id="set_to_model_modelid" required="true"/>
                <script>
                    $('#set_to_model_modelid').combogrid({
                        panelWidth: 450,
                        idField: 'id',
                        mode: 'remote',
                        textField: 'name',
                        url: '<?php echo site_url('model/get_available_for_costing') ?>',
                        columns: [[
                                {field: 'id', hidden: true, rowspan: 2},
                                {field: 'code', title: 'Item Code', width: 100, rowspan: 2},
                                {field: 'name', title: 'Item Name', width: 100, rowspan: 2},
                                {title: 'Item Size', width: 100, colspan: 3},
                                {title: 'Packing size', width: 100, colspan: 3}
                            ], [
                                {field: 'itemsize_mm_w', title: 'W', width: 50, align: 'center'},
                                {field: 'itemsize_mm_d', title: 'D', width: 50, align: 'center'},
                                {field: 'itemsize_mm_h', title: 'H', width: 50, align: 'center'},
                                {field: 'packagingsize_mm_w', title: 'W', width: 50, align: 'center'},
                                {field: 'packagingsize_mm_d', title: 'D', width: 50, align: 'center'},
                                {field: 'packagingsize_mm_h', title: 'H', width: 50, align: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
    </table>        
</form>