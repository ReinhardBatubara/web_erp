<div id="interliner_toolbar" style="padding-bottom: 0">
    Code : <input type="text" size="12" class="easyui-validatebox" id="interliner_code_s" onkeypress="if (event.keyCode == 13) {
                interliner_search()
            }"/>    
    Description : <input type="text" size="20" class="easyui-validatebox" id="interliner_description_s" onkeypress="if (event.keyCode == 13) {
                interliner_search()
            }"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="interliner_search()"></a>

    <?php
    if (in_array('add', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="interliner_add()"> Add</a>
        <?php
    }if (in_array('edit', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="interliner_edit()"> Edit</a>
        <?php
    }if (in_array('delete', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="interliner_delete()"> Delete</a>
        <?php
    }
    ?>
</div>
<table id="interliner" data-options="
       url:'<?php echo site_url('interliner/get') ?>',
       method:'post',
       title:'Interliner',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#interliner_toolbar'">
    <thead>
        <tr>
            <th field="code" width="100" align="center">Code</th>            
            <th field="description" width="400" halign="center">Description</th>            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#interliner').datagrid({});
    });
</script>
<?php
$this->load->view('interliner/add');
?>

