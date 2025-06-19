<form id="carvingpricelist_form" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="100"><label class="field_label">Model :</label></td>
            <td width="300">
                <input type="text" size="20" name="modelid" id="modelid" required="true" style="width: 290px"/>
                <script>
                    $('#modelid').combogrid({
                        panelWidth: 450,
                        idField: 'id',
                        mode: 'remote',
                        textField: 'name',
                        url: '<?php echo site_url('model/get_open') ?>',
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
            <td align="right"><label class="field_label">Price :</label></td>
            <td><input type="text" name="price" class="easyui-numberbox" precision="2" groupSeparator="," required="true" value="" style="width: 180px;text-align: right"/></td></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Date Approved: </label></td>
            <td><input type="tex" class="easyui-datebox" name="date_approve" id="carv_price_list_date_approve" size="13" required="true" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>
            <td align="right" width="40%"><label class="field_label">Approved By : </label></td>
            <td>
                <input type="text" name="approved_by" id="carv_price_list_approved_by" mode="remote" style="width: 150px" required="true"/>
                <script type="text/javascript">
                    $('#carv_price_list_approved_by').combogrid({
                        panelWidth: 450,
                        idField: 'id',
                        textField: 'name',
                        url: '<?php echo site_url('employee/get_remote_data') ?>',
                        columns: [[
                                {field: 'id', title: 'ID', width: 60},
                                {field: 'name', title: 'Name', width: 100},
                                {field: 'department', title: 'Department', width: 100},
                                {field: 'jobtitle', title: 'Job Title', width: 100}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark :</label></td>
            <td><textarea type="tex" class="easyui-validatebox" name="remark" style="width: 290px;height: 40px"></textarea></td>
        </tr>
    </table>        
</form>