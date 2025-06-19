<form id="purchaseorder_search-form" method="post" novalidate onsubmit="return false;">
    <table width="300" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">PO No# : </label></td>
            <td>
                <input type="text" size="8" class="easyui-validatebox" name="number" id="po_number_s" onkeypress="if (event.keyCode === 13) {
                    purchaseorder_search();
                }"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">PR No# : </label></td>
            <td>
                <input type="text" size="8" name="pr" class="easyui-validatebox" id="po_pr_number_s" onkeypress="if (event.keyCode === 13) {
                purchaseorder_search();
            }"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Date From :</label></td>
            <td>
                <input type="text" size="11" name="datefrom" class="easyui-datebox" id="po_datefrom_s" data-options="formatter:myformatter,parser:myparser"/>
                To :<input type="text" size="11" name="dateto" class="easyui-datebox" id="po_dateto_s" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr>

        <tr>
            <td align="right"><label class="field_label">Department : </label></td>
            <td>
                <select class="easyui-combobox" name="departmentid" id="po_departmentid_s" style="width: 100px">
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
                <input name="vendorid" id="po_vendorid_s" class="easyui-combobox" data-options="
                       valueField: 'id',
                       textField: 'text',
                       url: '<?php echo site_url('vendor/get_remote_data') ?>'" mode="remote" style="width: 150px">
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Status : </label></td>
            <td>
                <select name="status" class="easyui-combobox" panelHeight="auto" data-options="onSelect:function(rec){purchaseorder_search()}">
                    <option></option>
                    <option value="0">New</option>
                    <option value="1">Open</option>
                    <option value="2">Finish</option>
                    <option value="3">Close</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top: 10px" align="center">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="purchaseorder_search()">Find</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="purchaseorder_print_detail()">Print</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="purchaseorder_clear_search()" style="float: right">Clear</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="$('#purchaseorder_menu_search').tooltip('hide');"  style="float: right">Close</a>
            </td>
        </tr>
    </table>   
</form>
