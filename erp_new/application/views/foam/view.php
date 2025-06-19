<div id="foam_toolbar" style="padding-bottom: 0px;">
  Code : <input type="text" size="12" class="easyui-validatebox" id="foam_code_s" onkeypress="if (event.keyCode === 13) {
        foam_search();
      }"/>    
  Description : <input type="text" size="20" class="easyui-validatebox" id="foam_description_s" onkeypress="if (event.keyCode === 13) {
        foam_search();
      }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="foam_search()"></a>
  <?php if (in_array('add', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="foam_add()"> Add</a>
  <?php }if (in_array('edit', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="foam_edit()"> Edit</a>
  <?php }if (in_array('delete', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="foam_delete()"> Delete</a>
  <?php } ?>
</div>
<table id="foam" data-options="
       url:'<?php echo site_url('foam/get') ?>',
       method:'post',
       title: 'Foam',
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
       toolbar:'#foam_toolbar'">
  <thead>
    <tr>
      <th field="code" width="100" align="center" sortable="true">Code</th>            
      <th field="description" width="400" halign="center" sortable="true">Description</th>            
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#foam').datagrid({});
  });
</script>
<?php
$this->load->view('foam/add');
?>

