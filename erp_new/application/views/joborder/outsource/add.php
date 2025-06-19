<div id="joborder_outsource-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#joborder_outsource-button">
    <form id="joborder_outsource-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Item :</label></td>
                <td width="70%">
                    <input type="text" size="20" name="joborderitemid" id="joborderitemid" required="true" style="width:250px;"/>
                    <input type="hidden" id="jo_item_qty" />
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Qty :</label></td>
                <td>
                    <input type="text" 
                           class="easyui-numberbox" 
                           name="qty" 
                           required="true" 
                           style="text-align: center" 
                           size="5"
                           />
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Type :</label></td>
                <td>
                    <select name="type" id="jo_outsource_type" class="easyui-combobox" panelHeight="auto" editable="false" required="true" style="width: 250px">
                        <option></option>
                        <option value="1">Spare part</option>
                        <option value="2">Partial</option>
                        <option value="3">Full</option>
                    </select>
                    <script>
                        $('#jo_outsource_type').combobox({
                            onChange:function(newValue, oldValue){
                                if(newValue == '' || newValue == '3'){
                                    $('#jo_include_material').combobox('clear')
                                    $('#jo_include_material').combobox('disable')
                                }else{
                                    $('#jo_include_material').combobox('setValue','true');
                                    $('#jo_include_material').combobox('enable')
                                }
                            }
                        })
                    </script>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Include Material :</label></td>
                <td>
                    <select name="include_material" disabled="true" panelHeight="auto" id="jo_include_material" class="easyui-combobox" editable="false" style="width: 100px">
                        <option value="true">Yes</option>
                        <option value="false">No</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Vendor :</label></td>
                <td>
                    <input id="vendorid" 
                           name="vendorid" 
                           class="easyui-combobox" 
                           data-options="
                           valueField: 'id',
                           textField: 'text',
                           url: '<?php echo site_url('vendor/get_remote_data') ?>'" 
                           mode="remote"
                           required="true"
                           style="width: 250px" />
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="joborder_outsource-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="joborder_outsource_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#joborder_outsource-form').dialog('close')">Cancel</a>
</div>  