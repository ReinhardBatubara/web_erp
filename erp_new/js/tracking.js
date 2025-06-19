/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function tracking_search() {
    var serial = $('#t_serial').val();
    var itemcode = $('#t_itemcode').val();
    var itemname = $('#t_itemname').val();
    var jo_no = $('#t_jo_no').val();
    var so_no = $('#t_so_no').val();
    var po_no = $('#t_po_no').val();
    var customerid = $('#t_customerid').combobox('getValue');
    var order_type = $('#tracking_order_type').combobox('getValue');

    $('#tracking').datagrid('reload', {
        serial: serial,
        itemcode: itemcode,
        itemname: itemname,
        jo_no: jo_no,
        so_no: so_no,
        po_no: po_no,
        customerid: customerid,
        order_type: order_type,
        processid: $('#tracking_process_id_s').combobox('getValue')
    });
}

function tracking_finish_production_search() {
    $('#finished_production_order').datagrid('reload',$('#finished_production_order_search_form').serializeObject());
}

function tracking_import_process() {
    $('#tracking_import_process-form').dialog('open').dialog('setTitle', 'Import Process');
    $('#tracking_import_process-input').form('clear');
    url = base_url + 'tracking/do_import_process';
}

function tracking_do_import_process() {
    if ($('#tracking_import_process-input').form('validate')) {
        var tracking_process_id = $('#tracking_process_id').combogrid('getValue');
        var tracking_process_date = $('#tracking_process_date').datebox('getValue');
        if ($('#inputfile').val() !== '') {
            $.ajaxFileUpload({
                url: url,
                secureuri: false,
                fileElementId: 'inputfile',
                dataType: 'json',
                data: {
                    process_id: tracking_process_id,
                    date: tracking_process_date
                },
                success: function (data, status) {
                    //alert(data);
                    var result = eval('(' + data + ')');
                    console.log(result.serial);
                    var str_serial = "'" + result.serial.join("','") + "'";
                    if (result.status === 'success' || result.status === 'warning') {
                        $('#inputfile').val('');
                        $('#tracking').datagrid('reload', {serials: str_serial});
                        $('#tracking_import_process-form').dialog('close');
                        if (result.status === 'success') {
                            $.messager.show({
                                title: 'Server Notify',
                                msg: result.msg,
                                timeout: 5000,
                                showType: 'slide'
                            });
                        } else {
                            $.messager.show({
                                title: 'Server Notify',
                                msg: result.msg,
                                timeout: 5000,
                                showType: 'slide'
                            });
                        }
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                },
                error: function (data, status, e) {
                    console.log(e);
                }
            });
        } else {
            $.messager.alert('Error', 'No File Choosed!', 'error');
        }
    }
}

function tracking_view_history() {
    var row = $('#tracking').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'History Process',
            width: 500,
            height: 300,
            closed: false,
            cache: false,
            href: base_url + 'tracking/history/' + row.serial,
            modal: true,
            resizable: true
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function tracking_edit(processid, st) {
    var rows = $('#tracking').datagrid('getChecked');
    if (rows.length > 0) {
        var serial = '0';
        var msg = '';

        for (var i = 0; i < rows.length; i++) {
            serial += '-' + rows[i].serial;
            if (processid == 7 && st == 'ot') {
                if (rows[i].pack_in == null) {
                    msg = msg + 'No Packing in for serial: ' + rows[i].serial + '<br/>';
                }
            }
        }
        var my_title = 'Edit Date';
        if (processid == 7 && st == 'ot') {
            my_title = 'Packing Out';
        }
        if (msg == '') {
            $('#global_dialog').dialog({
                title: my_title,
                width: 300,
                height: 110,
                closed: false,
                cache: false,
                href: base_url + 'tracking/edit_date/' + serial + '/' + processid + '/' + st,
                modal: true,
                resizable: true,
                buttons: [
                    {
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            if ($('#tracking_edit_date').form('validate')) {
                                $.post(base_url + 'tracking/update_date', $('#tracking_edit_date').serializeObject(), function (content) {
                                    var result = eval('(' + content + ')');
                                    if (result.success) {
                                        $('#global_dialog').dialog('close');
                                        $('#tracking').datagrid('reload');
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
                ]
            });
        } else {
            $.messager.alert('Action interupted', msg, 'warning');
        }
    } else {
        $.messager.alert('No Item Checked', 'Please Check Item', 'warning');
    }
}

function tracking_do_finish() {
    var rows = $('#tracking').datagrid('getSelections');
    if ($('#tracking_finish-input').form('validate')) {
        var arr_serial = new Array();
        for (var i = 0; i < rows.length; i++) {
            arr_serial[i] = rows[i].serial
        }
        $.post(url, {
            date: $('#tracking_finish_date_').datebox('getValue'),
            serial: arr_serial
        }, function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#tracking_finish-form').dialog('close');
                $('#tracking').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    }
}

function tracking_make_to_stock() {
    var rows = $('#tracking').datagrid('getChecked');
    var arr_serial = new Array();
    var arr_position = new Array();
    if (rows.length > 0) {
        var msg = '';
        for (var i = 0; i < rows.length; i++) {
            if (rows[i].positionid == 0) {
                msg += 'No Position for Serial : ' + rows[i].serial + '<br/>';
            }
            arr_serial.push(rows[i].serial);
            arr_position.push(rows[i].positionid);
        }
        if (msg == '') {
            $.messager.confirm('Confirm', 'Are you sure you want to make checked item as a stock?', function (r) {
                if (r) {
                    $.post(base_url + 'tracking/do_make_stock_item', {
                        serial: arr_serial,
                        position: arr_position
                    }, function (content) {
                        var result = eval('(' + content + ')');
                        if (result.success) {
                            $('#tracking').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    });
                }
            });
        } else {
            $.messager.show({
                width: 400,
                height: 200,
                title: '<font style="color:red">Error. System Interupted</font>',
                msg: msg,
                timeout: 5000,
                showType: 'slide'
            });
        }
    } else {
        $.messager.alert('No Item Checked', 'Please Check Item to Make as Stock', 'warning');
    }
}

function tracking_back_item(processid) {
    var rows = $('#tracking').datagrid('getChecked');
    if (rows.length > 0) {
        var arr_serial = new Array();
        var msg = '';
        for (var i = 0; i < rows.length; i++) {
            if ((parseInt(rows[i].positionid) <= parseInt(processid)) || rows[i].positionid == '0') {
                msg += 'Invalid back process for serial : ' + rows[i].serial + '<br/>';
            } else {
                arr_serial.push(rows[i].serial);
            }
        }
        if (msg == '') {
            $('#global_dialog').dialog({
                title: 'Back Item Process',
                width: 300,
                height: 110,
                closed: false,
                cache: false,
                href: base_url + 'tracking/back_item',
                modal: true,
                resizable: true,
                buttons: [{
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            if ($('#tracking_back').form('validate')) {
                                var _date = $('#tracking_back_date').datebox('getValue');
                                $.messager.confirm('Confirm', 'Are you sure ?', function (r) {
                                    if (r) {
                                        $.post(base_url + 'tracking/do_back_item', {
                                            serial: arr_serial,
                                            processid: processid,
                                            date: _date
                                        }, function (content) {
                                            var result = eval('(' + content + ')');
                                            if (result.success) {
                                                $('#tracking').datagrid('reload');
                                                $('#global_dialog').dialog('close');
                                            } else {
                                                $.messager.alert('Error', result.msg, 'error');
                                            }
                                        });
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
                    }]
            });
        } else {
            $.messager.alert('Action Interupted', msg, 'warning');
        }
    } else {
        $.messager.alert('No Item Checked', 'Please Check Item', 'warning');
    }
}

function tracking_view_remark(_joborderitembarcodeid) {
    $('#global_dialog').dialog({
        title: 'Remark',
        width: 500,
        height: 300,
        closed: false,
        cache: false,
        href: base_url + 'tracking/view_remark/' + _joborderitembarcodeid,
        modal: true,
        resizable: true,
        buttons: []
    });
}

function tracking_add_remark(_joborderitembarcodeid) {
    $('#tracking_dialog_d').dialog({
        title: 'Add Remark',
        width: 300,
        height: 150,
        closed: false,
        cache: false,
        href: base_url + 'tracking/add_remark/' + _joborderitembarcodeid,
        modal: true,
        resizable: true,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    if ($('#tracking_remark-input').form('validate')) {
                        $.post(base_url + 'tracking/save_remark/0', $('#tracking_remark-input').serializeObject(), function (content) {
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $('#tracking_remark').datagrid('reload');
                                $('#tracking').datagrid('reload');
                                $('#tracking_dialog_d').dialog('close');
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
                    $('#tracking_dialog_d').dialog('close');
                }
            }],
        onLoad: function () {
            $('#tracking_remark-input').form('clear');
            $('#tracking_joborderitembarcodeid').val(_joborderitembarcodeid);
        }
    });
}

function tracking_edit_remark() {
    var row = $('#tracking_remark').datagrid('getSelected');
    if (row != null) {
        $('#tracking_dialog_d').dialog({
            title: 'Edit Remark',
            width: 300,
            height: 150,
            closed: false,
            cache: false,
            href: base_url + 'tracking/add_remark',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#tracking_remark-input').form('validate')) {
                            $.post(base_url + 'tracking/save_remark/' + row.id, $('#tracking_remark-input').serializeObject(), function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#tracking_remark').datagrid('reload');
                                    $('#tracking').datagrid('reload');
                                    $('#tracking_dialog_d').dialog('close');
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
                        $('#tracking_dialog_d').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#tracking_remark-input').form('load', row);
            }
        });
    } else {
        $.messager.alert('No Detail Selected', 'Please Select Detail', 'warning');
    }
}

function tracking_delete_remark() {
    var row = $('#tracking_remark').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'tracking/delete_remark', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#tracking_remark').datagrid('reload');
                        $('#tracking').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Detail Selected', 'Please Select Detail', 'warning');
    }
}

function tracking_print_target(position) {
    open_target('POST', base_url + 'tracking/print_target', {
        position: position
    }, '_blank');
}

function tracking_print_sticker() {
    open_target('POST', base_url + 'tracking/print_sticker', {
    }, '_blank');
}