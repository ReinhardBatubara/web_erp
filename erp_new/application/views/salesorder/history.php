<div id="salesorder_history_toolbar" style="padding-bottom: 0px;">
  <form id="salesorder_history_search_form" style="margin: 0px;">
    Date From :
    <input type="text" 
           style="width: 90px" 
           class="easyui-datebox" 
           name="datefrom" 
           data-options="formatter:myformatter,parser:myparser"
           id="salesorder_history_search_datefrom"
           />
    To : 
    <input type="text" 
           style="width: 90px" 
           class="easyui-datebox" 
           name="dateto" 
           data-options="formatter:myformatter,parser:myparser"
           id="salesorder_history_search_dateto"
           />
    Customer :
    <input class="easyui-combobox" name="customerid" id="salesorder_history_customerid_s" data-options="
           url: '<?php echo site_url('customer/get') ?>',
           method: 'post',
           valueField: 'id',
           textField: 'name',
           panelHeight: '200',
           panelWidth:'150',
           mode: 'remote',
           formatter: format_salesorder_history_customerid_s"
           style="width: 100px">
    <script type="text/javascript">
      function format_salesorder_history_customerid_s(row) {
        return '<span>' + row.code + '<br/>' + row.name + '</span>';
      }
    </script>
    SO :
    <input type="text" 
           name="sonumber"  
           style="width: 100px;" 
           class="easyui-validatebox" 
           onkeyup="if (event.keyCode == 13) {
                 salesorder_history_search()
               }"/>
    Item :
    <input type="text" 
           name="item" 
           style="width: 100px;" 
           class="easyui-validatebox"
           onkeyup="if (event.keyCode == 13) {
                 salesorder_history_search()
               }"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="salesorder_history_search()"></a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="salesorder_history_print()">Print</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-excel" plain="true" onclick="salesorder_history_excel()">Excel</a>    
  </form>
</div>
<table id="salesorder_history" data-options="
       url:'<?php echo site_url('salesorder/history_get') ?>',
       method:'post',
       title:'Order Item History',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:50,
       pageList: [50, 100, 150, 200],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       sortName:'id',
       sortOrder:'desc',
       striped:true,
       toolbar:'#salesorder_history_toolbar'">
  <thead>
    <tr>
      <th field="customer" width="100" halign="center" sortable="true">Customer</th>      
      <th field="sonumber" width="80" align="center" sortable="true">SO</th>
      <th field="date" width="70" align="center" formatter="myFormatDate" sortable="true">Date</th>      
      <th field="itemcode" width="100" halign="center" sortable="true">Item Code</th>
      <th field="itemdescription" width="150" halign="center" sortable="true">Item Description</th>
      <th field="qty" width="50" align="center">Qty</th>
      <th field="price" width="70" halign="center" align="right" formatter="formatPrice" sortable="true">Price</th>
      <th field="total_price" width="90" halign="center" align="right" formatter="formatPrice">Total Price</th>            
      <th field="currency" width="70" align="center" sortable="true">Currency</th>
      <th field="qty_ship" width="70" align="center">Qty Shipped</th>
      <th field="balance_qty" width="80" align="center">Balance Qty</th>

    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#salesorder_history').datagrid();
  });
</script>

