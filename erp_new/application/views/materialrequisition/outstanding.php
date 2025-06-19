<div id="materialrequisition_outstanding-toolbar" style="padding-bottom: 2px;">
    <form id="materialrequisition_outstanding_search-form" method="post" novalidate onsubmit="return false;" style="margin-bottom: 0px;">    
        MR No # :
        <input type="text" id="materialrequisition_outstandingid" name="materialrequisitionid" mode="remote" style="width: 150px"/>
        <script type="text/javascript">
            $('#materialrequisition_outstandingid').combogrid({
                panelWidth: 300,
                panelHeight: 200,
                idField: 'id',
                textField: 'number',
                url: '<?php echo site_url('materialrequisition/get_by_item_outstanding') ?>',
                columns: [[
                        {field: 'number', title: 'MR No #', width: 90},
                        {field: 'date_format', title: 'Date', align:'center', width: 90},
                        {field: 'required_date_format', title: 'Required Date',align:'center', width: 90}
                    ]],
                onSelect:function(rowIndex, rowData){
                    $('#materialrequisition_outstanding').datagrid('reload',{
                        materialrequisitionid: rowData.id
                    })
                }
            });
        </script>
        Item Code :
        <input type="text" 
               size="8" 
               class="easyui-validatebox" 
               name="itemcode" 
               onkeypress="if (event.keyCode === 13) {materialrequisition_outstanding_search()}"
               />    
        Item Description : 
        <input type="text" 
               size="12" 
               class="easyui-validatebox" 
               name="itemdescription" 
               onkeypress="if (event.keyCode === 13) {materialrequisition_outstanding_search()}"
               />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="materialrequisition_outstanding_search()"> Search</a>
    </form>
</div>
<table id="materialrequisition_outstanding" data-options="
       url:'<?php echo site_url('materialrequisitiondetail/get_outstanding') ?>',
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
       toolbar:'#materialrequisition_outstanding-toolbar'">
    <thead>
        <tr>
            <th field="mr_no" width="100" halign="center">MR NO #</th>
            <th field="itemcode" width="100" halign="center">Item Code</th>
            <th field="itemdescription" width="200" halign="center">Item Description</th>
            <th field="unitcode" width="70" align="center">Unit Code</th>
            <th field="qty_request" width="80" align="center">Qty Request</th>
            <th field="qty_ots" width="80" align="center">Outstanding</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#materialrequisition_outstanding').datagrid();
    });
</script>
