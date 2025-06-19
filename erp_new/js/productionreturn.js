/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/* global base_url */

function productionreturn_search2() {
    $('#productionreturn').datagrid('reload', $('#productionreturn_form_search2').serializeObject());
}

function productionreturn_add() {
    $('#productionreturn-form').dialog('open').dialog('setTitle', 'New Return');
    $('#productionreturn-input').form('clear');
    url = base_url + 'productionreturn/save/0';
}

function productionreturn_save() {
    $('#productionreturn-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#productionreturn-form').dialog('close');
                $('#productionreturn').datagrid('reload');
            } else {
                $.messager.allert('Error', result.msg, 'error');
            }
        }
    });
}

function productionreturn_edit() {
    var row = $('#productionreturn').datagrid('getSelected');
    if (row != null) {
        $('#productionreturn-form').dialog('open').dialog('setTitle', 'Edit Production Return');
        $('#productionreturn-input').form('load', row);
        url = base_url + 'productionreturn/save/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Production Return to Edit', 'warning');
    }
}
function productionreturn_delete() {
    var row = $('#productionreturn').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'productionreturn/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#productionreturn').datagrid('reload');
                        $('#productionreturndetail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Production Return to Delete', 'warning');
    }
}

function productionreturn_detail_search() {
    var row = $('#productionreturn').datagrid('getSelected');
    $('#productionreturndetail').datagrid('reload', {
        productionreturnid: row.id,
        itemcode: $('#productionreturndetail_search_itemcode').val(),
        itemdescription: $('#productionreturndetail_search_itemdescription').val()
    });
}

function productionreturn_detail_add() {
    var row = $('#productionreturn').datagrid('getSelected');
    if (row != null) {
        $('#productionreturndetail-form').dialog('open').dialog('setTitle', 'Edit Production Return');
        $('#productionreturndetail-input').form('clear');
        url = base_url + 'productionreturn/detail_save/' + row.id + '/0';
    } else {
        $.messager.alert('Waring', 'Choose Production Return to Edit', 'warning');
    }
}

function productionreturndetail_save() {
    $('#productionreturndetail-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#productionreturndetail-form').dialog('close');
                $('#productionreturndetail').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function productionreturn_detail_edit() {
    var row = $('#productionreturndetail').datagrid('getSelected');
    if (row != null) {
        $('#productionreturndetail-form').dialog('open').dialog('setTitle', 'Edit Item');
        if ($('#productionreturndetail_warehouseid').length) {
            $('#productionreturndetail_warehouseid').combobox('clear');
            $('#productionreturndetail_warehouseid').combobox('reload', base_url + 'itemwarehousestock/get_warehouse_for_combo_by_item_id/' + row.itemid);
        }
        $('#productionreturndetail-input').form('load', row);
        url = base_url + 'productionreturn/detail_save/0/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Item to Edit', 'warning');
    }
}

function productionreturn_detail_delete() {
    var row = $('#productionreturndetail').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'productionreturn/detail_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#productionreturndetail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Item to Delete', 'warning');
    }
}

function productionreturn_print() {
    var row = $('#productionreturn').datagrid('getSelected');
    if (row !== null) {
        window.open(base_url + 'productionreturn/prints/' + row.id, 'Stock Opname',
                'width=1000,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=no ,modal=yes');
    } else {
        $.messager.alert('Waring', 'Choose Production Return to Delete', 'warning');
    }
}