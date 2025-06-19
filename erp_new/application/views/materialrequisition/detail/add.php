<form id="materialrequisitiondetail-input" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right" width="25%"><label class="field_label">Item Code : </label></td>
            <td width="75%">
                <input type="text" id="mrdetail_itemid50" required="true" name="itemid" style="width: 300px"/>
                <script type="text/javascript">
                    $(function() {
                        $('#mrdetail_itemid50').combobox({
                            url: '<?php echo site_url('item/get_for_combo') ?>',
                            method: 'post',
                            valueField: 'id',
                            textField: 'code',
                            panelHeight: '200',
                            mode: 'remote',
                            panelWidth:'250',
                            formatter: formatMRDetailAddItemFormat,
                            onSelect:function(row){
                                $('#mrdetail_description').val(row.description);                                
                                $('#mrdetail_unitcode').combobox('clear');
                                $('#mrdetail_unitcode').combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row.id);
                                $('#mrdetail_unitcode').combobox('setValue',row.unitcode);
                            }
                        });
                    });
                    function formatMRDetailAddItemFormat(row){
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
                <textarea name="itemdescription" readonly id="mrdetail_description" class="easyui-validatebox" style="width: 300px;height: 40px"></textarea>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code : </label></td>
            <td>
                <input id="mrdetail_unitcode" name="unitcode" class="easyui-combobox" panelHeight="auto" editable="false" data-options="valueField:'id',textField:'text'" required="true" style="width: 80px;">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input unit="text" name="qty" style="text-align: center" class="easyui-numberbox" size="15" precision="4" required="true" value=""/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Required For  :</label></td>
            <td>
                <textarea class="easyui-validatebox" style="width: 300px;height: 40px" name="requiredfor"></textarea>
            </td>
        </tr>
    </table>       
</form>