<div id="mirror_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="mirror_add" onclick="mirror_add()"> Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="mirror_edit" onclick="mirror_edit()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="mirror_delete" onclick="mirror_delete()">Delete</a>
</div>
<table id="mirror" data-options="
       url:'<?php echo site_url('mirror/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       title:'Mirror/Glass',
       pageSize:50,
       pageList: [50, 100],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#mirror_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="modelid" hidden="true"></th>
            <th field="itemid" hidden="true"></th>
            <th field="description" width="200" halign="center">Description</th>            
            <th field="code" width="90" align="center">Material Code</th>
            <th field="materialdescription" width="150" halign="center">Material Description</th>
            <th field="size_l" width="70" align="center">L</th>
            <th field="size_w" width="70" align="center">W</th>
            <th field="size_t" width="70" align="center">T</th>
            <th field="qty" width="40" align="center">Qty</th>
            <th field="volume" width="80" halign="center" align="right">Volume</th>
            <th field="total_qty" width="80" halign="center" align="right">Total Qty</th>
            <th field="unitcode" width="40" align="center">Unit</th>
            <th field="remark" width="150" halign="center" halign="center">Remark</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#mirror').datagrid({});
    });
</script>
