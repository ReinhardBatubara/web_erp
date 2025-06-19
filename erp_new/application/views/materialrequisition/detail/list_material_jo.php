<div id="mr_list_material_jo_toolbar" style="padding-bottom: 0px">
    <form id="mr_list_material_jo_search_form" style="margin-bottom: 0px;">
        Item Code : 
        <input type="text" 
               size="12" 
               name="itemcode"
               class="easyui-validatebox"
               onkeypress="if (event.keyCode === 13) {mr_list_jo_material_search();}"
               />   
        Item Description : 
        <input type="text" 
               size="18" 
               name="itemdescription"
               class="easyui-validatebox"
               onkeypress="if (event.keyCode === 13) {mr_list_jo_material_search();}"
               />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="mr_list_jo_material_search()"> Search</a>
    </form>
</div>
<table id="mr_list_material_jo" data-options="
       url:'<?php echo site_url('joborder/get_item_outstanding_requisition/' . $joborderid) ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       rownumbers:true,
       fitColumns:false,
       striped:true,
       checkOnSelect: false,
       selectOnCheck: false,
       toolbar:'#mr_list_material_jo_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>
            <th field="mr_list_mat_jo" checkbox="true"></th>
            <th field="itemcode" width="100" halign="center">Item Code</th>
            <th field="itemdescription" width="250" halign="center">Item Description</th>
            <th field="unitcode" width="50" align="center">UoM</th>
            <th field="ots" width="70" align="center">Ots</th>
            <th field="qty" width="90" align="center"  data-options="editor:{type:'numberbox',options:{precision:4}}">Qty Request</th>
            <th field="moq" width="70" align="center">MoQ</th>
        </tr>
    </thead>
</table>
<script>    
    $.extend($.fn.datagrid.methods, {
        editCell: function(jq,param){
            return jq.each(function(){
                var opts = $(this).datagrid('options');
                var fields = $(this).datagrid('getColumnFields',true).concat($(this).datagrid('getColumnFields'));
                for(var i=0; i<fields.length; i++){
                    var col = $(this).datagrid('getColumnOption', fields[i]);
                    col.editor1 = col.editor;
                    if (fields[i] != param.field){
                        col.editor = null;
                    }
                }
                $(this).datagrid('beginEdit', param.index);
                var ed = $(this).datagrid('getEditor', param);
                if (ed){
                    if ($(ed.target).hasClass('textbox-f')){
                        $(ed.target).textbox('textbox').focus();
                    } else {
                        $(ed.target).focus();
                    }
                }
                for(var i=0; i<fields.length; i++){
                    var col = $(this).datagrid('getColumnOption', fields[i]);
                    col.editor = col.editor1;
                }
            });
        },
        enableCellEditing: function(jq){
            return jq.each(function(){
                var dg = $(this);
                var opts = dg.datagrid('options');
                opts.oldOnClickCell = opts.onClickCell;
                opts.onClickCell = function(index, field){
                    if (opts.editIndex != undefined){
                        if (dg.datagrid('validateRow', opts.editIndex)){
                            dg.datagrid('endEdit', opts.editIndex);
                            opts.editIndex = undefined;
                        } else {
                            return;
                        }
                    }
                    dg.datagrid('selectRow', index).datagrid('editCell', {
                        index: index,
                        field: field
                    });
                    opts.editIndex = index;
                    opts.oldOnClickCell.call(this, index, field);
                }
            });
        }
    });
    
    var index_mat_jo = null;
    
    $(function(){
        $('#mr_list_material_jo').datagrid({
            onSelect:function(index,row){
                if(index_mat_jo !== null){
                    $(this).datagrid('checkRow',index_mat_jo);
                }
                index_mat_jo = index;
                
            }
        }).datagrid('enableCellEditing');
    });
</script>

