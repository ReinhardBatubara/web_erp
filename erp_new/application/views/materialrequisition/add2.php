<form id="materialrequisition-input" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="25%"><label class="field_label">Date : </label></td>
            <td width="70%"><input type="text" style="width: 200px" class="easyui-datebox" name="date" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Nota No : </label></td>
            <td>
                <input type="text" name="job_no" id="job_no_"class="easyui-validatebox" style="width: 200px"/>                
            </td>
        </tr>        
        <tr>
            <td align="right"><label class="field_label">Required Date  : </label></td>
            <td><input type="text" style="width: 200px" class="easyui-datebox" name="required_date" data-options="formatter:myformatter,parser:myparser"/></td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">Remark : </label></td>
            <td>
                <textarea name="remark" class="easyui-validatebox" style="width: 90%;height: 40px"></textarea>
            </td>
        </tr>            
    </table>        
</form>