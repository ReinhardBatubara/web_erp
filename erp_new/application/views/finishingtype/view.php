<div class="easyui-layout" data-options="fit:true">        
  <div region="center" style="border: none;">
    <div id="finishingtype_toolbar" style="padding-bottom: 0;">
      Name : 
      <input type="text"            
             size="12" 
             class="easyui-validatebox" 
             id="finishingtype_name_s" 
             onkeypress="if (event.keyCode === 13) {
                   finishingtype_search();
                 }"
             /> 
      Position :
      <select class="easyui-combobox" id="finishingtype_positionid_s" data-options="onSelect:function(){finishingtype_search()}">
        <option value=""></option>
        <option value="1">SEEN FACE AREA</option>
        <option value="1">TOP AREA</option>
        <option value="1">UN-SEEN FACE</option>
      </select> 
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="finishingtype_search()"></a>
      <?php if (in_array('add', $action)) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="finishingtype_add()">Add</a>
      <?php }if (in_array('edit', $action)) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="finishingtype_edit()">Edit</a>
      <?php }if (in_array('delete', $action)) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="finishingtype_delete()">Delete</a>
      <?php } ?>

    </div>
    <table id="finishingtype" data-options="
           url:'<?php echo site_url('finishingtype/get') ?>',
           method:'post',
           title:'Finishing Type',
           border:true,
           singleSelect:true,
           fit:true,
           pageSize:30,
           pageList: [30, 50, 70, 90, 110],
           rownumbers:true,
           fitColumns:false,
           pagination:true,
           striped:true,
           sortName:'id',
           sortOrder:'desc',
           toolbar:'#finishingtype_toolbar'">
      <thead>
        <tr>
          <th field="id" hidden="true"></th>
          <th field="name" width="150" halign="center" sortable="true">Name</th>
          <th field="position_name" width="150" halign="center" sortable="true">Position</th>
          <th field="remark" width="400" halign="center" sortable="true">Remark</th>            
        </tr>
      </thead>
    </table>
    <script>
      $(function() {
        $('#finishingtype').datagrid({
          onSelect: function(index, row) {
            $('#finishingtype_material').datagrid('reload', {
              finishingtypeid: row.id
            });
          }
        });
      });
    </script>
  </div>
  <div region="south" split="true" style="height:350px;border: none;" title="Item Material" collapsible="false">
    <div id="finishingtype_material_toolbars" style="padding-bottom: 0;">
      Item Code : 
      <input type="text" 
             size="12" 
             name="itemcode"
             id="finishingtype_material_search_itemcode"
             class="easyui-validatebox" 
             onkeyup="if (event.keyCode === 13) {
                   finishingtype_material_search();
                 }"/>       
      Item Description : 
      <input type="text" 
             size="20" 
             name="itemdescription"
             id="finishingtype_material_search_itemdescription"
             class="easyui-validatebox" 
             onkeyup="if (event.keyCode === 13) {
                   finishingtype_material_search();
                 }"/>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="finishingtype_material_search()"></a>
      <?php if (in_array('add', $action)) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="finishingtype_material_add()"> Add</a>
      <?php }if (in_array('edit', $action)) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="finishingtype_material_edit()"> Edit</a>
      <?php }if (in_array('delete', $action)) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="finishingtype_material_delete()"> Delete</a>
      <?php } ?>
    </div>
    <table id="finishingtype_material" data-options=" 
           url: '<?php echo site_url('finishingtype/material_get') ?>',
           method:'post',
           border:true,       
           singleSelect:true,
           fit:true,
           rownumber:true,
           striped:true,
           fitColumns:false,
           pagination:false,
           rownumbers: true,
           sortName:'id',
           sortOrder:'desc',

           toolbar:'#finishingtype_material_toolbars'" class="easyui-datagrid">
      <thead>        
        <tr>
          <th field="itemcode" width="120" halign="center" sortable="true">Item Code </th>
          <th field="itemdescription" width="350" halign="center" sortable="true">Description</th>
          <th field="unitcode" width="60" align="center">Unit</th>
          <th field="qty" width="70" align="right" halign="center">Qty/M2</th>
          <th field="remark" width="400" halign="center">Remark</th>
        </tr>
      </thead>
    </table>
    <script type="text/javascript">
      $(function() {
        $('#finishingtype_material').datagrid({
        });
      });
    </script>
  </div>
</div>
<?php
$this->load->view('finishingtype/add');


