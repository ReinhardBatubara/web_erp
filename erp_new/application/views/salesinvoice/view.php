<div id="salesinvoice_toolbar" style="padding-bottom: 2px;">
  <form id='salesinvoice_search_form' onsubmit="return false"  style="margin-bottom: 0px">
    Inv No
    <input type="text" name='invoice_no' style="width: 120px" onkeyup="if (event.keyCode === 13) {
          salesinvoice_search()
        }"/>
    Date From :
    <input type="text" size="15" name="datefrom" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
    To :
    <input type="text" size="15" name="dateto" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/> 
    Customer
    <input type="text" name='customer_name' style="width: 120px" onkeyup="if (event.keyCode === 13) {
          salesinvoice_search()
        }"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="salesinvoice_search()"></a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="salesinvoice_add()">Create</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="salesinvoice_edit()">Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="salesinvoice_delete()">Delete</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="salesinvoice_print()">Print</a>
  </form>
</div>
<table id="salesinvoice" data-options="
       url:'<?php echo site_url('salesinvoice/get') ?>',
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
       toolbar:'#salesinvoice_toolbar'">
  <thead>
    <tr>
      <th field="invoice_no" width="80" halign="center" sortable="true">Invoice No.</th>
      <th field="invoice_date_format" width="70" align="center" sortable="true">Date</th>
      <th field="customer_name" width="150" halign="center" sortable="true">Customer</th>
<!--            <th field="bill_to" width="150" halign="center">Bill To</th>
      <th field="ship_to" width="150" halign="center">Ship To</th>-->
      <th field="terms" width="50" align="center" sortable="true">Terms</th>
      <th field="ship_date_format" width="70" align="center" sortable="true">Ship Date</th>
      <th field="ship_via" width="60" align="center" sortable="true">Ship Via</th>
      <th field="currency" width="50" align="center" sortable="true">Curr</th>
      <th field="subtotal" width="100" halign="center" align="right">Sub Total</th>
      <th field="discount" width="100" halign="center" align="right">Discount</th>
      <th field="tax" width="100" halign="center" align="right">Tax</th>
      <th field="totalinvoice" width="100" halign="center" align="right">Total Invoice</th>
      <th field="downpayment" width="100" halign="center" align="right">Down Payment</th>
      <th field="balancepayment" width="100" halign="center" align="right">Balance Payment</th>
      <th field="description" width="250">Description</th>
    </tr>
  </thead>
</table>
<script type="text/javascript">
  $(function() {
    $('#salesinvoice').datagrid({
      onSelect: function(value, row, index) {
        $('#salesinvoicedetail').datagrid('reload', {
          salesinvoiceid: row.id
        });
      }
    });
  });
</script>
<div id="si_dialog"></div>