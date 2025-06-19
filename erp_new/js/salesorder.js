/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function salesorder_search() {
    $('#salesorder').datagrid('reload', $('#salesorder_search_form2').serializeObject());
}

function salesorder_add() {
    if ($('#salesorder_dialog')) {
        $('#bodydata').append("<div id='salesorder_dialog'></div>");
    }
    $('#salesorder_dialog').dialog({
        title: 'New Sales Order',
        width: 400,
        height: 'auto',
        top: 100,
        closed: false,
        cache: false,
        href: base_url + 'salesorder/input',
        modal: true,
        resizable: true,
        buttons: [
            {
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    salesorder_save();
                }
            },
            {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#salesorder_dialog').dialog('close');
                }
            }
        ],
        onLoad: function () {
            $(this).dialog('center');
        }
    });
    url = base_url + 'salesorder/save';
}

function salesorder_save() {
    $('#salesorder-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#salesorder_dialog').dialog('close');
                $('#salesorder').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function salesorder_edit() {
    var row = $('#salesorder').datagrid('getSelected');
    if (row !== null) {
        if ($('#salesorder_dialog')) {
            $('#bodydata').append("<div id='salesorder_dialog'></div>");
        }
        $('#salesorder_dialog').dialog({
            title: 'Edit Sales Order',
            width: 400,
            height: 'auto',
            top: 100,
            closed: false,
            cache: false,
            href: base_url + 'salesorder/input',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        salesorder_save();
                    }
                },
                {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#salesorder_dialog').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $('#salesorder-input').form('load', row);
                $(this).dialog('center');
            }
        });
        url = base_url + 'salesorder/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Sales Order to edit', 'warning');
    }
}

function salesorder_delete() {
    var row = $('#salesorder').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'salesorder/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#salesorder').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose salesorder to delete', 'warning');
    }
}

function salesorderitem_available_search() {
    var salesorderid = $('#jo_salesorderid').combogrid('getValue');
    $('#salesorderitem_available').datagrid('reload', {
        salesorderid: salesorderid
    });
}

function salesorder_edit_price() {
    var row = $('#salesorder').datagrid('getSelected');
    if (row !== null) {
        if ($('#salesorder_dialog')) {
            $('#bodydata').append("<div id='salesorder_dialog'></div>");
        }
        $('#salesorder_dialog').dialog({
            title: 'Edit Price',
            width: 400,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'salesorder/edit_price',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#salesorder_edit_price-input').form('submit', {
                            url: base_url + 'salesorder/update_price/' + row.id,
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                //            alert(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#salesorder_dialog').dialog('close');
                                    $('#salesorder').datagrid('reload');
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
                        $('#salesorder_dialog').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $('#salesorder_edit_price-input').form('load', row);
                $(this).dialog('center');
            }
        });
    } else {
        $.messager.alert('No Sales Order Selected', 'Choose Sales Order to Edit', 'warning');
    }
}

function salesorder_process() {
    var row = $('#salesorder').datagrid('getSelected');
    if (row !== null) {
        if ($('#salesorder_dialog')) {
            $('#bodydata').append("<div id='salesorder_dialog'></div>");
        }
        $('#salesorder_dialog').dialog({
            title: 'Process Sales to Next Step',
            width: 300,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'salesorder/process/' + row.id,
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        salesorder_do_process();
                    }
                },
                {
                    text: 'Cancel',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#salesorder_dialog').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $(this).dialog('center');
            }
        });
    } else {
        $.messager.alert('No Sales Order Selected', 'Choose Sales Order to Process', 'warning');
    }
}

function salesorder_do_process() {

    if ($('#salesorder_process-form').form('validate')) {
        $.post(base_url + 'salesorder/do_process',
                $('#salesorder_process-form').serialize(),
                function (content) {
                    //            alert(content);
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#global_dialog').dialog('close');
                        $('#salesorder').datagrid('reload');
                        $('#salesorder_edit').linkbutton('disable');
                        $('#salesorder_delete').linkbutton('disable');
                        $('#salesorder_edit_price').linkbutton('disable');
                        $('#salesorder_cancel').linkbutton('disable');
                        $('#salesorder_process').linkbutton('disable');
                        $('#salesorderdetail_add').linkbutton('disable');
                        $('#salesorderdetail_edit').linkbutton('disable');
                        $('#salesorderdetail_delete').linkbutton('disable');
                        $('#salesorderdetail_edit_finishing').linkbutton('disable');
                        $('#salesorderdetail_edit_specification').linkbutton('disable');
                        $('#salesorderdetail_edit_finishing').linkbutton('disable');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                });
    }
}

function salesorder_cancel() {
    var row = $('#salesorder').datagrid('getSelected');
    if (row !== null) {
        var index = $('#salesorder').datagrid('getRowIndex', row.id);
        $('#salesorder').datagrid('reload');
        $('#salesorder').datagrid('selectRow', index);
        row = $('#salesorder').datagrid('getSelected');
        if (row.process_to_jo === '0') {
            $('#global_dialog').dialog({
                title: 'Cancel Sales Order',
                width: 300,
                height: 'auto',
                closed: false,
                cache: false,
                href: base_url + 'salesorder/cancel/' + row.id,
                modal: true,
                resizable: true,
                buttons: [
                    {
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            salesorder_do_cancel();
                        }
                    },
                    {
                        text: 'Cancel',
                        iconCls: 'icon-remove',
                        handler: function () {
                            $('#global_dialog').dialog('close');
                        }
                    }
                ]
            });
        } else {
            $.messager.alert('Not Allowed', 'Not allowed to cancel SO.\n Some item already on Job Order', 'error');
        }

    } else {
        $.messager.alert('No Sales Order Selected', 'Choose Sales Order to Process', 'warning');
    }
}


function salesorder_do_cancel() {
    if ($('#salesorder_cancel-form').form('validate')) {
        $.post(base_url + 'salesorder/do_cancel',
                $('#salesorder_cancel-form').serialize(),
                function (content) {
                    //            alert(content);
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#global_dialog').dialog('close');
                        $('#salesorder').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                });
    }
}

function salesorderdetail_cancel() {
    var row = $('#salesorderdetail').datagrid('getSelected');
    if (row !== null) {
        var index = $('#salesorderdetail').datagrid('getRowIndex', row.id);
        $('#salesorderdetail').datagrid('reload');
        $('#salesorderdetail').datagrid('selectRow', index);
        row = $('#salesorderdetail').datagrid('getSelected');
        if (row.ots !== '0') {
            $('#global_dialog').dialog({
                title: 'Cancel Sales Order Item',
                width: 300,
                height: 'auto',
                closed: false,
                cache: false,
                href: base_url + 'salesorder/cancel_detail/' + row.id,
                modal: true,
                resizable: true,
                buttons: [
                    {
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            salesorder_do_cancel_detail();
                        }
                    },
                    {
                        text: 'Cancel',
                        iconCls: 'icon-remove',
                        handler: function () {
                            $('#global_dialog').dialog('close');
                        }
                    }
                ]
            });
        } else {
            $.messager.alert('No Outstanding', 'No Outstanding Quantity to Pending', 'warning');
        }
    } else {
        $.messager.alert('No Item Selected', 'Please select item', 'warning');
    }
}

function salesorder_do_cancel_detail() {
    if ($('#salesorderdetail_cancel-form').form('validate')) {
        $.post(base_url + 'salesorder/do_cancel_detail',
                $('#salesorderdetail_cancel-form').serialize(),
                function (content) {
                    //            alert(content);
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#global_dialog').dialog('close');
                        $('#salesorderdetail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                });
    }
}


function salesorder_revision() {
    var row = $('#salesorder').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Sales Order Revision',
            width: 400,
            height: 'auto',
            closed: false,
            cache: false,
            modal: true,
            href: base_url + 'salesorder/revision/' + row.id,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#so_rev-input').form('validate')) {
                            $.post(base_url + 'salesorder/do_revision',
                                    $('#so_rev-input').serialize(),
                                    function (content) {
                                        //            alert(content);
                                        var result = eval('(' + content + ')');
                                        if (result.success) {
                                            $('#global_dialog').dialog('close');
                                            $('#salesorderdetail').datagrid('reload');
                                            $('#salesorder').datagrid('reload');
                                            $('#salesorder').datagrid('selectRecord', row.id);
                                        } else {
                                            $.messager.alert('Error', result.msg, 'error');
                                        }
                                    });
                        }
                    }
                },
                {
                    text: 'Cancel',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }
            ]
        });
    } else {
        $.messager.alert('No Sales Order Selected', 'Choose Sales Order to Edit', 'warning');
    }
}

function salesorder_set_down_payment() {
    var row = $('#salesorder').datagrid('getSelected');
    if (row !== null) {
        if ($('#salesorder_dialog')) {
            $('#bodydata').append("<div id='salesorder_dialog'></div>");
        }
        $('#salesorder_dialog').dialog({
            title: 'Set Down Payment',
            width: 400,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'salesorder/set_down_payment',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#so_set_down_payment-input').form('submit', {
                            url: base_url + 'salesorder/save_down_payment/' + row.id,
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                //            alert(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#so_set_down_payment-form').dialog('close');
                                    $('#salesorder').datagrid('reload');
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
                        $('#salesorder_dialog').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $(this).dialog('center');
                $('#so_set_down_payment-input').form('load', row);
            }
        });
    } else {
        $.messager.alert('No Sales Order Selected', 'Please Select Sales Order', 'warning');
    }
}

function salesorder_print() {
    var row = $('#salesorder').datagrid('getSelected');
    if (row !== null) {
        open_target('POST', base_url + 'salesorder/prints/' + row.id + '/print', {
        }, '_blank');
    } else {
        $.messager.alert('No Sales Order Selected', 'Please Select Sales Order', 'warning');
    }
}

function salesorder_preview() {
    var row = $('#salesorder').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Print Preview',
            width: 820,
            height: 600,
            closed: false,
            cache: false,
            href: base_url + 'salesorder/prints/' + row.id + '/preview',
            buttons: [{
                    text: 'Print',
                    iconCls: 'icon-print',
                    handler: function () {
                        salesorder_print();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-close',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            top: 20
        });
    } else {
        $.messager.alert('No Sales Order Selected', 'Please Select Sales Order', 'warning');
    }
}

function salesorder_history_search() {
    $('#salesorder_history').datagrid('reload', $('#salesorder_history_search_form').serializeObject());
}

function salesorder_history_print() {
//alert($('#salesorder_history_search_datefrom').datebox('getValue'));
    if ($('#salesorder_history_search_datefrom').datebox('getValue') == '' && $('#salesorder_history_search_dateto').datebox('getValue') == '') {
        $.messager.alert('No Date Range', 'Please Fill Date Range', 'warning');
    } else {
        open_target('post', base_url + 'salesorder/history_print', $('#salesorder_history_search_form').serializeObject(), 'blank');
    }
}


function salesorder_history_excel() {
    if ($('#salesorder_history_search_datefrom').datebox('getValue') == '' && $('#salesorder_history_search_dateto').datebox('getValue') == '') {
        $.messager.alert('No Date Range', 'Please Fill Date Range', 'warning');
    } else {
        open_target('post', base_url + 'salesorder/history_excel', $('#salesorder_history_search_form').serializeObject(), 'blank');
    }
}