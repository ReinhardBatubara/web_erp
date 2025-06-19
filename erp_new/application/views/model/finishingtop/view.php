<div id="finishingtop_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="finishingtop_add()"> Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="finishingtop_edit()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="finishingtop_delete()"> Delete</a>
</div>
<table id="finishingtop" data-options="
       url:'<?php echo site_url('finishingtop/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       title:'Finishing Top',
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:false,
       striped:true,
       toolbar:'#finishingtop_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>   
            <th field="description" width="200" halign="center">Description</th>
            <th field="finishing_type_name" width="150">Finishing Type</th>
            <th field="area" width="120" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value}">Area</th>
            <th field="size_l" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value}">L</th>
            <th field="size_w" width="50" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value}">W</th>            
            <th field="qty" width="80" align="center">Qty</th>
            <th field="total_area" width="80" align="center">M2</th>
            <th field="remark" width="250" halign="center">Remark</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#finishingtop').datagrid({
            view: detailview,
            detailFormatter: function(index, row) {
                return '<div class="finishingtop_ddv" style="padding:10px"></div>';
            },
            onExpandRow: function(index, row) {
                var finishingtop_ddv = $(this).datagrid('getRowDetail', index).find('div.finishingtop_ddv');
                finishingtop_ddv.datagrid({
                    url: '<?php echo site_url('finishingtop/get_detail_material') ?>',
                    queryParams: {
                        finishingtopid: row.id
                    },
                    fitColumns: false,
                    singleSelect: true,
                    rownumbers: true,
                    loadMsg: '',
                    height: 150,
                    width: 'auto',
                    columns: [[
                            {field: 'o_itemcode', title: 'Item Code', width: 173},
                            {field: 'o_itemdescription', title: 'Item Description', width: 373, halign: 'center'},
                            {field: 'o_qty', title: 'Qty', width: 80, align: 'center'},
                            {field: 'o_unitcode', title: 'Unit', width: 80, align: 'center'}
                        ]],
                    onResize: function() {
                        $('#finishingtop').datagrid('fixDetailRowHeight', index);
                    },
                    onLoadSuccess: function() {
                        setTimeout(function() {
                            $('#finishingtop').datagrid('fixDetailRowHeight', index);
                        }, 0);
                    }
                });
                $('#finishingtop').datagrid('fixDetailRowHeight', index);
            }
        });
    });
</script>
