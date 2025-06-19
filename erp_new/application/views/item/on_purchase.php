<div id="on_purchase_toolbar" style="padding-bottom: 0">  
    <form id="on_purchase_form" style="margin-bottom: 0px" onsubmit="return false;">
        <span style="display: inline-block;">Item
            <input type="text" 
                   size="10" 
                   name="itemcode"
                   class="easyui-validatebox"
                   onkeypress="if (event.keyCode === 13) {
                               $('#on_purchase').datagrid('reload', $('#on_purchase_form').serializeObject());
                           }"
                   />
        </span>
        <span style="display: inline-block;">P.O
            <input type="text" 
                   size="10" 
                   name="po_no"
                   class="easyui-validatebox"
                   onkeypress="if (event.keyCode === 13) {
                               $('#on_purchase').datagrid('reload', $('#on_purchase_form').serializeObject());
                           }"
                   />
        </span>
        <span style="display: inline-block;">P.R
            <input type="text" 
                   size="10" 
                   name="pr_no"
                   class="easyui-validatebox"
                   onkeypress="if (event.keyCode === 13) {
                               $('#on_purchase').datagrid('reload', $('#on_purchase_form').serializeObject());
                           }"
                   />
        </span>
        <span style="display: inline-block;">Supplier
            <input name="vendorid" id="po_vendorid_s" class="easyui-combobox" data-options="
                       valueField: 'id',
                       textField: 'text',
                       panelWidth:200,
                       onSelect:function(){
                       $('#on_purchase').datagrid('reload', $('#on_purchase_form').serializeObject());
                       },
                       url: '<?php echo site_url('vendor/get_remote_data') ?>'" mode="remote" style="width: 100px">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="$('#on_purchase').datagrid('reload', $('#on_purchase_form').serializeObject());"></a>
        </span>
    </form>
</div>

<table id="on_purchase" data-options="
       url:'<?php echo site_url('item/get_onpurchase') ?>',
       method:'post',
       singleSelect:true,
       title:'On Purchase Item',
       fit:true,
       pageSize:50,
       pageList: [50, 100, 150, 200, 250],
       border:false,
       striped:true,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       nowrap: true,
       idField: 'id',
       scrollbarSize: 5,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#on_purchase_toolbar'">
    <thead>
        <tr>           
            <th field="itemcode" width="80" halign="center">Item Code</th>
            <th field="itemdescription" width="250" halign="center">Item Description</th>
            <th field="unitcode" width="80" align="center">UoM</th>
            <th field="qty_ots" width="50" halign="center">Qty</th>
            <th field="po_number" width="100" halign="center">PO No</th>
            <th field="vendor" width="100" halign="center">Vendor</th>
            <th field="pr_number" width="100" halign="center">PR No</th>
            <th field="mr_number" width="100" halign="center">MR No</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#on_purchase').datagrid({});
    });

</script>