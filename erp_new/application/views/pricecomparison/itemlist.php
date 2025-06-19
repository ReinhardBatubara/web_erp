<table id="itemlist" data-options="
       url:'<?php echo site_url('purchaserequestdetail/get') ?>',
       method:'post',
       border:false,
       title:'Item Purchase',
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#itemlist_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="purchaserequestid" hidden="true"></th>
            <th field="itemcode" width="80" halign="center">Item Code</th>
            <th field="itemdescription" width="200" halign="center">Item Description</th>
            <th field="unitcode" width="60" align="center">Unit</th>
            <th field="qty" width="80" align="center">Qty</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#itemlist').datagrid({
            onSelect: function(value, row, index) {
                $('#vendorlist').datagrid('load', {
                    purchaserequestdetailid: row.id
                });

            }
        });
    });
</script>