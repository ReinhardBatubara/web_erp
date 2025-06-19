/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* global base_url */

function goodsreceive_add() {

//    $('#global_dialog').dialog({
//        title: 'New Goods Receive',
//        width: 700,
//        height: 420,
//        closed: false,
//        cache: true,
//        href: base_url + 'goodsreceive/add',
//        modal: true,
//        resizable: true,
//        buttons: [{
//                text: 'Save',
//                iconCls: 'icon-save',
//                handler: function () {
//                    goodsreceive_save()
//                }
//            }, {
//                text: 'Close',
//                iconCls: 'icon-remove',
//                handler: function () {
//                    $('#global_dialog').dialog('close');
//                }
//            }]
//    });


    $('#global_dialog').dialog({
        title: 'New Goods Receive',
        width: 400,
        height: 'auto',
        closed: false,
        cache: true,
        href: base_url + 'goodsreceive/input',
        modal: true,
        resizable: true,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    $('#goodreceive_input_form').form('submit', {
                        url: base_url + 'goodsreceive/insert',
                        onSubmit: function () {
                            return $(this).form('validate');
                        },
                        success: function (content) {
                            console.log(content);
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $('#global_dialog').dialog('close');
                                $('#goodsreceive').datagrid('reload');
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
        }
    });
}

function goodsreceive_receive() {
    var row = $('#po_list_outstanding').datagrid('getSelected');
    if (row !== null) {
//goodsreceive_add();
        $('#global_dialog').dialog({
            title: 'New Goods Receive',
            width: 700,
            height: 420,
            closed: false,
            cache: true,
            href: base_url + 'goodsreceive/add',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        goodsreceive_save()
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#gr_purchaseorderid').combogrid('setValue', row.id);
                $('#po_vendor').val(row.vendor);
                $('#list_item_receive').datagrid('reload', {
                    purchaseorderid: row.id
                });
            }
        });
    } else {
        $.messager.alert('No PO Selected', 'Please Select PO', 'error');
    }
}

function goodsreceive_save() {
    $('#list_item_receive').datagrid('endEdit', gr_lastIndex);
    var valid = $('#goodsreceive-input').form('validate');
    if (valid) {
        var gr_number = $('#gr_number').val();
        var date = $('#gr_date').datebox('getValue');
        var no_sj = $('#gr_no_sj').val();
        var purchaseorderid = $('#gr_purchaseorderid').combogrid('getValue');
        var remark = $('#remark').val();
        var checked_by = $('#gr_checked_by').combogrid('getValue');
        var rows = $('#list_item_receive').datagrid('getChanges');
        //alert(rows.length);
        var error = 0;
        if (rows.length !== 0) {
            var purchaseorderdetail_id = new Array();
            var qty_receive = new Array();
            var warehouseid = new Array();
            for (var i = 0; i < rows.length; i++) {
                if (rows[i].qty_receive !== '' && rows[i].qty_receive !== '0.00') {
                    purchaseorderdetail_id[i] = rows[i].id;
                    qty_receive[i] = rows[i].qty_receive;
                    if (user_option_group == -1) {
                        if (rows[i].itemid == 0) {
                            warehouseid[i] = 0;
                        } else {
                            warehouseid[i] = rows[i].warehouseid;
                        }
                    } else {
                        warehouseid[i] = user_option_group;
                    }
                    if (warehouseid[i] == '') {
                        error = 1;
                    }
                }
            }
            if (purchaseorderdetail_id.length !== 0) {
                if (error == 0) {
                    $.post(base_url + 'goodsreceive/save', {
                        gr_number: gr_number,
                        date: date,
                        no_sj: no_sj,
                        purchaseorderid: purchaseorderid,
                        purchaseorderdetail_id: purchaseorderdetail_id,
                        qty_receive: qty_receive,
                        warehouseid: warehouseid,
                        checked_by: checked_by,
                        remark: remark
                    }, function (content) {
                        var result = eval('(' + content + ')');
                        if (result.success) {
                            $('#global_dialog').dialog('close');
                            $('#goodsreceive').datagrid('reload');
                            $('#po_list_outstanding').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    });
                } else {
                    $.messager.alert('Invalid Input', 'Some Item need Warehouse to Store Item', 'error');
                }
            } else {
                $.messager.alert('No Item to receive', 'Set Qty Item to receive', 'error');
            }
        } else {
            $.messager.alert('No Item to receive', 'Set Qty Item to receive', 'error');
        }
    }
}

function goodsreceive_search() {
    $('#goodsreceive').datagrid('reload', $('#goodsreceive_search_form').serializeObject());
}

function goodsreceive_search2() {
    $('#goodsreceive').datagrid('reload', $('#goodsreceive_search_form2').serializeObject());
}

function goodsreceive_edit() {
    var row = $('#goodsreceive').datagrid('getSelected');
    if (row !== null) {
        $('#goodsreceive_edit-form').dialog('open').dialog('setTitle', 'Edit Goods Receive');
        $('#goodsreceive_edit-input').form('load', row);
    } else {
        $.messager.alert('No Goods Receive Choosed', 'Choose Goods Receive', 'error');
    }
}

function goodsreceive_update() {
    var row = $('#goodsreceive').datagrid('getSelected');
    if ($('#goodsreceive_edit-input').form('validate')) {
        $.post(base_url + 'goodsreceive/update', {
            id: row.id,
            date: $('#gr_edit_date').datebox('getValue'),
            no_sj: $('#gr_edit_no_sj').val(),
            checked_by: $('#gr_edit_checked_by').combobox('getValue'),
            remark: $('#gr_edit_remark').val()
        }, function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#goodsreceive_edit-form').dialog('close');
                $('#goodsreceive').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    }
}

function goodsreceive_delete() {
    var row = $('#goodsreceive').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'goodsreceive/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#goodsreceive').datagrid('reload');
                        $('#po_list_outstanding').datagrid('reload');
                        $('#goodsreceivedetail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Goods Receive Selected', 'Please Select Goods Receive', 'error');
    }

}

function goodsreceivedetail_search() {
    var row = $('#goodsreceive').datagrid('getSelected');
    var code = $('#gr_detail_code_s').val();
    var description = $('#gr_detail_description_s').val();
    var goodsreceiveid = 0;
    if (row !== null) {
        goodsreceiveid = row.id;
    }

    $('#goodsreceivedetail').datagrid({
        url: base_url + 'goodsreceivedetail/get',
        queryParams: {
            goodsreceiveid: goodsreceiveid,
            code: code,
            description: description
        }
    });
}

function goodsreceivedetail_add() {
    var row = $('#goodsreceive').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Add Item',
            width: 400,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'goodsreceive/detail_input/' + row.id + '/' + row.vendorid,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#goodsreceivedetail_input_form').form('submit', {
                            url: base_url + 'goodsreceivedetail/insert/' + row.id,
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                console.log(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#goodsreceivedetail').datagrid('reload');
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
            }
        });
    } else {
        $.messager.alert('No Goods Receive Selected', 'Please Select Goods Receive', 'error');
    }
}


function goodsreceivedetail_edit() {
    var row = $('#goodsreceivedetail').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Item',
            width: 400,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'goodsreceive/detail_edit',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#goodsreceivedetail_edit_form').form('submit', {
                            url: base_url + 'goodsreceivedetail/update/' + row.id,
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                console.log(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#goodsreceivedetail').datagrid('reload');
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
                if ($('#e23_goodsreceivedetail_warehouseid').length > 0) {
                    $('#e23_goodsreceivedetail_warehouseid').combobox('clear');
                    $('#e23_goodsreceivedetail_warehouseid').combobox('reload', base_url + 'item/get_warehouse/' + row.itemid + '/' + row.unitcode)
                }
                $('#goodsreceivedetail_edit_form').form('load', row);
                $(this).dialog('center');
            }
        });
    } else {
        $.messager.alert('No Goods Receive Selected', 'Please Select Goods Receive', 'error');
    }
}


function goodsreceivedetail_delete() {
    var row = $('#goodsreceivedetail').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'goodsreceive/detail_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#goodsreceive').datagrid('reload');
                        $('#goodsreceivedetail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Goods Receive Selected', 'Please Select Goods Receive', 'error');
    }

}


function goodsreceive_print() {
    var row = $('#goodsreceive').datagrid('getSelected');
    if (row !== null) {
        open_target('POST', base_url + 'goodsreceive/prints', {
            goodsreceiveid: row.id
        }, '_blank');
    } else {
        $.messager.alert('No Goods Receive Choosed', 'Choose Goods Receive', 'error');
    }
}

function goodsreceive_report() {
    $('#global_dialog').dialog({
        title: 'Goods Receive Report',
        width: 400,
        height: 'auto',
        closed: false,
        cache: true,
        href: base_url + 'goodsreceive/report',
        modal: true,
        resizable: true,
        buttons: [{
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
        }
    });
}

function goodsreceive_print_detail() {
    open_target('POST', base_url + 'goodsreceive/print_detail', $('#goodsreceive_search_form').serializeObject(), '_blank');
}




//STOCK IN MANUAL

function stock_in_search2() {
    $('#stock_in').datagrid('reload', $('#stock_in_form_search2').serializeObject());
}

function stock_in_add() {
    if ($('#stock_in_dialog')) {
        $('#bodydata').append("<div id='stock_in_dialog'></div>");
    }
    $('#stock_in_dialog').dialog({
        title: 'New Stock In',
        width: 400,
        height: 'auto',
        top: 100,
        closed: false,
        cache: false,
        href: base_url + 'goodsreceive/stock_in_add',
        modal: true,
        resizable: true,
        buttons: [
            {
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    stock_in_save();
                }
            },
            {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#stock_in_dialog').dialog('close');
                }
            }
        ],
        onLoad: function () {
            $(this).dialog('center');
            $('#stock_in-input').form('clear');
        }
    });
    url = base_url + 'goodsreceive/stock_in_save/0';
}

function stock_in_save() {
    $('#stock_in-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#stock_in_dialog').dialog('close');
                $('#stock_in').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function stock_in_edit() {
    var row = $('#stock_in').datagrid('getSelected');
    if (row != null) {
        if ($('#stock_in_dialog')) {
            $('#bodydata').append("<div id='stock_in_dialog'></div>");
        }
        $('#stock_in_dialog').dialog({
            title: 'Edit Stock In',
            width: 400,
            height: 'auto',
            top: 100,
            closed: false,
            cache: false,
            href: base_url + 'goodsreceive/stock_in_add',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        stock_in_save();
                    }
                },
                {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#stock_in_dialog').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $(this).dialog('center');
                $('#stock_in-input').form('load', row);
            }
        });
        url = base_url + 'goodsreceive/stock_in_save/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Stock In to Edit', 'warning');
    }
}

function stock_in_delete() {
    var row = $('#stock_in').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'goodsreceive/stock_in_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#stock_in').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Stock In to Delete', 'warning');
    }
}

function stock_in_detail_search() {
    var row = $('#stock_in').datagrid('getSelected');
    $('#stock_in_detail').datagrid('reload', {
        stock_in_id: row.id,
        itemcode: $('#stock_in_detail_search_itemcode').val(),
        itemdescription: $('#stock_in_detail_search_itemdescription').val()
    });
}

function stock_in_detail_add() {
    var row = $('#stock_in').datagrid('getSelected');
    if (row != null) {
        $('#global_dialog').dialog({
            title: 'Add Item',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'goodsreceive/stock_in_detail_add',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        stock_in_detail_save();
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
                $('#stock_in_detail-input').form('clear');
            }
        });
        url = base_url + 'goodsreceive/stock_in_detail_save/' + row.id + '/0';
    } else {
        $.messager.alert('Waring', 'Choose Stock In to Edit', 'warning');
    }
}

function stock_in_detail_edit() {
    var row = $('#stock_in_detail').datagrid('getSelected');
    if (row != null) {
        $('#global_dialog').dialog({
            title: 'Edit Item',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'goodsreceive/stock_in_detail_add',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        stock_in_detail_save();
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
                if ($('#stock_in_detail_warehouseid').length > 0) {
                    $('#stock_in_detail_warehouseid').combobox('clear');
                    $('#stock_in_detail_warehouseid').combobox('reload', base_url + 'item/get_warehouse/' + row.itemid + '/' + row.unitcode)
                }
                $('#stock_in_detail_itemid').focus();
                $('#stock_in_detail-input').form('load', row);
            }
        });
        url = base_url + 'goodsreceive/stock_in_detail_save/0/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Item to Edit', 'warning');
    }
}

function stock_in_detail_save() {
    $('#stock_in_detail-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#stock_in_detail').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}


function stock_in_detail_delete() {
    var row = $('#stock_in_detail').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'goodsreceive/stock_in_detail_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#stock_in_detail').datagrid('reload');
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


function stock_in_print() {
    var row = $('#stock_in').datagrid('getSelected');
    if (row !== null) {
        open_target('POST', base_url + 'goodsreceive/stock_in_print', {id: row.id}, '_blank');
    } else {
        $.messager.alert('Waring', 'Choose Stock In to Edit', 'warning');
    }

}

function stockindetail_summary_search() {
    if ($('#stockin_summary_form_search').form('validate')) {
        $('#stockin_summary').datagrid({
            url: base_url + 'goodsreceive/summary_get',
            queryParams: $('#stockin_summary_form_search').serializeObject()
        });
    }
}

function stock_in_detail_transaction_search() {
    if ($('#stock_in_all_detail_form_search').form('validate')) {
        $('#stock_in_all_detail').datagrid({
            url: base_url + 'goodsreceive/get_all_detail',
            queryParams: $('#stock_in_all_detail_form_search').serializeObject()
        });
    }
}

function stock_in_detail_transaction_print() {
//alert($('#stock_in_all_detail').datagrid('options').sortName());
    if ($('#stock_in_all_detail_form_search').form('validate')) {
        open_target('POST', base_url + 'goodsreceive/print_all_detail',
                $('#stock_in_all_detail_form_search').serializeObject(), '_blank');
    }
}

function stock_in_detail_transaction_excel() {
    if ($('#stock_in_all_detail_form_search').form('validate')) {
        open_target('POST', base_url + 'goodsreceive/excel_all_detail',
                $('#stock_in_all_detail_form_search').serializeObject(), '_blank');
    }
}