/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function customer_search() {
    $('#customer').datagrid('reload', {
        code: $('#customer_code_s').val(),
        name: $('#customer_name_s').val()
    });
}

function customer_add() {
    $('#customer-form').dialog('open').dialog('setTitle', ' New customer');
    $('#customer-input').form('clear');
    url = base_url + 'customer/save';
}

function customer_save() {
    $('#customer-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#customer-form').dialog('close');
                $('#customer').datagrid('reload');
            } else {
                $.messager.allert('Error', result.msg, 'error');
            }
        }
    });
}

function customer_edit() {
    var row = $('#customer').datagrid('getSelected');
    if (row != null) {
        $('#customer-form').dialog('open').dialog('setTitle', ' Edit customer');
        $('#customer-input').form('load', row);
        url = base_url + 'customer/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose customer to edit', 'warning');
    }
}

function customer_delete() {
    var row = $('#customer').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'customer/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#customer').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose customer to delete', 'warning');
    }
}