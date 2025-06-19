<div id="productionreturndetail-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:450px; padding: 5px 5px" closed="true" buttons="#productionreturndetail-button">
    <form id="productionreturndetail-input" method="post" novalidate class="table_form">
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Item Code : </label></td>
                <td>
                    <input type="hidden" id="productionreturndetail_itemid" required="true" name="itemid" class="easyui-validatebox"/>
                    <input type="text" name="itemcode" id="productionreturndetail_code" class="easyui-validatebox" required="true" value="" readonly/>
                    <a href="javascript:void(0)" class="button" onclick="item_dialogsearch('productionreturndetail_itemid', 'productionreturndetail_code', 'productionreturndetail_description', 'productionreturndetail_unitcode', 'productionreturndetail_warehouseid')">Select</a>
                </td>
            </tr>            
            <tr>
                <td align="right"><label class="field_label">Description : </label></td>
                <td>
                    <textarea name="itemdescription" readonly id="productionreturndetail_description" class="easyui-validatebox" style="width: 90%;height: 40px"></textarea>
                </td>
            </tr>
            <?php if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') { ?>
                <tr>
                    <td align="right"><label class="field_label">Store To : </label></td>
                    <td>
                        <input type="text"
                               name="warehouseid" 
                               id="productionreturndetail_warehouseid" 
                               class="easyui-combobox" 
                               data-options="
                               valueField: 'id',
                               textField: 'text'
                               " 
                               style="width: 80px" 
                               panelHeight="auto"
                               required="true" >
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td align="right"><label class="field_label">Unit Code : </label></td>
                <td>
                    <input id="productionreturndetail_unitcode" name="unitcode"  class="easyui-combobox" panelHeight="auto" editable="false" data-options="valueField:'id',textField:'text'" required="true" style="width: 80px;">
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Qty :</label></td>
                <td><input name="qty" style="text-align: center" precision="4" decimalSeparator="." class="easyui-numberbox" size="5" required="true" value=""/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Return Type :</label></td>
                <td>
                    <select name="returntype" class="easyui-combobox" panelHeight="auto">
                        <option value="Increase Stock">Increase Stock</option>
                        <option value="Reject">Reject</option>
                    </select>
                </td>
            </tr>
        </table>      
    </form>
</div>
<div id="productionreturndetail-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="productionreturndetail_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#productionreturndetail-form').dialog('close')">Cancel</a>
</div>