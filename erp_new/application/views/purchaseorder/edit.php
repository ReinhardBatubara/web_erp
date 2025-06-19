<div id="purchaseorder_edit-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:450px; padding: 5px 5px" closed="true" buttons="#purchaseorder_edit-button">
    <form id="purchaseorder_edit-input" method="post" novalidate class="table_form">
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Date : </label></td>
                <td><input type="text" name="date" class="easyui-datebox" size="12" required="true" value="" style="text-align: center" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Terms : </label></td>
                <td>
                    <select class="easyui-combobox" name="terms" panelHeight="auto" editable="false">
                        <option value="Cash">Cash</option>
                        <option value="COD">COD</option>
                        <option value="7 days">7 days</option>
                        <option value="14 days">14 days</option>
                        <option value="30 days">30 days</option>
                    </select>
            </tr>            
            <tr>
                <td align="right"><label class="field_label">FOB : </label></td>
                <td><input type="text" name="fob" class="easyui-validatebox" size="12" value="" style="text-align: center"/></td>
            </tr>
            <tr valign="top">
                <td align="right"><label class="field_label">Ship To : </label></td>
                <td>
                    <textarea name="shipto" id="po_shipto" class="easyui-validatebox" style="width: 220px;height: 70px"><?php echo 'sas' ?></textarea>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Ship Via : </label></td>
                <td>
                    <select class="easyui-combobox" name="ship_via" panelHeight="auto" editable="false">
                        <option value="LAND">LAND</option>
                        <option value="SEA">SEA</option>
                        <option value="AIR">AIR</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Delivery Date : </label></td>
                <td><input type="text" name="expected_date" class="easyui-datebox" size="15" value="" style="text-align: center" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Vendor is Taxable : </label></td>
                <td>
                    <select class="easyui-combobox" name="vendor_is_taxable" editable="false" panelHeight="auto">
                        <option value="TRUE">YES</option>
                        <option value="FALSE">NO</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Rate : </label></td>
                <td><input unit="text" name="rate" style="text-align: right" class="easyui-numberbox" value="" precision="2"/></td>
            </tr>

            <tr valign="top">
                <td align="right"><label class="field_label">Description : </label></td>
                <td>
                    <textarea name="description" class="easyui-validatebox" style="width: 250px;height: 60px"></textarea>
                </td>
            </tr>         
        </table>        
    </form>
</div>
<div id="purchaseorder_edit-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="purchaseorder_update()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#purchaseorder_edit-form').dialog('close')">Cancel</a>
</div>