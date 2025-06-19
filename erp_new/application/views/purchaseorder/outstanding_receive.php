<div id="po_outstanding_receive-toolbar" style="padding: 2px;height: 23px;">
    <form id="po_outstanding_search-form" method="post" novalidate onsubmit="return false;">
        Item Code :
        <input type="text" 
               size="8" 
               class="easyui-validatebox" 
               name="item_code" 
               onkeypress="if (event.keyCode === 13) {purchaseorder_outstanding_search()}"
               />    
        Item Description : 
        <input type="text" 
               size="10" 
               class="easyui-validatebox" 
               name="item_description" 
               onkeypress="if (event.keyCode === 13) {purchaseorder_outstanding_search()}"
               />
        PO # :
        <input type="text" 
               size="8" 
               class="easyui-validatebox" 
               name="po_number" 
               onkeypress="if (event.keyCode === 13) {purchaseorder_outstanding_search()}"
               />
        PR # : 
        <input type="text" 
               size="8" 
               name="pr_number" 
               class="easyui-validatebox"
               onkeypress="if (event.keyCode === 13) {purchaseorder_outstanding_search()}"
               />
        Vendor : 
        <input name="vendorid" 
               class="easyui-combobox" 
               valueField="id"
               textField ="text"
               url="<?php echo site_url('vendor/get_remote_data') ?>" 
               mode="remote" style="width: 100px"
               panelWidth="150"
               />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="purchaseorder_outstanding_search()"> Search</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="purchaseorder_outstanding_print()">Print</a>
    </form>
</div>
<table id="po_outstanding_receive" data-options="
       url:'<?php echo site_url('purchaseorder/get_outstanding_item') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       striped:true,
       rownumbers:true,
       pageList: [30, 50, 70, 90, 110],
       fitColumns:true,
       pagination:true,
       toolbar:'#po_outstanding_receive-toolbar'">
    <thead>
        <tr>
            <th field="item_code" width="100" halign="center">Item Code</th>            
            <th field="item_description" width="200" halign="center">Item Description</th>
            <th field="qty_ots" width="70" align="center">Outstanding</th>
            <th field="qty" width="70" align="center">Qty Order</th>
            <th field="po_number" width="80" halign="center">PO #</th>
            <th field="pr_number" width="80" halign="center">PR #</th>
            <th field="vendor" width="100" halign="center">Vendor</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#po_outstanding_receive').datagrid();
    });
</script>
