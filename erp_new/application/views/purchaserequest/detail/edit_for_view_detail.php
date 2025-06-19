<div id="purchaserequestdetail_vd-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:450px; padding: 5px 5px" closed="true" buttons="#purchaserequestdetail_vd-button">
    <form id="purchaserequestdetail_vd-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Item Code : </label></td>
                <td>
                    <input type="hidden" id="pr_itemid" required="true" name="itemid" class="easyui-validatebox"/>
                    <input purchaserequestdetail="text" name="code" id="pr_code" class="easyui-validatebox" required="true" value="" readonly/>
                    <a href="javascript:void(0)" class="button" onclick="item_dialogsearch('pr_itemid', 'pr_code', 'pr_description', 'pr_unitcode')">Select</a>
                </td>
            </tr>            
            <tr>
                <td align="right"><label class="field_label">Description : </label></td>
                <td>
                    <textarea name="description" 
                              id="pr_description" 
                              class="easyui-validatebox" 
                              style="width: 90%;height: 40px"></textarea>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Unit Code : </label></td>
                <td>
                    <input id="pr_unitcode" 
                           name="unitcode" 
                           class="easyui-combobox" 
                           data-options="valueField:'id',textField:'text'" 
                           required="true" 
                           panelHeight="auto" 
                           style="width: 80px;"
                           editable="false">
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Qty : </label></td>
                <td><input unit="text" name="qty" style="text-align: center" class="easyui-numberbox" size="5" required="true" value=""/></td>
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
<div id="purchaserequestdetail_vd-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="purchaserequestdetail_update_for_view_detail()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#purchaserequestdetail_vd-form').dialog('close')">Cancel</a>
</div>