<div id="requisition_item-toolbar" style="padding-bottom: 2px;">
    <form id='requisition_item_search_form' style="margin: 0" onsubmit="return false">
        M.R No : 
        <input id="materialrequisition_outstanding" name="materialrequisitionid" mode="remote" style="width: 150px"/>
        <script type="text/javascript">
            $('#materialrequisition_outstanding').combogrid({
                panelWidth: 300,
                panelHeight: 200,
                idField: 'id',
                textField: 'number',
                url: '<?php echo site_url('materialrequisition/get_by_item_outstanding') ?>',
                columns: [[
                        {field: 'number', title: 'MR No #', width: 90},
                        {field: 'date_format', title: 'Date', align: 'center', width: 90},
                        {field: 'required_date_format', title: 'Required Date', align: 'center', width: 90}
                    ]],
                onSelect: function (index, row) {
                    materialrequisitiondetail_search_outstanding();
                }
            });
        </script>
        Item Code / Description
        <input type="text" class="easyui-validatebox" name='item_code_desc' onkeyup="if(event.keyCode===13){materialrequisitiondetail_search_outstanding()}"/>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="materialrequisitiondetail_search_outstanding()">Search</a>
    </form>
</div>
<table id="requisition_item" data-options="
       url:'<?php echo site_url('materialrequisitiondetail/get_outstanding') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList:[30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       checkOnSelect: false,
       selectOnCheck: false,
       toolbar:'#requisition_item-toolbar'">
    <thead>
        <tr> 
            <th field="requisition_chck" checkbox="true"></th>
            <th field="mr_no" width="100" halign="center">MR NO</th>
            <th field="itemcode" width="100" halign="center">Item Code</th>
            <th field="itemdescription" width="200" halign="center">Item Description</th>
            <th field="unitcode" width="70" align="center">Unit Code</th>
            <th field="qty_request" width="80" align="center">Qty Request</th>
            <th field="qty_ots" width="80" align="center" 
                data-options="editor:{
                type:'numberbox',
                options:{precision:4}
                }">Qty</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $.extend($.fn.datagrid.methods, {
        editCell: function (jq, param) {
            return jq.each(function () {
                var opts = $(this).datagrid('options');
                var fields = $(this).datagrid('getColumnFields', true).concat($(this).datagrid('getColumnFields'));
                for (var i = 0; i < fields.length; i++) {
                    var col = $(this).datagrid('getColumnOption', fields[i]);
                    col.editor1 = col.editor;
                    if (fields[i] != param.field) {
                        col.editor = null;
                    }
                }
                $(this).datagrid('beginEdit', param.index);
                var ed = $(this).datagrid('getEditor', param);
                if (ed) {
                    if ($(ed.target).hasClass('textbox-f')) {
                        $(ed.target).textbox('textbox').focus();
                    } else {
                        $(ed.target).focus();
                    }
                }
                for (var i = 0; i < fields.length; i++) {
                    var col = $(this).datagrid('getColumnOption', fields[i]);
                    col.editor = col.editor1;
                }
            });
        },
        enableCellEditing: function (jq) {
            return jq.each(function () {
                var dg = $(this);
                var opts = dg.datagrid('options');
                opts.oldOnClickCell = opts.onClickCell;
                opts.onClickCell = function (index, field) {
                    if (opts.editIndex != undefined) {
                        if (dg.datagrid('validateRow', opts.editIndex)) {
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

    var index_mat_rqstion = null;
    $(function () {
        $('#requisition_item').datagrid({
            onSelect: function (index, row) {
                if (index_mat_rqstion !== null) {
                    $(this).datagrid('checkRow', index_mat_rqstion);
                }
                index_mat_rqstion = index;
            }
        }).datagrid('enableCellEditing');
    });
</script>
