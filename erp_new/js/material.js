/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function material_search() {
    var code = $('#material_code_s').val();
    var description = $('#material_description_s').val();

    $('#material').datagrid('reload', {
        code: code,
        description: description
    });
}

function material_add() {
    $('#material-form').dialog('open').dialog('setTitle', ' New Material');
    $('#material-input').form('clear');
    url = base_url + 'material/save';
}

function material_save() {
    $('#material-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#material-form').dialog('close');
                $('#material').datagrid('reload');
            } else {
                $.messager.allert('Error', result.msg, 'error');
            }
        }
    });
}

function material_edit() {
    var row = $('#material').datagrid('getSelected');
    if (row !== null) {
        $('#material-form').dialog('open').dialog('setTitle', 'Edit Material');
        $('#material-input').form('load', row);
        url = base_url + 'material/update/' + row.code;
    } else {
        $.messager.alert('Waring', 'Choose model category to edit', 'warning');
    }
}

function material_delete() {
    var row = $('#material').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'material/delete', {
                    code: row.code
                }, function(result) {
                    if (result.success) {
                        $('#material').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose model category to delete', 'warning');
    }
}

