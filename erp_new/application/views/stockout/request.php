<div id="stockoutrequest_toolbar" style="padding-bottom: 0;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-purchase_order" plain="true" onclick="stockout_request_create()"> Create Stock Out</a>  
</div>
<table id="stockoutrequest" data-options="
       url: '<?php echo site_url('materialwithdraw/get_list_to_out') ?>',
       method:'post',
       border:true,
       title:'Request to Out',
       singleSelect:true,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination: true,
       striped:true,
       toolbar:'#stockoutrequest_toolbar'">
    <thead>
        <tr>
            <th field="chck" checkbox="true"></th>
            <th field="number" width="100" halign="center">MW NO</th>
            <th field="date" formatter="myFormatDate" width="100" align="center">Date</th>
            <th field="department" width="150" halign="center">Department</th>
            <th field="employeerequest" width="150" halign="center">Requested By</th>
            <th field="must_receive_at" formatter="myFormatDate" width="120" align="center">Must Receive At</th>
            <th field="remark" width="350">Remark</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#stockoutrequest').datagrid({
            view: detailview, 
            detailFormatter: function(index, row) {
                return '<div class="ddv" style="padding:10px"></div>';
            },
            onExpandRow: function(index, row) {
                var ddv = $(this).datagrid('getRowDetail', index).find('div.ddv');
                ddv.datagrid({
                    url: '<?php echo site_url('materialwithdrawdetail/get_available_to_out_by_warehouse') ?>',
                    queryParams: {
                        materialwithdrawid: row.id
                    },
                    fitColumns: true,
                    singleSelect: true,
                    rownumbers: true,
                    height: 80,
                    width: 480,
                    columns: [[
                            {field: 'itemcode', title: 'Item', width: 80},
                            {field: 'itemdescription', title: 'Description', width: 100, halign: 'center'},
                            {field: 'unitcode', title: 'Unit', width: 50, align: 'center'},
                            {field: 'qty', title: 'Order', width: 50, align: 'center'},
                            {field: 'qty_ots', title: 'Outstanding', width: 50, align: 'center'}
                        ]],
                    onResize: function() {
                        $('#stockoutrequest').datagrid('fixDetailRowHeight', index);
                    },
                    onLoadSuccess: function() {
                        setTimeout(function() {
                            $('#stockoutrequest').datagrid('fixDetailRowHeight', index);
                        }, 0);
                    }
                });
                $('#stockoutrequest').datagrid('fixDetailRowHeight', index);
            }
            //            onSelect: function(value, row, index) {
            //                $('#stockoutrequestdetail').datagrid('reload', {
            //                    materialwithdrawid: row.id
            //                });
            //            }
        }).datagrid('getPager').pagination({
            pageList: [30, 50, 70, 90, 110]
        });
    });
</script>

