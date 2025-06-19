<div id="hardware_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="hardware_add" onclick="hardware_add()"> Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add2" plain="true" id="hardware_add_new_material" onclick="hardware_add_new_material()">Add New Material</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="hardware_edit" onclick="hardware_edit()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="hardware_delete" onclick="hardware_delete()">Delete</a>
</div>
<table id="hardware" data-options="
       url:'<?php echo site_url('hardware/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       title:'Hardware/Accessories',
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#hardware_toolbar'">
    <thead>
        <tr>
            <th field="description" width="180" halign="center">Description</th>
            <th field="code" width="90" align="center">Material Code</th>
            <th field="materialdescription" width="300" halign="center">Material Description</th>
            <th field="size_l" width="40" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">L</th>
            <th field="size_w" width="40" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">W</th>
            <th field="size_t" width="40" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">T</th>
            <th field="qty" width="40" align="center">Qty</th>
            <th field="total_qty" width="60" halign="center" align="right">Total Qty</th>
            <th field="unitcode" width="40" align="center">Unit</th>
            <th field="remark" width="150" halign="center">Remark</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#hardware').datagrid({});
    });
</script>

<?php
//$this->load->view('model/hardware/add2');