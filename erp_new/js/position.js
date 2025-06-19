/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function position_search() {
    $('#position').datagrid('reload', $('#position_search_form').serializeObject());
}

function position_add() {
    $('#position-form').dialog('open').dialog('setTitle', ' New Job title');
    $('#position-input').form('clear');
    url = base_url + 'position/save';
}

function position_save() {
    $('#position-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#position-form').dialog('close');
                $('#position').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function position_edit() {
    var row = $('#position').datagrid('getSelected');
    if (row != null) {
        $('#position-form').dialog('open').dialog('setTitle', ' Edit position');
        $('#position-input').form('load', row);
        url = base_url + 'position/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Job title to Edit', 'warning');
    }
}

function position_delete() {
    var row = $('#position').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'position/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#position').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Job title to Delete', 'warning');
    }
}

