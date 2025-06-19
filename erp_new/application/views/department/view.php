<div id="department_toolbar" style="padding-bottom: 0;">
  Code : <input type="text" size="12" class="easyui-validatebox" id="department_code_s" onkeypress="if (event.keyCode === 13) {
        department_search();
      }"/>    
  Name : <input type="text" size="12" class="easyui-validatebox" id="department_name_s" onkeypress="if (event.keyCode === 13) {
        department_search();
      }"/>    
  Description : <input type="text" size="20" class="easyui-validatebox" id="department_description_s" onkeypress="if (event.keyCode === 13) {
        department_search();
      }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="department_search()"></a>
  <?php
  if (in_array('add', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="department_add()">Add</a>
    <?php
  }if (in_array('edit', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="department_edit()">Edit</a>
    <?php
  }if (in_array('delete', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="department_delete()">Delete</a>
    <?php
  }
  ?>
</div>
<table id="department" data-options="
       'url':'<?php echo site_url('department/get') ?>',
       method:'post',
       title:'Department',
       border:true,
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#department_toolbar'">
  <thead>
    <tr>
      <th field="id" hidden="true"></th>            
      <th field="code" width="100" halign="center" sortable="true">Code</th>
      <th field="name" width="150" halign="center" sortable="true">Name</th>
      <th field="description" width="400" halign="center" sortable="true">Description</th>            
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#department').datagrid();
  });
</script>
<?php
$this->load->view('department/add');
?>

