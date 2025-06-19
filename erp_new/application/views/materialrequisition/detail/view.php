<div id="materialrequisitiondetail_toolbar" style="padding-bottom: 0px;">
  Item : 
  <input type="text" 
         size="12" 
         class="easyui-validatebox" 
         id="materialrequisitiondetail_code_s" 
         onkeyup="if (events.keyCode == 13) {
               materialrequisitiondetail_search()
             }"/>    
  Description : 
  <input type="text" 
         size="12" 
         class="easyui-validatebox" 
         id="materialrequisitiondetail_description_s"
         onkeyup="if (events.keyCode == 13) {
               materialrequisitiondetail_search()
             }"/>    

  <a href="javascript:void(0)" 
     class="easyui-linkbutton" 
     iconCls="icon-search" 
     plain="true" 
     id="materialrequisitiondetail-add" 
     onclick="materialrequisitiondetail_search()">Search</a>
     <?php if (in_array('add', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" id='mrd-add' iconCls="icon-add" plain="true" onclick="materialrequisitiondetail_add(0)">Add</a>
  <?php }if (in_array('create_from_jo', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" id='mrd-add2' iconCls="icon-add2" plain="true" onclick="materialrequisitiondetail_add_from_jo()">View JO Material</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" id='mrd-add-others' iconCls="icon-add-others" plain="true" onclick="materialrequisitiondetail_add(1)">Add Others</a>
  <?php }if (in_array('edit', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" id='mrd-edit' iconCls="icon-edit" plain="true" onclick="materialrequisitiondetail_edit()">Edit</a>
  <?php } if (in_array('delete', $action)) { ?>
    <a href="javascript:void(0)" class="easyui-linkbutton" id='mrd-remove' iconCls="icon-remove" plain="true" onclick = "materialrequisitiondetail_delete()">Delete</a>
  <?php } ?>
</div>
<table id = "materialrequisitiondetail"></table>
<script type = "text/javascript">
  $(function() {
    $('#materialrequisitiondetail').datagrid({
      url: '<?php echo site_url('materialrequisitiondetail/get') ?>',
      method: 'post',
      border: false,
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
      toolbar: '#materialrequisitiondetail_toolbar',
      columns: [[
          {field: 'id', hidden: true},
          {field: 'mrdetail_chck', checkbox: true},
          {field: 'itemcode', title: 'Item Code', width: 150, halign: 'center', sortable: "true"},
          {field: 'itemdescription', title: 'Item Description', width: 250, halign: 'center', sortable: "true"},
          {field: 'qty', title: 'Qty', width: 90, align: 'center'},
          {field: 'unitcode', title: 'Unit', width: 90, align: 'center'},
          {field: 'requiredfor', title: 'Required For', width: 300, halign: 'center'}
        ]]
    });
  });
</script>


