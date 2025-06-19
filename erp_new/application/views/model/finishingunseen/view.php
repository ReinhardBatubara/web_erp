<div id="finishingunseen_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="finishingunseen_add" onclick="finishingunseen_add()"> Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="finishingunseen_edit" onclick="finishingunseen_edit()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="finishingunseen_delete" onclick="finishingunseen_delete()">Delete</a>
</div>
<table id="finishingunseen" data-options="
       url:'<?php echo site_url('finishingunseen/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:50,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#finishingunseen_toolbar'">
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
            <th field="volume" width="80" align="right" halign="center">Total Qty</th>
            <th field='unitcode' width='40' align="center">Unit</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#finishingunseen').datagrid().datagrid('getPager').pagination({
            pageList: [50, 100]
        });
    });
</script>
<?php
$this->load->view('model/finishingunseen/add');
