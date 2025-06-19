/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function currency_search() {
    $('#currency').datagrid('reload', $('#currency_search_form').serializeObject());
}

function currency_add() {
    $('#currency-form').dialog('open').dialog('setTitle', ' New currency');
    $('#currency-input').form('clear');
    url = base_url + 'currency/save';
}

function currency_save() {
    $('#currency-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#currency-form').dialog('close');
                $('#currency').datagrid('reload');
            } else {
                $.messager.allert('Error', result.msg, 'error');
            }
        }
    });
}

function currency_edit() {
    var row = $('#currency').datagrid('getSelected');
    if (row != null) {
        $('#currency-form').dialog('open').dialog('setTitle', ' Edit curency');
        $('#currency-input').form('load', row);
        url = base_url + 'currency/update/' + row.curr;
    } else {
        $.messager.alert('Waring', 'Choose model category to edit', 'warning');
    }
}

function currency_delete() {
    var row = $('#currency').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'currency/delete', {
                    curr: row.curr
                }, function(result) {
                    if (result.success) {
                        $('#currency').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose currency to delete', 'warning');
    }
}

