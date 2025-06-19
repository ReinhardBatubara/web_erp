<form id="solidwood-input" method="post" novalidate>
    <table width="100%" border="0">            
        <tr>
            <td align="right" width="30%"><label class="field_label">Description :</label></td>
            <td width="70%">
                <input type="text" name="description" class="easyui-validatebox" style="width: 270px" required="true" />
            </td>
        </tr>    
        <tr>
            <td align="right" width="30%"><label class="field_label">Material Code :</label></td>
            <td>
                <input type="text" id="solidwoodmaterialitemid" name="itemid" <?php echo $required ?> style="width: 270px"/>
                <script type="text/javascript">
                    $(function() {
                        $('#solidwoodmaterialitemid').combobox({
                            url: '<?php echo site_url('item/get_for_combo') ?>',
                            method: 'post',
                            valueField: 'id',
                            textField: 'code',
                            panelHeight: '200',
                            mode: 'remote',
                            formatter: formatSolidwoodItemFormat,
                            onSelect:function(row){
                                $('#solidwoodmaterialdescription').val(row.description);
                                $('#solidwoodunitcode').combobox('clear');
                                $('#solidwoodunitcode').combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row.id);
                                $('#solidwoodunitcode').combobox('setValue',row.unitcode);
                            }
                        });
                    });
                    function formatSolidwoodItemFormat(row){
                        var s = '<span style="font-weight:bold">' + row.code +'</span><br/>' +
                            '<span style="color:#888;font-size:7.5pt">Desc: ' + row.description + '</span><br/>' +
                            '<span>Unit Code: '+row.unitcode+'</span><br/>';
                        return s;
                    }
                </script>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Material Description :</label></td>
            <td>
                <input name="materialdescription" id="solidwoodmaterialdescription" class="easyui-validatebox" readonly="true" style="width: 270px;">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code :</label></td>
            <td>
                <input id="solidwoodunitcode" name="unitcode" <?php echo $required ?> panelHeight="auto" editable="false" class="easyui-combobox" data-options="valueField:'id',textField:'text',panelHeight:'auto'" style="width: 120px;">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Finished Size :</label></td>
            <td>
                <table width="90%" border="0" style="border-radius: 3px;border-width: 1px;border-collapse: collapse;border-color: #ccccff;" cellpadding="0" cellspacing="0">                        
                    <tr>
                        <td align="center" style="border: 1px solid #ccccff;" width="33%"><b>L</b></td>
                        <td align="center" style="border: 1px solid #ccccff;" width="33%"><b>W</b></td>
                        <td align="center" style="border: 1px solid #ccccff;" width="33%"><b>T</b></td>
                    </tr>
                    <tr>
                        <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" id="swd_finishedsize_l" name="finishedsize_l" precision="2"  style="width: 90%;text-align: center;"/></td>
                        <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" id="swd_finishedsize_w" name="finishedsize_w" precision="2"  style="width: 90%;text-align: center;" /></td>
                        <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" id="swd_finishedsize_t" name="finishedsize_t" precision="2"  style="width: 90%;text-align: center;" /></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input type="text" name="qty" style="text-align: center" class="easyui-numberbox" size="5" value=""/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark :</label></td>
            <td>
                <textarea name="remark" id="remark" class="easyui-validatebox" style="width: 90%;height: 45px"></textarea>
            </td>
        </tr>
    </table>        
</form>