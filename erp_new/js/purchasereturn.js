/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/* global base_url */

function purchasereturn_search2() {
    $('#purchasereturn').datagrid('reload', $('#purchasereturn_form_search2').serializeObject());
}

function purchasereturn_input(type, title, row) {
    if ($('#purchasereturn_dialog')) {
        $('#bodydata').append("<div id='purchasereturn_dialog'></div>");
    }
    $('#purchasereturn_dialog').dialog({
        title: title,
        width: 400,
        height: 'auto',
        href: base_url + 'purchasereturn/input',
        modal: true,
        resizable: false,
        shadow: false,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    purchasereturn_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#purchasereturn_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
            if (type === 'edit') {
                $('#purchasereturn_input').form('load', row);
            } else {
                $('#purchasereturn_input').form('clear');
            }

        }
    });
}

function purchasereturn_add() {
    purchasereturn_input('add', 'New Purchase Return', null);
    url = base_url + 'purchasereturn/save/0';
}

function purchasereturn_save() {
    $('#purchasereturn_input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#purchasereturn_dialog').dialog('close');
                $('#purchasereturn').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function purchasereturn_edit() {
    var row = $('#purchasereturn').datagrid('getSelected');
    if (row !== null) {
        purchasereturn_input('edit', 'Edit Purchase Return', row);
        url = base_url + 'purchasereturn/save/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Purchase Return to Edit', 'warning');
    }
}

function purchasereturn_print() {
    var row = $('#purchasereturn').datagrid('getSelected');
    if (row !== null) {
        window.open(base_url + 'purchasereturn/prints/' + row.id, 'Purchase Return',
                'width=1000,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=no ,modal=yes');
    } else {
        $.messager.alert('No Purchase Return Selected', 'Please Select Purchase Return', 'warning');
    }
}

function purchasereturn_delete() {
    var row = $('#purchasereturn').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'purchasereturn/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#purchasereturn').datagrid('reload');
                        $('#purchasereturndetail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Purchase Return to Delete', 'warning');
    }
}

function purchasereturn_detail_search() {
    var row = $('#purchasereturn').datagrid('getSelected');
    $('#purchasereturndetail').datagrid('reload', {
        purchasereturnid: row.id,
        itemcode: $('#purchasereturndetail_search_itemcode').val(),
        itemdescription: $('#purchasereturndetail_search_itemdescription').val()
    });
}

function purchasereturn_detail_add() {
    var row = $('#purchasereturn').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Add Item',
            width: 400,
            closed: false,
            cache: false,
            href: base_url + 'purchasereturn/detail_add/' + row.goodsreceiveid,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#purchasereturndetail-input').form('submit', {
                            url: base_url + 'purchasereturn/detail_save/' + row.id + '/0',
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#purchasereturndetail').datagrid('reload');
                                } else {
                                    $.messager.alert('Error', result.msg, 'error');
                                }
                            }
                        });
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
                $('#purchasereturndetail-input').form('clear');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Purchase Return to Edit', 'warning');
    }
}

function purchasereturndetail_save() {
    $('#purchasereturndetail-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#purchasereturndetail-form').dialog('close');
                $('#purchasereturndetail').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function purchasereturn_detail_edit() {
    var row = $('#purchasereturndetail').datagrid('getSelected');
    if (row != null) {
        $('#global_dialog').dialog({
            title: 'Edit Item',
            width: 400,
            closed: false,
            cache: false,
            href: base_url + 'purchasereturn/detail_add/' + row.goodsreceiveid,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#purchasereturndetail-input').form('validate')) {
                            $.post(base_url + 'purchasereturn/detail_save/0/' + row.id, $('#purchasereturndetail-input').serializeObject(), function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#purchasereturndetail').datagrid('reload');
                                } else {
                                    $.messager.alert('Error', result.msg, 'error');
                                }
                            });
                        }
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                if ($('#prt_detail_warehouseid')) {
                    $('#prt_detail_warehouseid').combobox('clear');
                    $('#prt_detail_warehouseid').combobox('reload', base_url + 'item/get_warehouse/' + row.itemid + '/' + row.unitcode)
                }
                $('#purchasereturndetail-input').form('load', row);
                $(this).dialog('center');
            }
        });

    } else {
        $.messager.alert('Waring', 'Choose Item to Edit', 'warning');
    }
}

function purchasereturn_detail_delete() {
    var row = $('#purchasereturndetail').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'purchasereturn/detail_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#purchasereturndetail').datagrid('reload');
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