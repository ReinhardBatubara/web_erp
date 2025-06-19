<div id="salesorderitem_available-toolbar" style="padding-bottom: 2px;">
    Sales Order : <input type="text" name="salesorderid" id="jo_salesorderid" mode="remote" style="width: 200px"/>
    <script type="text/javascript">
        $('#jo_salesorderid').combogrid({
            panelWidth: 500,
            idField: 'id',
            textField: 'sonumber',
            url: '<?php echo site_url('salesorder/get_available_for_combogrid') ?>',
            columns: [[
                    {field: 'sonumber', title: 'SO No', width: 100, halign: 'center'},
                    {field: 'date_f', title: 'Date', width: 100, align: 'center'},
                    {field: 'po_no', title: 'PO No.', width: 100, halign: 'center'},
                    {field: 'customerorder', title: 'Customer', width: 200, halign: 'center'}
                ]],
            onSelect: function(index,row) {
                salesorderitem_available_search();
            }
        });
    </script>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="salesorderitem_available_search()">Search</a>
</div>
<table id="salesorderitem_available" data-options="
       url:'<?php echo site_url('salesorder/get_available_item') ?>',
       method:'post',
       border:false,
       singleSelect:false,
       fit:true,
       pageSize:50,
       pageList: [50, 100],
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       checkOnSelect: false,
       selectOnCheck: false,
       toolbar:'#salesorderitem_available-toolbar'">
    <thead>
        <tr>
            <th field="so_i_a_chck" checkbox="true"></th>
            <th field="code" width="80" align="center">Item Code</th>
            <th field="name" width="80" halign="center">Item Name</th>
            <th field="material" width="150" halign="center">Material</th>
            <th field="finishing" width="150" halign="center">Finishing</th>
            <th field="qty" width="40" align="center">Order</th>
            <th field="ots" width="70" align="center" editor="numberbox">Qty</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    
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
    
    var jo_itm_temp_index = null;
    $(function() {
        $('#salesorderitem_available').datagrid({
            onSelect:function(index,row){
                if(jo_itm_temp_index !== null){
                    $(this).datagrid('checkRow',jo_itm_temp_index);
                }
                jo_itm_temp_index = index;          
            }
        }).datagrid('enableCellEditing');
    });
</script>

