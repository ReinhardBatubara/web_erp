<form id="joborder_item_import_form" enctype="multipart/form-data" method="post" novalidate class="table_form">
    <table width="100%" border="0">
        <tr>
            <td width="30%" align="right"><label class="field_label">Date</label></td>
            <td width="70%">
                <input name="date" 
                       class="easyui-datebox" 
                       style="width: 120px;" 
                       required="true"
                       data-options="formatter:myformatter,parser:myparser"
                       >
            </td>
        </tr>
        <tr>
            <td align="right"><label class="field_label">File (Ext: csv,txt)</label></td>
            <td>
                <input type="file" required="true" name="inputfile" id="inputfile" style="width: 250px"/>
            </td>
        </tr>
    </table>        
</form>