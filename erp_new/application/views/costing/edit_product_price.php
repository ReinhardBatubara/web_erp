<form id="product_price_list-input" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="40%"><label class="field_label">Item Code : </label></td>
            <td width="60%"><input type="text" name="code" class="easyui-validatebox" required="true" value="" style="width: 180px" disabled/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Item Name : </label></td>
            <td><input type="text" name="name" class="easyui-validatebox" required="true" value="" style="width: 180px" disabled/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">USD Price : </label></td>
            <td><input type="text" name="usd_price" class="easyui-numberbox" precision="2" groupSeparator="," required="true" value="" style="width: 180px;text-align: right"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">USD Price (Optional) : </label></td>
            <td><input type="text" name="usd_optional_price" class="easyui-numberbox" precision="2" groupSeparator="," value="" style="width: 180px;text-align: right"/></td>
        </tr>
    </table>        
</form>
