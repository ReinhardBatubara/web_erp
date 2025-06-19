<div id="carvingpricelist_toolbar" style="padding-bottom: 0px;">
  <form id="carvingpricelist_search_form" style="margin-bottom: 0px" onsubmit="return false;">
    Item Code/Name: 
    <input type="text" 
           size="25" 
           name="itemcode" 
           class="easyui-validatebox"
           onkeyup="if (event.keyCode == 13) {
                 carvingpricelist_search()
               }"/>        
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="carvingpricelist_search()"></a>        
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="carvingpricelist_add()">Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="carvingpricelist_edit()">Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="carvingpricelist_delete()">Delete</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="carvingpricelist_print()">Print</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="carvingpricelist_excel()">Export to Excel</a>
  </form>
</div>
<table id="carvingpricelist" data-options="
       url:'<?php echo site_url('carvingpricelist/get') ?>',
       method:'post',
       title: 'Carving Price List',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       idField:'id',
       autoRowHeight:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#carvingpricelist_toolbar'">
  <thead>
    <tr>
      <th field="image_location" width="120" halign="center" rowspan="2">Product Photo</th>
      <th field="code" width="90" halign="center" rowspan="2" sortable="true">Item Code</th>
      <th field="originalcode" width="90" halign="center" rowspan="2" sortable="true">Original Code</th>
      <th field="name" width="180" halign="center" rowspan="2" sortable="true">Item Name</th>
      <th align="center" colspan="3">Item Size (MM)</th>
      <th field="price" width="100" align="right" halign='center' rowspan="2" formatter="formatPrice" sortable="true">Price</th>
      <th field="date_approve" width="80" align="center" rowspan="2" formatter="myFormatDate" sortable="true">Date Approved</th>
      <th field="name_approved_by" width="100" halign="center" rowspan="2" sortable="true">Approved By</th>
      <th field="remark" width="400" rowspan="2">Remark</th>
    </tr>
    <tr>
      <th field="itemsize_mm_w" width="50" align="center">W</th>
      <th field="itemsize_mm_d" width="50" align="center">D</th>
      <th field="itemsize_mm_h" width="50" align="center">H</th>
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#carvingpricelist').datagrid({
    });
  });
</script>

