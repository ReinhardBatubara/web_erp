<div id="materialtrash-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:460px; padding: 2px 2px" closed="true" buttons="#materialtrash-button">
    <form id="materialtrash-input" method="post" novalidate class="table_form" style="padding: 2px">
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Date : </label></td>
                <td width="70%"><input type="text" size="13" class="easyui-datebox" name="date" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Item Code:</label></td>
                <td>
                    <input type="text" id="materialtrashitemid" required="true" name="itemid" style="width: 180px"/>
                    <script type="text/javascript">
                        $(function () {
                            $('#materialtrashitemid').combobox({
                                url: '<?php echo site_url('item/get_for_combo') ?>',
                                method: 'post',
                                valueField: 'id',
                                textField: 'code',
                                panelHeight: '200',
                                mode: 'remote',
                                panelWidth: '250',
                                formatter: materialScrapItemFormat,
                                onSelect: function (row) {
                                    $('#materialtrashdescription').val(row.description);
                                    $('#materialtrashunitcode').combobox('clear');
                                    $('#materialtrashunitcode').combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row.id);
                                    $('#materialtrashunitcode').combobox('setValue', row.unitcode);
                                }
                            });
                        });
                        function materialScrapItemFormat(row) {
                            var s = '<span style="font-weight:bold">' + row.code + '</span><br/>' +
                                    '<span style="color:#888;font-size:7.5pt">Desc: ' + row.description + '</span><br/>' +
                                    '<span>Unit Code: ' + row.unitcode + '</span><br/>';
                            return s;
                        }
                    </script>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Item Description :</label></td>
                <td>
                    <input name="materialdescription" id="materialtrashdescription" class="easyui-validatebox" readonly="true" style="width: 270px;">
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Unit Code :</label></td>
                <td>
                    <input id="materialtrashunitcode" name="unitcode" class="easyui-combobox" panelHeight="auto" editable="false" data-options="valueField:'id',textField:'text'" required="true" style="width: 80px;">
                </td>
            </tr>            
            <tr>
                <td align="right"><label class="field_label">Qty :</label></td>
                <td><input type="text" name="qty" style="text-align: center" precision="4" decimalSeparator="." class="easyui-numberbox" size="5" value=""/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Remark :</label></td>
                <td>
                    <textarea name="remark" class="easyui-validatebox" style="width: 90%;height: 45px"></textarea>
                </td>
            </tr>
        </table>       
    </form>
</div>
<div id="materialtrash-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="materialtrash_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#materialtrash-form').dialog('close')">Cancel</a>
</div>