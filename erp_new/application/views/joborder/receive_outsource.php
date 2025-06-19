<form id="receive_outsource_form" method="post" novalidate>
    <table width="100%" border="0">
        <tr>
            <td align="right"><label class="field_label">Receive Date :</label></td>
            <td><input type="text" name="date" class="easyui-datebox" required="true" value="" style="text-align: center;width: 200px" data-options="formatter:myformatter,parser:myparser"/></td>    
        </tr>            
        <tr valign="top">
            <td align="right"><label class="field_label">Remark : </label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width: 200;height: 50px"></textarea>
            </td>
        </tr>            
    </table>        
</form>