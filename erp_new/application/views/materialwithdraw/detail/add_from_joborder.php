<div id="mw_add_detail_jo_toolbar" style="padding-bottom:0">
    <form id="mw_list_material_jo_search_form" style="margin:0;">
        Item Code : 
        <input type="text" 
               size="12" 
               name="itemcode"
               class="easyui-validatebox"
               onkeypress="if (event.keyCode === 13) {mw_list_material_jo_search();}"
               />   
        Description : 
        <input type="text" 
               size="20" 
               name="itemdescription"
               class="easyui-validatebox"
               onkeypress="if (event.keyCode === 13) {mw_list_material_jo_search();}"
               />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="mw_list_material_jo_search()"> Search</a>
    </form>
</div>

<table id="mw_add_detail_jo" data-options="
       url:'<?php echo site_url('joborder/get_item_outstanding_withdraw/' . $joborderid) ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       striped:true,
       toolbar:'#mw_add_detail_jo_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>            
            <th field="itemcode" width="100" halign="center">Item Code</th>
            <th field="itemdescription" width="250" halign="center">Item Description</th>
            <th field="unitcode" width="50" align="center">UoM</th>
            <th field="ots" width="70" align="center">Ots</th>
            <th field="qty" width="80" align="center"  data-options="editor:{type:'numberbox',options:{precision:4}}">Qty Request</th>
            <th field="moq" width="30" align="center">MoQ</th>
        </tr>
    </thead>
</table>
<script>
    var lastIndex = -1;
    $(function() {
        $('#mw_add_detail_jo').datagrid({
            onDblClickRow: function(rowIndex, row) {                                
                $('#mw_add_detail_jo').datagrid('beginEdit', rowIndex);
                lastIndex = rowIndex;
            },
            onClickRow: function() {
                $('#mw_add_detail_jo').datagrid('endEdit', lastIndex);
            }
        });
    });
</script>
