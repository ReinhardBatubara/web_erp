<div id="subsection_toolbar" style="padding-bottom: 0;">
  Code : 
  <input type="text" size="12" class="easyui-validatebox" id="subsection_code_s" onkeypress="if (event.keyCode === 13) {
        subsection_search();
      }"/>    
  Name : <input type="text" size="12" class="easyui-validatebox" id="subsection_name_s" onkeypress="if (event.keyCode === 13) {
        subsection_search();
      }"/>    
  Description : <input type="text" size="20" class="easyui-validatebox" id="subsection_description_s" onkeypress="if (event.keyCode === 13) {
        subsection_search();
      }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="subsection_search()"> Search</a>

  <?php if (in_array('add', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="subsection_add()">Add</a>
  <?php }if (in_array('edit', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="subsection_edit()">Edit</a>
  <?php }if (in_array('delete', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="subsection_delete()">Delete</a>
  <?php } ?>
</div>
<table id="subsection" data-options="
       url:'<?php echo site_url('subsection/get') ?>',
       method:'post',
       title:'Sub Section',
       border:true,
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#subsection_toolbar'">
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
    $('#subsection').datagrid();
  });
</script>
<?php
$this->load->view('subsection/add');

