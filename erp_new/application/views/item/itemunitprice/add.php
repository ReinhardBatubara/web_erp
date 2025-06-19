<div id="itemunitprice-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#dialog-button">
    <form id="itemunitprice-input" method="post" novalidate>
        <table width="100%" border="0">
            <tr>
                <td align="right" width="40%"><label class="field_label">Unit :</label></td>
                <td>
                    <input class="easyui-combobox" name="unitcode" data-options="
                           url: '<?php echo site_url('unit/get') ?>',
                           method: 'post',
                           valueField: 'code',
                           textField: 'code',
                           panelHeight: '200',
                           mode:'remote'" 
                           required="true">
                </td>
            </tr>
<!--            <tr>
                <td align="right"><label class="field_label">Original Price :</label></td>
                <td><input type="tex" name="originalprice" id="originalprice" size="15" style="text-align: right;" class="easyui-numberbox" precision="2"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Sell/Costing Price :</label></td>
                <td><input type="tex" name="sellprice" id="sellprice" size="15" style="text-align: right;" class="easyui-numberbox" precision="2"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Currency :</label></td>
                <td>                                
                    <select name="currency" class="easyui-combobox" required="true">
            <?php
            foreach ($currency as $result) {
                echo "<option value='$result->code'>$result->code</option>";
            }
            ?>
                    </select>
                </td>
            </tr>-->
            <tr>
                <td align="right"><label class="field_label">Rate :</label></td>
                <td><input type="text" name="rate" id="iup_rate" size="7" style="text-align: center;" class="easyui-numberbox" precision="5"/></td>
            </tr>
        </table>
    </form>
</div>
<div id="dialog-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="itemunitprice_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#itemunitprice-form').dialog('close')">Cancel</a>
</div>