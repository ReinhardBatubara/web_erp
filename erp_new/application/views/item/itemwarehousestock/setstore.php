<div id="itemwarehousestock-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#dialog-button">
    <form id="itemwarehousestock-input" method="post" novalidate>
        <table width="100%" border="0" id="itemwarehousestock_table">

        </table>
    </form>
</div>
<div id="dialog-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="itemwarehousestock_save()">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#itemwarehousestock-form').dialog('close')">Cancel</a>
</div>