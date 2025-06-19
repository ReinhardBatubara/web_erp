<div id="joborderoutsource_toolbar" style="padding-bottom: 2px;">    
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" id='joborderoutsource_btn_add' plain="true" onclick="joborder_outsource_add()">Add</a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id='joborderoutsource_btn_delete' plain="true" onclick="joborder_outsource_remove()">Delete</a>    
</div>
<table id="joborderoutsource" data-options="
       url:'<?php echo site_url('joborder/outsource_get') ?>',
       method:'post',
       border:false,
       singleSelect:true,       
       fit:true,
       pageList: [30, 50, 70, 90, 110],
       pageSize:30,
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       idField: 'id',
       showFooter: true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#joborderoutsource_toolbar'">
  <thead>
    <tr>
      <th field="modelcode" width="60" halign="center" sortable="true">Item Code</th>
      <th field="modelname" width="100" halign="center" sortable="true">Item Name</th>            
      <th field="qty" width="25" align="center">Qty</th>
      <th field="outsourcetype" width="50" halign="center" sortable="true">Type</th>
      <th field="vendor" width="110" halign="center" sortable="true">Vendor</th>
      <th field="include_material" width="40" align="center" data-options="formatter:function(value,row,index){return (value == 't' ? 'Yes' : 'No')}">Inc. Mat</th>
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#joborderoutsource').datagrid({});
  });
</script>
<?php
$this->load->view('joborder/outsource/add');
