<div id="jo_material_to_outsource_toolbar" style="padding-bottom: 0px;">
    <form id="jo_material_to_outsource_search_form" style="margin-bottom: 0px;">
        Item Code : 
        <input type="text" 
               size="12" 
               class="easyui-validatebox"
               name="itemcode"
               onkeypress="if (event.keyCode == 13) {joborder_material_to_oursource_search()}"
               />    
        Item Description : 
        <input type="text" 
               size="20" 
               name="itemdescription"
               class="easyui-validatebox" 
               id="top_description_s" 
               onkeypress="if (event.keyCode == 13) {joborder_material_to_oursource_search()}"
               />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="joborder_material_to_oursource_search()"></a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="joborder_material_to_oursource_add()" <?php echo $disabled ?>> Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="joborder_material_to_oursource_edit()" <?php echo $disabled ?>> Edit</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="joborder_material_to_oursource_delete()" <?php echo $disabled ?>> Delete</a>
    </form>
</div>
<table id="joborder_material_to_oursource" data-options="
       url:'<?php echo site_url('joborder/material_to_oursource_get/'.$joborderid) ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#jo_material_to_outsource_toolbar'">
    <thead>
        <tr>
            <th field="code" width="100" align="center">Item Code</th>            
            <th field="materialdescription" width="200" halign="center">Description</th>
            <th field="unitcode" width="80" halign="center">Unit Code</th>
            <th field="qty" width="100" align="center">Qty</th>
            <th field="remark" width="200" halign="center">Remark</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#joborder_material_to_oursource').datagrid();
    });
</script>
<div id="mto_temp"></div>

