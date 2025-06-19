<div id="furring_toolbar" style="padding-bottom: 0px;">
  Code : <input type="text" size="12" class="easyui-validatebox" id="furring_code_s" onkeypress="if (event.keyCode == 13) {
        furring_search()
      }"/>    
  Description : <input type="text" size="20" class="easyui-validatebox" id="furring_description_s" onkeypress="if (event.keyCode == 13) {
        furring_search()
      }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="furring_search()"></a>
  <?php
  if (in_array('add', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="furring_add()"> Add</a>
    <?php
  }if (in_array('edit', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="furring_edit()"> Edit</a>
    <?php
  }if (in_array('delete', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="furring_delete()"> Delete</a>
    <?php
  }
  ?>
</div>
<table id="furring" data-options="
       url:'<?php echo site_url('furring/get') ?>',
       method:'post',
       title:'Furring',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pageList: [30, 50, 70, 90, 110],
       pagination:true,
       striped:true,
       sortName:'code',
       sortOrder:'desc',
       toolbar:'#furring_toolbar'">
  <thead>
    <tr>
      <th field="code" width="100" align="center" sortable="true">Code</th>            
      <th field="description" width="400" halign="center" sortable="true">Description</th>            
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#furring').datagrid();
  });
</script>
<?php
$this->load->view('furring/add');
?>

