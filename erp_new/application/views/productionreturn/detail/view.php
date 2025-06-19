<div id="productionreturndetail_toolbars" style="padding-bottom: 0;">
    Item Code : 
    <input type="text" 
           size="12" 
           name="itemcode"
           id="productionreturndetail_search_itemcode"
           class="easyui-validatebox" 
           onkeyup="if (event.keyCode === 13) {
                     productionreturn_detail_search();
                 }"/>       
    Item Description : 
    <input type="text" 
           size="20" 
           name="itemdescription"
           id="productionreturndetail_search_itemdescription"
           class="easyui-validatebox"
           onkeyup="if (event.keyCode === 13) {
                     productionreturn_detail_search();
                 }"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="productionreturn_detail_search()"> Search</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="productionreturn_detail_add()"> Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="productionreturn_detail_edit()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="productionreturn_detail_delete()"> Delete</a>
</div>
<table id="productionreturndetail"></table>
<script type="text/javascript">
    $(function () {
        $('#productionreturndetail').datagrid({
            url: '<?php echo site_url('productionreturn/detail_get') ?>',
            method: 'post',
            border: true,
            singleSelect: true,
            fit: true,
            pageSize: 30,
            pageList: [30, 50, 70, 90, 110],
            rownumbers: true,
            fitColumns: false,
            pagination: true,
            striped: true,
            sortName: 'id',
            sortOrder: 'desc',
            toolbar: '#productionreturndetail_toolbars',
            columns: [[
                    {field: 'rtn_chck', checkbox: true},
                    {field: 'itemcode', title: 'Item Code', width: 100, halign: 'center', sortable: "true"},
                    {field: 'itemdescription', title: 'Item Description', width: 400, halign: 'center', sortable: "true"},
                    {field: 'qty', title: 'Qty', width: 80, align: 'center', sortable: "true"},
                    {field: 'unitcode', title: 'Unit', width: 80, align: 'center', sortable: "true"},
                    {field: 'returntype', title: 'Type', width: 80, halign: 'center', sortable: "true"}
                ]]
        });
    });
</script>
<?php $this->load->view('productionreturn/detail/add'); ?>