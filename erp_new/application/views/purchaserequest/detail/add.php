<div id="purchaserequestdetail-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:450px; padding: 5px 5px" closed="true" buttons="#purchaserequestdetail-button">
    <form id="purchaserequestdetail-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td width="28%"><label class="field_label">Item Code</label></td>
                <td width="1%" align="center"><label class="field_label">:</label></td>
                <td width="71%">
                    <input type="text" id="pr_itemid" required="true" name="itemid" style="width: 300px"/>
                    <script type="text/javascript">
                        $(function() {
                            $('#pr_itemid').combobox({
                                url: '<?php echo site_url('item/get_for_combo') ?>',
                                method: 'post',
                                valueField: 'id',
                                textField: 'code',
                                panelHeight: '200',
                                mode: 'remote',
                                formatter: formatPurchaseRequestAddItemFormat,
                                onSelect:function(row){
                                    $('#pr_description').val(row.description);                                 
                                    $('#pr_unitcode').combobox('clear');
                                    $('#pr_unitcode').combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row.id);
                                    $('#pr_unitcode').combobox('setValue',row.unitcode);
                                }
                            });
                        });
                        function formatPurchaseRequestAddItemFormat(row){
                            var s = '<span style="font-weight:bold">' + row.code +'</span><br/>' +
                                '<span style="color:#888;font-size:7.5pt">Desc: ' + row.description + '</span><br/>' +
                                '<span>Unit Code: '+row.unitcode+'</span><br/>';
                            return s;
                        }
                    </script>
                </td>
            </tr>            
            <tr>
                <td><label class="field_label">Item Description</label></td>
                <td align="center"><label class="field_label">:</label></td>
                <td>
                    <textarea name="description" 
                              id="pr_description" 
                              class="easyui-validatebox" 
                              style="width: 300px;height: 40px"></textarea>
                </td>
            </tr>
            <tr>
                <td><label class="field_label">Unit Code</label></td>
                <td align="center"><label class="field_label">:</label></td>
                <td>
                    <input id="pr_unitcode" 
                           name="unitcode" 
                           class="easyui-combobox" 
                           data-options="valueField:'id',textField:'text'" 
                           required="true" 
                           panelHeight="auto" 
                           style="width: 150px;"
                           editable="false">
                </td>
            </tr>
            <tr>
                <td><label class="field_label">Qty</label></td>
                <td align="center"><label class="field_label">:</label></td>
                <td><input unit="text" name="qty" style="text-align: center;width: 100px" class="easyui-numberbox" required="true" value="" precision="4"/></td>
            </tr>
<!--            <tr>
                <td align="right"><label class="field_label">Unit Price : </label></td>
                <td><input unit="text" name="price" style="text-align: right" class="easyui-numberbox" required="true" value="" precision="2"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Tax : </label></td>
                <td><input unit="text" name="tax" style="text-align: right" class="easyui-numberbox" required="true" value="" precision="2"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Discount : </label></td>
                <td><input unit="text" name="discount" style="text-align: right" class="easyui-numberbox" value="" precision="2"/></td>
            </tr>-->
        </table>       
    </form>
</div>
<div id="purchaserequestdetail-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="purchaserequestdetail_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#purchaserequestdetail-form').dialog('close')">Cancel</a>
</div>