/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function furring_search() {
    var code = $('#furring_code_s').val();
    var description = $('#furring_description_s').val();

    $('#furring').datagrid('reload', {
        code: code,
        description: description
    });
}

function furring_add() {
    $('#furring-form').dialog('open').dialog('setTitle', ' New model category');
    $('#furring-input').form('clear');
    url = base_url + 'furring/save';
}

function furring_save() {
    $('#furring-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#furring-form').dialog('close');
                $('#furring').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function furring_edit() {
    var row = $('#furring').datagrid('getSelected');
    if (row !== null) {
        $('#furring-form').dialog('open').dialog('setTitle', ' Edit model category');
        $('#furring-input').form('load', row);
        url = base_url + 'furring/update/' + row.code;
    } else {
        $.messager.alert('Waring', 'Choose model category to edit', 'warning');
    }
}

function furring_delete() {
    var row = $('#furring').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'furring/delete', {
                    code: row.code
                }, function(result) {
                    if (result.success) {
                        $('#furring').datagrid('reload');
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

