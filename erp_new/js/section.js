/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function section_search() {
    var code = $('#section_code_s').val();
    var name = $('#section_name_s').val();
    var description = $('#section_description_s').val();

    $('#section').datagrid('reload', {
        code: code,
        name: name,
        description: description
    });
}

function section_add() {
    $('#section-form').dialog('open').dialog('setTitle', ' New Section');
    $('#section-input').form('clear');
    url = base_url + 'section/save';
}

function section_save() {
    $('#section-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#section-form').dialog('close');
                $('#section').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function section_edit() {
    var row = $('#section').datagrid('getSelected');
    if (row != null) {
        $('#section-form').dialog('open').dialog('setTitle', ' Edit section');
        $('#section-input').form('load', row);
        url = base_url + 'section/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Section to Edit', 'warning');
    }
}

function section_delete() {
    var row = $('#section').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'section/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#section').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Section to Delete', 'warning');
    }
}

