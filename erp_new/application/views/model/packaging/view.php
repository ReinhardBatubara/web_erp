<div id="packaging_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="packaging_add" onclick="packaging_add()">Add Parent</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add-child" plain="true" id="packaging_add_child" onclick="packaging_add_child()">Add Child</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="packaging_edit" onclick="packaging_edit()">Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="packaging_delete" onclick="packaging_delete()">Delete</a>
</div>
<table id="packaging" data-options="
       url:'<?php echo site_url('packaging/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       title:'Packaging',
       rownumbers:true,
       fitColumns:false,
       animate:true,
       lines:true,
       striped:true,
       idField: 'id',
       toolbar:'#packaging_toolbar'"
       treeField="description">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="modelid" hidden="true"></th>            
            <th field="itemid" hidden="true"></th>            
            <th field="description" width="200" halign="center">Description</th>
            <th field="code" width="100" align="center">Material Code</th>
            <th field="materialdescription" width="150" halign="center">Material Description</th>
            <th field="size_l" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">L</th>
            <th field="size_w" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">W</th>
            <th field="size_t" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">T</th>
            <th field="volume_m3" width="60" halign="center" align="right" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">M3</th>
            <th field="volume_m2" width="60" halign="center" align="right" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">M2</th>
            <th field="qty" width="40" align="center">Qty</th>
            <th field="total_qty" width="80" halign="center" align="right" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">Total Qty</th>
            <th field="unitcode" width="50" align="center">Unit</th>
            <th field="remark" width="220" halign="center">Remark</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#packaging').treegrid();
    });
</script>
