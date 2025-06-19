/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function unit_search() {
    $('#unit').datagrid('reload', $('#unit_search_form').serializeObject());
}

function po_product_search() {
    var row = $('#purchaseorder').datagrid('getSelected');
    var postData = $('#po_product_search_form').serializeObject();
    $.extend(postData, {purchaseorderid: row.id});
    $('#po_product').datagrid('reload', postData);
}
function unit_add() {
    $('#unit-form').dialog('open').dialog('setTitle', ' New unit');
    $('#unit-input').form('clear');
    url = base_url + 'unit/save';
}

function unit_save() {
    $('#unit-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#unit-form').dialog('close');
                $('#unit').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function unit_edit() {
    var row = $('#unit').datagrid('getSelected');
    if (row !== null) {
        $('#unit-form').dialog('open').dialog('setTitle', ' Edit unit');
        $('#unit-input').form('load', row);
        url = base_url + 'unit/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose unit to edit', 'warning');
    }
}

function unit_delete() {
    var row = $('#unit').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'unit/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#unit').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose unit to delete', 'warning');
    }
}

