/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/* global base_url */

var stockopname_url = '';


function stockopname_search() {
    $('#stockopname').datagrid('reload', $('#stockopname_search_form').serializeObject());
}

function stockopname_detail_search() {
    var data = $('#stockopname_detail_search_form').serializeObject();
    $.extend(data, {stockopnameid: $('#stockopname').datagrid('getSelected').id});
    $('#stockopname_detail').datagrid('reload', data);
}


function stockopname_input_form(type, title, row) {
    if ($('#stockopname_dialog')) {
        $('#bodydata').append("<div id='stockopname_dialog'></div>");
    }

    $('#stockopname_dialog').dialog({
        title: title,
        width: 400,
        height: 'auto',
        href: base_url + 'stockopname/input',
        modal: true,
        resizable: true,
        top: 60,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    stockopname_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#stockopname_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
            if (type === 'edit') {
                $('#stockopname_input_form').form('load', row);
            } else {
                $('#stockopname_input_form').form('clear');
            }
        }
    });
}

function stockopname_add() {
    stockopname_input_form('add', 'ADD STOCK OPNAME', null);
    stockopname_url = base_url + 'stockopname/save/0';
}

function stockopname_edit() {
    var row = $('#stockopname').datagrid('getSelected');
    if (row !== null) {
        stockopname_input_form('edit', 'EDIT STOCK OPNAME', row);
        stockopname_url = base_url + 'stockopname/save/' + row.id;
    } else {
        $.messager.alert('No Stock Opname Selected', 'Please Select Stock Opname', 'warning');
    }
}

function stockopname_save() {
    $('#stockopname_input_form').form('submit', {
        url: stockopname_url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#stockopname').datagrid('reload');
                $('#stockopname_dialog').dialog('close');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function stockopname_delete() {
    var row = $('#stockopname').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'stockopname/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#stockopname').datagrid('reload');
                        $('#stockopname_detail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Stock Opname Selected', 'Please Select Stock Opname', 'warning');
    }
}

function stockopname_posting() {
    var row = $('#stockopname').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Posting transaction will update stock in system with Real Stock<br>Are you sure?', function (r) {
            if (r) {
                $.post(base_url + 'stockopname/posting', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#stockopname').datagrid('reload');
                        $('#stockopname_detail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Stock Opname Selected', 'Please Select Stock Opname', 'warning');
    }
}

function stockopname_print() {
    var row = $('#stockopname').datagrid('getSelected');
    if (row !== null) {
        open_target('POST', base_url + 'stockopname/prints', {stockopnameid: row.id}, '_blank');
    } else {
        $.messager.alert('No Stock Opname Selected', 'Please Select Stock Opname', 'warning');
    }
}


function stockopname_detail_input_form(type, title, row) {
    if ($('#stockopname_detail_dialog')) {
        $('#bodydata').append("<div id='stockopname_detail_dialog'></div>");
    }
    $('#stockopname_detail_dialog').dialog({
        title: title,
        width: 400,
        height: 'auto',
        href: base_url + 'stockopname/detail_input/' + row.warehouseid,
        modal: true,
        resizable: true,
        top: 60,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    stockopname_detail_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#stockopname_detail_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
            if (type === 'edit') {
                $('#stokopname_detail_input_form').form('load', row);
            } else {
                $('#stokopname_detail_input_form').form('clear');
            }
        }
    });
}

function stockopname_detail_add() {
    var row = $('#stockopname').datagrid('getSelected');
    console.log(row);
    if (row !== null) {
        stockopname_detail_input_form('add', 'ADD ITEM', row);
        stockopname_detail_url = base_url + 'stockopname/detail_save/0/' + row.id;
    } else {
        $.messager.alert('No Stock Opname Selected', 'Please Select Stock Opname', 'warning');
    }
}

function stockopname_detail_edit() {
    var row = $('#stockopname_detail').datagrid('getSelected');
    if (row !== null) {
        stockopname_detail_input_form('edit', 'EDIT ITEM', row);
        stockopname_detail_url = base_url + 'stockopname/detail_save/' + row.id + '/0';
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function stockopname_detail_save() {
    $('#stokopname_detail_input_form').form('submit', {
        url: stockopname_detail_url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#stockopname_detail').datagrid('reload');
                $('#stockopname_detail_dialog').dialog('close');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function stockopname_detail_delete() {
    var row = $('#stockopname_detail').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'stockopname/detail_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#stockopname_detail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}