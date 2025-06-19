<form id="stockout_search_form" method="post" novalidate onsubmit="return false;">
    <table width="300" border="0">
        <tr>
            <td align="right" width="30%"><label class="field_label"> STO : </label></td>
            <td>
                <input type="text" 
                       class="easyui-validatebox" 
                       id="stockout_number_s" 
                       onkeypress="if (event.keyCode === 13) {stockout_search();}"
                       name="number"
                       />
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Date From : </label></td>
            <td>
                <input type="text" 
                       size="11" 
                       class="easyui-datebox" 
                       id="stockout_datefrom_s" 
                       data-options="formatter:myformatter,parser:myparser"
                       name="datefrom"
                       />
                <label class="field_label">To :</label>
                <input type="text" 
                       size="11" 
                       class="easyui-datebox" 
                       id="stockout_dateto_s" 
                       data-options="formatter:myformatter,parser:myparser"
                       name="dateto"
                       />
            </td>
        </tr>
        <tr>
            <td align="right" width="30%"><label class="field_label">MW/Nota : </label></td>
            <td>
                <input type="text" 
                       class="easyui-validatebox" 
                       id="stockout_mw_s" 
                       onkeypress="if (event.keyCode === 13) {stockout_search();}"
                       name="mw_or_nota"
                       />
            </td>
        </tr>
        <tr>
            <td style="padding-top: 10px" colspan="2" align="center">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="stockout_search()">Find</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="stockout_print_detail()">Print</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="$('#stockout_search_form').form('clear');stockout_search()" style="float: right">Clear</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="$('#stockout_menu_search').tooltip('hide');"  style="float: right">Close</a>
            </td>
        </tr>
    </table>
</form>