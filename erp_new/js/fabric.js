/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function fabric_search() {
    var code = $('#fabric_code_s').val();
    var description = $('#fabric_description_s').val();

    $('#fabric').datagrid('reload', {
        code: code,
        description: description
    });
}

function fabric_add() {
    $('#fabric-form').dialog('open').dialog('setTitle', ' New model category');
    $('#fabric-input').form('clear');
    url = base_url + 'fabric/save';
}

function fabric_save() {
    $('#fabric-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#fabric-form').dialog('close');
                $('#fabric').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function fabric_edit() {
    var row = $('#fabric').datagrid('getSelected');
    if (row !== null) {
        $('#fabric-form').dialog('open').dialog('setTitle', ' Edit model category');
        $('#fabric-input').form('load', row);
        url = base_url + 'fabric/update/' + row.code;
    } else {
        $.messager.alert('Waring', 'Choose model category to edit', 'warning');
    }
}

function fabric_delete() {
    var row = $('#fabric').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'fabric/delete', {
                    code: row.code
                }, function(result) {
                    if (result.success) {
                        $('#fabric').datagrid('reload');
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

