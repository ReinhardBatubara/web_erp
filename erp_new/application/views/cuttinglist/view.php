<div id="cuttinglist_toolbar" style="padding-bottom: 0">
  <form id="cuttinglist_search_from" style="margin-bottom: 0px;">
    Date From : 
    <input type="text" 
           style="width: 90px;" 
           name="datefrom" 
           class="easyui-datebox" 
           data-options="formatter:myformatter,parser:myparser"
           />
    To : 
    <input type="text" 
           size="13" 
           style="width: 90px;"
           name="dateto" 
           class="easyui-datebox"
           data-options="formatter:myformatter,parser:myparser"
           />
    JO : 
    <input type="text" 
           size="12" 
           class="easyui-validatebox" 
           name="jo_number"
           onkeypress="if (event.keyCode === 13) {
                 cuttinglist_search();
               }"
           />
    Item Code / Name: 
    <input type="text" 
           size="12" 
           class="easyui-validatebox"
           name="item_code_name"
           onkeypress="if (event.keyCode === 13) {
                 cuttinglist_search();
               }"
           />
    Wood Category
    <input type="text" 
           name="woodcategory" 
           class="easyui-combobox"
           url="<?php echo site_url('cuttinglist/get_woodcategory') ?>"
           method="post"
           panelHeight="200"
           valueField="woodcategory"
           textField="woodcategory"
           style="width: 100px"
           />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="cuttinglist_search()"></a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="cuttinglist_add()">Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="cuttinglist_edit()">Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="cuttinglist_delete()">Delete</a>
  </form>
</div>
<table id="cuttinglist" data-options="
       url:'<?php echo site_url('cuttinglist/get') ?>',
       method:'post',
       title:'Cutting List',
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
       toolbar:'#cuttinglist_toolbar'">
  <thead>
    <tr>       
      <th field="date" width="80" align="center" rowspan="2" formatter="myFormatDate" sortable="true">Date</th>
      <th field="joborder_no" width="120" align="center" rowspan="2" sortable="true">JO NO</th>
      <th field="item_code" width="120" halign="center" rowspan="2" sortable="true">Item Code</th>
      <th field="item_name" width="120" halign="center" rowspan="2" sortable="true">Item Name</th>            
      <th field="woodcategory" width="120" align="center" rowspan="2" sortable="true">Wood Category</th>
      <th field="qty" width="40" align="center" rowspan="2">Qty</th>
      <th width="140" halign="center" colspan="2">Size (M3)</th>
      <th width="140" halign="center" colspan="2">Total (M3)</th>
    </tr>
    <tr>
      <th field="final_size" width="70" align="center">Final</th>
      <th field="raw_size" width="70" align="center">Raw</th>
      <th field="total_final_size" width="70" align="center">Final</th>
      <th field="total_raw_size" width="70" align="center">Raw</th>
    </tr>
  </thead>
</table>
<script>
  $(function() {
    $('#cuttinglist').datagrid({});
  });
</script>