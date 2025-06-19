/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function transferstock_search2() {
    $('#transferstock').datagrid('reload', $('#transferstock_form_search2').serializeObject());
}

function transferstock_add() {
    $('#transferstock-form').dialog('open').dialog('setTitle', 'New Transfer Stock');
    $('#transferstock-input').form('clear');
    $('#transferstock_fromwarehouseid').combobox('enable');
    $('#transferstock_towarehouseid').combobox('enable');
    url = base_url + 'transferstock/save/0';
}

function transferstock_save() {
    $('#transferstock-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#transferstock-form').dialog('close');
                $('#transferstock').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function transferstock_edit() {
    var row = $('#transferstock').datagrid('getSelected');
    if (row != null) {
        $('#transferstock-form').dialog('open').dialog('setTitle', 'Edit Production Return');
        $('#transferstock-input').form('load', row);
        $('#transferstock_towarehouseid').combobox('reload', base_url + 'warehouse/get_filter/' + row.fromwarehouseid);
        var row_detail = $('#transferstockdetail').datagrid('getRows');
        if (row_detail.length > 0) {
            $('#transferstock_fromwarehouseid').combobox('disable');
            $('#transferstock_towarehouseid').combobox('disable');
        } else {
            $('#transferstock_fromwarehouseid').combobox('enable');
            $('#transferstock_towarehouseid').combobox('enable');
        }
        url = base_url + 'transferstock/save/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Production Return to Edit', 'warning');
    }
}

function transferstock_print() {
    var row = $('#transferstock').datagrid('getSelected');
    if (row != null) {
        open_target('POST', base_url + 'transferstock/prints', {id: row.id}, '_blank');
    } else {
        $.messager.alert('Waring', 'Choose Production Return to Delete', 'warning');
    }
}
function transferstock_delete() {
    var row = $('#transferstock').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'transferstock/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#transferstock').datagrid('reload');
                        $('#transferstockdetail').datagrid('reload');
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

function transferstock_detail_search() {
    var row = $('#transferstock').datagrid('getSelected');
    $('#transferstockdetail').datagrid('reload', {
        transferstockid: row.id,
        itemcode: $('#transferstockdetail_search_itemcode').val(),
        itemdescription: $('#transferstockdetail_search_itemdescription').val()
    });
}

function transferstock_detail_add() {
    var row = $('#transferstock').datagrid('getSelected');
    if (row != null) {
        $('#global_dialog').dialog({
            title: 'Add Item',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'transferstock/detail_add/' + row.fromwarehouseid + '/' + row.towarehouseid,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        transferstockdetail_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                $('#transferstockdetail-input').form('clear');
                $('#transferstockdetail_itemid_last').val(0);
                $('#transferstockdetail_stock_input').val(0);
            }
        });
        url = base_url + 'transferstock/detail_save/' + row.id + '/0';
    } else {
        $.messager.alert('Waring', 'Choose Production Return to Edit', 'warning');
    }
}

function transferstockdetail_save() {
    $('#transferstockdetail-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#transferstockdetail').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function transferstock_detail_edit() {
    var row = $('#transferstockdetail').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Add Item',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'transferstock/detail_add/' + row.fromwarehouseid + '/' + row.towarehouseid,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        transferstockdetail_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#transferstockdetail-input').form('load', row);
                $('#transferstockdetail_itemid_last').val(row.itemid);
                $('#transferstockdetail_stock_input').val(row.qty);

                $.get(base_url + 'itemwarehousestock/get_stock/' + row.itemid + '/' + row.unitcode + '/' + row.fromwarehouseid, function (content) {
                    var new_stock = parseFloat(row.qty) + parseFloat(content);
                    $('#transferstockdetail_item_stock_qty521').val(new_stock);
                });
                $(this).dialog('center');
            }
        });
        url = base_url + 'transferstock/detail_save/0/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Item to Edit', 'warning');
    }
}

function transferstock_detail_delete() {
    var row = $('#transferstockdetail').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'transferstock/detail_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#transferstockdetail').datagrid('reload');
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