<div id="directlabour_toolbar" style="padding-bottom: 0;">
    <form id="directlabour_search_form" onsubmit="unit_search();return false;">
  Code : 
  <input type="text" size="12" class="easyui-validatebox" name=code id="directlabour_code_s" onkeypress="if (event.keyCode === 13) {
        directlabour_search();
      }"/>    
  Name : <input type="text" size="12" class="easyui-validatebox" name=name  id="directlabour_name_s" onkeypress="if (event.keyCode === 13) {
        directlabour_search();
      }"/>    
  Description : <input type="text" size="20" class="easyui-validatebox" name=description  id="directlabour_description_s" onkeypress="if (event.keyCode === 13) {
        directlabour_search();
      }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="directlabour_search()"> Search</a>

  <?php if (in_array('add', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="directlabour_add()">Add</a>
  <?php }if (in_array('edit', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="directlabour_edit()">Edit</a>
  <?php }if (in_array('delete', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="directlabour_delete()">Delete</a>
  <?php } ?>
    </form>
</div>
<table id="directlabour" data-options="
       url:'<?php echo site_url('directlabour/get') ?>',
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
       toolbar:'#directlabour_toolbar'">
  <thead>
    <tr>
      <th field="id" hidden="true"></th>      
      <th field="description" width="400" halign="center" sortable="true">Description</th>        
      <th field="unit" width="100" halign="center" sortable="true">Unit</th>
      <th field="price" width="120" halign="center" sortable="true">Price</th>   
      <th field="curr" width="120" halign="center" sortable="true">Currency</th>  
      <th field="percentage" width="120" halign="center" sortable="true">Percentage</th>         
    </tr>
  </thead>
</table>
<script>
  $(function() {
    $('#directlabour').datagrid();
  });
</script>
<?php
$this->load->view('directlabour/add');

