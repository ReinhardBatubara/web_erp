<form id="purchaserequest_by_item_search-form" method="post" novalidate onsubmit="return false;">
    <table width="100%" border="0">        
        <tr>
            <td align="right"><label class="field_label">PR No# : </label></td>
            <td>
                <input type="text" 
                       size="12" 
                       name="pr_number" 
                       class="easyui-validatebox" 
                       onkeypress="if (event.keyCode === 13) {purchaserequest_by_item_search();}"
                       />
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">MR No# : </label></td>
            <td>
                <input type="text" 
                       size="12" 
                       name="mr_number" 
                       class="easyui-validatebox" 
                       onkeypress="if (event.keyCode === 13) {purchaserequest_by_item_search();}"
                       />
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Date From :</label></td>
            <td>
                <input type="text" 
                       size="12" 
                       name="datefrom" 
                       class="easyui-datebox" 
                       id="po_datefrom_s" 
                       data-options="formatter:myformatter,parser:myparser"
                       />
                <label class="field_label">To : </label>
                <input type="text" 
                       size="11" 
                       name="dateto" 
                       class="easyui-datebox" 
                       data-options="formatter:myformatter,parser:myparser"
                       />
            </td>
        </tr>

        <tr>
            <td align="right"><label class="field_label">Department : </label></td>
            <td>
                <select class="easyui-combobox" 
                        name="departmentid" 
                        style="width: 100px" 
                        data-options="onSelect:function(rec){purchaserequest_by_item_search()}">
                    <option></option>
                    <?php
                    foreach ($department as $result) {
                        echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Vendor :</label></td>
            <td>
                <input name="vendorid" 
                       id="po_vendorid_s" 
                       class="easyui-combobox" 
                       data-options="
                       valueField: 'id',
                       textField: 'text',
                       url: '<?php echo site_url('vendor/get_remote_data') ?>'"
                       mode="remote" 
                       style="width: 150px"
                       panelWidth="180">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Currency : </label></td>
            <td>
                <select class="easyui-combobox" 
                        name="currency"
                        panelWidth="180"
                        panelHeight="auto"
                        data-options="onSelect:function(rec){purchaserequest_by_item_search()}">
                    <option></option>
                    <?php
                    foreach ($currency as $result) {
                        echo "<option value='" . $result->code . "'>" . $result->code . ": " . $result->description . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>        
        <tr>
            <td align="right"><label class="field_label">Item Code :</label></td>
            <td>
                <input type="text" 
                       size="8" 
                       class="easyui-validatebox" 
                       name="itemcode" 
                       onkeypress="if (event.keyCode === 13) {purchaserequest_by_item_search()}"
                       />
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Item Description :</label></td>
            <td>
                <input type="text" 
                       size="25" 
                       class="easyui-validatebox" 
                       name="itemdescription" 
                       onkeypress="if (event.keyCode === 13) {purchaserequest_by_item_search()}"
                       />
            </td>
        </tr>
        <tr>
            <td style="padding-top: 10px" colspan="2" align="center">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="purchaserequest_by_item_search()">Find</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="$('#purchaserequest_by_item_search-form').form('clear');purchaserequest_by_item_search()">Clear</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="$('#purchaserequest_by_item_menu_search').tooltip('hide');">Close</a>
            </td>
        </tr>
    </table>   
</form>
