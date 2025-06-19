<div id="po_plan_toolbar" style="padding-bottom: 0;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="purchaserequest_po_plan_edit()">Edit</a>
</div>
<table id="po_plan" data-options="
       url:'<?php echo site_url('purchaserequest/get_po_plan') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       striped:true,
       title:'Purchase Order Planning',
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       toolbar:'#po_plan_toolbar'">
    <thead>
        <tr>
            <th field="vendor_name" width="200" halign="center" data-options="formatter:function(val,row){return val+' - <b>'+row.vendor_code+'</b>';}">Vendor</th>            
            <th field="currency" width="80" align="center">Currency</th>             
            <th field="sub_total" width="120" halign="center" align="right" formatter='formatPrice'>Amount</th>               
            <th field="discount" width="120" halign="center" align="right">Discount</th>                
            <!--<th field="sub_total_discount" width="120" halign="center" align="right" formatter='formatPrice'>Amount-Discount</th>-->                    
            <th field="tax" width="120" halign="center" align="right">Tax</th>
            <th field="total_amount" width="120" halign="center" align="right" formatter='formatPrice'>Grand Total</th>
            <th field="expected_delivery_date" width="90" align="center">Expected Delivery Date</th>            
            <th field="payment_terms" width="120" halign="center">Payment Term</th>            
            <th field="description" width="220" halign="center">Description</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#po_plan').datagrid();
    });
</script>