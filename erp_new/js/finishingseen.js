/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function finishingseen_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#finishingseen-form').dialog('open').dialog('setTitle', ' New Finishing Seen');
        $('#finishingseen-input').form('clear');
        url = base_url + 'finishingseen/save/' + row.id + '/0';
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }

}

function finishingseen_save() {
    $('#finishingseen-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
//            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#finishingseen-form').dialog('close');
                $('#finishingseen').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function finishingseen_edit() {
    var row = $('#finishingseen').datagrid('getSelected');
    if (row !== null) {
        $('#finishingseen-form').dialog('open').dialog('setTitle', ' Edit finishingseen');
        $('#finishingseen-input').form('load', row);
        url = base_url + 'finishingseen/save/' + row.modelid + '/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Plywood to edit', 'warning');
    }
}

function finishingseen_delete() {
    var row = $('#finishingseen').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'finishingseen/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#finishingseen').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose finishingseen to delete', 'warning');
    }
}

