<div id="allocated_process-toolbar" style="padding-bottom: 2px;">
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" id='allocated_process_btn_add' plain="true" onclick="joborder_add_on_process()">Add</a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" id='allocated_process_btn_edit' plain="true" onclick="joborder_edit_on_process()">Edit</a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id='allocated_process_btn_delete' plain="true" onclick="joborder_delete_on_process()">Delete</a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-configuration" plain="true" id='allocated_process_btn_configure' onclick="joborder_configure_on_process()">Configure</a>
</div>
<table id="allocated_process" data-options="
       url:'<?php echo site_url('joborder/get_allocated_process') ?>',
       method:'post',
       title:'Item On Process',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       idField:'id',
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#allocated_process-toolbar'">
  <thead>
    <tr>
      <th field="modelcode" width="60" halign="center" sortable="true">Item Code</th>
      <th field="modelname" width="120" halign="center" sortable="true">Item Name</th>
      <th field="process" width="140" halign="center" sortable="true">Process</th>
      <th field="qty" width="40" align="center">Qty</th>            
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#allocated_process').datagrid();
  });
</script>
<div id="temp_configure_on_process"></div>
<?php
$this->load->view('unit/add');



