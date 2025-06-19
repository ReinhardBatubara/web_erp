<div id="stockout_wating_to_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" id='btn_stockout_receive' iconCls="icon-receive" plain="true" onclick="stockout_receive()">Receive</a>    
</div>
<table id="stockout_wating_to_receive"></table>
<script type="text/javascript">
    $(function() {
        $('#stockout_wating_to_receive').datagrid({
            url: '<?php echo site_url('stockout/get_wating_to_receive') ?>',
            method: 'post',
            border: false,
            singleSelect: true,
            fit: true,
            pageSize: 30,
            rownumbers: true,
            fitColumns: true,
            striped: true,
            toolbar: '#stockout_wating_to_toolbar',
            columns: [[
                    {field: 'swtr_chck', checkbox: true},
                    {field: 'stockout_number', title: 'STO NO', width: 100, halign: 'center'},
                    {field: 'stockout_date_format', title: 'Date', width: 70, align: 'center'},
                    {field: 'employee_outby', title: 'Out By', width: 100, halign: 'center'},
                    {field: 'remark', title: 'Remark', width: 130, halign: 'center'},
                    {field: 'receive_date_format', title: 'Receive Date', width: 70, align: 'center'}
                ]],
            rowStyler: function(index, row) {
                if (row.receive_date_format === '') {
                    return 'background-color:#fec0c1;'; //New PO
                }
            },
            view: detailview,
            detailFormatter: function(index, row) {
                return '<div class="ddv" style="padding:10px"></div>';
            },
            onExpandRow: function(index, row) {
                var ddv = $(this).datagrid('getRowDetail', index).find('div.ddv');
                ddv.datagrid({
                    url: '<?php echo site_url('stockoutdetail/get') ?>',
                    queryParams: {
                        stockoutid: row.id
                    },
                    fitColumns: true,
                    singleSelect: true,
                    rownumbers: true,
                    loadMsg: '',
                    height: 60,
                    width: 'auto',
                    columns: [[
                            {field: 'itemcode', title: 'Item', width: 80},
                            {field: 'itemdescription', title: 'Description', width: 100, halign: 'center'},
                            {field: 'unitcode', title: 'Unit', width: 50, align: 'center'},
                            {field: 'qty', title: 'Qty', width: 50, align: 'center'}
                        ]],
                    onResize: function() {
                        $('#stockout_wating_to_receive').datagrid('fixDetailRowHeight', index);
                    },
                    onLoadSuccess: function() {
                        setTimeout(function() {
                            $('#stockout_wating_to_receive').datagrid('fixDetailRowHeight', index);
                        }, 0);
                    }
                });
                $('#stockout_wating_to_receive').datagrid('fixDetailRowHeight', index);
            },
            onSelect: function(value, row, index) {
//                alert(row.receivedate);
                if (row.receivedate === null) {
                    $('#btn_stockout_receive').linkbutton('enable');
                } else {
                    $('#btn_stockout_receive').linkbutton('disable');
                }
            }
        }).datagrid('getPager').pagination({
            pageList: [30, 50, 70, 90, 110]
        });
    });
</script>