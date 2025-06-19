<div id="pritemdetail_toolbar" style="padding-bottom: 0;">
    <form onsubmit="return false" id='pr_list_67' style="margin: 0">
        Item Code / Description: 
        <input type="text" 
               size="12" 
               name='item_code_desc'
               class="easyui-validatebox"
               onkeypress="if (event.keyCode === 13) {
                           pritem_search_88();
                       }"
               />   
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="pritem_search_88()"></a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="pritem_edit()">Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="pritem_delete()">Delete</a>
    </form>
</div>
<table id="pritemdetail" data-options="
       url:'<?php echo site_url('purchaserequestdetail/get_all_detail_item/' . $pritemid) ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       pagination:false,
       striped:true,
       toolbar:'#pritemdetail_toolbar'">
    <thead>
        <tr>       
            <th field="itemcode" width="100" align="center">Item Code</th>
            <th field="itemdescription" width="250" halign="center">Item Description</th>
            <th field="unitcode" width="50" align="center">Unit</th>
            <th field="qty" width="50" align="center">Qty</th>        
            <th field="mr_no" width="80" align="center">MR</th>    
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#pritemdetail').datagrid();
    });
</script>

