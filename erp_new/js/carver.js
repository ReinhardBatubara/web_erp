/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/* global base_url */

function carver_search() {
    $('#carver').datagrid('reload', $('#carver_search_form').serializeObject());
}

function carver_add() {
    $('#carver-form').dialog('open').dialog('setTitle', 'New Carver');
    $('#carver-input').form('clear');
    url = base_url + 'carver/save';
}

function carver_save() {
    $('#carver-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
//            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#carver-form').dialog('close');
                $('#carver').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function carver_edit() {
    var row = $('#carver').datagrid('getSelected');
    if (row !== null) {
        $('#carver-form').dialog('open').dialog('setTitle', 'Edit Carver');
        $('#carver-input').form('load', row);
        url = base_url + 'carver/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Carver to Edit', 'warning');
    }
}

function carver_delete() {
    var row = $('#carver').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'carver/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#carver').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Carver to Delete', 'warning');
    }
}

