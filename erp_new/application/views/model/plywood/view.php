<div id="plywood_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="plywood_add" onclick="plywood_add()"> Add Path</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add-child" plain="true" id="plywood_children" onclick="plywood_children()">Add Child</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="plywood_edit" onclick="plywood_edit()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="plywood_delete" onclick="plywood_delete()">Delete</a>

    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-arrow-up" plain="true" id="plywood_make_as_path" onclick="plywood_make_as_path()">Make as Path</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-arrow-down" plain="true" id="plywood_make_as_child" onclick="plywood_make_as_child()">Make as Child</a>
</div>
<table id="plywood" data-options="
       url:'<?php echo site_url('plywood/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       title:'Plywood / MDF',
       fit:true,
       rownumbers:true,
       fitColumns:false,
       striped:true,
       idField: 'id',
       toolbar:'#plywood_toolbar'"
       treeField="description">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="modelid" hidden="true"></th>
            <th field="itemid" hidden="true"></th>
            <th field="description" width="200" halign="center">Description</th>
            <th field="code" width="90" align="center">Material Code</th>
            <th field="materialdescription" width="250" halign="center">Material Description</th>
            <th field="size_l" width="70" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">L</th>
            <th field="size_w" width="70" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">W</th>
            <th field="size_t" width="70" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">T</th>
            <th field="qty" width="40" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">Qty</th>
<!--            <th field="volume_m2" width="60" halign="center" align="right" data-options="formatter:function(value,row,index){return (row.unitcode == 'M2') ? row.volume: '';}">M2</th>
            <th field="volume_m3" width="60" halign="center" align="right" data-options="formatter:function(value,row,index){return (row.unitcode == 'M3') ? row.volume: '';}">M3</th>-->
            <th field="total_qty" width="80" halign="center" align="right" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">Total Qty</th>
            <th field="unitcode" width="40" align="center">Unit</th>
            <th field="remark" width="80" align="center">Remark</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#plywood').treegrid();
    });
</script>