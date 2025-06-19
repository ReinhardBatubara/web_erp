/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function materialrequisition_search() {
    $('#materialrequisition').datagrid('load', $('#materialrequisition_search_form').serializeObject());
}

function mr_list_jo_material_search() {
    $('#mr_list_material_jo').datagrid('load', $('#mr_list_material_jo_search_form').serializeObject());
}

function materialrequisition_add() {
    $('#global_dialog').dialog({
        title: 'Material Requisition',
        width: 400,
        height: 'auto',
        top: 100,
        closed: false,
        cache: false,
        href: base_url + 'materialrequisition/add',
        modal: true,
        resizable: true,
        buttons: [
            {
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    materialrequisition_save()
                }
            },
            {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }
        ]
    }).dialog('hcenter');
    url = base_url + 'materialrequisition/save';
}

function materialrequisition_add_from_jo() {
    $('#global_dialog').dialog({
        title: 'New Material Requisition',
        width: 450,
        height: 'auto',
        top: 100,
        closed: false,
        cache: false,
        href: base_url + 'materialrequisition/add_from_jo',
        modal: true,
        resizable: true,
        buttons: [
            {
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    materialrequisition_save()
                }
            },
            {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }
        ]
    }).dialog('hcenter');
    url = base_url + 'materialrequisition/save';
}

function materialrequisition_edit() {
    var row = $('#materialrequisition').datagrid('getSelected');
    if (row !== null) {
        if (row.joborderid == 0) {
            $('#global_dialog').dialog({
                title: 'Material Requisition',
                width: 400,
                height: 'auto',
                top: 100,
                closed: false,
                cache: false,
                href: base_url + 'materialrequisition/add',
                modal: true,
                resizable: true,
                buttons: [
                    {
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            materialrequisition_save()
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
                    $('#materialrequisition-input').form('load', row);
                }
            }).dialog('hcenter');
            url = base_url + 'materialrequisition/update/' + row.id;
        } else {
            $('#global_dialog').dialog({
                title: 'Edit Material Requisition',
                width: 450,
                height: 'auto',
                top: 100,
                closed: false,
                cache: false,
                href: base_url + 'materialrequisition/add_from_jo',
                modal: true,
                resizable: true,
                buttons: [
                    {
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            materialrequisition_save()
                        }
                    },
                    {
                        text: 'Close',
                        iconCls: 'icon-remove',
                        handler: function () {
                            $('#global_dialog').dialog('close');
                        }
                    }
                ]
            }).dialog('hcenter');
            url = base_url + 'materialrequisition/save';
        }

    } else {
        $.messager.alert('No Material Requisition Choose', 'Please Choose Material Requisition', 'error');
    }

}

function materialrequisition_delete() {
    var row = $('#materialrequisition').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'materialrequisition/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#materialrequisition').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Material Requisition Choose', 'Please Choose Material Requisition', 'error');
    }
}

function materialrequisition_save() {
    if ($('#materialrequisition-input').form('validate')) {
        $.post(url, $('#materialrequisition-input').serializeObject(), function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#materialrequisition').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    }
}

function materialrequisition_send() {
    var row = $('#materialrequisition').datagrid('getSelected');
    if (row !== null) {
        var row_detail = $('#materialrequisitiondetail').datagrid('getRows');
        if (row_detail.length === 0) {
            $.messager.alert('No Item to Submit', 'Please Input Item to Submit', 'error');
        } else {
            $.messager.confirm('Confirm', 'You Can\'t modified this requisition after send. \n Are you Sure?', function (r) {
                if (r) {
                    $.post(base_url + 'materialrequisition/send', {
                        id: row.id
                    }, function (result) {
                        if (result.success) {
                            $('#materialrequisition').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        }
    } else {
        $.messager.alert('No Material Requisition Choose', 'Please Choose Material Requisition', 'error');
    }
}


function materialrequisition_outstanding() {
    $('#global_dialog').dialog({
        title: 'Outstanding Purchase',
        width: 800,
        height: 500,
        closed: false,
        cache: false,
        href: base_url + 'materialrequisition/outstanding',
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




//Detail

function materialrequisitiondetail_search() {
    var row = $('#materialrequisition').datagrid('getSelected');
    var itemcode = $('#materialrequisitiondetail_code_s').val();
    var description = $('#materialrequisitiondetail_description_s').val();
    var materialrequisitionid = 0;

    if (row !== null) {
        materialrequisitionid = row.id;
    }

    $('#materialrequisitiondetail').datagrid('reload', {
        materialrequisitionid: materialrequisitionid,
        itemcode: itemcode,
        description: description
    });
}

function materialrequisitiondetail_add(st) {
    var row = $('#materialrequisition').datagrid('getSelected');
    if (row !== null) {
        if (row.joborderid === '0' || st === 1) {
            $('#global_dialog').dialog({
                title: 'Add Item to Requisition',
                width: 450,
                height: 'auto',
                closed: false,
                cache: false,
                top: 100,
                href: base_url + 'materialrequisitiondetail/add',
                modal: true,
                resizable: true,
                buttons: [
                    {
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            materialrequisitiondetail_save();
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
                    $('#materialrequisitiondetail-input').form('clear');
                }
            }).dialog('hcenter');
            url = base_url + 'materialrequisitiondetail/save/' + row.id;
        } else {
            $('#global_dialog').dialog({
                title: 'Add Item to Requisition',
                width: 450,
                height: 'auto',
                closed: false,
                cache: false,
                top: 100,
                href: base_url + 'materialrequisitiondetail/add_from_jo/' + row.joborderid,
                modal: true,
                resizable: true,
                buttons: [
                    {
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            materialrequisitiondetail_save_from_jo();
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
                    $('#materialrequisitiondetail_from_jo-input').form('clear');
                }
            }).dialog('hcenter');
            url = base_url + 'materialrequisitiondetail/save/' + row.id;
        }

    }
    else {
        $.messager.alert('No Material Requisition Choosed', 'Please Choose Material Requisition', 'error');
    }
}

function materialrequisitiondetail_add_from_jo() {
    var row = $('#materialrequisition').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'JO Material',
            width: 700,
            height: 420,
            closed: false,
            cache: true,
            href: base_url + 'materialrequisitiondetail/list_material_jo/' + row.joborderid,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        materialrequisitiondetail_save_from_list_jo();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }]
        });
        url = base_url + 'materialrequisitiondetail/save_from_list_jo/' + row.id
    } else {
        $.messager.alert('No Material Requisition Choosed', 'Please Choose Material Requisition', 'error');
    }
}

function materialrequisitiondetail_save_from_list_jo() {
    if (index_mat_jo !== null) {
        $('#mr_list_material_jo').datagrid('endEdit', index_mat_jo);
        $('#mr_list_material_jo').datagrid('checkRow', index_mat_jo);
        index_mat_jo = null;
    }
    $('#mr_list_material_jo').datagrid('acceptChanges');
    var rows = $('#mr_list_material_jo').datagrid('getChecked');
    if (rows.length > 0) {
        var r_mrpid = new Array();
        var r_itemid = new Array();
        var r_unitcode = new Array();
        var r_qty = new Array();
        var msg = '';
        for (var i = 0; i < rows.length; i++) {
            r_mrpid[i] = rows[i].id;
            r_itemid[i] = rows[i].itemid;
            r_unitcode[i] = rows[i].unitcode;
            r_qty[i] = rows[i].qty;
        }

        $.post(url, {
            mrpid: r_mrpid,
            itemid: r_itemid,
            unitcode: r_unitcode,
            qty: r_qty
        }, function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $.messager.show({
                    title: 'Saving Status',
                    msg: 'Succesfull...',
                    timeout: 3000,
                    showType: 'slide'
                });
                $('#mr_list_material_jo').datagrid('reload');
                $('#materialrequisitiondetail').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    } else {
        $.messager.alert('Nothing to save', 'Please check item to request', 'warning');
    }
}

function materialrequisitiondetail_save() {
    $('#materialrequisitiondetail-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#materialrequisitiondetail').datagrid('reload');
            } else {
                $.messager.alert('Save Error', result.msg, 'error');
            }
        }
    });
}

function materialrequisitiondetail_save_from_jo() {
    //alert(url);
    $('#materialrequisitiondetail_from_jo-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#materialrequisitiondetail').datagrid('reload');
                mrp_frst_id = 0;
            } else {
                $.messager.alert('Save Error', result.msg, 'error');
            }
        }
    });
}
var mrp_frst_id = 0;
function materialrequisitiondetail_edit() {
    var row = $('#materialrequisitiondetail').datagrid('getSelected');
    if (row !== null) {
        if (row.mrpid === '0') {
            $('#global_dialog').dialog({
                title: 'Edit Item Requisition',
                width: 450,
                height: 'auto',
                closed: false,
                cache: false,
                top: 100,
                href: base_url + 'materialrequisitiondetail/add',
                modal: true,
                resizable: true,
                buttons: [
                    {
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            materialrequisitiondetail_save();
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
                    $('#materialrequisitiondetail-input').form('load', row);
                }
            }).dialog('hcenter');
            url = base_url + 'materialrequisitiondetail/update/' + row.id;
        } else {
            var row_jo = $('#materialrequisition').datagrid('getSelected');
            mrp_frst_id = row.mrpid;
            $('#global_dialog').dialog({
                title: 'Edit Item to Requisition',
                width: 450,
                height: 'auto',
                closed: false,
                cache: false,
                top: 100,
                href: base_url + 'materialrequisitiondetail/add_from_jo/' + row_jo.joborderid,
                modal: true,
                resizable: true,
                buttons: [
                    {
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            materialrequisitiondetail_save_from_jo();
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
                    $('#mrdetail_itemid_from_jo').combobox('setValue', row.itemid);
                    $('#mrdetail_code_from_jo').val(row.itemcode);
                    $('#mrdetail_description_from_jo').val(row.itemdescription);
                    $('#mrdetail_unitcode_from_jo').val(row.unitcode);
                    var ots = parseFloat(row.ots_requisition) + parseFloat(row.qty)
                    $('#ots_qty_from_jo').val(ots);
                    $('#mrpid_').val(row.mrpid);
                    $('#qty_from_jo').numberbox('setValue', row.qty);
                    $('#mrdetail_qty_inputed').val(row.qty);
                }
            }).dialog('hcenter');
            url = base_url + 'materialrequisitiondetail/update/' + row.id;
        }
    } else {
        $.messager.alert('No Item Choosed', 'Please Choose Item Requisition', 'error');
    }
}

function materialrequisitiondetail_delete() {
    var row = $('#materialrequisitiondetail').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'materialrequisitiondetail/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#materialrequisitiondetail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Item Choosed', 'Please Choose Item Requisition', 'error');
    }
}

function materialrequisition_outstanding_search() {
    $('#materialrequisition_outstanding').datagrid('reload', $('#materialrequisition_outstanding_search-form').serializeObject());
}

function materialrequisition_item_search() {
    $('#materialrequisitionitem').datagrid('reload', $('#materialrequisitionitem_search-form').serializeObject());
}

function materialrequisition_dialog_item_search_from_jo(joborderid) {
    $('#mr_dialog').dialog({
        title: 'Add Item to Requisition',
        width: 700,
        height: 'auto',
        closed: false,
        cache: false,
        top: 100,
        href: base_url + 'materialrequisition/dialog_item_search_from_jo/' + joborderid,
        modal: true,
        resizable: true,
        buttons: [
            {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#mr_dialog').dialog('close');
                }
            }
        ]
    }).dialog('hcenter');
}

function materialrequisitiondetail_set_selected_from_mrp() {
    var row = $('#mrp_list_to_request').datagrid('getSelected');
    if (row !== null) {
        $('#mrdetail_itemid_from_jo').val(row.itemid);
        $('#mrdetail_code_from_jo').val(row.itemcode);
        $('#mrdetail_description_from_jo').val(row.itemdescription);
        $('#mrdetail_unitcode_from_jo').val(row.unitcode);
        $('#ots_qty_from_jo').val(row.required_qty);
        $('#mrpid_').val(row.id);
        $('#mr_dialog').dialog('close');
    }
}

function materialrequisition_from_mrp_searchfordialog() {
    var code = $('#mr_detail_code_s_').val();
    var description = $('#mr_detail_description_s').val();
    $('#mrp_list_to_request').datagrid('reload', {
        itemcode: code,
        itemdescription: description
    });
}

function materialrequisition_item_change_status(status) {
    var rows = $('#materialrequisitionitem').datagrid('getSelections');
    if (rows.length > 0) {
        $.messager.confirm('Confirm', 'Are you sure?', function (r) {
            if (r) {
                var arr_mr_item = new Array();
                for (var i = 0; i < rows.length; i++) {
                    arr_mr_item.push(rows[i].id);
                }
                $.post(base_url + 'materialrequisitiondetail/change_status', {
                    mrdetailid: arr_mr_item,
                    status: status
                }, function (content) {
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#materialrequisitionitem').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }

                });
            }
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function materialrequisition_item_create_pr() {

    var rows = $('#materialrequisitionitem').datagrid('getSelections');
    if (rows.length > 0) {
        var arr_mritemid = new Array();
        var arr_itemid = new Array();
        var arr_unitcode = new Array();
        var arr_qty = new Array();
        var msg_error = '';
        for (var i = 0; i < rows.length; i++) {
            if (parseFloat(rows[i].qty_ots) > 0 && rows[i].status == 'open') {
                arr_mritemid.push(rows[i].id);
                arr_itemid.push(rows[i].itemid);
                arr_unitcode.push(rows[i].unitcode);
                arr_qty.push(rows[i].qty_ots);
            } else {
                if (parseFloat(rows[i].qty_ots) <= 0) {
                    msg_error += 'No Qty Outstanding for item: ' + rows[i].itemcode + ', MR : ' + rows[i].mr_no + '<br/>';
                }
                if (rows[i].status == 'close') {
                    msg_error += 'Item: ' + rows[i].itemcode + ', MR : ' + rows[i].mr_no + ' already close<br/>';
                }
            }
        }
        if (msg_error == '') {
            $('#global_dialog').dialog({
                title: 'New Purchase Request',
                width: 400,
                height: 'auto',
                top: 100,
                closed: false,
                cache: false,
                href: base_url + 'purchaserequest/add',
                modal: true,
                resizable: true,
                buttons: [
                    {
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            if ($('#purchaserequest-input').form('validate')) {
                                var data = $('#purchaserequest-input').serializeArray();
                                $.post(base_url + 'purchaserequest/save_batch_from_mr_item', {
                                    pr: data,
                                    mritemid: arr_mritemid,
                                    itemid: arr_itemid,
                                    unitcode: arr_unitcode,
                                    qty: arr_qty
                                }, function (content) {
                                    var result = eval('(' + content + ')');
                                    if (result.success) {
                                        $('#global_dialog').dialog('close');
                                        $('#materialrequisitionitem').datagrid('reload');
                                        $.messager.confirm('Confirm', 'Create PR Success! Do you want to open PR ', function (r) {
                                            if (r) {
                                                if ($('#tt').tabs('exists', 'Purchase Request')) {
                                                    $('#tt').tabs('select', 'Purchase Request');
                                                    $('#purchaserequest').datagrid('reload');
                                                } else {
                                                    addTab('Purchase Request', 'purchaserequest');
                                                }
                                            } else {
                                                if ($('#tt').tabs('exists', 'Purchase Request')) {
                                                    $('#purchaserequest').datagrid('reload');
                                                }
                                            }
                                        });
                                    } else {
                                        $.messager.alert('Error', result.msg, 'error');
                                    }
                                });
                            }

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
                    $('#purchaserequest-input').form('clear');
                }
            }).dialog('hcenter');
        } else {
            $.messager.alert('Action Interupted', msg_error, 'error');
        }
    } else {
        $.messager.alert('No Item Checked', 'Please Check Item', 'warning');
    }
}

function materialrequisitiondetail_search_outstanding() {
    $('#requisition_item').datagrid('reload', $('#requisition_item_search_form').serializeObject());
}