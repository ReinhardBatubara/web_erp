<div id="item_edit-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#item_edit-button">
    <form id="item_edit-input" method="post" novalidate enctype="multipart/form-data">
        <table width="100%" border="0">
            <tr>
                <td width="35%" align="right"><label class="field_label">Code :</label></td>
                <td width="65%"><input type="text" name="code" id="code" class="easyui-validatebox" required="true"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Description :</label></td>
                <td><textarea id="description" name="description" style="width: 90%; height: 40px;" class="easyui-validatebox" required="true"></textarea></td>  
            </tr>
            <tr>
                <td align="right"><label class="field_label">Group :</label></td>
                <td>
                    <input class="easyui-combobox" name="groupid" data-options="
                           url: '<?php echo site_url('itemgroup/get') ?>',
                           method: 'post',
                           valueField: 'id',
                           textField: 'name',
                           mode: 'remote',
                           panelHeight: '200',
                           formatter: formatGroup"
                           style="width: 150px" 
                           required="true">
                    <script type="text/javascript">
                        function formatGroup(row){
                            var s = '<span style="font-weight:bold">' + row.code +'</span><br/>' +
                                '<span style="color:#888">Name: ' + row.name +'</span><br/>';
                            return s;
                        }
                    </script>                    
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Category :</label></td>
                <td>
                    <select id="category" name="category" class="easyui-combobox" required="true" style="width: 80px" panelHeight="auto" panelWidth="90">
                        <option></option>
                        <option value="1">Local</option>
                        <option value="2">Import</option>
                        <option value="3">Mix</option>
                    </select>         
                </td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Yield :</label></td>
                <td><input type="text" size="5" maxlength="3" style="text-align: center;" value="0" id="yield" name="yield" class="easyui-numberbox"/> %</td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Re-order Point :</label></td>
                <td><input type="tex" name="reorderpoint" id="reorderpoint" size="5" style="text-align: center;" class="easyui-numberbox"/> *In Base Unit</td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">MOQ :</label></td>
                <td><input type="text" name="moq" id="moq" size="5" class="easyui-numberbox" value="1" style="text-align: center"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Lead Time :</label></td>
                <td><input type="text" name="lt" id="lt" size="5" style="text-align: center" class="easyui-numberbox"/></td>
            </tr>
            <tr>
                <td align="right"><label class="field_label">Check On Receive :</label></td>
                <td>
                    <select name="qccheck" class="easyui-combobox" panelHeight="auto" required="true">
                        <option value="true">Yes</option>
                        <option value="false">No</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="item_edit-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="item_update()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#item_edit-form').dialog('close')">Cancel</a>
</div>