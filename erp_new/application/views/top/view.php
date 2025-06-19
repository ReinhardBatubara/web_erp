<div id="top_toolbar" style="padding-bottom: 0px;">
    Code : <input type="text" size="12" class="easyui-validatebox" id="top_code_s" onkeypress="if (event.keyCode == 13) {
                top_search()
            }"/>    
    Description : <input type="text" size="20" class="easyui-validatebox" id="top_description_s" onkeypress="if (event.keyCode == 13) {
                top_search()
            }"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="top_search()"> Search</a>
    <?php
    if (in_array('add', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="top_add()"> Add</a>
        <?php
    }if (in_array('edit', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="top_edit()"> Edit</a>
        <?php
    }if (in_array('delete', $action)) {
        ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="top_delete()"> Delete</a>
    <?php
}
?>
</div>
<table id="top" data-options="
       'url':'<?php echo site_url('top/get') ?>',
       method:'post',
       title:'Top',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:50,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#top_toolbar'">
    <thead>
        <tr>
            <th field="code" width="100" align="center">Code</th>            
            <th field="description" width="400" halign="center">Description</th>            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#top').datagrid().datagrid('getPager').pagination({
            pageList: [50, 100, 150, 200, 250]
        });
    });
</script>
<?php
$this->load->view('top/add');
?>

