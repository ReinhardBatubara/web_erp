<div id="goodsreceive_edit-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:600px; padding: 5px 5px" closed="true" buttons="#dialog-button">
    <form id="goodsreceive_edit-input" method="post" novalidate onsubmit="return false;">
        <table width="97%" border="0">
            <tr>
                <td width="23%" align="right"><label class="field_label">Number :</label></td>
                <td width="17%"><input type="text" disabled class="easyui-validatebox" id="gr_number" name="gr_number" required="true" size="15"/></td>
                <td width="25%"></td>
                <td width="17%" align="right"><label class="field_label">Date :</label></td>
                <td width="17%"><input type="text" size="15" class="easyui-datebox" required="true" id="gr_edit_date" name="gr_date" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">PO :</label></td>
                <td>
                    <input type="text" size="20" disabled name="po_number" id="gr_purchaseorderid_" required="true"/>
                </td>
                <td>&nbsp;</td>
                <td align="right"><label class="field_label">No SJ :</label></td>
                <td><input type="text" class="easyui-validatebox" id="gr_edit_no_sj" name="no_sj"  required="true" size="20"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Vendor :</label></td>
                <td colspan="2"><input type="text" disabled class="easyui-validatebox" size="30" name="vendor" readonly id="po_vendor_"/></td>                
                <td align="right"><label class="field_label">Checked By :</label></td>
                <td>
                    <input type="text" name="checked_by" id="gr_edit_checked_by" mode="remote" style="width: 150px" required="true"/>
                    <script type="text/javascript">
                        $('#gr_edit_checked_by').combogrid({
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
                <td colspan="4">
                    <textarea id="gr_edit_remark" style="width: 100%;height: 50px;" name="remark"></textarea>
                </td>
            </tr>
        </table>        
    </form>
</div>
<div id="dialog-button">
   <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="$('#list_item_receive').datagrid('endEdit', lastIndex);
        goodsreceive_update()">Update</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#goodsreceive_edit-form').dialog('close')">Cancel</a>
</div>