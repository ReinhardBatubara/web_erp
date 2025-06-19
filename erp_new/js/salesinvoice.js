/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function salesinvoice_search() {
    $('#salesinvoice').datagrid('reload', $('#salesinvoice_search_form').serializeObject());
}

function salesinvoice_add() {
    $('#global_dialog').dialog({
        title: 'INVOICE',
        width: 450,
        top: 100,
        height: 'auto',
        closed: false,
        cache: false,
        href: base_url + 'salesinvoice/add',
        modal: true,
        resizable: true,
        buttons: [
            {
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    salesinvoice_save();
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
}

function salesinvoice_save() {
    if ($('#salesinvoice-input').form('validate')) {
        $.post(base_url + 'salesinvoice/save', $('#salesinvoice-input').serializeObject(), function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#salesinvoice').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    }
}

function salesinvoice_edit() {
    var row = $('#salesinvoice').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'EDIT INVOICE',
            width: 850,
            top: 30,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'salesinvoice/edit/' + row.id,
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        salesinvoice_update();
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
                $('#salesinvoice_edit-input').form('load', row);
            }
        });
    } else {
        $.messager.alert('No Invoice Selected', 'Please Select Invoice', 'warning');
    }
}


function salesinvoice_update() {
    if ($('#salesinvoice_edit-input').form('validate')) {
        var row = $('#salesinvoice').datagrid('getSelected');
        $.post(base_url + 'salesinvoice/update/' + row.id, $('#salesinvoice_edit-input').serializeObject(), function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#salesinvoice').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    }
}


function salesinvoice_print() {
    var row = $('#salesinvoice').datagrid('getSelected');
    if (row !== null) {
        open_target('POST', base_url + 'salesinvoice/prints', {
            id: row.id
        }, '_blank');
    } else {
        $.messager.alert('No Invoice Selected', 'Please Select Invoice', 'warning');
    }
}





function salesinvoice_load_customer_order_item() {
    var customerid = $('#customerid').combobox('getValue');
    if (customerid != '') {
        salesinvoice_do_load_customer_order_item(customerid);
    } else {
        $.messager.alert('No Customer Choosed', 'Please Choose Customer', 'warning');
    }
}

function salesinvoice_do_load_customer_order_item(customerid) {
    $('#list_item_invoice').datagrid({
        url: base_url + 'salesinvoice/do_load_customer_order_item',
        queryParams: {
            customerid: customerid
        }
    });
}



function salesinvoicedetail_add() {
    var row = $('#salesinvoice').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Add Detail',
            width: 450,
            top: 100,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'salesinvoice/add_detail/' + row.customerid,
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        salesinvoicedetail_save(0);
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
                $('#salesinvoice-detail-input').form('clear');
            }
        });
        url = base_url + 'salesinvoice/save_detail/' + row.id;
    } else {
        $.messager.alert('No Invoice Selected', 'Please Select Invoice', 'warning');
    }
}




function salesinvoicedetail_add_f_e() {
    var row = $('#salesinvoice').datagrid('getSelected');
    if (row !== null) {
        $('#si_dialog').dialog({
            title: 'Add Detail',
            width: 450,
            top: 100,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'salesinvoice/add_detail/' + row.customerid,
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        salesinvoicedetail_save(1);
                    }
                },
                {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#si_dialog').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $('#salesinvoice-detail-input').form('clear');
            }
        });
        url = base_url + 'salesinvoice/save_detail/' + row.id;
    } else {
        $.messager.alert('No Invoice Selected', 'Please Select Invoice', 'warning');
    }
}

function load_total(id) {
    $.get(base_url + 'salesinvoice/get_data_total/' + id, function (content) {
        var list = content.split("|");
        $('#si_subtotal_e').numberbox('setValue', list[0]);
        $('#si_discount_e').numberbox('setValue', list[1]);
        $('#si_tax_e').numberbox('setValue', list[2]);
        $('#si_totalinvoice_e').numberbox('setValue', list[3]);
        $('#si_downpayment_e').numberbox('setValue', list[4]);
        $('#si_balancepayment_e').numberbox('setValue', list[5]);
    });
}

function salesinvoicedetail_save(flag) {
    if ($('#salesinvoice-detail-input').form('validate')) {
        $.post(url, $('#salesinvoice-detail-input').serializeObject(), function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#salesinvoicedetail').datagrid('reload');
                $('#salesinvoice').datagrid('reload');
                if (flag == 0) {
                    $('#global_dialog').dialog('close');
                } else {
                    $('#si_dialog').dialog('close');
                    $('#list_item_invoice').datagrid('reload');
                    var n_row = $('#salesinvoice').datagrid('getSelected');
                    load_total(n_row.id)
                }
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    }
}

function salesinvoicedetail_edit() {
    var row = $('#salesinvoicedetail').datagrid('getSelected');
    if (row !== null) {
        var row_invoice = $('#salesinvoice').datagrid('getSelected');
        $('#global_dialog').dialog({
            title: 'Edit Detail',
            width: 450,
            top: 100,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'salesinvoice/edit_detail/' + row.id + '/' + row.salesorderdetailid + '/' + row_invoice.customerid,
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        salesinvoicedetail_update(0);
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
                $('#salesinvoice-detail-input').form('load', row);
                $.get(base_url + 'salesinvoice/get_sales_order_detail_ots/' + row.id + '/' + row.salesorderdetailid, function (data) {
                    $('#si_temp_ots').val(data);
                });
            }
        });
        url = base_url + 'salesinvoice/update_detail/' + row.id;
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function salesinvoicedetail_edit_f_e() {
    var row = $('#list_item_invoice').datagrid('getSelected');
    if (row !== null) {
        var row_invoice = $('#salesinvoice').datagrid('getSelected');
        $('#si_dialog').dialog({
            title: 'Edit Detail',
            width: 450,
            top: 100,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'salesinvoice/edit_detail/' + row.id + '/' + row.salesorderdetailid + '/' + row_invoice.customerid,
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        salesinvoicedetail_update(1);
                    }
                },
                {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#si_dialog').dialog('close');
                    }
                }
            ],
            onLoad: function () {
                $('#salesinvoice-detail-input').form('load', row);
                $.get(base_url + 'salesinvoice/get_sales_order_detail_ots/' + row.id + '/' + row.salesorderdetailid, function (data) {
                    $('#si_temp_ots').val(data);
                });
            }
        });
        url = base_url + 'salesinvoice/update_detail/' + row.id;
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function salesinvoicedetail_update(flag) {
    if ($('#salesinvoice-detail-input').form('validate')) {
        $.post(url, $('#salesinvoice-detail-input').serializeObject(), function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#salesinvoicedetail').datagrid('reload');
                $('#salesinvoice').datagrid('reload');
                if (flag == 0) {
                    $('#global_dialog').dialog('close');
                } else {
                    $('#si_dialog').dialog('close');
                    $('#list_item_invoice').datagrid('reload');
                    var n_row = $('#salesinvoice').datagrid('getSelected');
                    load_total(n_row.id)
                }
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    }
}

function salesinvoicedetail_delete() {
    var row = $('#salesinvoicedetail').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'salesinvoice/delete_detail', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#salesinvoicedetail').datagrid('reload');
                        $('#salesinvoice').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function salesinvoicedetail_delete_f_e() {
    var row = $('#list_item_invoice').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'salesinvoice/delete_detail', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#salesinvoicedetail').datagrid('reload');
                        $('#salesinvoice').datagrid('reload');
                        $('#list_item_invoice').datagrid('reload');
                        var n_row = $('#salesinvoice').datagrid('getSelected');
                        load_total(n_row.id)
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}