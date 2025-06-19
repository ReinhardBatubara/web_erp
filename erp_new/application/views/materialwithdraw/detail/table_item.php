<table id="stockoutrequestdetail" data-options="
       url:'<?php echo site_url('materialwithdrawdetail/get_available_to_out_by_warehouse') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       rownumber:true,
       striped:true,
       fitColumns:false,
       pagination:false" class="easyui-datagrid">
    <thead>        
        <tr>   
            <th field="itemcode" width="80" halign="center">Item</th>
            <th field="itemdescription" width="100" halign="center">Description</th>
            <th field="unitcode" width="50" align="center">Unit</th>
            <th field="qty" width="50" align="center">Order</th>
            <th field="qty_ots" width="60" align="center">Outstanding</th>
        </tr>
    </thead>
</table>
