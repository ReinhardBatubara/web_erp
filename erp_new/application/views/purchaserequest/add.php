<form id="purchaserequest-input" method="post" novalidate class="table_form" style="margin-top: 2px">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="20%"><label class="field_label">Date :</label></td>
            <td width="80%"><input type="text" name="date" class="easyui-datebox" required="true" value="" style="text-align: center;width: 50%" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark :</label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width: 100%;height: 50px"></textarea>
            </td>
        </tr>         
    </table>        
</form>