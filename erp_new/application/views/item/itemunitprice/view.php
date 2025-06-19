<div id="itemunitprice_toolbar">
    <?php if (in_array('update_unit', $action)) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="itemunitprice_add()"> Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="itemunitprice_delete()"> Delete</a>
    <?php } ?>
</div>
<table id="itemunitprice" data-options="
       url:'<?php echo site_url('itemunitprice/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,         
       pagination:true,
       fitColumns:true,
       striped:true,
       toolbar:'#itemunitprice_toolbar'">
    <thead>
        <tr>
            <th field="unitcode" width="90" align="center">Unit</th>
            <th field="rate" width="50" align="center">Rate</th>
            <?php if (in_array('view_price', $action)) { ?>
                <th field="originalprice" width="120" halign="center" align="right">Original Price</th>
                <th field="sellprice" width="120" halign="center" align="right">Costing/Sell Price</th>
                <th field="currency" width="50" align="center">Currency</th>
            <?php } ?>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#itemunitprice').datagrid({
        }).datagrid('getPager').pagination({
            displayMsg: ''
        });
    });
</script>
<?php
$this->load->view('item/itemunitprice/add');
