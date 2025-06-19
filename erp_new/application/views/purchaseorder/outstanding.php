<div id="po_list_outstanding_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="goodsreceive_search_po_list_outstanding_receive()"> Search</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" id='btn_po_list_outstanding_receive' iconCls="icon-receive" plain="true" onclick="goodsreceive_receive()">Receive</a>
</div>
<table id="po_list_outstanding" data-options="
       url:'<?php echo site_url('purchaseorder/get_available_to_receive_by_warehouse') ?>',
       method:'post',
       title:'PO Outstanding',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       idField:'id',
       toolbar:'#po_list_outstanding_toolbar'">
    <thead>
        <tr>           
            <th field="number" width="100" align="center">PO NO</th>
            <th field="date_modify" width="120" align="center">Date</th>
            <th field="vendor" width="150" halign="center">Vendor</th>            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#po_list_outstanding').datagrid();
    });
</script>