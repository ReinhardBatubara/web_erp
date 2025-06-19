/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function directlabour_search() {
    $('#directlabour').datagrid('reload', $('#directlabour_search_form').serializeObject());
}

function directlabour_add() {
    $('#directlabour-form').dialog('open').dialog('setTitle', ' New Job title');
    $('#directlabour-input').form('clear');
    url = base_url + 'directlabour/save';
}

function directlabour_save() {
    $('#directlabour-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#directlabour-form').dialog('close');
                $('#directlabour').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function directlabour_edit() {
    var row = $('#directlabour').datagrid('getSelected');
    if (row != null) {
        $('#directlabour-form').dialog('open').dialog('setTitle', ' Edit directlabour');
        $('#directlabour-input').form('load', row);
        url = base_url + 'directlabour/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Job title to Edit', 'warning');
    }
}

function directlabour_delete() {
    var row = $('#directlabour').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'directlabour/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#directlabour').datagrid('reload');
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

