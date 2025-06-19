/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function process_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#process-form').dialog('open').dialog('setTitle', 'New Process');
        $('#process-input').form('clear');
        url = base_url + 'process/save/' + row.id + '/0';
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }
}

function process_save() {
    $('#process-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#process-form').dialog('close');
                $('#process').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function process_edit() {
    var row = $('#process').datagrid('getSelected');
    if (row !== null) {
        $('#process-form').dialog('open').dialog('setTitle', ' Edit process');
        $('#process-input').form('load', row);
        url = base_url + 'process/save/' + row.modelid + '/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose process to edit', 'warning');
    }
}

function process_delete() {
    var row = $('#process').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'process/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#process').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose process to delete', 'warning');
    }
}

