<div id="accessories_toolbar" style="padding-bottom: 0">
  Code : 
  <input type="text" 
         size="12" 
         class="easyui-validatebox" 
         id="accessories_code_s" 
         onkeypress="if (event.keyCode === 13) {
               accessories_search();
             }"
         />    
  Description : 
  <input type="text" 
         size="20" 
         class="easyui-validatebox" 
         id="accessories_description_s" 
         onkeypress="if (event.keyCode === 13) {
               accessories_search();
             }"
         />
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="accessories_search()"></a>
  <?php
  if (in_array('add', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="accessories_add()"> Add</a>
    <?php
  }if (in_array('edit', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="accessories_edit()"> Edit</a>
    <?php
  }if (in_array('delete', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="accessories_delete()"> Delete</a>
    <?php
  }
  ?>
</div>
<table id="accessories" data-options="
       url:'<?php echo site_url('accessories/get') ?>',
       method:'post',
       title:'Accessories',
       border:true,
       singleSelect:true,
       fit:true,
       striped:true,
       pageList: [30, 50, 70, 90, 110],
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       sortName:'code',
       sortOrder:'desc',
       toolbar:'#accessories_toolbar'">
  <thead>
    <tr>
      <th field="code" width="100" align="center" sortable="true">Code</th>            
      <th field="description" width="400" halign="center" sortable="true">Description</th>            
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#accessories').datagrid({
      onDblClickRow: function(value, row, data) {
        accessories_edit();
      }
    });
  });
</script>
<?php
$this->load->view('accessories/add');
?>

