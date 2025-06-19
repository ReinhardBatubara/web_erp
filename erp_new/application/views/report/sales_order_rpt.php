<div id="sales_order_rpt_toolbar" style="padding-bottom: 0px;">
  <form id="sales_order_rpt_form_search" style="margin-bottom: 0">
    Date From :
    <input type="text" size="15" name="datefrom" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" required="true"/>
    To :
    <input type="text" size="15" name="dateto" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" required="true"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="report_sales_order_rpt_search()"></a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-view_detail_item" plain="true" onclick="report_sales_order_rpt_preview()">Preview</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="report_sales_order_rpt_print()">Print</a>
  </form>
</div>
<table id="sales_order_rpt" data-options="
       url:'<?php echo site_url('report/sales_order_rpt_get') ?>',
       method:'post',
       title:'Report Sales Order',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#sales_order_rpt_toolbar'">
  <thead>
    <tr>     
      <th field="so_no" width="90" halign="center" sortable="true">SO</th>
      <th field="date" formatter="myFormatDate" width="70" halign="center" sortable="true">Date</th>
      <th field="po_no" width="90" halign="center" sortable="true">PO</th>
      <th field="customer" width="150" halign="center" sortable="true">Customer</th>
      <th field="item_code" width="100" halign="center" sortable="true">Item Code</th>
      <th field="item_description" width="180" halign="center" sortable="true">Item Description</th>
      <th field="qty" width="50" halign="center" sortable="true">Qty</th>
      <th field="price" width="70" halign="center" align="right" sortable="true">Price</th>
      <th field="currency" width="70" halign="center" align="right" sortable="true">Currency</th>
      <th field="down_payment" width="180" halign="center" sortable="true">Down Payment</th>
    </tr>
  </thead>
</table>
<script>
  $(function() {
    $('#sales_order_rpt').datagrid({});
  });
</script>


