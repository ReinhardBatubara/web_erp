<div id="position_toolbar" style="padding-bottom: 0;">
    <form id="position_search_form" onsubmit="unit_search();return false;">
  Code : 
  <input type="text" size="12" class="easyui-validatebox" name=code id="position_code_s" onkeypress="if (event.keyCode === 13) {
        position_search();
      }"/>    
  Name : <input type="text" size="12" class="easyui-validatebox" name=name  id="position_name_s" onkeypress="if (event.keyCode === 13) {
        position_search();
      }"/>    
  Description : <input type="text" size="20" class="easyui-validatebox" name=description  id="position_description_s" onkeypress="if (event.keyCode === 13) {
        position_search();
      }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="position_search()"> Search</a>

  <?php if (in_array('add', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="position_add()">Add</a>
  <?php }if (in_array('edit', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="position_edit()">Edit</a>
  <?php }if (in_array('delete', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="position_delete()">Delete</a>
  <?php } ?>
    </form>
</div>
<table id="position" data-options="
       url:'<?php echo site_url('position/get') ?>',
       method:'post',
       title:'Job Title',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#position_toolbar'">
  <thead>
    <tr>
      <th field="id" hidden="true"></th>            
      <th field="code" width="100" halign="center" sortable="true">Code</th>
      <th field="name" width="120" halign="center" sortable="true">Name</th>
      <th field="description" width="400" halign="center" sortable="true">Description</th>            
    </tr>
  </thead>
</table>
<script>
  $(function() {
    $('#position').datagrid();
  });
</script>
<?php
$this->load->view('position/add');

