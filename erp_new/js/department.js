/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function department_search() {
    var code = $('#department_code_s').val();
    var name = $('#department_name_s').val();
    var description = $('#department_description_s').val();

    $('#department').datagrid('reload', {
        code: code,
        name: name,
        description: description
    });
}

function department_add() {
    $('#department-form').dialog('open').dialog('setTitle', ' New Department');
    $('#department-input').form('clear');
    url = base_url + 'department/save';
}

function department_save() {
    $('#department-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#department-form').dialog('close');
                $('#department').datagrid('reload');
            } else {
                $.messager.allert('Error', result.msg, 'error');
            }
        }
    });
}

function department_edit() {
    var row = $('#department').datagrid('getSelected');
    if (row !== null) {
        $('#department-form').dialog('open').dialog('setTitle', ' Edit department');
        $('#department-input').form('load', row);
        url = base_url + 'department/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose department to edit', 'warning');
    }
}

function department_delete() {
    var row = $('#department').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'department/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#department').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose department to Delete', 'warning');
    }
}

