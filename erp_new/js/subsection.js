/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function subsection_search() {
    var code = $('#subsection_code_s').val();
    var name = $('#subsection_name_s').val();
    var description = $('#subsection_description_s').val();

    $('#subsection').datagrid('reload', {
        code: code,
        name: name,
        description: description
    });
}

function subsection_add() {
    $('#subsection-form').dialog('open').dialog('setTitle', ' New Sub Section');
    $('#subsection-input').form('clear');
    url = base_url + 'subsection/save';
}

function subsection_save() {
    $('#subsection-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#subsection-form').dialog('close');
                $('#subsection').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function subsection_edit() {
    var row = $('#subsection').datagrid('getSelected');
    if (row != null) {
        $('#subsection-form').dialog('open').dialog('setTitle', ' Edit Sub Section');
        $('#subsection-input').form('load', row);
        url = base_url + 'subsection/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Sub Section to Edit', 'warning');
    }
}

function subsection_delete() {
    var row = $('#subsection').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'subsection/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#subsection').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Sub Section to Delete', 'warning');
    }
}

