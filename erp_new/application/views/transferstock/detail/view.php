<div id="transferstockdetail_toolbars" style="padding-bottom: 1px;">
  Item Code : 
  <input type="text" 
         size="12" 
         name="itemcode"
         id="transferstockdetail_search_itemcode"
         class="easyui-validatebox" 
         onkeyup="if (event.keyCode === 13) {
               transferstock_detail_search();
             }"/>       
  Item Description : 
  <input type="text" 
         size="20" 
         name="itemdescription"
         id="transferstockdetail_search_itemdescription"
         class="easyui-validatebox"
         onkeyup="if (event.keyCode === 13) {
               transferstock_detail_search();
             }"/>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="transferstock_detail_search()"> Search</a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="transferstock_detail_add()"> Add</a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="transferstock_detail_edit()"> Edit</a>
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="transferstock_detail_delete()"> Delete</a>
</div>
<table id="transferstockdetail"></table>
<script type="text/javascript">
  $(function() {
    $('#transferstockdetail').datagrid({
      url: '<?php echo site_url('transferstock/detail_get') ?>',
      method: 'post',
      border: true,
      singleSelect: true,
      fit: true,
      rownumbers: true,
      fitColumns: false,
      pagination: true,
      striped: true,
      sortName: 'id',
      sortOrder: 'desc',
      toolbar: '#transferstockdetail_toolbars',
      columns: [[
          {field: 'rtn_chck', checkbox: true},
          {field: 'itemcode', title: 'Item Code', width: 100, halign: 'center', sortable: "true"},
          {field: 'itemdescription', title: 'Item Description', width: 400, halign: 'center', sortable: "true"},
          {field: 'qty', title: 'Qty', width: 80, align: 'center', sortable: "true"},
          {field: 'unitcode', title: 'Unit', width: 80, align: 'center', sortable: "true"},
          {field: 'remark', title: 'Remark', width: 300, halign: 'center', sortable: "true"}
        ]]
    });
  });
</script>