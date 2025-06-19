/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function finishingunseen_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#finishingunseen-form').dialog('open').dialog('setTitle', ' New Finishing Unseen');
        $('#finishingunseen-input').form('clear');
        url = base_url + 'finishingunseen/save/' + row.id + '/0';
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }

}

function finishingunseen_save() {
    $('#finishingunseen-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
//            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#finishingunseen-form').dialog('close');
                $('#finishingunseen').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function finishingunseen_edit() {
    var row = $('#finishingunseen').datagrid('getSelected');
    if (row !== null) {
        $('#finishingunseen-form').dialog('open').dialog('setTitle', ' Edit Finishing Unseen');
        $('#finishingunseen-input').form('load', row);
        url = base_url + 'finishingunseen/save/' + row.modelid + '/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Plywood to edit', 'warning');
    }
}

function finishingunseen_delete() {
    var row = $('#finishingunseen').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'finishingunseen/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#finishingunseen').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose finishingunseen to delete', 'warning');
    }
}

