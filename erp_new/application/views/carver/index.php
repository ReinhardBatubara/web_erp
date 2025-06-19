<div id="carver_toolbar" style="padding-bottom: 0;"> 
    <form id="carver_search_form" style="margin-bottom:  0px" onsubmit="return false;">
        Name : 
        <input type="text" 
               size="12" 
               class="easyui-validatebox" 
               name="name" 
               onkeypress="if (event.keyCode === 13) {
                           carver_search();
                       }"
               /> 
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="carver_search()">Search</a>
        <?php if (in_array('add', $action)) { ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="carver_add()">Add</a>
        <?php }if (in_array('edit', $action)) { ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="carver_edit()">Edit</a>
        <?php }if (in_array('delete', $action)) { ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="carver_delete()">Delete</a>
        <?php } ?>
    </form>
</div>
<table id="carver" data-options="
       url:'<?php echo site_url('carver/get') ?>',
       method:'post',
       title:'Carver',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#carver_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="name" width="120" halign="center">Name</th>
            <th field="remark" width="400" halign="center">Remark</th>            
        </tr>
    </thead>
</table>
<script>
    $(function () {
        $('#carver').datagrid({});
    });
</script>
<?php
$this->load->view('carver/add');

