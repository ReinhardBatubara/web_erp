<form id="materialwithdraw_search_form" method="post" novalidate onsubmit="return false;">
    <table width="300" border="0">
        <tr>
            <td align="right" width="30%">MW No# :</td>
            <td>
                <input type="text" size="8" class="easyui-validatebox" id="mw_number_s" onkeypress="if (event.keyCode === 13) {
                            materialwithdraw_search();
                        }"/>
            </td>
        </tr>
        <tr>
            <td align="right">Date From :</td>
            <td>
                <input type="text" size="11" class="easyui-datebox" id="mw_datefrom_s" data-options="formatter:myformatter,parser:myparser"/>
                To :
                <input type="text" size="11" class="easyui-datebox" id="mw_dateto_s" data-options="formatter:myformatter,parser:myparser"/>
            </td>
        </tr>
        <tr>
            <td align="right">Department :</td>
            <td>
                <select class="easyui-combobox" id="mw_departmentid_s" style="width: 100px">
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
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="materialwithdraw_search()">Find</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="$('#materialwithdraw_search_form').form('clear');
                        materialwithdraw_search()" style="float: right">Clear</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="$('#materialwithdraw_menu_search').tooltip('hide');"  style="float: right">Close</a>
            </td>
        </tr>
    </table>   
</form>