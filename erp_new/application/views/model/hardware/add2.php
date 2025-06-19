<form id="hardware-input2" method="post" novalidate>
    <table width="100%" border="0">            
        <tr>
            <td align="right" width="30%" ><label class="field_label">Description :</label></td>
            <td width='70%'>
                <input type="text" name="description" class="easyui-validatebox" style="width: 270px" required="true" />
            </td>
        </tr>            
        <tr>
            <td align="right"><label class="field_label">Material Description :</label></td>
            <td>
                <textarea name="materialdescription" id="hardwarematerialdescription" class="easyui-validatebox" style="width: 90%;height: 40px"></textarea>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Size :</label></td>
            <td>
                <table width="80%" border="0" style="border-width: 1px;border-collapse: collapse;border-color: #ccccff;" cellpadding="0" cellspacing="0">                        
                    <tr>
                        <td align="center" style="border: 1px solid #ccccff;" width="33%"><b>L</b></td>
                        <td align="center" style="border: 1px solid #ccccff;" width="33%"><b>W</b></td>
                        <td align="center" style="border: 1px solid #ccccff;" width="33%"><b>T</b></td>
                    </tr>
                    <tr>
                        <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="size_l" precision="0"  style="width: 80%;text-align: center;"/></td>
                        <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="size_w" precision="0"  style="width: 80%;text-align: center;" /></td>
                        <td align="center" style="border: 1px solid #ccccff;padding: 2px;"><input type="text" class="easyui-numberbox" name="size_t" precision="0"  style="width: 80%;text-align: center;" /></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Unit Code :</td>
            <td>
                <input class="easyui-combobox"
                       url='<?php echo site_url('unit/get') ?>'
                       method= "post"
                       name="unitcode"
                       valueField='code'
                       textField='name'
                       panelHeight='200'
                       required="true">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Qty :</label></td>
            <td><input type="text" name="qty" style="text-align: center" class="easyui-numberbox" precision='3' size="10" value=""/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Total Qty :</label></td>
            <td><input type="text" name="total_qty" style="text-align: center" class="easyui-numberbox" precision="4" size="10" value=""/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark :</label></td>
            <td><textarea style="width: 90%;height: 40px" id='remark' name='remark'></textarea></td>
        </tr>
    </table>        
</form>
