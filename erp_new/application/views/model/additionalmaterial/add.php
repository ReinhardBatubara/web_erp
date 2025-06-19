<form id="additionalmaterial-input" method="post" novalidate>
    <table width="100%" border="0">            
        <tr>
            <td align="right" width="30%"><label class="field_label">Description :</label></td>
            <td width="70%">
                <input type="text" name="description" class="easyui-validatebox" style="width: 270px" required="true" />
            </td>
        </tr>    
        <tr>
            <td align="right"><label class="field_label">Material :</label></td>
            <td>
                <input type="text" id="additionalmaterialitemid" name="itemid" required style="width: 270px"/>
                <script type="text/javascript">
                    $(function() {
                        $('#additionalmaterialitemid').combobox({
                            url: '<?php echo site_url('item/get_for_combo') ?>',
                            method: 'post',
                            valueField: 'id',
                            textField: 'code',
                            panelHeight: '200',
                            mode: 'remote',
                            formatter: additionalmaterialItemFormat,
                            onSelect:function(row){
                                $('#additionalmaterialmaterialdescription').val(row.description);
                                $('#additionalmaterialunitcode').combobox('clear');
                                $('#additionalmaterialunitcode').combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row.id);
                                $('#additionalmaterialunitcode').combobox('setValue',row.unitcode);
                            }
                        });
                    });
                    function additionalmaterialItemFormat(row){
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
                <input name="materialdescription" id="additionalmaterialmaterialdescription" class="easyui-validatebox" readonly="true" style="width: 270px;">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code :</label></td>
            <td>
                <input id="additionalmaterialunitcode" name="unitcode" class="easyui-combobox" panelHeight="auto" editable="false" data-options="valueField:'id',textField:'text'" required="true" style="width: 80px;">
            </td>
        </tr>            
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input type="text" name="qty" style="text-align: center" class="easyui-numberbox" size="5" value=""/></td>
        </tr>
    </table>        
</form>
