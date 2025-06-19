/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function purchaseorder_search() {
    $('#purchaseorder').datagrid('reload', $('#purchaseorder_search-form').serializeObject());
}

function purchaseorder_print_detail() {
    open_target('POST', base_url + 'purchaseorder/print_detail', $('#purchaseorder_search-form').serializeObject(), '_blank');
}

function purchaseorder_clear_search() {
    $('#purchaseorder_search-form').form('clear');
    purchaseorder_search();
}

function purchaseorder_create() {
    var row = $('#purchaserequest').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure?', function (r) {
            if (r) {
                $.post(base_url + 'purchaseorder/create', {
                    purchaserequestid: row.id
                }, function (content) {
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        addTab('Purchase Order', 'purchaseorder');
                        $('#purchaseorder').datagrid('reload');
                        $('#purchaserequest').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                });

            }
        });
    } else {
        $.messager.alert('No Purchase Request', 'Choose Purchase Request', 'warning');
    }
}

function purchaseorder_save() {
    $('#purchaseorder-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#purchaseorder-form').dialog('close');
                $('#purchaseorder').datagrid('reload');
                $('#purchaserequest').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function purchaseorder_print() {
    var row = $('#purchaseorder').datagrid('getSelected');
    if (row !== null) {
        window.open(base_url + 'purchaseorder/prints/' + row.id + '/print', '_blank')
    } else {
        $.messager.alert('Error', 'Choose Purchase Order to Print', 'error');
    }
}

function purchaseorder_open() {
    var row = $('#purchaseorder').datagrid('getSelected');
    if (row !== null) {
        if (row.status == 0 || row.status == 3) {
            $.messager.confirm('Confirm', 'Are you sure you want to open this PO to receive?', function (r) {
                if (r) {
                    $.post(base_url + 'purchaseorder/open', {
                        id: row.id,
                        status: 1
                    }, function (result) {
                        if (result.success) {
                            $('#purchaseorder').datagrid('reload');
                            $('#purchaseorderdetail').datagrid('reload');
                            $.messager.show({
                                title: 'Notification',
                                msg: 'Selected Purchase Order Available to receive now!',
                                showType: 'slide'
                            });
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.alert('Open PO', 'This PO already open to receive', 'error');
        }
    } else {
        $.messager.alert('No Purchase Order Choosed', 'Choose Purchase Order', 'error');
    }
}

function purchaseorder_close() {
    var row = $('#purchaseorder').datagrid('getSelected');
    if (row !== null) {
        if (row.status == 1) {
            $.messager.confirm('Confirm', 'Are you sure you want to close this PO?', function (r) {
                if (r) {
                    $.post(base_url + 'purchaseorder/open', {
                        id: row.id,
                        status: 3
                    }, function (result) {
                        if (result.success) {
                            $('#purchaseorder').datagrid('reload');
                            $.messager.show({
                                title: 'Notification',
                                msg: 'Selected Purchase Order Closed!',
                                showType: 'slide'
                            });
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else if (row.status == 3) {
            $.messager.alert('Action Interupted', 'PO Already Close', 'error');
        } else if (row.status == 2) {
            $.messager.alert('Action Interupted', 'Unable to close finish PO', 'error');
        } else {
            $.messager.alert('Action Interupted', 'Unable to close new PO', 'error');
        }
    } else {
        $.messager.alert('No Purchase Order Choosed', 'Choose Purchase Order', 'error');
    }
}


function purchaseorder_edit() {
    var row = $('#purchaseorder').datagrid('getSelected');
    if (row !== null) {
        $('#purchaseorder_edit-form').dialog('open').dialog('setTitle', 'Edit Purchase Order');
        $('#purchaseorder_edit-input').form('load', row);
        url = base_url + 'purchaseorder/update/' + row.id;
    } else {
        $.messager.alert('No Purchase Order Choosed', 'Choose Purchase Order', 'error');
    }
}

function purchaseorder_change_vendor() {
    var row = $('#purchaseorder').datagrid('getSelected');
    if (row !== null) {
        if ($('#purchaseorder_dialog')) {
            $('#bodydata').append("<div id='purchaseorder_dialog'></div>");
        }
        $('#purchaseorder_dialog').dialog({
            title: 'Edit Vendor',
            width: 400,
            height: 'auto',
            href: base_url + 'purchaseorder/change_vendor',
            modal: true,
            resizable: false,
            shadow: false,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#po_change_vendor_form').form('submit', {
                            url: base_url + 'purchaseorder/update_vendor',
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                console.log(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#purchaseorder_dialog').dialog('close');
                                    $('#purchaseorder').datagrid('reload');
                                    $('#purchaserequest').datagrid('reload');
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
                        $('#purchaseorder_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                $('#po_change_vendor_form').form('load', row);
            }
        });
    } else {
        $.messager.alert('No Purchase Order Choosed', 'Choose Purchase Order', 'error');
    }
}

function purchaseorder_update() {
    $('#purchaseorder_edit-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#purchaseorder_edit-form').dialog('close');
                $('#purchaseorder').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}



function purchaseorderdetail_search() {
    var code = $('#purchaseorderdetail_code_s').val();
    var description = $('#purchaseorderdetail_description_s').val();
    var row = $('#purchaseorder').datagrid('getSelected');
    if (row != null) {
        $('#purchaseorderdetail').datagrid('reload', {
            purchaseorderid: row.id,
            itemcode: code,
            itemdescription: description
        });
    }

}

function purchaseorderdetail_clear_search() {
    $('#purchaseorderdetail_code_s').val('');
    $('#purchaseorderdetail_description_s').val();
    purchaseorderdetail_search();
}

function purchaseorder_outstanding() {
    $('#global_dialog').dialog({
        title: 'Outstanding Receive',
        width: 850,
        height: 500,
        closed: false,
        cache: false,
        href: base_url + 'purchaseorder/outstanding_item',
        modal: true,
        resizable: true,
        buttons: [
            {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }
        ]
    });
}

function purchaseorder_outstanding_search() {
    $('#po_outstanding_receive').datagrid('reload', $('#po_outstanding_search-form').serializeObject())
}

function purchaseorder_outstanding_print() {
    open_target('POST', base_url + 'purchaseorder/print_outstanding_item', $('#po_outstanding_search-form').serializeObject(), '_blank')
}

function purchaseorder_by_item_search() {
    $('#po_item').datagrid('reload', $('#purchaseorder_by_item_by_item_search-form').serializeObject())
}

function purchaseorder_by_item_print() {
    open_target('POST', base_url + 'purchaseorder/print_report', $('#purchaseorder_by_item_by_item_search-form').serializeObject(), '_blank')
}

function purchaseorder_item_change_status(status) {
    var rows = $('#po_item').datagrid('getSelections');
    var msg = '';
    if (rows.length > 0) {
        var arr_po_item = new Array();
        for (var i = 0; i < rows.length; i++) {
            if (rows[i].status == 'finish') {
                msg = 'Some item selected already finish receive';
                break;
            }
            arr_po_item.push(rows[i].id);
        }
        if (msg == '') {
            if (status == 'close') {
                $('#temp_close_item').dialog({
                    title: 'Close PO Item',
                    width: 250,
                    height: 'auto',
                    closed: false,
                    cache: false,
                    href: base_url + 'purchaseorder/close_po_item',
                    modal: true,
                    resizable: true,
                    buttons: [{
                            text: 'Save',
                            iconCls: 'icon-save',
                            handler: function () {
                                var option_price = $('input:radio[name=option_price]:checked').val();
                                if (option_price != null) {
                                    $.post(base_url + 'purchaseorderdetail/do_close', {
                                        poitem: arr_po_item,
                                        status: status,
                                        option_price: option_price
                                    }, function (content) {
                                        var result = eval('(' + content + ')');
                                        if (result.success) {
                                            $('#temp_close_item').dialog('close');
                                            $('#po_item').datagrid('reload');
                                        } else {
                                            $.messager.alert('Error', result.msg, 'error');
                                        }

                                    });
                                } else {
                                    $.messager.alert('Action interupted', 'Please choose option to set sell price for item', 'warning');
                                }
                            }
                        }, {
                            text: 'Close',
                            iconCls: 'icon-remove',
                            handler: function () {
                                $('#temp_close_item').dialog('close');
                            }
                        }
                    ]
                });
            } else {
                $.messager.confirm('Confirm', 'Are you sure you want to open this item?', function (r) {
                    if (r) {
                        $.post(base_url + 'purchaseorderdetail/change_status', {
                            poitem: arr_po_item,
                            status: status
                        }, function (content) {
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $('#po_item').datagrid('reload');
                            } else {
                                $.messager.alert('Error', result.msg, 'error');
                            }

                        });
                    }
                });
            }

        } else {
            $.messager.alert('Action interupted', msg, 'warning');
        }
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}