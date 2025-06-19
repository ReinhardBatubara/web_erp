<div id="model_additionalmaterial_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="additionalmaterial_add" onclick="additionalmaterial_add()"> Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="additionalmaterial_edit" onclick="additionalmaterial_edit()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="additionalmaterial_delete" onclick="additionalmaterial_delete()">Delete</a>
</div>
<table id="model_additionalmaterial" data-options="
       url:'<?php echo site_url('additionalmaterial/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       title:'Additional Material',
       pageSize:50,
       pageList: [50, 100],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#model_additionalmaterial_toolbar'">
    <thead>
        <tr>
            <th field="description" width="250" halign="center">Description</th>
            <th field="code" width="150" halign="center">Material Code</th>
            <th field="materialdescription" width="250" halign="center">Material Description</th>
            <th field="unitcode" width="80" halign="center">Unit</th>
            <th field="qty" width="80" align="center">Qty</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#model_additionalmaterial').datagrid();
    });
</script>
