<div id="material_toolbar" style="padding-bottom: 0px;">
  Code : <input type="text" size="12" class="easyui-validatebox" id="material_code_s" onkeypress="if (event.keyCode == 13) {
        material_search()
      }"/>    
  Description : <input type="text" size="20" class="easyui-validatebox" id="material_description_s" onkeypress="if (event.keyCode == 13) {
        material_search()
      }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="material_search()"> Search</a>
  <?php
  if (in_array('add', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="material_add()"> Add</a>
    <?php
  }if (in_array('edit', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="material_edit()"> Edit</a>
    <?php
  }if (in_array('delete', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="material_delete()"> Delete</a>
    <?php
  }
  ?>
</div>
<table id="material" data-options="
       url:'<?php echo site_url('material/get') ?>',
       method:'post',
       border:true,
       title:'Material',
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       sortName:'code',
       sortOrder:'desc',
       toolbar:'#material_toolbar'">
  <thead>
    <tr>
      <th field="code" width="100" align="center" sortable="true">Code</th>            
      <th field="description" width="400" halign="center" sortable="true">Description</th>            
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#material').datagrid();
  });
</script>
<?php
$this->load->view('material/add');
?>

