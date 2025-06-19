<div id="itemunitrelation_toolbar">
    <?php if (in_array('update_unit_relation', $action)) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="itemunitrelation_add()">New Conversion</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="itemunitrelation_delete()">Delete</a>
    <?php } ?>
</div>
<table id="itemunitrelation" data-options="
       url:'<?php echo site_url('itemunitrelation/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,                       
       fitColumns:true,
       pagination:true,
       striped:true,
       toolbar:'#itemunitrelation_toolbar'
       ">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="unitfrom" width="50" align="center">Unit From</th>
            <th field="unitto" width="50" align="center">Unit To</th>
            <th field="value" width="50" align="center">Rate</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#itemunitrelation').datagrid({
        }).datagrid('getPager').pagination({
            displayMsg: ''

        });
    });
</script>
<?php
$this->load->view('item/itemunitrelation/add');
