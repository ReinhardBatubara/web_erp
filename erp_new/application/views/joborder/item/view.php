<div id="joborderitemitem_toolbar" style="padding-bottom: 0px;">
  Code / Name :
  <input type="text" 
         class="easyui-validatebox" 
         id="joitem_code_name50" 
         style="width: 100px"
         onkeyup="if (event.keyCode == 13) {
               joborderitem_search()
             }"
         />
  PO :
  <input type="text" 
         class="easyui-validatebox" 
         id="joitem_po50"  
         style="width: 100px"
         onkeyup="if (event.keyCode == 13) {
               joborderitem_search()
             }"
         />
  Customer :
  <input type="text" 
         class="easyui-validatebox" 
         id="joitem_customer50"  
         style="width: 100px"
         onkeyup="if (event.keyCode == 13) {
               joborderitem_search()
             }"
         />
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="joborderitem_search()"></a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" id='joborderitemitem_btn_add' plain="true" onclick="joborderitem_add()">Add</a>
  <!--    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" id='joborderitemitem_btn_edit' plain="true" onclick="joborderitem_edit()">Edit Qty</a>-->
  <!--    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id='joborderitemitem_btn_delete' plain="true" onclick="joborderitem_remove()">Delete</a> -->
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-generate-barcode" plain="true" id='joborder_generate_barcode' onclick="joborder_generate_barcode()">Generate Barcode</a>
  <a href="javascript:void(0)" class="easyui-menubutton" iconCls="icon-print-barcode" plain="true"menu="#mm-joborder_print_barcode" id='mm_joborder_print_barcode'>Print Barcode</a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print-sticker" plain="true" id='joborder_print_sticker' onclick="joborder_print_sticker()">Print Sticker</a>    
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-view_detail_item" plain="true" id='joborder_btn_view_detail_item' onclick="joborder_view_detail_item()">View Detail Item</a>    
  <a href="javascript:void(0)" class="easyui-menubutton" iconCls="icon-more" id='mm_jo_more' menu="#mm-jo_more">More</a>
  <div id="mm-joborder_print_barcode" class="easyui-menu" border="false">
    <div id="joborder_print_barcode_all"  onclick="joborder_print_barcode()" iconCls="icon-print-barcode"><span>Print All</span></div>
    <div id="joborder_print_barcode_custom"  onclick="joborder_print_barcode_custom()" iconCls="icon-print"><span>Print Custom</span></div>
  </div>

  <div id="mm-jo_more" class="easyui-menu" border="false">
    <div onclick="joborderitem_edit()" id="joborderitemitem_btn_edit" iconCls="icon-edit"><span>Edit Qty</span></div>
    <div onclick="joborderitem_remove()" id="joborderitemitem_btn_delete" iconCls="icon-remove"><span>Delete</span></div>
  </div>
</div>
<table id="joborderitem" data-options="
       url:'<?php echo site_url('joborder/item_get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       idField: 'id',
       sortName:'id',
       sortOrder:'desc',
       showFooter: true,
       toolbar:'#joborderitemitem_toolbar'">
  <thead>
    <tr>
      <th field="modelcode" width="100" halign="center" sortable="true">Item Code</th>
      <th field="modelname" width="100" halign="center" sortable="true">Item Name</th>            
      <th field="itemsize_mm_w" width="30" align="center">W</th>
      <th field="itemsize_mm_d" width="30" align="center">D</th>
      <th field="itemsize_mm_h" width="30" align="center">H</th>
      <th field="finishing" width="100" halign="center" sortable="true">Finishing Std.</th>
      <th field="fabric" width="100" halign="center" sortable="true">Fabric</th>
      <th field="material" width="100" halign="center" sortable="true">Material</th>
      <th field="mirror" width="100" halign="center" sortable="true">Mirror</th>
      <th field="qty" width="70" align="center">Total</th>
      <th field="sonumber" width="100" halign="center" sortable="true">SO</th>
      <th field="po_no" width="100" halign="center" sortable="true">PO</th>
      <th field="customer" width="150" halign="center" sortable="true">Customer</th>
      <th field="notes" width="100" align="center">Notes</th>
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#joborderitem').datagrid({
      onSelect: function(value, row, index) {
        $('#allocated_process').datagrid('reload', {
          joborderitemid: row.id,
          joborderid: row.joborderid
        });
      }
    });
  });
</script>

