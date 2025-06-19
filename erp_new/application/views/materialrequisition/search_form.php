<form id="materialrequisition_search_form" method="post" novalidate onsubmit="return false;">
    <table width="300" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label">MR :</label></td>
            <td width="70%">
                <input type="text" size="8" class="easyui-validatebox" name="number" id="mr_number_s" onkeypress="if (event.keyCode === 13) {
                    materialrequisition_search();
                }"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Date From :</label></td>
            <td>
                <input type="text" size="11" class="easyui-datebox" name="datefrom" id="mr_datefrom_s" data-options="formatter:myformatter,parser:myparser"/>
                <label class="field_label">To : </label>
                <input type="text" size="11" class="easyui-datebox" name="dateto" id="mr_dateto_s" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Department :</label></td>
            <td>
                <select class="easyui-combobox" name="departmentid" id="mr_departmentid_s" panelWidth="150" style="width: 100px">
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
            <td></td>
            <td style="padding-top: 10px">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="materialrequisition_search()">Find</a>
                   <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="$('#materialrequisition_search_form').form('clear');
                   materialrequisition_search()" style="float: right">Clear</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="$('#materialrequisition_menu_search').tooltip('hide');"  style="float: right">Close</a>
            </td>
        </tr>
    </table>   
</form>