<div id="purchaseorder-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:450px; padding: 5px 5px" closed="true" buttons="#purchaseorder-button">
    <form id="purchaseorder-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">PO Number :</label></td>
                <td>
                    <input type="text" name="po_number" class="easyui-validatebox" size="12" required="true" value="" style="text-align: center"/>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Date :</label></td>
                <td><input type="text" name="po_date" class="easyui-datebox" size="15" required="true" value="" style="text-align: center" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Terms :</label></td>
                <td><input type="text" name="terms" class="easyui-validatebox" size="12" value="" style="text-align: center"/></td>
            </tr>            
            <tr>
                <td align="right"><label class="field_label">FOB :</label></td>
                <td><input type="text" name="fob" class="easyui-validatebox" size="12" value="" style="text-align: center"/></td>
            </tr>
            <tr valign="top">
                <td align="right"><label class="field_label">Ship To :</label></td>
                <td>
                    <textarea name="shipto" id="po_shipto" class="easyui-validatebox" style="width: 220px;height: 70px"><?php echo 'sas' ?></textarea>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Ship Via :</label></td>
                <td>
                    <select class="easyui-combobox" name="ship_via">
                        <option value="LAND">LAND</option>
                        <option value="SEA">SEA</option>
                        <option value="AIR">AIR</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Expected Date :</label></td>
                <td><input type="text" name="expected_date" class="easyui-datebox" size="15" value="" style="text-align: center" data-options="formatter:myformatter,parser:myparser"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Vendor is Taxable:</label></td>
                <td>
                    <select class="easyui-combobox" name="vendor_is_taxable">
                        <option value="TRUE">YES</option>
                        <option value="FALSE">NO</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Rate :</label></td>
                <td><input unit="text" name="rate" style="text-align: right" class="easyui-numberbox" required="true" value="" precision="2"/></td>
            </tr>

            <tr valign="top">
                <td align="right"><label class="field_label">Description :</label></td>
                <td>
                    <textarea name="description" class="easyui-validatebox" style="width: 250px;height: 60px"></textarea>
                </td>
            </tr>         
        </table>        
    </form>
</div>
<div id="purchaseorder-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="purchaseorder_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#purchaseorder-form').dialog('close')">Cancel</a>
</div>