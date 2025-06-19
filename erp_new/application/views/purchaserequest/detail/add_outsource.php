<form id="purchaserequestdetail_outsource-form" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right"><label class="field_label">Model :</label></td>
            <td>
                <input type="text" id="pr_modelid" name="modelid" style="width: 200px" required="true"/>
                <script type="text/javascript">
                    $('#pr_modelid').combogrid({
                        panelWidth: 300,
                        idField: 'id',
                        fitColumns: true,
                        textField: 'code',
                        pagination: true,
                        url: '<?php echo site_url('model/get_ready') ?>',
                        columns: [[
                                {field: 'code', title: 'Item Code', width: 100},
                                {field: 'name', title: 'Item Description', width: 200, halign: 'center'}
                            ]]
                    });
                </script>
            </td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">Process :</label></td>
            <td width="70%">  
                <select name="outsource_type" id="po_outsource_type" class="easyui-combobox" style="width: 200px" panelHeight="auto" editable="false" required="true">
                    <option></option>
                    <option value="1">Spare part</option>
                    <option value="2">Partial</option>
                    <option value="3">Full</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Description :</label></td>
            <td><textarea style="width: 90%;height: 40px;" name="description" class="easyui-validatebox" required="true"></textarea></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input type="text" class="easyui-numberbox" name="qty" required="true" size="5" style="text-align: center;"/></td>
        </tr>
    </table>
</form>