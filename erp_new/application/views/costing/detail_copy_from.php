<form id="detail_copy_from" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="25%"><label class="field_label">Model :</label></td>
            <td>
                <input type="hidden" name="modelid" value="<?php echo $modelid ?>" />
                <input type="hidden" name="to_costingid" value="<?php echo $costingid ?>" />
                <input type="text" style="width: 200px" name="from_costingid" id="detail_copy_from_costingid" required="true"/>
                <script>
                    $('#detail_copy_from_costingid').combogrid({
                        panelWidth: 450,
                        idField: 'id',
                        mode: 'remote',
                        textField: 'code',
                        url: '<?php echo site_url('costing/get_not_id/' . $costingid) ?>',
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
        <tr>
            <td align="right"><label class="field_label">Category :</label></td>
            <td>
                <select class="easyui-combobox" name="categoryid" required="true" panelHeight="auto" editable="false" style="width: 200px">
                    <option value="0">All</option>
                    <?php
                    foreach ($costingmaterialgroup as $result) {
                        ?>
                        <option value="<?php echo $result->id ?>"><?php echo $result->name ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
</form>
