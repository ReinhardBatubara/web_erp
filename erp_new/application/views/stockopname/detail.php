<div id="stockopname_detail_toolbar" style="padding-bottom: 0px;">
    <form id='stockopname_detail_search_form' onsubmit="return false;" style="margin: 0;">
        Item : <input type="text" class="easyui-validatebox" name="q" style="width: 100px" onkeyup="if(event.keyCode===13){stockopname_detail_search()}"/>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" onclick="stockopname_detail_search()"> Search</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="stockopname_detail_add()"> Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" onclick="stockopname_detail_edit()"> Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" onclick="stockopname_detail_delete()"> Delete</a>
    </form>
</div>
<table id="stockopname_detail" data-options="
       url:'<?php echo site_url('stockopname/detail_get') ?>',
       method:'post',
       title:'Detail Item',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:50,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#stockopname_detail_toolbar'">
    <thead>
        <tr>
            <th field="item_group_code" width="80" halign="center">Item Group</th>
            <th field="item_code" width="150" halign="center">Item Code</th>
            <th field="item_description" width="200" halign="center">Item Description</th>
            <th field="unitcode" width="50" align="center">UoM</th>
            <th field="stock" width="80" halign="center" align="right">System Stock</th>
            <th field="real_stock" width="80" halign="center" align="right">Real Stock</th>
            <th field="difference" width="80" halign="center" align="right">Difference</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#stockopname_detail').datagrid({});
    });
</script>

