<div id="vendor-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:600px; padding: 5px 5px" closed="true" buttons="#vendor-button">
    <form id="vendor-input" method="post" novalidate class="table_form">
        <table width="100%" border="0">
            <tr valign="top">
                <td width="50%">
                    <table width="100%">
                        <tr>
                            <td width="40%" align="right"><label class="field_label">Code : </span></td>
                            <td><input size='8' type='text' name='code' id='code' value="" class="easyui-validatebox" required="true"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="field_label">Name : </span></td>
                            <td><input size='25' type='text' name='name' id='name' class="easyui-validatebox"  required="true"/></td>
                        </tr>   
                        <tr>
                            <td align="right"><label class="field_label">Currency : </label></td>
                            <td>
                                <select class="easyui-combobox" name='currency' editable="false" required='true' panelHeight="50" style="width: 100px">
                                    <option></option>
                                    <?php
                                    foreach ($currency as $result) {
                                        echo "<option value='" . $result->code . "'>" . $result->code . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="field_label">Contact : </span></td>
                            <td><input size='25' type='text' name='contact' id='contact' class="easyui-validatebox"  /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="field_label">Phone : </span></td>
                            <td><input type='text' name='phone' id='phone' class="easyui-validatebox"  /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="field_label">Fax : </span></td>
                            <td><input type='text' name='fax' id='fax' class="easyui-validatebox"  /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="field_label">Email : </span></td>
                            <td><input size='25' type='text' name='email' id='email' /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="field_label">Address : </span></td>
                            <td><textarea style="width: 100%;height: 50px" name='address1' id="address1" class="easyui-validatebox" ></textarea></td>
                        </tr>                 
                    </table>
                </td>
                <td width="50%" valign="top">
                    <table width="100%">
                        <tr>
                            <td align="right"><label class="field_label">Taxable : </label></td>
                            <td>
                                <select class="easyui-combobox" name="taxable" panelHeight="auto" editable="false">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><label class="field_label">Payment Terms : </label></td>
                            <td>
                                <select class="easyui-combobox" name="payment_terms" panelHeight="auto" editable="false">
                                    <option value="Cash">Cash</option>
                                    <option value="COD">COD</option>
                                    <option value="7 days">7 days</option>
                                    <option value="14 days">14 days</option>
                                    <option value="30 days">30 days</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%" align="right"><span class="field_label">City : </span></span></td>
                            <td><input type='text' name='city' id='city'  class="easyui-validatebox" /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="field_label">State : </span></td>
                            <td><input type='text' name='state' id='state'  class="easyui-validatebox"  /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="field_label">Zip code : </span></td>
                            <td><input type='text' name='zipcode' id='zipcode' class="easyui-validatebox"  /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="field_label">Country : </span></td>
                            <td><input type='country' name='country' id='country' class="easyui-validatebox"  /></td>
                        </tr>							
                        <tr>
                            <td align="right"><span class="field_label">Service : </span></td>
                            <td><textarea style="width: 100%;height: 35px" name='service' id="service"  class="easyui-validatebox" ></textarea></td>
                        </tr>                  
                        <tr>
                            <td align="right"><span class="field_label">Join Date : </span></td>
                            <td><input type='text' name='joindate' id='joindate' size="10" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="field_label">End Date : </span></td>
                            <td><input type='text' name='enddate' id='enddate' size="10"  class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/></td>
                        </tr>                        
                    </table>
                </td>
            </tr>         
        </table>
    </form>
</div>
<div id="vendor-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="vendor_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#vendor-form').dialog('close')">Cancel</a>
</div>