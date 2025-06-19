<div id="itemwarehousestock-toolbar">
    <?php if ((($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1)) || $this->session->userdata('id') == 'admin') { ?>
        <a href="javascript:void(0)" class="easyui-menubutton" iconCls="icon-report" data-options="menu:'#mm-itemwarehousestock'"plain="true"> Store Item To</a>
    <?php }if (($this->session->userdata('department') == 9 /*&& $this->session->userdata('optiongroup') != -1*/) || $this->session->userdata('id') == 'admin') { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="itemwarehousestock_edit()">Edit</a>
    <?php } if ((($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1)) || $this->session->userdata('id') == 'admin') { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="itemwarehousestock_delete()">Delete</a>
    <?php } ?>
</div>
<div id="mm-itemwarehousestock" class="easyui-menu" style="width:120px;">
    <?php
    foreach ($warehouse as $result) {
        ?>
        <div onclick="itemwarehousestock_set_store(<?php echo $result->id ?>)"><span><?php echo $result->code ?></span></div>
        <?php
    }
    ?>
</div>
<table id="itemwarehousestock" data-options=" 
       url:'<?php echo site_url('itemwarehousestock/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,                       
       fitColumns:true,
       pagination:true,
       striped:true,
       toolbar:'#itemwarehousestock-toolbar'">
    <thead>
        <tr>                       
            <th field="id" hidden="true"></th>
            <th field="warehouse" width="100" align="center">Warehouse</th>
            <th field="rack" width="50" align="center">Rack</th>
            <th field="unitcode" width="50" align="center">Unit</th>
            <th field="qty" width="50" halign="center" align="right">Qty</th>                            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#itemwarehousestock').datagrid({
        }).datagrid('getPager').pagination({
            displayMsg: ''
        });
    });
</script>
<?php
$this->load->view('item/itemwarehousestock/setstore');
$this->load->view('item/itemwarehousestock/edit');



