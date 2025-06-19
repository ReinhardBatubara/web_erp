<div id="model_detail_layout-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:400px; padding: 5px 5px" closed="true" buttons="#model_detail_layout-button">
    <form id="model_detail_layout-input" method="post" novalidate enctype="multipart/form-data">
        <table width="100%" border="0">
            <tr>
                <td align="right" width="30%"><label class="field_label">Title :</label></td>
                <td><input type="text" class="easyui-validatebox" name="title" id='model_detail_layout_title' required='true'/></td>
            </tr>
            <tr>
                <td align="right" width="30%"><label class="field_label">Image File:</label></td>
                <td><input type="file" name="fileupload" id='model_detail_layout_fileupload' style="width: 150px"/> &nbsp; .jpg .png .gif</td>
            </tr>
        </table>        
    </form>
</div>
<div id="model_detail_layout-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="model_detail_layout_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#model_detail_layout-form').dialog('close')">Cancel</a>
</div>