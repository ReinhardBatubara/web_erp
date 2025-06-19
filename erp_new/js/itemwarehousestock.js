/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function itemwarehousestock_set_store(warehouseid) {
    var row = $('#item').datagrid('getSelected');
    if (row !== null) {
        var unit_row = $('#itemunitprice').datagrid('getRows');
        if (unit_row.length !== 0) {
            //            $.messager.confirm('Confirm', 'Are you sure?', function(r) {
            //                if (r) {
            $.post(base_url + 'itemwarehousestock/set_store', {
                itemid: row.id,
                warehouseid: warehouseid
            }, function(result) {
                if (result.success) {
                    $('#itemwarehousestock').datagrid('reload');
                    item_search2();
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }, 'json');
        //                }
        //            });
        } else {
            $.messager.alert('No Choose Item', 'Need to set unit for store to warehouse', 'warning');
        }
    } else {
        $.messager.alert('No Choose Item', 'Choose Item', 'warning');
    }
}

function itemwarehousestock_edit() {
    var row = $('#itemwarehousestock').datagrid('getSelected');
    if (row !== null) {
        $('#itemwarehousestock_edit-form').dialog('open').dialog('setTitle', 'Edit Warehouse Unit');        
        $('#itemwarehousestock_edit-input').form('load', row);
        url = base_url + 'itemwarehousestock/update/' + row.id;
    } else {
        $.messager.alert('No Choose Item', 'Choose Warehouse Unit', 'warning');
    }
}

function itemwarehousestock_delete(){
    var row = $('#itemwarehousestock').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure?', function(r) {
            if (r) {
                $.post(base_url + 'itemwarehousestock/remove', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#itemwarehousestock').datagrid('reload');
                        $('#item').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Choose Item', 'Choose Warehouse Unit', 'warning');
    }
}

function itemwarehousestock_edit_update() {
    $('#itemwarehousestock_edit-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#itemwarehousestock_edit-form').dialog('close');
                $('#itemwarehousestock').datagrid('reload');
            } else {
                $.messager.alert('Error Update', result.msg, 'error');
            }
        }
    });
}