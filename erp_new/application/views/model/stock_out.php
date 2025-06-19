<div id="modelprocess_stock_out_toolbar" style="padding-bottom: 2px;">
    Code : 
    <input type="text" 
           size="12" 
           class="easyui-validatebox" 
           id="top_code_s" 
           onkeypress="if (event.keyCode == 13) {model_process_stock_out_search()}"
           />    
    Description : 
    <input type="text" 
           size="20" 
           class="easyui-validatebox" 
           id="top_description_s" 
           onkeypress="if (event.keyCode == 13) {model_process_stock_out_search()}"
           />
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="model_process_stock_out_search()"> Search</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="model_create_stock_out()">Create</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="model_edit_stock_out()">Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="model_delete_stock_out()">Delete</a>

</div>
<table id="modelprocess_stock_out" data-options="
       url:'<?php echo site_url('modelprocess/get_stock_out') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       toolbar:'#modelprocess_stock_out_toolbar'">
    <thead>
        <tr>
            <th field="number" width="80" align="center">No</th>
            <th field="date_f" width="100" align="center">Date</th>
            <th field="modelcode" width="100" halign="center">Model Code</th>
            <th field="modelname" width="150" halign="center">Model Description</th>
            <th field="processname" width="130" halign="center">Process</th>
            <th field="joborder_no" width="120" align="center">JO No.</th>
            <th field="qty" width="100" align="center">Qty</th>
            <th field="remark" width="300" halign="center">Remark</th>            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#modelprocess_stock_out').datagrid();
    });
</script>
