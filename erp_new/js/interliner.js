/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function interliner_search() {
    var code = $('#interliner_code_s').val();
    var description = $('#interliner_description_s').val();

    $('#interliner').datagrid('reload', {
        code: code,
        description: description
    });
}

function interliner_add() {
    $('#interliner-form').dialog('open').dialog('setTitle', ' New model category');
    $('#interliner-input').form('clear');
    url = base_url + 'interliner/save';
}

function interliner_save() {
    $('#interliner-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#interliner-form').dialog('close');
                $('#interliner').datagrid('reload');
            } else {
                $.messager.allert('Error', result.msg, 'error');
            }
        }
    });
}

function interliner_edit() {
    var row = $('#interliner').datagrid('getSelected');
    if (row != null) {
        $('#interliner-form').dialog('open').dialog('setTitle', ' Edit model category');
        $('#interliner-input').form('load', row);
        url = base_url + 'interliner/update/' + row.code;
    } else {
        $.messager.alert('Waring', 'Choose model category to edit', 'warning');
    }
}

function interliner_delete() {
    var row = $('#interliner').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'interliner/delete', {
                    code: row.code
                }, function(result) {
                    if (result.success) {
                        $('#interliner').datagrid('reload');
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

