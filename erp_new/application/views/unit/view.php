<div id="unit_toolbar" style="padding-bottom: 2px;">
    <form id="unit_search_form" onsubmit="unit_search();return false;">
  Code : <input type="text" size="12" class="easyui-validatebox" name='code' id="unit_code_s" onkeypress="if (event.keyCode === 13) {
        unit_search();
      }"/>    
  Name : <input type="text" size="12" class="easyui-validatebox" name='name' id="unit_name_s" onkeypress="if (event.keyCode === 13) {
        unit_search();
      }"/>    
  Description : <input type="text" size="20" class="easyui-validatebox"  name='remark' id="unit_remark_s" onkeypress="if (event.keyCode === 13) {
        unit_search();
      }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="unit_search()"> Search</a>
  <?php if (in_array('add', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="unit_add()"> Add</a>
  <?php }if (in_array('edit', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="unit_edit()"> Edit</a>
  <?php }if (in_array('delete', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="unit_delete()"> Delete</a>
  <?php } ?>
    </form>
</div>
<table id="unit" data-options="
       url:'<?php echo site_url('unit/get') ?>',
       method:'post',
       title:'Unit',
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
       toolbar:'#unit_toolbar'">
  <thead>
    <tr>
      <th field="id" hidden="true"></th>            
      <th field="codes" width="100" align="center" sortable="true">Code</th>
      <th field="names" width="120" halign="center" sortable="true">Name</th>
      <th field="remark" width="400" halign="center" sortable="true">Remark</th>            
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#unit').datagrid();
  });
</script>
<?php
$this->load->view('unit/add');

