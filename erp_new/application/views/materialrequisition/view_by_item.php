<div id="materialrequisitionitem-toolbar" style="padding-bottom: 0px;">
    <form id="materialrequisitionitem_search-form" method="post" novalidate onsubmit="return false;" style="margin-bottom: 0px;">
        MR NO :
        <input type="text" 
               name="mr_no"
               size="10"
               onkeyup="if (event.keyCode === 13) {materialrequisition_item_search()}"/>
        Date From :
        <input type="text" 
               size="12" 
               class="easyui-datebox" 
               name="datefrom" 
               data-options="formatter:myformatter,parser:myparser"
               />
        To :
        <input type="text" 
               size="12" 
               class="easyui-datebox" 
               name="dateto" 
               data-options="formatter:myformatter,parser:myparser"
               />
        Item Code :
        <input type="text" 
               size="8" 
               class="easyui-validatebox" 
               name="itemcode" 
               onkeypress="if (event.keyCode === 13) {materialrequisition_item_search()}"
               />    
        Item Description : 
        <input type="text" 
               size="10" 
               class="easyui-validatebox" 
               name="itemdescription" 
               onkeypress="if (event.keyCode === 13) {materialrequisition_item_search()}"
               />
        Status 
        <select class="easyui-combobox" name="status" editable="false" panelHeight="auto" data-options="onSelect:function(rec){materialrequisition_item_search()}">
            <option value="-1">All</option>
            <option value="1">Purchased</option>
            <option value="2" selected>Outstanding</option>
            <option value="3">Closed</option>
        </select>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="materialrequisition_item_search()"> Search</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-close" plain="true" onclick="materialrequisition_item_change_status('close')">Close</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-open" plain="true" onclick="materialrequisition_item_change_status('open')">Open</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-create" plain="true" onclick="materialrequisition_item_create_pr()">Create PR</a>
    </form>
</div>

<table id="materialrequisitionitem" data-options="
       url:'<?php echo site_url('materialrequisitionitem/get') ?>',
       method:'post',
       title:'Material Requisition Items',
       border:true,
       singleSelect:false,
       fit:true,
       pageSize:30,
       striped:true,
       rownumbers:true,
       pageList: [30, 50, 70, 90, 110],
       fitColumns:true,
       pagination:true,
       nowrap:false,
       idField:'id',
       sortName:'mr_no',
       sortOrder:'desc',
       toolbar:'#materialrequisitionitem-toolbar'">
    <thead>
        <tr>
            <th field="mr_detail_ckck" checkbox="true"></th>
            <th field="mr_no" width="100" halign="center" sortable="true">MR NO</th>
            <th field="date" width="80" formatter="myFormatDate" align="center" sortable="true">Date</th>
            <th field="itemcode" width="100" halign="center" sortable="true">Item Code</th>
            <th field="itemdescription" width="400" halign="center" sortable="true">Item Description</th>
            <th field="unitcode" width="70" align="center" sortable="true">Unit Code</th>
            <th field="qty_request" width="80" align="center" sortable="true">Qty Request</th>
            <th field="qty_ots" width="80" align="center" sortable="true">Ots Purchase</th>
            <th field="status" width="100" align="center" sortable="true" data-options="formatter:function(value,row,index){return (parseFloat(row.qty_ots)==0 ? 'purchased' : value)}">Status</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#materialrequisitionitem').datagrid({
            onLoadSuccess:function(data){
                $('#materialrequisitionitem').datagrid('unselectAll');
                $('#materialrequisitionitem').datagrid('uncheckAll');
            }
        });
    });
</script>
<div id="mr_item_dialog"></div>