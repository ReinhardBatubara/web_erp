<div id="salesorderdetail_toolbar" style="padding-bottom: 0px;">
    Item Code : 
    <input type="text" 
           size="12" 
           class="easyui-validatebox" 
           id="salesorderdetail_code_s" 
           onkeyup="if (event.keyCode === 13) {
                       salesorderdetail_search();
                   }"
           />       
    Item Name : 
    <input type="text" 
           size="20" 
           class="easyui-validatebox" 
           id="salesorderdetail_name_s" 
           onkeyup="if (event.keyCode === 13) {
                       salesorderdetail_search();
                   }"
           />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" id="salesorderdetail_search" plain="true" onclick="salesorderdetail_search()">Search</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" id="salesorderdetail_add" plain="true" onclick="salesorderdetail_add()">Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" id="salesorderdetail_edit" plain="true" onclick="salesorderdetail_edit()">Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" id="salesorderdetail_delete" plain="true" onclick="salesorderdetail_delete()">Delete</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-finishing-edit" id="salesorderdetail_edit_finishing" plain="true" onclick="salesorderdetail_edit_finishing()">Edit Finishing</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-finishing-edit" id="salesorderdetail_edit_upholstry" plain="true" onclick="salesorderdetail_upholstry()">Edit Upholstry</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit-specification" id="salesorderdetail_edit_specification" plain="true" onclick="salesorderdetail_edit_specification()">Edit Specification</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-view_detail_item" id="salesorderdetail_preview_detail" plain="true" onclick="salesorderdetail_preview_detail()">Preview Detail</a>

    <!--    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-close" plain="true" onclick="salesorderdetail_cancel()">Cancel</a>-->
</div>
<table id="salesorderdetail" data-options="
       url:'<?php echo site_url('salesorder/detail_get') ?>',
       title:'Order Detail',
       method:'post',
       border:true,
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       idField: 'id',
       showFooter: true,
       toolbar:'#salesorderdetail_toolbar'">
    <thead>
        <tr>            
            <th field="customer_code" width="100" halign="center">Customer Code</th>   
            <th field="code" width="100" halign="center">Item Code</th>   
            <th field="name" width="150" halign="center">Item Name</th>
            <th field="qty" width="40" align="center">Qty</th>
            <th field="unitprice" width="100" halign="center" align="right" formatter="formatPrice">Unit Price</th>
            <th field="discount" width="100" halign="center" align="right" formatter="formatPrice">Discount</th>
            <th field="tax" width="100" halign="center" align="right" formatter="formatPrice">Tax</th>
            <th field="amount" width="100" halign="center" align="right" formatter="formatPrice">Amount</th>
            <th field="ots" width="90" halign="center" align="center">Outstanding</th>
            <th field="finishing" width="200" halign="center" align="left">Finishing</th>
            <th field="material" width="200" halign="center" align="left">Material</th>
            <th field="top" width="200" halign="center" align="left">Top</th>
            <th field="mirrorglass" width="200" halign="center" align="left">Mirror/Glass</th>
            <th field="foam" width="200" halign="center" align="left">Foam</th>
            <th field="interliner" width="200" halign="center" align="left">Interliner</th>
            <th field="fabric" width="200" halign="center" align="left">Fabric</th>
            <th field="furring" width="200" halign="center" align="left">Furring</th>
            <th field="accessories" width="200" halign="center" align="left">Accessories</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#salesorderdetail').datagrid({});
    });
</script>
<script src="<?php echo base_url() ?>js/salesorderdetail.js"></script>

