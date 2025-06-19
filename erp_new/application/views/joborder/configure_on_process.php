<div id="configure_on_process_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="joborder_set_reference_item_on_process()">Set Reference</a>
</div>
<table id="configure_on_process" data-options="
       url:'<?php echo site_url('joborder/get_on_process_item/' . $joborderid) ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       pagination:false,
       striped:true,
       toolbar:'#configure_on_process_toolbar'">
    <thead>
        <tr>
            <th field="serial" width="65" align="center">Serial</th>
            <th field="sonumber" width="75" align="center">SO NO</th>
            <th field="po_no" width="80" align="center">PO NO</th>            
            <th field="customer" width="150" halign="center">Customer</th>
            <th field="itemcode" width="80" halign="center">Item Code</th>
            <th field="itemname" width="150" halign="center">Item Name</th>
            <th field="processname" width="100" halign="center">Stock From</th>
            <th field="ref_stock_serial" width="70" halign="center">Reference</th>
            <th field="start_process" width="160" align="hcenter">Production Starting Process</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#configure_on_process').datagrid();
    });
</script>

