<div style="width: 100%;height: 260px" class="easyui-panel" fit="true" border="false">
    <div id="sod_upholstry_toolbar" style="padding-bottom: 2px;">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="sod_edit_upholstry" onclick="sod_edit_upholstry()"> Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="sod_delete_upholstry" onclick="sod_delete_upholstry()">Delete Update</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-delete2" plain="true" id="sod_permanent_delete_upholstry" onclick="sod_permanent_delete_upholstry()">Delete From List</a>        
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-restore" plain="true" id="sod_restore_upholstry" onclick="sod_restore_upholstry()">Restore Original</a>
    </div>
    <table id="sod_upholstry" data-options="
           url:'<?php echo site_url('salesorder/detail_get_upholstry/' . $salesorderdetailid . '/' . $modelid) ?>',
           method:'post',
           border:false,
           singleSelect:true,
           fit:true,
           rownumbers:true,
           fitColumns:false,
           striped:true,
           toolbar:'#sod_upholstry_toolbar'">
        <thead>
            <tr>
                <th field="description" width="120" halign="center" rowspan="2">Description</th>
                <th halign="center" colspan="2">Standard Material</th>
                <th field="total_qty" width="50" halign="center" align="right" rowspan="2">Qty</th>
                <th field="unitcode" width="50" align="center" rowspan="2">Unit</th>   
                <th halign="center" colspan="2">New Updated Material</th>
            </tr>
            <tr>
                <th field="std_mat_item_code" width="80" align="center">Code</th>
                <th field="std_mat_item_description" width="170" halign="center">Description</th>
                <th field="upd_mat_itemcode" width="80" align="center">Code</th>
                <th field="upd_mat_item_description" width="170" halign="center">Description</th>
            </tr>
        </thead>
    </table>
    <script type="text/javascript">
        $(function() {
            $('#sod_upholstry').datagrid();
        });
    </script>
</div>
<input type="hidden" id="sod_detailid56" value="<?php echo $salesorderdetailid ?>" />
<div id="sod_upholstry_temp"></div>