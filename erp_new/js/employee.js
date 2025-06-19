/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function employee_search(){
    $('#employee').datagrid('load',$('#employee_form_search2').serializeObject());
}

function employee_add() {
    $('#employee-form').dialog('open').dialog('setTitle', 'New employee');
    $('#employee-input').form('clear');
    url = base_url + 'employee/save';
}

function employee_save() {
    $('#employee-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#employee-form').dialog('close');
                $('#employee').datagrid('reload');
                $.messager.show({
                    title: 'Notification',
                    msg: 'Successfull !',
                    showType: 'slide'
                });
            } else {
                $.messager.allert('Error', result.msg, 'error');
            }
        }
    });
}

function employee_edit() {
    var row = $('#employee').datagrid('getSelected');
    if (row != null) {
        $('#employee-form').dialog('open').dialog('setTitle', ' Edit employee');
        $('#employee-input').form('load', row);
        url = base_url + 'employee/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose employee to edit', 'warning');
    }
}

function employee_delete() {
    var row = $('#employee').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'employee/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#employee').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose employee to delete', 'warning');
    }
}