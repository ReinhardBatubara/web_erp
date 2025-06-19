<div id="quotationdetail_toolbars" style="padding-bottom: 0px;">
    Item Code : 
    <input type="text" 
           size="12" 
           name="itemcode"
           id="quotationdetail_search_itemcode"
           class="easyui-validatebox" 
           onkeyup="if (event.keyCode === 13) {quotation_detail_search();}"/>       
    Item Description : 
    <input type="text" 
           size="20" 
           name="itemdescription"
           id="quotationdetail_search_itemdescription"
           class="easyui-validatebox"
           onkeyup="if (event.keyCode === 13) {quotation_detail_search();}"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="quotation_detail_search()"> Search</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="quotation_detail_add()"> Add</a>    
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add-others" plain="true" onclick="quotation_detail_add_others()">Add Others</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="quotation_detail_edit()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="quotation_detail_delete()"> Delete</a>
</div>
<table id="quotationdetail"></table>
<script type="text/javascript">
    $(function() {
        $('#quotationdetail').datagrid({
            url: '<?php echo site_url('quotation/detail_get') ?>',
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
            toolbar: '#quotationdetail_toolbars',
            columns: [[
                    {field: 'modelcode', title: 'Item Code', width: 100, halign: 'center',rowspan:2},
                    {field: 'modelname', title: 'Item Description', width: 250, halign: 'center',rowspan:2},
                    {title: 'Dimension (mm)', width: 150, aalign: 'center',colspan:3},
                    {field: 'finishing', title: 'Finishing', width: 150, halign: 'center',rowspan:2},
                    {field: 'price', title: 'Price', width: 120, align: 'right',halign:'center',formatter:formatPrice,rowspan:2},
                    {field: 'remark', title: 'Remark', width: 250,halign:'center',rowspan:2}
                ],[
                    {field: 'item_size_w',title: 'W', width: 50, align: 'center'},
                    {field: 'item_size_d',title: 'D', width: 50, align: 'center'},
                    {field: 'item_size_h',title: 'H', width: 50, align: 'center'},
                ]]
        });
    });
</script>