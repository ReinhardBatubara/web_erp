/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* global base_url */

function pricecomparison_view() {
    var row = $('#purchaserequest').datagrid('getSelected');
    if (row !== null) {

        if ($('#pricecomparison_dialog')) {
            $('#bodydata').append("<div id='pricecomparison_dialog'></div>");
        }

        $('#pricecomparison_dialog').dialog({
            title: 'Price Comparison',
            width: 1200,
            height: 500,
            closed: false,
            cache: false,
            href: base_url + 'pricecomparison',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#pricecomparison_dialog').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $('#itemlist').datagrid('reload', {purchaserequestid: row.id});
                $('#vendorlist').datagrid('reload', {});
                $(this).dialog('hcenter');
                $('#purchaserequest-input').form('clear');
            }
        });
    } else {
        $.messager.alert('Warning', 'Please Choose Purchase Request', 'warning');
    }
}

function pricecomparison_add() {
    var row = $('#itemlist').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Add Vendor',
            width: 400,
            height: 'auto',
            top: 100,
            closed: false,
            cache: false,
            href: base_url + 'pricecomparison/load_input',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        pricecomparison_save();
                    }
                },
                {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $(this).dialog('center');
                $('#pricecomparison_add-input').form('clear');
            }
        });
        url = base_url + 'pricecomparison/save/' + row.id + '/' + row.qty;
    } else {
        $.messager.alert('Waring', 'Choose item', 'warning');
    }
}

function pricecomparison_save() {
    $('#pricecomparison_add-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
//            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#vendorlist').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function pricecomparison_edit() {
    var row_item = $('#itemlist').datagrid('getSelected');
    var row = $('#vendorlist').datagrid('getSelected');
    if (row !== null) {

        $('#global_dialog').dialog({
            title: 'Edit Vendor Price',
            width: 400,
            height: 'auto',
            top: 100,
            closed: false,
            cache: false,
            href: base_url + 'pricecomparison/load_input',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        pricecomparison_save();
                    }
                },
                {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $(this).dialog('center');
                $('#pricecomparison_add-input').form('load', row);
            }
        });
        url = base_url + 'pricecomparison/update/' + row.id + '/' + row_item.qty;
    } else {
        $.messager.alert('Waring', 'Choose item', 'warning');
    }
}

function pricecomparison_delete() {
    var row = $('#vendorlist').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'pricecomparison/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#vendorlist').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose vendor to delete', 'warning');
    }
}

function pricecomparison_setselected() {

    var row = $('#vendorlist').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to set vendor price?', function (r) {
            $.post(base_url + 'pricecomparison/setselected', {
                id: row.id,
                purchaserequestdetailid: row.purchaserequestdetailid,
                vendorid: row.vendorid,
                price: row.price,
                discount: row.discount,
                ppn: row.ppn,
                amount: row.amount,
                currency: row.currency
            }, function (content) {
//                alert(content);
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#vendorlist').datagrid('reload');
                    $('#purchaserequestdetail').datagrid('reload');
                    $.messager.show({
                        title: 'Price Comparison Selected',
                        msg: 'Set Price Successfull',
                        showType: 'show'
                    });
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            });
        });
    } else {
        $.messager.alert('Waring', 'Choose Vendor List', 'warning');
    }
}

function pricecomparison_preview() {
    var row = $('#purchaserequest').datagrid('getSelected');
    if (row !== null) {

        if ($('#pricecomparison_view')) {
            $('#bodydata').append("<div id='pricecomparison_view'></div>");
        }
        $('#pricecomparison_view').dialog({
            title: 'New Purchase Request',
            width: 820,
            height: 600,
            closed: false,
            cache: false,
            href: base_url + 'pricecomparison/preview/' + row.id + '/view',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#pricecomparison_view').dialog('close');
                    }
                }
            ],
            toolbar: [
                {
                    text: 'Pdf',
                    iconCls: 'icon-pdf',
                    handler: function () {
                        alert('Underconstruction');
                    }
                }, {
                    text: 'Print',
                    iconCls: 'icon-print',
                    handler: function () {
                        open_target('POST', base_url + 'pricecomparison/preview/' + row.id + '/print', {}, '_blank');
                    }
                }
            ],
            onLoad: function () {
                $(this).dialog('center');
            }
        });
//        $('#pricecomparison_view').dialog({
//            title: 'Price Comparison',
//            width: 820,
//            height: 600,
//            closed: false,
//            cache: false,
//            href: base_url + 'pricecomparison/preview/' + row.id + '/view',
//            modal: true,
//            toolbar: '#pricecomparison_view_toolbar'
//        });
    } else {
        $.messager.alert('No Purchase Request', 'Choose Purchase Request', 'warning');
    }
}