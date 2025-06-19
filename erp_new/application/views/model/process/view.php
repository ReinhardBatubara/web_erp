<div id="process_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="process_add" onclick="process_add()"> Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="process_edit" onclick="process_edit()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="process_delete" onclick="process_delete()">Delete</a>
</div>
<table id="process" data-options="
       url:'<?php echo site_url('process/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:50,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#process_toolbar'">
    <thead>
        <tr>
            <th field="process" width="250" halign="center">Process Name</th>
            <th field="stock" width="80" align="center">Stock</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#process').datagrid().datagrid('getPager').pagination({
            pageList: [50, 100]
        });
    });
</script>
<?php
$this->load->view('model/process/add');
