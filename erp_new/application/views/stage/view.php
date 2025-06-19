<div id="stage_toolbar" style="padding-bottom: 0px;">
  Code : <input type="text" size="12" class="easyui-validatebox" id="stage_code_s" onkeypress="if (event.keyCode === 13) {
        stage_search();
      }"/>    
  Description : <input type="text" size="20" class="easyui-validatebox" id="stage_description_s" onkeypress="if (event.keyCode === 13) {
        stage_search();
      }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="stage_search()"> Search</a>    
  <?php
  if (in_array('add', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="stage_add()"> Add</a>
    <?php
  }if (in_array('edit', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="stage_edit()"> Edit</a>
    <?php
  }if (in_array('delete', $action)) {
    ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="stage_delete()"> Delete</a>
    <?php
  }
  ?>
</div>
<table id="stage" data-options="
       url:'<?php echo site_url('stage/get') ?>',
       method:'post',
       title:'Stage',
       border:true,
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
       toolbar:'#stage_toolbar'">
  <thead>
    <tr>
      <th field="code" width="100" align="center" sortable="true">Code</th>            
      <th field="description" width="400" halign="center" sortable="true">Description</th>            
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#stage').datagrid({
    });
  });
</script>
<?php
$this->load->view('stage/add');
?>

