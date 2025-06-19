<div id="costing_change_image-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#costing_change_image-button">
    <form id="costing_change_image-input" method="post" novalidate enctype="multipart/form-data" class="table_form">
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label for="inputfile">Image :</label></td>
                <td><input type="file" name="fileupload" id="costing_change_fileupload" class="easyui-validatebox" required="true"/></td>
            </tr>                        
        </table>        
    </form>
</div>
<div id="costing_change_image-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="costing_update_image()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#costing_change_image-form').dialog('close')">Cancel</a>
</div>