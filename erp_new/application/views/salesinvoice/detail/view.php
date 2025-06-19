<div id="salesinvoicedetail_toolbar" style="padding-bottom: 2px;">
    Item Code : <input type="text" size="12" class="easyui-validatebox" id="salesinvoicedetail_code_s" onkeyup="if (event.keyCode === 13) {
        salesinvoicedetail_search();
    }"/>       
    Item Name : <input type="text" size="20" class="easyui-validatebox" id="salesinvoicedetail_name_s" onkeyup="if (event.keyCode === 13) {
    salesinvoicedetail_search();
}"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="salesinvoicedetail_search()"> Search</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="salesinvoicedetail_add()"> Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="salesinvoicedetail_edit()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="salesinvoicedetail_delete()"> Delete</a>
</div>
<table id="salesinvoicedetail" data-options="
       url:'<?php echo site_url('salesinvoice/get_detail') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#salesinvoicedetail_toolbar'">
    <thead>
        <tr>          
            <th field="modelcode" width="100" halign="center">Item Code</th>   
            <th field="modelname" width="150" halign="center">Item Name</th>
            <th field="qty" width="100" align="center">Qty</th>
            <th field="unitprice" width="100" halign="center" align="right">Unit Price</th>
            <th field="discount" width="100" halign="center" align="right">Discount</th>
            <th field="tax" width="100" halign="center" align="right">Tax</th>
            <th field="amount" width="100" halign="center" align="right">Amount</th>
            <th field="ramark" width="100" halign="center" align="right">Remark</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
$(function() {
$('#salesinvoicedetail').datagrid();
});
</script>

