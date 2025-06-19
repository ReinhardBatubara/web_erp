/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* global base_url */

function mrp_search() {
    $('#mrp_joborder').datagrid('reload', $('#mrp_joborder_form').serializeObject());
}
function joborder_search() {
    var number = $('#jo_search_number50').val();
    var order_type = $('#jo_search_order_type50').combobox('getValue');
    var status = $('#jo_search_status51').combobox('getValue');
    $('#joborder').datagrid('reload', {
        number: number,
        order_type: order_type,
        status: status
    });
}

function joborder_add() {
    $('#joborder-form').dialog('open').dialog('setTitle', 'New Job Order');
    $('#joborder-input').form('clear');
    $('#joborder_type50').combobox('readonly',false);
    url = base_url + 'joborder/save/0';
}

function joborder_save() {
    $('#joborder-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#joborder-form').dialog('close');
                $('#joborder').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function joborder_edit() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        $('#joborder-form').dialog('open').dialog('setTitle', 'Edit Job Order');
        $('#joborder-input').form('load', row);
        var row_detail = $('#joborderitem').datagrid('getRows');
        if (row_detail.length > 0) {
            $('#joborder_type50').combobox('readonly',true);
        } else {
            $('#joborder_type50').combobox('readonly',false);
        }
        url = base_url + 'joborder/save/' + row.id;
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_print(){
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        open_target('GET',base_url+'joborder/prints/'+row.id,{},'_blank');
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_delete() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'joborder/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#joborder').datagrid('reload');
                        $('#joborderitem').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_generate_barcode() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure?', function (r) {
            if (r) {
                $.post(base_url + 'joborder/generate_barcode', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#joborder').datagrid('reload');
                        $('#joborderitem').datagrid('reload');
                        $('#joborder_generate_barcode').linkbutton('disable');
                        $('#joborder_print_barcode').linkbutton('enable');
                        $('#joborder_btn_release').linkbutton('enable');

                        $.messager.show({
                            title: 'Information',
                            msg: 'Generate Barcode Successfull<br/>Click View detail item to view barcode  Serialdetail',
                            timeout: 5000,
                            showType: 'slide'
                        });

                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_print_barcode() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        window.open(base_url + 'joborder/print_barcode/' + row.id, '_blank');
        $('#joborder').datagrid('reload');
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_print_barcode_custom() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        if ($('#joborder_dialog')) {
            $('#bodydata').append("<div id='joborder_dialog'></div>");
        }
        $('#joborder_dialog').dialog({
            title: 'PRINT CUSTOME BARCODE',
            width: 900,
            height: 'auto',
            href: base_url + 'joborder/print_barcode_custom/' + row.id,
            modal: false,
            resizable: true,
            shadow: false,
            maximizable: true,
            collapsible: true,
            buttons: [{
                    text: 'Print',
                    iconCls: 'icon-print',
                    handler: function () {
                        var all_rows = $('#jo_print_barcode_custom_detail_item').datagrid('getSelections');
                        if (all_rows.length > 0) {
                            var r_serial = new Array();
                            for (var i = 0; i < all_rows.length; i++) {
                                r_serial[i] = all_rows[i].serial;
                                console.log(r_serial[i]);
                            }
                            open_target('POST', base_url + 'joborder/print_barcode/' + row.id, {
                                serials: r_serial
                            }, '_blank');
                        } else {
                            $.messager.alert('Nothing to Print', 'Please check serial to print', 'warning');
                        }
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#joborder_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('vcenter');
            }
        });
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborderitem_search() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        $('#joborderitem').datagrid('reload', {
            joborderid: row.id,
            code_name: $('#joitem_code_name50').val(),
            po: $('#joitem_po50').val(),
            customer: $('#joitem_customer50').val()
        });
    }
}


function joborderitem_add() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        if (row.order_type === 'Order') {
            $('#global_dialog').dialog({
                title: 'Add Item',
                width: 750,
                height: 400,
                closed: false,
                cache: false,
                href: base_url + 'joborder/item_add',
                modal: true,
                resizable: true,
                buttons: [{
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            joborderitem_save_all_checked();
                        }
                    },
                    /*,{
                     text: 'Save',
                     iconCls: 'icon-save',
                     handler: function () {
                     joborderitem_save();
                     }
                     },*/ {
                        text: 'Close',
                        iconCls: 'icon-remove',
                        handler: function () {
                            $('#global_dialog').dialog('close');
                        }
                    }]
            });
        } else {
            $('#global_dialog').dialog({
                title: 'Add Item',
                width: 400,
                height: 'auto',
                closed: false,
                cache: false,
                href: base_url + 'joborder/item_add2',
                modal: true,
                resizable: true,
                buttons: [{
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            joborderitem_save2();
                        }
                    }, {
                        text: 'Close',
                        iconCls: 'icon-remove',
                        handler: function () {
                            $('#global_dialog').dialog('close');
                        }
                    }]
            });
            url = base_url + 'joborder/item_save2/' + row.id;
        }
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborderitem_save2() {
    $('#joborder_item_add2-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#joborderitem').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function joborderitem_save() {
    $('#salesorderitem_available').datagrid('endEdit', temp_index);
    var rows = $('#salesorderitem_available').datagrid('getChanges');
    temp_index = -1;
    if (rows !== null) {
        var msg = '';
        var a_salesorderdetailid = [];
        var a_modelid = [];
        var a_salesorderid = [];
        var a_qty = [];
        for (var i = 0; i < rows.length; i++) {
            if (rows[i].jo_qty !== '') {
                if (parseInt(rows[i].ots) < parseInt(rows[i].jo_qty)) {
                    //alert(rows[i].ots + '#' + rows[i].jo_qty)
                    msg = msg + "- Out of Outstanding for item " + rows[i].code + "<br/>";
                    //break;
                } else {
                    a_salesorderdetailid[i] = rows[i].id;
                    a_modelid[i] = rows[i].modelid;
                    a_salesorderid[i] = rows[i].salesorderid;
                    a_qty[i] = rows[i].jo_qty;
                }
            }
        }

        if (msg === '') {
            var joborderid = $('#joborder').datagrid('getSelected').id;
            $.post(base_url + 'joborder/item_save', {
                joborderid: joborderid,
                salesorderdetailid: a_salesorderdetailid,
                modelid: a_modelid,
                salesorderid: a_salesorderid,
                qty: a_qty
            }, function (content) {
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#global_dialog').dialog('close');
                    $('#joborderitem').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            });
        } else {
            $.messager.alert('Error Input', msg, 'error');
        }
    } else {
        $.messager.alert('Nothing to save', 'Please Set Qty', 'error');
    }
}

function joborderitem_save_all_checked() {

    if (jo_itm_temp_index !== null) {
        $('#salesorderitem_available').datagrid('endEdit', jo_itm_temp_index);
        $('#salesorderitem_available').datagrid('checkRow', jo_itm_temp_index);
        jo_itm_temp_index = null;
    }

    $('#salesorderitem_available').datagrid('acceptChanges');
    var rows = $('#salesorderitem_available').datagrid('getChecked');

    if (rows.length > 0) {
        var a_salesorderdetailid = [];
        var a_modelid = [];
        var a_salesorderid = [];
        var a_qty = [];
        for (var i = 0; i < rows.length; i++) {
            a_salesorderdetailid[i] = rows[i].id;
            a_modelid[i] = rows[i].modelid;
            a_salesorderid[i] = rows[i].salesorderid;
            a_qty[i] = rows[i].ots;
        }
        var joborderid = $('#joborder').datagrid('getSelected').id;
        $.post(base_url + 'joborder/item_save', {
            joborderid: joborderid,
            salesorderdetailid: a_salesorderdetailid,
            modelid: a_modelid,
            salesorderid: a_salesorderid,
            qty: a_qty
        }, function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#joborderitem').datagrid('reload');
                $('#salesorderitem_available').datagrid('reload');
                $.messager.show({
                    title: 'Notification',
                    msg: 'Save Succes..!!',
                    timeout: 4000,
                    showType: 'slide'
                });
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    } else {
        $.messager.alert('Nothing item checked', 'Please Check Item to Save', 'warning');
    }
}

function joborderitem_remove() {
    var row = $('#joborderitem').datagrid('getSelected');
    if (row !== null) {
        var row_jo = $('#joborder').datagrid('getSelected');
//        alert(row_jo.status);
        if (row_jo.status == '0') {
            $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
                if (r) {
                    $.post(base_url + 'joborder/item_remove', {
                        id: row.id
                    }, function (content) {
                        var result = eval('(' + content + ')');
                        if (result.success) {
                            $('#joborderitem').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    });
                }
            });
        } else {
            $.messager.alert('Action interupted', 'Unable to delete', 'warning');
        }
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function joborderitem_edit() {
    var row = $('#joborderitem').datagrid('getSelected');
    if (row !== null) {
        var row_jo = $('#joborder').datagrid('getSelected');
//        alert(row_jo.status);
        if (row_jo.status == '0') {
            $('#global_dialog').dialog({
                title: 'Edit Qty',
                width: 200,
                height: 'auto',
                closed: false,
                cache: false,
                modal: true,
                resizable: false,
                href: base_url + 'joborder/item_edit_form',
                buttons: [{
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            if ($('#joborder_item_edit-form').form('validate')) {
                                $.post(base_url + 'joborder/update_qty',
                                        $('#joborder_item_edit-form').serializeObject()
                                        , function (content) {
                                            var result = eval('(' + content + ')');
                                            if (result.success) {
                                                $('#joborderitem').datagrid('reload');
                                                $('#global_dialog').dialog('close');
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
                    $('#joborder_item_edit-form').form('load', row)
                }
            });
        } else {
            $.messager.alert('Action interupted', 'Unable to edit', 'warning');
        }

    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function joborder_release() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        var rows_item = $('#joborderitem').datagrid('getRows');
        if (rows_item.length > 0) {
            if (row.generated_barcode == 1) {
                $.get(base_url + 'joborder/joborderitemprocess_is_complete_reference/' + row.id, function (content) {
                    if (content == '0') {
                        $('#global_dialog').dialog({
                            title: 'Release Job Order',
                            width: 350,
                            height: 'auto',
                            closed: false,
                            cache: false,
                            href: base_url + 'joborder/release/' + row.id,
                            modal: true,
                            resizable: true,
                            buttons: [{
                                    text: 'Save',
                                    iconCls: 'icon-save',
                                    handler: function () {
                                        joborder_do_release();
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
                        $.messager.alert('Uncomplete Refrence On Prosess', 'Some item on process need to set item reference<br/>Click Configure to view detail', 'warning');
                    }
                });
            } else {
                $.messager.alert('No Barcode/Serial to release', 'Please Generate Barcode /Serial for each item', 'warning');
            }
        } else {
            $.messager.alert('No Item to release', 'Please Input Item to Release', 'warning');
        }
    }
    else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_do_release() {
    if ($('#joborder_release-form').form('validate')) {
        $.post(base_url + 'joborder/do_release',
                $('#joborder_release-form').serialize(),
                function (content) {
                    //            alert(content);
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#global_dialog').dialog('close');
                        $('#joborder').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                });
    }
}



function joborder_add_on_process() {
    var row = $('#joborderitem').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Add on Process',
            width: 320,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'joborder/add_on_process/' + row.id + '/' + row.modelid,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        joborder_save_on_process();
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
        $.messager.alert('No Job Order Item Selected', 'Please Select Job Order Item', 'warning');
    }
}

function joborder_save_on_process() {
    if ($('#joborder_add_on_process-form').form('validate')) {
        $.post(base_url + 'joborder/save_on_process',
                $('#joborder_add_on_process-form').serialize(),
                function (content) {
                    //            alert(content);
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#global_dialog').dialog('close');
                        $('#allocated_process').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                });
    }
}

function joborder_edit_on_process() {
    var row = $('#allocated_process').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit on Process',
            width: 320,
            height: 'auto',
            href: base_url + 'joborder/edit_on_process/' + row.id + '/' + row.modelid,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        joborder_update_on_process();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }]
        });
        $('#joborder_add_on_process-form').form('load', row);
    } else {
        $.messager.alert('No Process Selected', 'Please Select Process', 'warning');
    }
}

function joborder_update_on_process() {
    if ($('#joborder_edit_on_process-form').form('validate')) {
        $.post(base_url + 'joborder/update_on_process',
                $('#joborder_edit_on_process-form').serialize(),
                function (content) {
                    //            alert(content);
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#global_dialog').dialog('close');
                        $('#allocated_process').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                });
    }
}

function joborder_delete_on_process() {
    var row = $('#allocated_process').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'joborder/delete_on_process', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#joborder').datagrid('reload');
                        $('#allocated_process').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Process Selected', 'Please Select Process', 'warning');
    }
}

function joborder_generate_mrp() {
    var row = $('#mrp_joborder').datagrid('getSelected');
    if (row !== null) {
        if (row.final_mrp === 'f') {
            $.messager.confirm('Confirm', 'Are you sure?', function (r) {
                if (r) {
                    $.post(base_url + 'joborder/generate_mrp', {
                        id: row.id
                    }, function (result) {
                        if (result.success) {
                            $('#mrp').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.alert('Not Allowed', 'Not Allowed', 'warning');
        }
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_view_mrp() {
    var row = $('#joborder').datagrid('getSelected');
    if (row != null) {
        $('#global_dialog').dialog({
            title: 'Material Request Planning (MRP)',
            width: 900,
            height: 500,
            href: base_url + 'joborder/view_mrp/' + row.id,
            modal: false,
            resizable: true,
            buttons: [{
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }]
        });
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_save_mrp() {
    $('#mrp').datagrid('endEdit', lastIndex);
    var rows = $('#mrp').datagrid('getChanges');
    if (rows.length !== 0) {
        var arr_id = new Array();
        var arr_allowance_qty = new Array();
        for (var i = 0; i < rows.length; i++) {
            arr_id.push(rows[i].id);
            arr_allowance_qty.push(rows[i].allowance_qty);
        }

        $.post(base_url + 'joborder/save_mrp', {
            id: arr_id,
            allowance_qty: arr_allowance_qty
        }, function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#mrp').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    } else {
        $.messager.alert('Nothing to save', 'Set Allowance Qty', 'warning');
    }
}

function joborder_outsource() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'JO Out Source',
            width: 600,
            height: 400,
            href: base_url + 'joborder/outsource/' + row.id,
            modal: false,
            resizable: true,
            buttons: [{
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }]
        });
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_outsource_add() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        $('#joborder_outsource-form').dialog('open').dialog('setTitle', 'New Outsource Item');
        $('#joborder_outsource-input').form('clear');
        $('#joborderitemid').combogrid({
            panelWidth: 400,
            idField: 'id',
            fitColumns: true,
            mode: 'remote',
            textField: 'modelname',
            url: base_url + 'joborder/item_get_for_combo/' + row.id,
            columns: [
                [{
                        field: 'modelcode',
                        title: 'Item Code',
                        width: 80,
                        halign: 'center'
                    }, {
                        field: 'modelname',
                        title: 'Item Name',
                        width: 150,
                        halign: 'center'
                    }, {
                        field: 'qty',
                        title: 'Qty',
                        width: 50,
                        align: 'center'
                    }, {
                        field: 'sonumber',
                        title: 'SO Number',
                        width: 100,
                        halign: 'center'
                    }
                ]],
            onSelect: function (value, row, index) {
                $('#jo_item_qty').val(row.qty);
            }
        });
        url = base_url + 'joborder/outsource_save/' + row.id;
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_outsource_save() {
    if ($('#joborder_outsource-input').form('validate')) {
        $.post(url, $('#joborder_outsource-input').serialize(), function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#joborder_outsource-form').dialog('close');
                $('#joborderoutsource').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    }
}

function joborder_outsource_remove() {
    var row = $('#joborderoutsource').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure?', function (r) {
            if (r) {
                $.post(base_url + 'joborder/outsource_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#joborderoutsource').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item!', 'warning');
    }
}

function joborder_print_mrp() {
    var row = $('#mrp_joborder').datagrid('getSelected');
    if (row !== null) {
        open_target('POST', base_url + 'joborder/print_mrp', {
            joborderid: row.id
        }, '_blank')
    } else {
        $.messager.alert('No JO Selected', 'Please Select JO!', 'warning');
    }
}

function joborder_submit_to_create_mrp() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        var row_item = $('#joborderitem').datagrid('getRows');
        if (row_item.length > 0) {
            $.messager.confirm('Confirm', 'This JO will submit to create MRP. Are you sure?', function (r) {
                if (r) {
                    $.post(base_url + 'joborder/submit_to_create_mrp', {
                        id: row.id
                    }, function (result) {
                        if (result.success) {
                            $('#joborder').datagrid('reload');
                            $('#joborder_btn_edit').linkbutton('disable');
                            $('#joborder_btn_delete').linkbutton('disable');
                            $('#joborderitemitem_btn_add').linkbutton('disable');
                            $('#joborderitemitem_btn_edit').linkbutton('disable');
                            $('#joborderitemitem_btn_delete').linkbutton('disable');
                            $('#allocated_process_btn_add').linkbutton('disable');
                            $('#allocated_process_btn_edit').linkbutton('disable');
                            $('#allocated_process_btn_delete').linkbutton('disable');
                            $('#joborderoutsource_btn_add').linkbutton('disable');
                            $('#joborderoutsource_btn_delete').linkbutton('disable');
                            $('#joborder_btn_submit_to_create_mrp').linkbutton('disable');
                            $('#joborder_generate_barcode').linkbutton('enable');

                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.alert('No Item to submit', 'Please input item!', 'warning');
        }
    } else {
        $.messager.alert('No JO Selected', 'Please Select JO!', 'warning');
    }
}

function joborder_mark_mrp_as_final() {
    var row = $('#mrp_joborder').datagrid('getSelected');
    if (row !== null) {
        var row_item = $('#mrp').datagrid('getRows');
        if (row_item.length > 0) {
            $.messager.confirm('Confirm', 'Unable change MRP when mark as Final. Are you sure?', function (r) {
                if (r) {
                    $.post(base_url + 'joborder/mark_mrp_as_final', {
                        id: row.id
                    }, function (result) {
                        if (result.success) {
                            $('#mrp_joborder').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.alert('Action Interupted', 'No Material to Submit', 'warning');
        }
    } else {
        $.messager.alert('No JO Selected', 'Please Select JO!', 'warning');
    }
}

function joborder_material_to_outsource() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        $('#mto_v_temp').dialog({
            title: 'Material to Outsource',
            width: 700,
            height: 400,
            href: base_url + 'joborder/material_to_outsource/' + row.id + '/' + row.status,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#mto_v_temp').dialog('close');
                    }
                }]
        });
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_material_to_oursource_search() {
    $('#joborder_material_to_oursource').datagrid('reload', $('#jo_material_to_outsource_search_form').serializeObject());
}

function joborder_material_to_oursource_add() {
    var row = $('#joborder').datagrid('getSelected');
    $('#mto_temp').dialog({
        title: 'Add Material',
        width: 460,
        href: base_url + 'joborder/material_to_outsource_add',
        modal: true,
        resizable: true,
        buttons: [
            {
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    $('#joborder_material_to_oursource-input').form('submit', {
                        url: base_url + 'joborder/material_to_outsource_save/' + row.id + '/0',
                        onSubmit: function () {
                            return $(this).form('validate');
                        },
                        success: function (content) {
                            //                        alert(content);
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $('#mto_temp').dialog('close');
                                $('#joborder_material_to_oursource').datagrid('reload');
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
                    $('#mto_temp').dialog('close');
                }
            }
        ],
        onLoad: function () {
            $('#joborder_material_to_oursource-input').form('clear');
        }
    });
}

function joborder_material_to_oursource_edit() {
    var row = $('#joborder_material_to_oursource').datagrid('getSelected');
    if (row !== null) {
        $('#mto_temp').dialog({
            title: 'Edit Material',
            width: 460,
            href: base_url + 'joborder/material_to_outsource_add',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#joborder_material_to_oursource-input').form('submit', {
                            url: base_url + 'joborder/material_to_outsource_save/' + 0 + '/' + row.id,
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                //                        alert(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#mto_temp').dialog('close');
                                    $('#joborder_material_to_oursource').datagrid('reload');
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
                        $('#mto_temp').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $('#joborder_material_to_oursource-input').form('load', row);
            }
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function joborder_material_to_oursource_delete() {
    var row = $('#joborder_material_to_oursource').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'joborder/material_to_oursource_delete', {
                    id: row.id
                }, function (content) {
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#joborder_material_to_oursource').datagrid('reload');
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

function joborder_configure_on_process() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        var row_on_process = $('#allocated_process').datagrid('getRows');
        if (row_on_process.length != 0) {
            if (row.generated_barcode == 1) {
                $('#global_dialog').dialog({
                    title: 'Configure on process item',
                    width: 1000,
                    height: 400,
                    closed: false,
                    cache: false,
                    href: base_url + 'joborder/configure_on_process/' + row.id,
                    modal: true,
                    resizable: true,
                    buttons: [{
                            text: 'Close',
                            iconCls: 'icon-remove',
                            handler: function () {
                                $('#global_dialog').dialog('close');
                            }
                        }]
                });
            } else {
                $.messager.alert('No Barcode/Serial', 'Please Generate Barcode/Serial for each item', 'warning');
            }
        } else {
            $.messager.alert('No item on process', 'No Item to configuration', 'warning');
        }
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_view_detail_item() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Detail Item',
            width: 1200,
            height: 400,
            closed: false,
            cache: false,
            href: base_url + 'joborder/view_detail_item/' + row.id,
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }]
        });
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_set_reference_item_on_process() {
    var row = $('#configure_on_process').datagrid('getSelected');
    if (row !== null) {
        $('#temp_configure_on_process').dialog({
            title: 'Set Reference Item',
            width: 400,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'joborder/set_reference_item_on_process/' + row.id + '/' + row.modelid + '/' + row.processid,
            modal: true,
            resizable: false,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#set_reference_iten_on_process-input').form('validate')) {
                            $.post(base_url + 'joborder/do_set_reference_item_on_process/' + row.id,
                                    $('#set_reference_iten_on_process-input').serializeObject()
                                    , function (content) {
                                        var result = eval('(' + content + ')');
                                        if (result.success) {
                                            $('#configure_on_process').datagrid('reload');
                                            $('#temp_configure_on_process').dialog('close');
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
                        $('#temp_configure_on_process').dialog('close');
                    }
                }],
            onLoad: function () {
                var next_process = parseInt(row.processid);
                $('#modelprocessid_stock').combogrid('setValue', next_process);
            }
        });
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_edit_specification_item() {
    var row = $('#jo_detail_item').datagrid('getSelected');
    if (row !== null) {
        $('#temp_edit_specification_item').dialog({
            title: 'Edit Specification Item',
            width: 400,
            closed: false,
            cache: false,
            href: base_url + 'joborder/edit_specification_item/' + row.serial,
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $.post(base_url + 'joborder/update_specification_item/' + row.serial,
                                $('#joborder_edit_specification_item').serializeObject(),
                                function (content) {
                                    var result = eval('(' + content + ')');
                                    if (result.success) {
                                        $('#jo_detail_item').datagrid('reload');
                                        $('#temp_edit_specification_item').dialog('close');
                                    } else {
                                        $.messager.alert('Error', result.msg, 'error');
                                    }
                                });
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#temp_edit_specification_item').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#joborder_edit_specification_item').form('load', row);
            }
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item ', 'warning');
    }
}

function joborder_item_shipment() {
    var rows = $('#jo_detail_item').datagrid('getChecked');
    var st = 0;
    if (rows.length > 0) {
        var arr_serial = new Array();
        for (var i = 0; i < rows.length; i++) {
            arr_serial.push(rows[i].serial);
        }
        $('#temp_shipment').dialog({
            title: 'Shipment Item',
            width: 350,
            height: 110,
            closed: false,
            cache: false,
            href: base_url + 'joborder/item_shipment',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#joborder_item_shipment').form('validate')) {
                            var _date = $('#joborder_item_shipment_date').datebox('getValue');
                            $.messager.confirm('Confirm', 'Are you sure ?', function (r) {
                                if (r) {
                                    $.post(base_url + 'joborder/do_item_shipment', {
                                        serial: arr_serial,
                                        date: _date
                                    }, function (content) {
                                        var result = eval('(' + content + ')');
                                        if (result.success) {
                                            $('#jo_detail_item').datagrid('reload');
                                            $('#temp_shipment').dialog('close');
                                        } else {
                                            $.messager.alert('Error', result.msg, 'error');
                                        }
                                    });
                                }
                            });
                        }
                    }
                },
                {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#temp_shipment').dialog('close');
                    }
                }
            ]
        });
    } else {
        $.messager.alert('No Item Checked', 'Please Check Item', 'warning');
    }
}

function joborder_detail_item_search() {
    $('#jo_detail_item').datagrid('reload', $('#jo_detail_item_form_search').serializeObject());
}

function joborder_print_barcode_custom_item_search() {
    $('#jo_print_barcode_custom_detail_item').datagrid('reload', $('#jo_print_barcode_custom_detail_item_form_search').serializeObject());
}

function joborder_close() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to close this project?', function (r) {
            if (r) {
                $.post(base_url + 'joborder/do_close', {
                    id: row.id
                }, function (content) {
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#joborder').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                });
            }
        });
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_mrp_search_material() {
    var row = $('#mrp_joborder').datagrid('getSelected');
    if (row != null) {
        $('#mrp').datagrid('reload', {
            joborderid: row.id,
            code_description: $('#mrp_detail_item_code_description_50').val()
        });
    }
}

function job_outsource_receive() {
    var row = $('#job_outsource').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Receive Outsource',
            width: 320,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'joborder/receive_outsource',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $.post(base_url + 'joborder/outsource_do_receive/' + row.id, $('#receive_outsource_form').serializeObject(), function (content) {
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $('#job_outsource').datagrid('reload');
                                $('#global_dialog').dialog('close');
                            } else {
                                $.messager.alert('Error', result.msg, 'error');
                            }
                        });
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
        $.messager.alert('No Outsource Selected', 'Please Select Outsource', 'warning');
    }
}

function job_outsource_revert() {
    var row = $('#job_outsource').datagrid('getSelected');
    if (row !== null) {
        if (row.receive === 't') {
            $.messager.confirm('Confirm', 'Are you sure you want to revert this job?', function (r) {
                if (r) {
                    $.post(base_url + 'joborder/outsource_do_revert', {id: row.id}, function (content) {
                        var result = eval('(' + content + ')');
                        if (result.success) {
                            $('#job_outsource').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    });
                }
            });
        } else {
            $.messager.alert('System intrupted', 'Unable to revert waiting status ', 'warning');
        }
    } else {
        $.messager.alert('No Outsource Selected', 'Please Select Outsource', 'warning');
    }
}

function job_outsource_search() {
    $('#job_outsource').datagrid('reload', $('#job_outsource_form_search').serializeObject());
}

function job_outsource_outstanding_search() {
    $('#job_outsource_outstanding').datagrid('reload', $('#job_outsource_outstanding_form_search').serializeObject());
}


function joborder_item_shipment2() {
    var rows = $('#finished_production_order').datagrid('getChecked');
    if (rows.length > 0) {
        var arr_serial = new Array();
        for (var i = 0; i < rows.length; i++) {
            arr_serial.push(rows[i].serial);
        }
        $('#global_dialog').dialog({
            title: 'Shipment Item',
            width: 350,
            height: 110,
            closed: false,
            cache: false,
            href: base_url + 'joborder/item_shipment',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#joborder_item_shipment').form('validate')) {
                            var _date = $('#joborder_item_shipment_date').datebox('getValue');
                            $.messager.confirm('Confirm', 'Are you sure ?', function (r) {
                                if (r) {
                                    $.post(base_url + 'joborder/do_item_shipment', {
                                        serial: arr_serial,
                                        date: _date
                                    }, function (content) {
                                        var result = eval('(' + content + ')');
                                        if (result.success) {
                                            $('#finished_production_order').datagrid('reload');
                                            $('#global_dialog').dialog('close');
                                        } else {
                                            $.messager.alert('Error', result.msg, 'error');
                                        }
                                    });
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
        $.messager.alert('No Item Checked', 'Please Check Item', 'warning');
    }
}


function joborder_import_shipment() {

    if ($('#joborder_item_import_dialog')) {
        $('#bodydata').append("<div id='joborder_item_import_dialog'></div>");
    }
    $('#joborder_item_import_dialog').dialog({
        title: 'Import File',
        width: 400,
        height: 'auto',
        href: base_url + 'tracking/import_shipment',
        modal: false,
        resizable: false,
        shadow: false,
        maximizable: true,
        collapsible: true,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {

                    $('#joborder_item_import_form').form('submit', {
                        url: base_url + 'tracking/do_import_shipment',
                        onSubmit: function () {
                            return $(this).form('validate');
                        },
                        success: function (content) {
                            var result = eval('(' + content + ')');
                            if (result.status === 'success' || result.status === 'warning') {
                                $('#finished_production_order').datagrid('reload');
                                $('#joborder_item_import_dialog').dialog('close');
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
                        }
                    });
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#joborder_item_import_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $(this).dialog('center');
        }
    });
}

function joborder_print_sticker() {
    var row = $('#joborder').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Option Print Sticker',
            width: 800,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'joborder/print_sticker/' + row.id,
            modal: true,
            buttons: [{
                    text: 'Print',
                    iconCls: 'icon-print',
                    handler: function () {
                        var rows = $('#jo_print_sticker_custom').datagrid('getSelections')
                        if (rows.length > 0) {
                            var r_serial = new Array();
                            for (var i = 0; i < rows.length; i++) {
                                r_serial[i] = rows[i].serial;
                                console.log(r_serial[i]);
                            }
                            open_target('POST', base_url + 'joborder/do_print_sticker/' + row.id, {
                                customerid: $('#joborder_print_sticker_customerid').combobox('getValue'),
                                serial: r_serial,
                                companylogo: $('#jo_ps_company_logo').combobox('getValue'),
                                madein: $('#jo_ps_made_id').combobox('getValue'),
                                remark: $('#jo_ps_remark_id').val(),
                                item_code_display: $('#jo_ps_item_code_type').combobox('getValue')
                            }, '_blank');
                        } else {
                            $.messager.alert('Interupted', 'Please check serial to print', 'warning');
                        }

//                        if ($('#joborder_print_sticker-input').form('validate')) {
//                            open_target('post', base_url + 'joborder/do_print_sticker/' + row.id,
//                                    $('#joborder_print_sticker-input').serializeObject(), '_blank');
//                        }
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('vcenter');
            }
        });
    } else {
        $.messager.alert('No Job Order Selected', 'Please Select Job Order', 'warning');
    }
}

function joborder_print_sticker_item_search() {
    var row_jo = $('#joborder').datagrid('getSelected');
    if ($('#jo_print_sticker_custom_form_search').form('validate')) {
        var customer_id = $('#joborder_print_sticker_customerid').combobox('getValue');
        $('#jo_print_sticker_custom').datagrid('reload', {
            joborderid: row_jo.id,
            customer_id: customer_id,
            serial: $('#joborder_print_sticker_serial').val(),
            so: $('#joborder_print_sticker_so').val(),
            itemcode_or_name: $('#joborder_print_sticker_code_name').val()
        });
    }
}

function critical_jo_order_search() {
    $('#critical_job_order').datagrid('reload', $('#critical_jo_order_search_form').serializeObject());
}

function critical_jo_order_print() {
    open_target('POST',base_url+'joborder/critical_jo_order_print',$('#critical_jo_order_search_form').serializeObject(),'_blank');
}

function critical_so_search(){
    $('#critical_order').datagrid('reload', $('#critical_so_search_form').serializeObject());
}

function critical_so_print(){
    open_target('POST',base_url+'joborder/critical_so_print',$('#critical_so_search_form').serializeObject(),'_blank');
}