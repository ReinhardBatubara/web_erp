<div id="mirrorglass_toolbar" style="padding-bottom: 0px">
    Code : <input type="text" size="12" class="easyui-validatebox" id="mirrorglass_code_s" onkeypress="if (event.keyCode == 13) {
                mirrorglass_search()
            }"/>    
    Description : <input type="text" size="20" class="easyui-validatebox" id="mirrorglass_description_s" onkeypress="if (event.keyCode == 13) {
                mirrorglass_search()
            }"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="mirrorglass_search()"></a>
    <?php
    if (in_array('add', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="mirrorglass_add()">Add</a>
        <?php
    }if (in_array('edit', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="mirrorglass_edit()">Edit</a>
        <?php
    }if (in_array('delete', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="mirrorglass_delete()">Delete</a>
        <?php
    }
    ?>
</div>
<table id="mirrorglass" data-options="
       url:'<?php echo site_url('mirrorglass/get') ?>',
       method:'post',
       title:'Mirror / Glass',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#mirrorglass_toolbar'">
    <thead>
        <tr>
            <th field="code" width="100" align="center">Code</th>            
            <th field="description" width="400" halign="center">Description</th>            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#mirrorglass').datagrid({});
    });
</script>
<?php
$this->load->view('mirrorglass/add');
?>

