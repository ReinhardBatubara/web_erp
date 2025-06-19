<div id="model_process_stock_toolbar" style="padding-bottom: 2px;">
  <form id="model_process_stock_search" style="margin: 0">
    Model : 
    <input size="10" 
           class="easyui-validatebox" 
           name="modelcode"
           onkeypress="if (event.keyCode === 13) {
                 model_process_stock_search();
               }"
           />   
    Process : 
    <input type="text" 
           name="processid" 
           id="model_process_stock_processid" 
           mode="remote" 
           style="width: 80px"
           />
    <script type="text/javascript">
      $('#model_process_stock_processid').combogrid({
        panelWidth: 210,
        idField: 'id',
        textField: 'name',
        url: '<?php echo site_url('tracking/get_tracking_process_for_combo') ?>',
        columns: [[
            {field: 'name', title: 'Name', width: 200}
          ]]
      });
    </script>
    <a href="javascript:void(0)" 
       class="easyui-linkbutton" 
       iconCls="icon-search" 
       plain="true" 
       onclick="model_process_stock_search()">Search</a>
    <a href="javascript:void(0)" 
       class="easyui-linkbutton" 
       iconCls="icon-edit" 
       plain="true" 
       onclick="model_process_stock_edit()">Edit Stock</a>
  </form>
</div>
<table id="model_process_stock" data-options="
       url:'<?php echo site_url('modelstock/get_process_stock') ?>',
       method:'post',
       title:'Process Stock',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#model_process_stock_toolbar'">
  <thead>
    <tr>        
      <th field="modelcode" width="200" halign="center" sortable="true">Model</th>
      <th field="processname" width="120" halign="center" sortable="true">Process</th>
      <th field="stock" width="80" align="center" rowspan="2">Stock</th>
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#model_process_stock').datagrid({
    });
  });
</script>

<div id="model_process_stock-form" class="easyui-dialog" 
     data-options="iconCls:'icon-save',resizable:true,modal:true"
     style="width:300px; padding: 5px 5px" closed="true" buttons="#model_process_stock-button">
  <form id="model_process_stock-input" method="post" novalidate>
    <table width="100%">
      <tr>
        <td width="40%" align="right"><label class="field_label">Stock :</label></td>
        <td width="60%"><input type="text" name="stock" size="10" style="text-align: center" class="easyui-numberbox" required="true"/></td>
      </tr>
    </table>
  </form>
</div>
<div id="model_process_stock-button">
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="model_process_stock_save()">Save</a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#model_process_stock-form').dialog('close')">Cancel</a>
</div>