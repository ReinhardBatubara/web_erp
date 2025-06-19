<div id="purchasereturn-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#purchasereturn-button">
    <form id="purchasereturn-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Date : </label></td>
                <td><input type="text" size="15" name="date" class="easyui-datebox" id="date" data-options="formatter:myformatter,parser:myparser" required="true"/></td>
            </tr>   
            <tr>
                <td align="right" width="30%"><label class="field_label">GR No : </label></td>
                <td>
                    <input type="text" name="goodsreceiveid" id="prt_goodsreceiveid" mode="remote" style="width: 150px" required="true"/>
                    <script type="text/javascript">
                        $('#prt_goodsreceiveid').combogrid({
                            panelWidth: 450,
                            idField: 'id',
                            textField: 'number',
                            url: '<?php echo site_url('goodsreceive/get') ?>',
                            columns: [[
                                    {field: 'gr_number', title: 'GR NO', width: 100},
                                    {field: 'gr_date_c_format', title: 'Date', width: 80},
                                    {field: 'po_number', title: 'PO', width: 100},
                                    {field: 'vendor', title: 'Vendor/Suplier', width: 100}
                                ]]
                        });
                    </script>
                </td>
            </tr>
            <tr valign="top">
                <td align="right"><label class="field_label">Remark : </label></td>
                <td>
                    <textarea name="remark" class="easyui-validatebox" style="width: 95%;height: 50px"></textarea>
                </td>
            </tr>            
        </table>        
    </form>
</div>
<div id="purchasereturn-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="purchasereturn_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#purchasereturn-form').dialog('close')">Cancel</a>
</div>