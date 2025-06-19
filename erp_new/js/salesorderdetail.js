/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function salesorderdetail_search() {
    var row = $('#salesorder').datagrid('getSelected');
    var code = $('#salesorderdetail_code_s').val();
    var name = $('#salesorderdetail_name_s').val();
    var salesorderid = 0;
    if (row !== null) {
        salesorderid = row.id;
    }

    $('#salesorderdetail').datagrid('reload', {
        salesorderid: salesorderid,
        code: code,
        name: name
    });
}

function salesorderdetail_add() {
    var row = $('#salesorder').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'New Sales Order Item',
            width: 400,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'salesorder/detail_input',
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#salesorderdetail-input').form('submit', {
                            url: base_url + 'salesorder/detail_save/' + row.id,
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                //            alert(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#salesorderdetail').datagrid('reload');
                                    $('#salesorder').datagrid('reload');
                                } else {
                                    $.messager.alert('Error', result.msg, 'error');
                                }
                            }
                        });
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-close',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                $('#salesorderdetail-input').form('clear');
            }
        });
    } else {
        $.messager.alert('No Sales Order Selected', 'Please Select Sales Order', 'warning');
    }
}

function salesorderdetail_edit() {
    var row = $('#salesorderdetail').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Sales Order Item',
            width: 400,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'salesorder/detail_input',
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#salesorderdetail-input').form('submit', {
                            url: base_url + 'salesorder/detail_update/' + row.id,
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                //            alert(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#salesorderdetail').datagrid('reload');
                                    $('#salesorder').datagrid('reload');
                                } else {
                                    $.messager.alert('Error', result.msg, 'error');
                                }
                            }
                        });
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-close',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
                $('#salesorderdetail-input').form('load', row);
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Item to edit', 'warning');
    }
}

function salesorderdetail_delete() {
    var row = $('#salesorderdetail').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'salesorder/detail_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#salesorderdetail').datagrid('reload');
                        $('#salesorder').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose salesorderdetail to delete', 'warning');
    }
}

function salesorderdetail_edit_finishing() {
    var row = $('#salesorderdetail').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Finishing',
            width: 500,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'salesorder/detail_edit_finishing/' + row.id,
            modal: true,
            resizable: true,
            top: 50,
            border: false,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        salesorderdetail_save_finishing();
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
        url = base_url + 'salesorder/detail_update_finishing';
    } else {
        $.messager.alert('No SO Detail Selected', 'Please Select SO Detail', 'warning');
    }
}

function salesorderdetail_save_finishing() {
    if (index_seen_face != undefined) {
        var ed_seen_face = $('#salesorderdetail_model_finishing_seen').datagrid('getEditor', {
            index: index_seen_face,
            field: 'finishingtypeid'
        });
        if (ed_seen_face !== null) {
            var finishingtypename = $(ed_seen_face.target).combobox('getText');
            $('#salesorderdetail_model_finishing_seen').datagrid('getRows')[index_seen_face]['finishingtypename'] = finishingtypename;
        }
        $('#salesorderdetail_model_finishing_seen').datagrid('endEdit', index_seen_face);
        index_seen_face = undefined;
    }

    if (index_top != undefined) {
        var ed_top = $('#salesorderdetail_model_finishing_top').datagrid('getEditor', {
            index: index_top,
            field: 'finishingtypeid'
        });
        if (ed_top !== null) {
            var finishingtypename_top = $(ed_top.target).combobox('getText');
            $('#salesorderdetail_model_finishing_top').datagrid('getRows')[index_top]['finishingtypename'] = finishingtypename_top;
        }
        $('#salesorderdetail_model_finishing_top').datagrid('endEdit', index_top);
        index_top = undefined;
    }


    if (index_unseen_face != undefined) {
        var ed_unseen_face = $('#salesorderdetail_model_finishing_unseen').datagrid('getEditor', {
            index: index_unseen_face,
            field: 'finishingtypeid'
        });
        if (ed_unseen_face !== null) {
            var finishingtypename_unseen_face = $(ed_unseen_face.target).combobox('getText');
            $('#salesorderdetail_model_finishing_unseen').datagrid('getRows')[index_unseen_face]['finishingtypename'] = finishingtypename_unseen_face;
        }
        $('#salesorderdetail_model_finishing_unseen').datagrid('endEdit', index_unseen_face);
        index_unseen_face = undefined;
    }


    var row_seen = $('#salesorderdetail_model_finishing_seen').datagrid('getChanges');
    var row_top = $('#salesorderdetail_model_finishing_top').datagrid('getChanges');
    var row_unseen = $('#salesorderdetail_model_finishing_unseen').datagrid('getChanges');

    var arr_seen = new Array();
    var arr_top = new Array();
    var arr_unseen = new Array();

    var i = 0;
    if (row_seen.length > 0) {
        for (i = 0; i < row_seen.length; i++) {
            arr_seen.push(row_seen[i].id + '#' + row_seen[i].finishingtypeid);
        }
    }
    if (row_top.length > 0) {
        for (i = 0; i < row_top.length; i++) {
            arr_top.push(row_top[i].id + '#' + row_top[i].finishingtypeid);
        }
    }
    if (row_unseen.length > 0) {
        for (i = 0; i < row_unseen.length; i++) {
            arr_unseen.push(row_unseen[i].id + '#' + row_unseen[i].finishingtypeid);
        }
    }
    if (arr_seen.length > 0 || arr_top.length > 0 || arr_unseen.length > 0) {
        $.post(url, {
            seen: arr_seen,
            top: arr_top,
            unseen: arr_unseen
        }, function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#salesorderdetail_model_finishing_seen').datagrid('reload');
                $('#salesorderdetail_model_finishing_top').datagrid('reload');
                $('#salesorderdetail_model_finishing_unseen').datagrid('reload');
                $.messager.show({
                    title: 'Notification',
                    msg: 'Update Finishing Successfull..!',
                    showType: 'show'
                });
            } else {
                $.messager.alert('Error', result.msg, 'error');
                $('#salesorderdetail_model_finishing_seen').datagrid('reload');
                $('#salesorderdetail_model_finishing_top').datagrid('reload');
                $('#salesorderdetail_model_finishing_unseen').datagrid('reload');
            }
        });
    } else {
        $.messager.alert('Nothing to Save', "No Data to Save", 'warning');
    }
}

function salesorderdetail_upholstry() {
    var row = $('#salesorderdetail').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Upholstry',
            width: 800,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'salesorder/detail_upholstry/' + row.id + '/' + row.modelid,
            modal: true,
            resizable: true,
            top: 50,
            border: false,
            buttons: [{
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }]
        });
    } else {
        $.messager.alert('No SO Detail Selected', 'Please Select SO Detail', 'warning');
    }
}

function sod_edit_upholstry() {
    var row = $('#sod_upholstry').datagrid('getSelected');
    if (row !== null) {
        $('#sod_upholstry_temp').dialog({
            title: 'Select Material',
            width: 400,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'salesorder/detail_edit_upholstry',
            modal: true,
            resizable: true,
            top: 50,
            border: false,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#sod_upholstry-input').form('validate')) {
                            $.post(base_url + 'salesorder/detail_update_upholstry/' + $('#sod_detailid56').val() + '/' + row.modelid + '/' + row.upholstryid,
                                    $('#sod_upholstry-input').serializeObject(), function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#sod_upholstry').datagrid('reload');
                                    $('#sod_upholstry_temp').dialog('close');
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
                        $('#sod_upholstry_temp').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog('center');
            }
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function sod_delete_upholstry() {
    var row = $('#sod_upholstry').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove update?', function (r) {
            if (r) {
                $.post(base_url + 'salesorder/detail_delete_upholstry/', {
                    salesorderdetailid: $('#sod_detailid56').val(),
                    modelid: row.modelid,
                    upholstryid: row.upholstryid
                }, function (result) {
                    if (result.success) {
                        $('#sod_upholstry').datagrid('reload');
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

function sod_permanent_delete_upholstry() {
    var row = $('#sod_upholstry').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove material?', function (r) {
            if (r) {
                $.post(base_url + 'salesorder/permanent_delete_upholstry/', {
                    salesorderdetailid: $('#sod_detailid56').val(),
                    modelid: row.modelid,
                    upholstryid: row.upholstryid,
                    itemid: row.upholstry_itemid,
                    unitcode: row.unitcode
                }, function (result) {
                    if (result.success) {
                        $('#sod_upholstry').datagrid('reload');
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



function salesorderdetail_edit_specification() {
    var row = $('#salesorderdetail').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Specification',
            width: 600,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'salesorder/detail_edit_specification/' + row.id,
            modal: true,
            resizable: true,
            top: 50,
            border: false,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $.post(base_url + 'salesorder/detail_update_specification/' + row.id,
                                $('#salesorderdetail_edit_specification_item').serializeObject(),
                                function (content) {
                                    console.log(content);
                                    var result = eval('(' + content + ')');
                                    if (result.success) {
                                        $('#salesorderdetail').datagrid('reload');
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
                }],
            onLoad: function () {
                $(this).dialog('center');
                $('#salesorderdetail_edit_specification_item').form('load', row);
            }
        });
        url = base_url + 'salesorder/save_specification/' + row.id;
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function salesorderdetail_preview_detail() {
    var row = $('#salesorder').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Preview Detail Item',
            width: 1200,
            height: 600,
            closed: false,
            cache: false,
            href: base_url + 'salesorder/detail_preview/' + row.id + '/preview',
            buttons: [{
                    text: 'Print',
                    iconCls: 'icon-print',
                    handler: function () {
                        open_target('GET', base_url + 'salesorder/detail_preview/' + row.id + '/print', {}, '_blank')
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-close',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }]
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function sod_restore_upholstry() {
    $.messager.confirm('Confirm', 'Are you sure you want to remove material?', function (r) {
        if (r) {
            $.post(base_url + 'salesorder/restore_upholstry/', {
                salesorderdetailid: $('#sod_detailid56').val()
            }, function (result) {
                if (result.success) {
                    $('#sod_upholstry').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }, 'json');
        }
    });
}
