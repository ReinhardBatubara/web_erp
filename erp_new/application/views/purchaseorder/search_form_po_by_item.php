<form id="purchaseorder_by_item_by_item_search-form" class="table_form" method="post" novalidate onsubmit="return false;">
    <table width="100%" border="0">
        <tr>
            <td width="30%"><label class="field_label">PO No</label></td>
            <td width="70%">
                <input type="text" 
                       style="width: 100%;"
                       class="easyui-validatebox" 
                       name="po_number" 
                       onkeypress="if (event.keyCode === 13) {
                                   purchaseorder_by_item_search();
                               }"
                       />
            </td>
        </tr>
        <tr>
            <td><label class="field_label">PR No</label></td>
            <td>
                <input type="text" 
                       style="width: 100%;"
                       name="pr_number" 
                       class="easyui-validatebox" 
                       onkeypress="if (event.keyCode === 13) {
                                   purchaseorder_by_item_search();
                               }"
                       />
            </td>
        </tr>
        <tr>
            <td><label class="field_label">MR No</label></td>
            <td>
                <input type="text" 
                       style="width: 100%;"
                       name="mr_number" 
                       class="easyui-validatebox" 
                       onkeypress="if (event.keyCode === 13) {
                                   purchaseorder_by_item_search();
                               }"
                       />
            </td>
        </tr>
        <tr>
            <td><label class="field_label">Date</label></td>
            <td>
                <input type="text" 
                       style="width: 100px;"
                       name="datefrom" 
                       class="easyui-datebox" 
                       id="po_datefrom_s" 
                       data-options="formatter:myformatter,parser:myparser"
                       />
                <label class="field_label">-</label>
                <input type="text" 
                       style="width: 100px;"
                       name="dateto" 
                       class="easyui-datebox" 
                       data-options="formatter:myformatter,parser:myparser"
                       />
            </td>
        </tr>

        <tr>
            <td><label class="field_label">Department</label></td>
            <td>
                <select class="easyui-combobox" 
                        name="departmentid" 
                        style="width: 100px" 
                        data-options="onSelect:function(rec){purchaseorder_by_item_search()}">
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
            <td><label class="field_label">Vendor</label></td>
            <td>
                <input name="vendorid" 
                       id="po_vendorid_s" 
                       class="easyui-combobox" 
                       data-options="
                       valueField: 'id',
                       textField: 'text',
                       url: '<?php echo site_url('vendor/get_remote_data') ?>'"
                       mode="remote" 
                       style="width: 180px;"
                       panelWidth="180">
            </td>
        </tr>
        <tr>
            <td><label class="field_label">Currency</label></td>
            <td>
                <select class="easyui-combobox" 
                        name="currency"
                        panelWidth="180"
                        panelHeight="auto"
                        data-options="onSelect:function(rec){purchaseorder_by_item_search()}"
                        style="width: 200px;">
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
            <td><label class="field_label">PO Status</label></td>
            <td>
                <select name="po_status" 
                        class="easyui-combobox" 
                        panelHeight="auto" 
                        data-options="onSelect:function(rec){purchaseorder_by_item_search()}"
                        style="width: 100px;">
                    <option value="">All</option>
                    <option value="0">New</option>
                    <option value="1">Open</option>
                    <option value="2">Finish</option>
                    <option value="3">Close</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label class="field_label">Item Description</label></td>
            <td>
                <input type="text" 
                       size="10" 
                       class="easyui-validatebox" 
                       name="itemdescription" 
                       onkeypress="if (event.keyCode === 13) {
                                   purchaseorder_by_item_search()
                               }"
                       />
            </td>
        </tr>
        <tr>
            <td><label class="field_label">Receive Status</label></td>
            <td>
                <select class="easyui-combobox" name="item_receive_status" editable="false" panelHeight="auto" data-options="onSelect:function(rec){purchaseorder_by_item_search()}">
                    <option value="0">All</option>
                    <option value="1">Complete Receive</option>
                    <option value="2">Outstanding</option>
                </select>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 10px" colspan="2" align="center">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" onclick="purchaseorder_by_item_search()">Find</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="purchaseorder_by_item_print()">Print</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" onclick="$('#purchaseorder_by_item_by_item_search-form').form('clear');
                        purchaseorder_by_item_search()">Clear</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" onclick="$('#purchaseorder_by_item_menu_search').tooltip('hide');">Close</a>
            </td>
        </tr>
    </table>   
</form>
