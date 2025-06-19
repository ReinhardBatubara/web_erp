/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function stockout_search() {
    $('#stockout').datagrid('reload', $('#stockout_search_form').serializeObject());
}

function stockout_search2() {
    $('#stockout').datagrid('reload', $('#stockout_search_form2').serializeObject());
}



function stockout_add() {

    $('#global_dialog').dialog({
        title: 'New Stock Out',
        width: 700,
        height: 'auto',
        closed: false,
        cache: true,
        top: 50,
        href: base_url + 'stockout/add',
        modal: true,
        resizable: true,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    stockout_save()
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $('#global_dialog').dialog('center');
            $('#stockout-input').form('clear');
        }
    })
}

function stockout_add2() {
    $('#global_dialog').dialog({
        title: 'New Stock Out',
        width: 400,
        height: 'auto',
        closable: true,
        cache: true,
        top: 50,
        href: base_url + 'stockout/add2',
        modal: true,
        resizable: true,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    if ($('#stockout_form_2').form('validate')) {
                        $.post(base_url + 'stockout/direct_save', $('#stockout_form_2').serializeObject(), function (content) {
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $('#sto_temp99').dialog('close');
                                $('#stockout').datagrid('reload');
                            } else {
                                $.messager.alert('Error', result.msg, 'error');
                            }
                        });
                    }
                }
            }, {
                text: 'Cancel',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $('#global_dialog').dialog('center');
        }
    });
    stockout_add()
}

function stockout_add_item2() {
    $('#sto_add_item').dialog({
        title: 'Add Item',
        width: 400,
        height: 'auto',
        closed: false,
        cache: true,
        top: 50,
        href: base_url + 'stockout/add_item2',
        modal: true,
        resizable: true,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    stockout_save()
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#sto_add_item').dialog('close');
                }
            }],
        onLoad: function () {
            $('#stockout-input').form('clear');
        }
    }).dialog('hcenter');
}

function stockout_add_from_nota() {
    $('#sto_temp99').dialog({
        title: 'Add From Nota',
        width: 400,
        height: 'auto',
        closable: true,
        cache: true,
        top: 50,
        href: base_url + 'stockout/add_from_nota',
        modal: true,
        resizable: true,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    if ($('#stockout_add_from_nota').form('validate')) {
                        $.post(base_url + 'stockout/save_from_nota', $('#stockout_add_from_nota').serializeObject(), function (content) {
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $('#sto_temp99').dialog('close');
                                $('#stockout').datagrid('reload');
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
                    $('#sto_temp99').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
            $('#stockout_add_from_nota').form('clear');
        }
    }).dialog('hcenter');
}


function stockout_save() {
    $('#list_item_to_out').datagrid('endEdit', stockout_lastIndex);
    var valid = $('#stockout-input').form('validate');
    if (valid) {
        var stockout_number = $('#stockout_number').val();
        var stockout_date = $('#stockout_date_').datebox('getValue');
        var stockout_mw_id = $('#stockout_mw_id_').combogrid('getValue');
        var stockout_remark = $('#stockout_remark').val();
        var rows = $('#list_item_to_out').datagrid('getChanges');
        if (rows.length !== 0) {
            var materialwithdrawdetail_id = new Array();
            var qty_out = new Array();
            var warehouse_id = new Array();
            for (var i = 0; i < rows.length; i++) {
                if (rows[i].qty_out !== '' && rows[i].qty_out !== '0.00') {
                    materialwithdrawdetail_id[i] = rows[i].id;
                    qty_out[i] = rows[i].qty_out;
                    warehouse_id[i] = rows[i].warehouseid;
                }
            }
            if (materialwithdrawdetail_id.length !== 0) {
                $.post(base_url + 'stockout/save', {
                    number: stockout_number,
                    date: stockout_date,
                    mw_id: stockout_mw_id,
                    remark: stockout_remark,
                    materialwithdrawdetail_id: materialwithdrawdetail_id,
                    warehouse_id: warehouse_id,
                    qty_out: qty_out
                }, function (content) {
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#global_dialog').dialog('close');
                        $('#stockout').datagrid('reload');
                        $('#stockoutrequest').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                });
            } else {
                $.messager.alert('No Item to Out', 'Set Qty Item to Out', 'error');
            }

        } else {
            $.messager.alert('No Item to Out', 'Set Qty Item to Out', 'error');
        }

    }
}



function stockout_delete() {
    var row = $('#stockout').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'stockout/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#stockout').datagrid('reload');
                        $('#stockoutdetail').datagrid('reload');
                        $('#stockoutrequest').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                        $('#stockout').datagrid('reload');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Stock Out Selected', 'Select Stock Out to Delete', 'error');
    }
}

function stockout_print() {
    var row = $('#stockout').datagrid('getSelected');
    if (row !== null) {
        open_target('POST', base_url + 'stockout/prints', {
            stockoutid: row.id
        }, '_blank');
    } else {
        $.messager.alert('No Stock Out Selected', 'Select Stock Out to Delete', 'error');
    }
}

function stockout_print_detail() {
    open_target('POST', base_url + 'stockout/print_detail', $('#stockout_search_form').serializeObject(), '_blank');
}


function stockout_request_create() {
    var row = $('#stockoutrequest').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'New Stock Out',
            width: 700,
            height: 'auto',
            closed: false,
            cache: true,
            top: 50,
            href: base_url + 'stockout/add',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        stockout_save()
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#request_by_').val(row.employeerequest);
                $('#stockout_mw_id_').combogrid('setValue', row.id);
                $('#list_item_to_out').datagrid('reload', {
                    materialwithdrawid: row.id
                });
                $('#department_').val(row.department);
            }
        }).dialog('hcenter');
    } else {
        $.messager.alert('No Request Choosed', 'Choose Material Withdraw Request', 'warning');
    }
}


function stockout_edit() {
    var row = $('#stockout').datagrid('getSelected');
    if (row !== null) {
        if (row.materialwithdrawid === '0' && row.joborderid === '0') {
            $('#sto_temp99').dialog({
                title: 'Edit From Nota',
                width: 400,
                height: 'auto',
                closable: true,
                cache: true,
                top: 50,
                href: base_url + 'stockout/add_from_nota',
                modal: true,
                resizable: true,
                buttons: [{
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            if ($('#stockout_add_from_nota').form('validate')) {
                                $.post(base_url + 'stockout/update_from_nota/' + row.id, $('#stockout_add_from_nota').serializeObject(), function (content) {
                                    var result = eval('(' + content + ')');
                                    if (result.success) {
                                        $('#sto_temp99').dialog('close');
                                        $('#stockout').datagrid('reload');
                                    } else {
                                        $.messager.alert('Error', result.msg, 'error');
                                    }
                                });
                            }
                        }
                    }, {
                        text: 'Cancel',
                        iconCls: 'icon-remove',
                        handler: function () {
                            $('#sto_temp99').dialog('close');
                        }
                    }],
                onLoad: function () {
                    $('#stockout_add_from_nota').form('load', row);
                    $(this).dialog('center');
                }
            }).dialog('hcenter');
        } else {
            $('#stockout_edit-form').dialog('open').dialog('setTitle', 'Edit Stock Out');
            $('#stockout_edit-input').form('load', row);
        }
    } else {
        $.messager.alert('No Stock Out Choosed', 'Choose Stock Out to Edit', 'error');
    }
}

function stockout_update() {
    var row = $('#stockout').datagrid('getSelected');
    $('#stockout_edit-input').form('submit', {
        url: base_url + 'stockout/update/' + row.id,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#stockout_edit-form').dialog('close');
                $('#stockout').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function stockout_receive() {
    var row = $('#stockout_wating_to_receive').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to receive this Item?', function (r) {
            if (r) {
                $.post(base_url + 'stockout/receive', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#stockout').datagrid('reload');
                        $('#stockout_wating_to_receive').datagrid('reload');
                        $('#materialwithdrawdetail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Stock Out Choosed', 'Please Choose Stock Out to Receive', 'error');
    }
}


//detail


function stockoutdetail_search() {
    var row = $('#stockout').datagrid('getSelected');
    if (row !== null) {
        var code = $('#stockoutdetail_detail_code_s').val();
        var description = $('#stockoutdetail_detail_description_s').val();
        $('#stockoutdetail').datagrid('reload', {
            stockoutid: row.id,
            code: code,
            description: description
        });
    }
}

function stockoutdetail_clear_search() {
    $('#stockoutdetail_detail_code_s').val('');
    $('#stockoutdetail_detail_description_s').val('');
    stockoutdetail_search();
}

function stockoutdetail_add() {
    var row = $('#stockout').datagrid('getSelected');
    if (row !== null) {
        if (row.joborderid !== '0') {
            $('#global_dialog').dialog({
                title: 'Add Item',
                width: 500,
                height: 'auto',
                closed: false,
                cache: true,
                href: base_url + 'stockout/add_item2/' + row.joborderid,
                modal: true,
                resizable: true,
                buttons: [{
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            if ($('#sto_add_item2-input').form('validate')) {
                                $.post(base_url + 'stockout/save_item2/' + row.id + '/' + row.materialwithdrawid, $('#sto_add_item2-input').serializeObject(), function (content) {
                                    var result = eval('(' + content + ')');
                                    if (result.success) {
                                        $('#stockout_form_2').form('clear')
                                        $('#global_dialog').dialog('close');
                                        $('#stockoutdetail').datagrid('reload');
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
                    $('#sto_add_item2-input').form('clear');
                }
            }).dialog('hcenter');
        } else {
            $('#global_dialog').dialog({
                title: 'Add Item',
                width: 500,
                height: 'auto',
                closed: false,
                cache: true,
                href: base_url + 'stockout/add_item_from_nota',
                modal: true,
                resizable: true,
                buttons: [{
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            if ($('#sto_add_item_from_nota').form('validate')) {
                                $.post(base_url + 'stockout/save_item_from_nota/' + row.id + '/' + row.materialwithdrawid, $('#sto_add_item_from_nota').serializeObject(), function (content) {
                                    var result = eval('(' + content + ')');
                                    if (result.success) {
                                        $('#sto_add_item_from_nota').form('clear')
                                        $('#global_dialog').dialog('close');
                                        $('#stockoutdetail').datagrid('reload');
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
                    $('#sto_add_item_from_nota_itemid').focus();
                }
            }).dialog('hcenter');

        }
    } else {
        $.messager.alert('No Request Choosed', 'Choose Material Withdraw Request', 'warning');
    }
}

function stockoutdetail_edit() {
    var row = $('#stockoutdetail').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Item',
            width: 400,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'stockout/detail_edit',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        stockoutdetail_update();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#stockoutdetail_edit-input').form('load', row);
                $(this).dialog('center');
            }
        });
    } else {
        $.messager.alert('No Item Choosed', 'Choose Item to Edit', 'error');
    }
}

function stockoutdetail_update() {
    var row = $('#stockoutdetail').datagrid('getSelected');

    $('#stockoutdetail_edit-input').form('submit', {
        url: base_url + 'stockoutdetail/update/' + row.id,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#stockoutdetail').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });

}

function stockoutdetail_delete() {
    var row = $('#stockoutdetail').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'stockoutdetail/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#stockoutdetail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Item Choosed', 'Choose Item to Delete', 'error');
    }
}



//Outsource
function stockout_to_outsource_search2() {
    $('#sto_os').datagrid('reload', $('#stockouttooutsource_form_search2').serializeObject());
}

function stockout_to_outsource_add() {
    $('#global_dialog').dialog({
        title: 'New Stock out to Outsource',
        width: 400,
        height: 'auto',
        top: 100,
        closed: false,
        cache: false,
        href: base_url + 'stockouttooutsource/add',
        modal: true,
        resizable: true,
        buttons: [
            {
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    stockout_to_outsource_save();
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
            $('#sto_os-input').form('clear');
        }
    });
    url = base_url + 'stockouttooutsource/save/0';
}

function stockout_to_outsource_save() {
    $('#sto_os-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#sto_os').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function stockout_to_outsource_edit() {
    var row = $('#sto_os').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Stock out to Outsource',
            width: 400,
            height: 'auto',
            top: 100,
            closed: false,
            cache: false,
            href: base_url + 'stockouttooutsource/add',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        stockout_to_outsource_save();
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
                $('#sto_os-input').form('load', row);
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Stock Out to Edit', 'warning');
    }
}

function stockout_to_outsource_delete() {
    var row = $('#sto_os').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'stockouttooutsource/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#sto_os').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Stock Out to Delete', 'warning');
    }
}

function sto_os_detail_search() {
    var row = $('#sto_os').datagrid('getSelected');
    $('#sto_os_detail').datagrid('reload', {
        sto_so_id: row.id,
        itemcode: $('#sto_os_detail_search_itemcode').val(),
        itemdescription: $('#sto_os_detail_search_itemdescription').val()
    });
}

function sto_os_detail_add() {
    var row = $('#sto_os').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Add Item',
            width: 400,
            height: 'auto',
            closed: false,
            cache: true,
            top: 50,
            href: base_url + 'stockouttooutsource/add_item',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        sto_os_detail_save();
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
                $('#sto_os_detail-input').form('clear');
            }
        });
        url = base_url + 'stockouttooutsource/detail_save/' + row.id + '/0';
    } else {
        $.messager.alert('Waring', 'Choose Stock Out to Edit', 'warning');
    }
}

function sto_os_detail_edit() {
    var row = $('#sto_os_detail').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Item',
            width: 400,
            height: 'auto',
            closed: false,
            cache: true,
            top: 50,
            href: base_url + 'stockouttooutsource/add_item',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        sto_os_detail_save();
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
                $('#sto_os_detail-input').form('load', row);
            }
        });
        url = base_url + 'stockouttooutsource/detail_save/0/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Item to Edit', 'warning');
    }
}

function sto_os_detail_save() {
    $('#sto_os_detail-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#sto_os_detail').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}


function sto_os_detail_delete() {
    var row = $('#sto_os_detail').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'stockouttooutsource/detail_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#sto_os_detail').datagrid('reload');
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

function stockoutdetail_summary_search() {
    if ($('#stockout_summary_form_search').form('validate')) {
        $('#stockout_summary').datagrid({
            url: base_url + 'stockout/summary_get',
            queryParams: $('#stockout_summary_form_search').serializeObject()
        });
    }
}


function stockoutdetail_transaction_search() {
    if ($('#stockout_all_detail_form_search').form('validate')) {
        $('#stockout_all_detail').datagrid({
            url: base_url + 'stockout/get_all_detail',
            queryParams: $('#stockout_all_detail_form_search').serializeObject()
        });
    }
}

function stockoutdetail_transaction_print() {
    open_target('POST', base_url + 'stockout/print_all_detail', $('#stockout_all_detail_form_search').serializeObject(), '_blank');
}

function stockoutdetail_transaction_excel() {
    open_target('POST', base_url + 'stockout/excel_all_detail', $('#stockout_all_detail_form_search').serializeObject(), '_blank');
}



