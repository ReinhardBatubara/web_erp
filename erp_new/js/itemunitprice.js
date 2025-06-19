/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function itemunitprice_add() {
    var row = $('#item').datagrid('getSelected');
    if (row !== null) {
        $('#itemunitprice-form').dialog('open').dialog('setTitle', 'New Unit Item');
        $('#itemunitprice-input').form('clear');
        $('#iup_rate').numberbox('setValue',1);
        url = base_url + 'itemunitprice/save/' + row.id;
    } else {
        $.messager.alert('No Choose Item', 'Choose Item', 'warning');
    }
}

function itemunitprice_save() {
    $('#itemunitprice-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#itemunitprice-form').dialog('close');
                $('#itemunitprice').datagrid('reload');
                $('#itemwarehousestock').datagrid('reload');  
                item_search2();
            } else {
                $.messager.alert('Error Insert', result.msg, 'error');
            }
        }
    });
}

function itemunitprice_delete() {
    var row = $('#itemunitprice').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'itemunitprice/delete', {
                    id: row.id,
                    itemid: row.itemid,
                    unitcode: row.unitcode
                }, function(result) {
                    if (result.success) {
                        $('#itemunitprice').datagrid('reload');
                        $('#itemwarehousestock').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Choose Unit', 'Choose Unit to Delete', 'warning');
    }
}