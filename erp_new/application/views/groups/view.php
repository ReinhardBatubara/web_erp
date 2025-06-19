<div id="groups_toolbar" style="padding-bottom: 0">
    <form id="groups_search_form" onsubmit="groups_search();return false;">
  Code : <input type="text" size="12" class="easyui-validatebox" name='code' id="groups_code_s" onkeypress="if (event.keyCode === 13) {
        groups_search();
      }"/>    
  Name : <input type="text" size="12" class="easyui-validatebox"  name='name' id="groups_name_s" onkeypress="if (event.keyCode === 13) {
        groups_search();
      }"/>    
  Description : <input type="text" size="20" class="easyui-validatebox" name='description' id="groups_description_s" onkeypress="if (event.keyCode === 13) {
        groups_search();
      }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="groups_search()"></a>
  <?php
  if (in_array('add', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="groups_add()"> Add</a>
    <?php
  }if (in_array('edit', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="groups_edit()"> Edit</a>
    <?php
  }if (in_array('delete', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="groups_delete()"> Delete</a>
    <?php
  }
  ?>
    </form>
</div>
<table id="groups" data-options="
       url:'<?php echo site_url('groups/get') ?>',
       method:'post',
       title:'Item Group',
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
       toolbar:'#groups_toolbar'">
  <thead>
    <tr>
      <th field="id" hidden="true"></th>            
      <th field="codes" width="100" halign="center" sortable="true">Code</th>
      <th field="names" width="120" halign="center" sortable="true">Name</th>
      <th field="descriptions" width="400" halign="center" sortable="true">Description</th>            
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#groups').datagrid({});
  });
</script>
<?php
$this->load->view('groups/add');
?>

