<div id="mrp-toolbar" style="padding-bottom: 0px;">
  Item Code / Description : 
  <input style="width: 120px" id="mrp_detail_item_code_description_50" onkeyup="if (event.keyCode == 13) {
        joborder_mrp_search_material()
      }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" id='mrp_btn_search' plain="true" onclick="joborder_mrp_search_material()"></a>
  <!--    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" id='mrp_btn_save' plain="true" onclick="joborder_save_mrp()">Save Change</a>    -->
</div>
<table id="mrp" data-options="
       url:'<?php echo site_url('joborder/get_mrp') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:true,
       pagination:false,
       striped:true,
       idField:'id',
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#mrp-toolbar'">
  <thead>
    <tr>
      <th field="itemcode" width="60" halign="center" sortable="true">Item Code</th>
      <th field="itemdescription" width="180" halign="center" sortable="true">Item Description</th>
      <th field="unitcode" width="30" align="center" sortable="true">Unit</th>
      <th field="qty" width="50" halign="center" align="right" sortable="true">Require</th>
<!--            <th field="allowance_qty" width="60" halign="center" align="right" editor="{type:'numberbox',options: {precision: 2, min: 0,value:0}}">Allowance</th>-->
<!--            <th field="final_required" width="80" halign="center" align="right">Final Require</th>-->
      <th field="stock_onhand" width="80" halign="center" align="right">Stock on Hand</th>
      <th field="stock_onpurchase" width="80" halign="center" align="right">On Purchase</th>
      <th field="stock_allocated" width="80" halign="center" align="right">Allocated</th>      
      <th field="total_available" width="70" halign="center" align="right">Available</th>      
      <th field="required_qty" width="100" halign="center" align="right">Need to Purchase</th>
    </tr>
  </thead>
</table>
<script type="text/javascript">
  var lastIndex = -1;
  $(function() {
    $('#mrp').datagrid({
      onDblClickRow: function(rowIndex, row) {
        var row_jo = $('#mrp_joborder').datagrid('getSelected');
        if (row_jo.final_mrp == 'f') {
          $('#mrp').datagrid('beginEdit', rowIndex);
        }
        lastIndex = rowIndex;
      },
      onClickRow: function() {
        $('#mrp').datagrid('endEdit', lastIndex);
      }
    });
  });
</script>