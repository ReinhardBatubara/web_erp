/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global base_url */

function purchaserequestdetail_search() {
    var row = $('#purchaserequest').datagrid('getSelected');
    var itemcode = $('#purchaserequestdetail_code_s').val();
    var description = $('#purchaserequestdetail_description_s').val();
    var purchaserequestid = 0;
    if (row !== null) {
        purchaserequestid = row.id;
    }
    $('#purchaserequestdetail').datagrid('reload', {
        purchaserequestid: purchaserequestid,
        itemcode: itemcode,
        description: description
    });
}


function purchaserequestdetail_add() {
    var row = $('#purchaserequest').datagrid('getSelected');
    if (row !== null) {
        $('#purchaserequestdetail-form').dialog('open').dialog('setTitle', 'Item Request');
        $('#purchaserequestdetail-input').form('clear');
        url = base_url + 'purchaserequestdetail/save/' + row.id;
    } else {
        $.messager.alert('No Purchase Request', 'Please Choose Purchase Request', 'warning');
    }
}

function purchaserequestdetail_edit() {
    pritem_edit();
//    var row = $('#purchaserequestdetail').datagrid('getSelected');
//    if (row !== null) {
//        $('#global_dialog').dialog({
//            title: 'Edit Item',
//            width: 600,
//            height: 300,
//            closed: false,
//            cache: false,
//            href: base_url + 'purchaserequestdetail/edit/' + row.id,
//            modal: true,
//            resizable: true,
//            buttons: [{
//                    text: 'Close',
//                    iconCls: 'icon-remove',
//                    handler: function () {
//                        $('#global_dialog').dialog('close');
//                    }
//                }
//            ]
//        });
//
//        //        
//        //        $('#purchaserequestdetail-form').dialog('open').dialog('setTitle', 'Edit Item Request');
//        //        $('#purchaserequestdetail-input').form('load', row);
//        //        url = base_url + 'purchaserequestdetail/update_item/' + row.id
//    } else {
//        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
//    }
}

function purchaserequestdetail_add_from_requisition() {
    var row = $('#purchaserequest').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Add From Requisition',
            width: 800,
            height: 400,
            closed: false,
            cache: false,
            href: base_url + 'purchaserequestdetail/add_from_requisition/' + row.id,
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        purchaserequestdetail_save_from_requisition();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }
            ]
        });
    } else {
        $.messager.alert('No Purchase Request', 'Please Choose Purchase Request', 'warning');
    }
}

function purchaserequestdetail_save_from_requisition() {

    if (index_mat_rqstion !== null) {
        $('#requisition_item').datagrid('endEdit', index_mat_rqstion);
        $('#requisition_item').datagrid('checkRow', index_mat_rqstion);
        index_mat_rqstion = null;
    }

    $('#requisition_item').datagrid('acceptChanges');
    var rows = $('#requisition_item').datagrid('getChecked');

    if (rows.length !== 0) {
        var arr_materialrequisitiondetailid = new Array();
        var arr_itemid = new Array();
        var arr_unitcode = new Array();
        var arr_qty = new Array();
        for (var i = 0; i < rows.length; i++) {
            if (rows[i].qty_ots != "") {
                arr_materialrequisitiondetailid.push(rows[i].id);
                arr_itemid.push(rows[i].itemid);
                arr_unitcode.push(rows[i].unitcode);
                arr_qty.push(rows[i].qty_ots);
            }
        }
        if (arr_materialrequisitiondetailid.length > 0) {
            var pr_row = $('#purchaserequest').datagrid('getSelected');
            $.post(base_url + 'purchaserequestdetail/save_from_requisition', {
                purchaserequestid: pr_row.id,
                materialrequisitiondetailid: arr_materialrequisitiondetailid,
                itemid: arr_itemid,
                unitcode: arr_unitcode,
                qty: arr_qty
            }, function (content) {
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#global_dialog').dialog('close');
                    $('#purchaserequestdetail').datagrid('reload');
                    $('#purchaserequest').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            });
        } else {
            $.messager.alert('Warning', 'Nothing to save', 'warning');
        }
    } else {
        $.messager.alert('Warning', 'Nothing to save', 'warning');
    }
}

function purchaserequestdetail_edit_vendor_price() {
    var row = $('#purchaserequestdetail').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Vendor Price',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'purchaserequestdetail/edit_vendor_price/' + row.id + '/' + row.pricecomparisonid,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        purchaserequestdetail_update_vendor_price()
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#purchaserequestdetail_edit_vendor_price-input').form('load', row);
            }
        });
        url = base_url + 'purchaserequestdetail/update_vendor_price/' + row.id;
    } else {
        $.messager.alert('No Item', 'Please Choose Purchase Request', 'warning');
    }
}

function purchaserequestdetail_set_price() {
    var row = $('#purchaserequestdetail').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Vendor Price',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'purchaserequestdetail/set_price/' + row.id,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#purchaserequestdetail_set_price_form').form('validate')) {
                            $.post(base_url + 'purchaserequestdetail/do_set_price/' + row.id, $('#purchaserequestdetail_set_price_form').serializeObject(), function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#purchaserequestdetail').datagrid('reload');
                                    $('#purchaserequest').datagrid('reload');
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
                $(this).dialog('center');
                $('#purchaserequestdetail_set_price_form').form('load', row);
            }
        });
        url = base_url + 'purchaserequestdetail/update_vendor_price/' + row.id;
    } else {
        $.messager.alert('No Item', 'Please Choose Purchase Request', 'warning');
    }
}

function purchaserequestdetail_update_vendor_price() {
    if ($('#purchaserequestdetail_edit_vendor_price-input').form('validate')) {
        $('#purchaserequestdetail_edit_vendor_price-input').form('submit', {
            url: url,
            success: function (content) {
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#global_dialog').dialog('close');
                    $('#purchaserequestdetail').datagrid('reload');
                    $('#purchaserequest').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }
        });
    }
}


function purchaserequestdetail_edit_vendor_price_trigger_from_view_detail() {
    var row = $('#pr_by_item').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Vendor Price',
            width: 350,
            height: 180,
            closed: false,
            cache: true,
            href: base_url + 'purchaserequestdetail/edit_vendor_price/' + row.id + '/' + row.pricecomparisonid,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        purchaserequestdetail_update_vendor_price_trigger_from_view_detail()
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#purchaserequestdetail_edit_vendor_price-input').form('load', row);
            }
        });
        url = base_url + 'purchaserequestdetail/update_vendor_price/' + row.id;
    } else {
        $.messager.alert('No Item', 'Please Choose Purchase Request', 'warning');
    }
}

function purchaserequestdetail_update_vendor_price_trigger_from_view_detail() {
    if ($('#purchaserequestdetail_edit_vendor_price-input').form('validate')) {
        $('#purchaserequestdetail_edit_vendor_price-input').form('submit', {
            url: url,
            success: function (content) {
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#global_dialog').dialog('close');
                    $('#pr_by_item').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }
        });
    }
}

function purchaserequestdetail_save() {
    $('#purchaserequestdetail-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#purchaserequestdetail-form').dialog('close');
                $('#purchaserequestdetail').datagrid('reload');
                $('#purchaserequest').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}


function purchaserequestdetail_delete() {
    var row = $('#purchaserequestdetail').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'purchaserequestdetail/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#purchaserequestdetail').datagrid('reload');
                        $('#purchaserequest').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose item to delete', 'warning');
    }
}

function purchaserequestdetail_edit_for_view_detail() {
    var row = $('#pr_by_item').datagrid('getSelected');
    if (row !== null) {
        $('#purchaserequestdetail_vd-form').dialog('open').dialog('setTitle', 'Edit Item Request');
        $('#purchaserequestdetail_vd-input').form('load', row);
        url = base_url + 'purchaserequestdetail/update_item/' + row.id
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}


function purchaserequestdetail_update_for_view_detail() {
    $('#purchaserequestdetail_vd-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#purchaserequestdetail_vd-form').dialog('close');
                $('#pr_by_item').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function purchaserequestdetail_add_outsource() {
    var row = $('#purchaserequest').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Add Model/Component to Outsource',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'purchaserequestdetail/add_outsource/' + row.id,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        purchaserequestdetail_save_outsource();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#purchaserequestdetail_edit_vendor_price-input').form('load', row);
            }
        });
        url = base_url + 'purchaserequestdetail/save_outsource/' + row.id;
    } else {
        $.messager.alert('No Purchase Request', 'Please Choose Purchase Request', 'warning');
    }
}

function purchaserequestdetail_save_outsource() {

    $('#purchaserequestdetail_outsource-form').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#purchaserequestdetail').datagrid('reload');
                $('#purchaserequest').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function pritem_search_88() {
    console.log($('#pr_list_67').serializeObject());
    $('#pritemdetail').datagrid('reload', $('#pr_list_67').serializeObject());
}

function pritem_delete() {
    var row = $('#pritemdetail').datagrid('getSelected');
    $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
        if (r) {
            $.post(base_url + 'purchaserequestdetail/pritem_delete', {
                id: row.id
            }, function (result) {
                if (result.success) {
                    $('#purchaserequestdetail').datagrid('reload');
                    $('#pritemdetail').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }, 'json');
        }
    });
}

function pritem_edit() {
    
    //var row = $('#pritemdetail').datagrid('getSelected');
    var row = $('#purchaserequestdetail').datagrid('getSelected');
    if (row !== null) {
        if ($('#dialog_67')) {
            $('#bodydata').append("<div id='dialog_67'></div>");
        }

        $('#dialog_67').dialog({
            title: 'Edit Item',
            width: 450,
            height: 'auto',
            top: 100,
            closed: false,
            cache: false,
            href: base_url + 'purchaserequestdetail/edit_item',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#pritem_edit_item_form').form('submit', {
                            url: base_url + 'purchaserequestdetail/do_edit_item/' + row.id,
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                console.log(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#dialog_67').dialog('close');
                                    $('#pritemdetail').datagrid('reload');
                                } else {
                                    $.messager.alert('Error', result.msg, 'error');
                                }
                            }
                        });
                    }
                },
                {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#dialog_67').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $('#dialog_67').dialog('center');
                $('#pritem_edit_item_form').form('load', row);
            }
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}