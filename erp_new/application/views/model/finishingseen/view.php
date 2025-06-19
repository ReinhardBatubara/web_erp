<div id="finishingseen_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="finishingseen_add" onclick="finishingseen_add()"> Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="finishingseen_edit" onclick="finishingseen_edit()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="finishingseen_delete" onclick="finishingseen_delete()">Delete</a>
</div>
<table id="finishingseen" data-options="
       url:'<?php echo site_url('finishingseen/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:50,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#finishingseen_toolbar'">
    <thead>
        <tr>
            <th field="description" width="180" halign="center">Description</th>
            <th field="comment" width="100" halign="center">Comment</th>
            <th field="code" width="100" halign="center">Material Code</th>
            <th field="materialdescription" width="200" halign="center">Material Description</th>
            <th field="area" width="70" align="center">Area</th>
            <th field="size_l" width="50" align="center">L</th>
            <th field="size_w" width="50" align="center">W</th>            
            <th field="qty" width="40" align="center">Qty</th>
            <th field="volume" width="80" align="center">Total</th>
            <th field="unitcode" width="40" align="center">Unit</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#finishingseen').datagrid().datagrid('getPager').pagination({
            pageList: [50, 100]
        });
    });
</script>
<?php
$this->load->view('model/finishingseen/add');
