<form id="salesorder_search_form" method="post" novalidate onsubmit="return false;">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="25%"><label class="field_label">SO :</label></td>
            <td width="75%">
                <input type="text" size="8" class="easyui-validatebox" id="salesorder_sonumber_s" name="sonumber" />
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Date From :</label></td>
            <td>
                <input type="text" size="12" style="height: 20px" class="easyui-datebox" id="salesorder_datefrom_s" name="datefrom" data-options="formatter:myformatter,parser:myparser"/>
                <label class="field_label">To :</label>
                <input type="text" size="12" style="height: 20px" class="easyui-datebox" id="salesorder_dateto_s" name="dateto" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Order By :</label></td>
            <td>
                <select class="easyui-combobox" name="orderby" panelHeight='200' panelWidth=200' style="width: 80px;">
                    <option></option>
                    <?php
                    foreach ($customer as $result) {
                        echo "<option value=" . $result->id . ">" . $result->name . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">Ship To :</label></td>
            <td>
                <select class="easyui-combobox" name="shipto"  panelHeight='200' panelWidth=200' style="width: 80px;">
                    <option></option>
                    <?php
                    foreach ($customer as $result) {
                        echo "<option value=" . $result->id . ">" . $result->name . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">PO :</label></td>
            <td>
                <input type="text" size="10" class="easyui-validatebox" name="po_no" id="salesorder_po_s"/>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-top: 10px">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="salesorder_search()">Find</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="$('#salesorder_search_form').form('clear');salesorder_search()">Clear</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="$('#salesorder_menu_search').tooltip('hide');">Close</a>
            </td>
        </tr>
    </table>   
</form>
