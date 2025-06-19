<div id="item_change_image-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#item_change_image-button">
    <form id="item_change_image-input" method="post" novalidate enctype="multipart/form-data">
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label for="inputfile">Image :</label></td>
                <td><input type="file" name="fileupload" class="easyui-validatebox" required="true"/></td>
            </tr>                        
        </table>        
    </form>
</div>
<div id="item_change_image-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="item_update_image()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#item_change_image-form').dialog('close')">Cancel</a>
</div>