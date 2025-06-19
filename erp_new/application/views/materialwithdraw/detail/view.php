<div id="materialwithdrawdetail_toolbar" style="padding-bottom: 0px;">
  Item : <input type="text" size="12" class="easyui-validatebox" id="materialwithdrawdetail_code_s" />    
  Description : <input type="text" size="12" class="easyui-validatebox" id="materialwithdrawdetail_description_s"/>    
  <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" id="materialwithdrawdetail-add" onclick="materialwithdrawdetail_search()"></a>
  <?php if (in_array('add', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" id='mwd-add' iconCls="icon-add" plain="true" id="materialwithdrawdetail-add" onclick="materialwithdrawdetail_add()">Add</a>
  <?php }if (in_array('edit', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" id='mwd-edit' iconCls="icon-edit" plain="true" id="materialwithdrawdetail-edit" onclick="materialwithdrawdetail_edit()">Edit</a>   
  <?php }if (in_array('delete', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" id='mwd-remove' iconCls="icon-remove" plain="true" id="materialwithdrawdetail-remove" onclick="materialwithdrawdetail_delete()">Delete</a>    
  <?php } ?>
</div>
<table id="materialwithdrawdetail"></table>
<script type="text/javascript">
  $(function() {
    $('#materialwithdrawdetail').datagrid({
      method: 'post',
      border: false,
      singleSelect: true,
      fit: true,
      pageSize: 30,
      pageList: [30, 50, 70, 90, 110],
      rownumbers: true,
      fitColumns: true,
      pagination: true,
      striped: true,
      sortName: 'id',
      sortOrder: 'desc',
      toolbar: '#materialwithdrawdetail_toolbar',
      columns: [[
          {field: 'id', hidden: true},
          {field: 'mwdetail_chck', checkbox: true},
          {field: 'itemcode', title: 'Item Code', width: 80, halign: 'center', sortable: "true"},
          {field: 'itemdescription', title: 'Item Description', width: 170, halign: 'center', sortable: "true"},
          {field: 'qty', title: 'Qty', width: 50, align: 'center'},
          {field: 'unitcode', title: 'Unit', width: 50, align: 'center', sortable: "true"},
          {field: 'qty_ots', title: 'Ots Receive', width: 80, align: 'center', sortable: "true"}
        ]]
    });
  });
</script>
<?php
$this->load->view('materialwithdraw/detail/add');

