<form id="costing_final_price-input" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right"><label class="field_label">Date : </label></td>
            <td><input type="tex" class="easyui-datebox" name="date" id="date" size="13" required="true" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>
            <td align="right" width="40%"><label class="field_label">Selling Price Approved : </label></td>
            <td>
                <input type="text" 
                       name="final_selling_price" 
                       class="easyui-numberbox" 
                       required="true" 
                       size="25" 
                       groupSeparator=","
                       style="text-align: right;" precision="2"/>
            </td>
        </tr>
    </table>        
</form>