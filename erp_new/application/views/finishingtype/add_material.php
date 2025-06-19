<form id="finishingtype_material-input" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">Item Code : </label></td>
            <td>
                <input type="text" id="finishingtype_material_itemid" required="true" name="itemid" style="width: 180px"/>
                <script type="text/javascript">
                    $(function() {
                        $('#finishingtype_material_itemid').combobox({
                            url: '<?php echo site_url('item/get_for_combo') ?>',
                            method: 'post',
                            valueField: 'id',
                            textField: 'code',
                            panelHeight: '200',
                            mode: 'remote',
                            panelWidth:'250',
                            formatter: formatFinishingTypeAddItemFormat,
                            onSelect:function(row){
                                $('#finishingtype_material_description').val(row.description);
                                $('#finishingtype_material_unitcode').combobox('clear');
                                $('#finishingtype_material_unitcode').combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row.id);
                                $('#finishingtype_material_unitcode').combobox('setValue',row.unitcode);
                            }
                        });
                    });
                    function formatFinishingTypeAddItemFormat(row){
                        var s = '<span style="font-weight:bold">' + row.code +'</span><br/>' +
                            '<span style="color:#888;font-size:7.5pt">Desc: ' + row.description + '</span><br/>' +
                            '<span>Unit Code: '+row.unitcode+'</span><br/>';
                        return s;
                    }
                </script>
            </td>
        </tr>            
        <tr>
            <td align="right"><label class="field_label">Description : </label></td>
            <td>
                <textarea name="itemdescription" readonly id="finishingtype_material_description" class="easyui-validatebox" style="width: 90%;height: 40px"></textarea>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code : </label></td>
            <td>
                <input id="finishingtype_material_unitcode" name="unitcode" class="easyui-combobox" panelHeight="auto" editable="false" data-options="valueField:'id',textField:'text'" required="true" style="width: 100px;">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input unit="text" precision="4" name="qty" style="text-align: center;width: 100px" class="easyui-numberbox" required="true" value=""/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark : </label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width: 90%;height: 40px"></textarea>
            </td>
        </tr>
    </table>      
</form>