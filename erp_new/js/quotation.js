/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function quotation_search2() {
    $('#quotation').datagrid('reload', $('#quotation_form_search2').serializeObject());
}

function quotation_add() {
    $('#global_dialog').dialog({
        title: 'New Quotation',
        width: 400,
        height: 'auto',
        closed: false,
        cache: false,
        href: base_url + 'quotation/input',
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    $('#quotation-input').form('submit', {
                        url: base_url + 'quotation/save/0',
                        onSubmit: function () {
                            return $(this).form('validate');
                        },
                        success: function (content) {
                            //            alert(content);
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $('#global_dialog').dialog('close');
                                $('#quotation').datagrid('reload');
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
            $('#quotation-input').form('clear');
            $('#quo_notes').val('The prices are ex warehouse');
        }
    });
}

function quotation_edit() {
    var row = $('#quotation').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Quotation',
            width: 400,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'quotation/input',
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#quotation-input').form('submit', {
                            url: base_url + 'quotation/save/' + row.id,
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                //            alert(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#quotation').datagrid('reload');
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
                $('#quotation-input').form('load', row);
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Quotation to Edit', 'warning');
    }
}
function quotation_delete() {
    var row = $('#quotation').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'quotation/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#quotation').datagrid('reload');
                        $('#quotationdetail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Quotation to Delete', 'warning');
    }
}

function quotation_detail_search() {
    var row = $('#quotation').datagrid('getSelected');
    $('#quotationdetail').datagrid('reload', {
        quotationid: row.id,
        itemcode: $('#quotationdetail_search_itemcode').val(),
        itemdescription: $('#quotationdetail_search_itemdescription').val()
    });
}

function quotation_detail_add() {
    var row = $('#quotation').datagrid('getSelected');
    if (row != null) {
        $('#global_dialog').dialog({
            title: 'Add Item',
            width: 400,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'quotation/detail_add',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#quotationdetail-input').form('validate')) {
                            $.post(base_url + 'quotation/detail_save/' + row.id + '/0', $('#quotationdetail-input').serializeObject(), function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#quotationdetail').datagrid('reload');
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
                $('#quotationdetail-input').form('clear');
            }
        });
    } else {
        $.messager.alert('No Quotation Selected', 'Please Select Quotation', 'warning');
    }
}

function quotation_detail_add_others() {
    var row = $('#quotation').datagrid('getSelected');
    if (row != null) {
        $('#global_dialog').dialog({
            title: 'Add Others Item',
            width: 400,
            height: 'auto',
            closed: false,
            cache: false,
            href: base_url + 'quotation/detail_add_others',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#quotationdetail-input').form('validate')) {
                            $('#quotationdetail-input').form('submit', {
                                url: base_url + 'quotation/detail_save_others/' + row.id + '/0',
                                onSubmit: function () {
                                    return $(this).form('validate');
                                },
                                success: function (content) {
                                    alert(content);
                                    var result = eval('(' + content + ')');
                                    if (result.success) {
                                        $('#global_dialog').dialog('close');
                                        $('#quotationdetail').datagrid('reload');
                                    } else {
                                        $.messager.alert('Error', result.msg, 'error');
                                    }
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
                $('#quotationdetail-input').form('clear');
            }
        });
    } else {
        $.messager.alert('No Quotation Selected', 'Please Select Quotation', 'warning');
    }
}

function quotationdetail_save() {
    $('#quotationdetail-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#quotationdetail-form').dialog('close');
                $('#quotationdetail').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function quotation_detail_edit() {
    var row = $('#quotationdetail').datagrid('getSelected');
    if (row != null) {
        if (row.modelid == '0') {
            $('#global_dialog').dialog({
                title: 'Add Others Item',
                width: 400,
                height: 'auto',
                closed: false,
                cache: false,
                href: base_url + 'quotation/detail_add_others',
                modal: true,
                resizable: true,
                buttons: [{
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            if ($('#quotationdetail-input').form('validate')) {
                                $('#quotationdetail-input').form('submit', {
                                    url: base_url + 'quotation/detail_save_others/0/' + row.id + '/' + row.images,
                                    onSubmit: function () {
                                        return $(this).form('validate');
                                    },
                                    success: function (content) {
                                        alert(content);
                                        var result = eval('(' + content + ')');
                                        if (result.success) {
                                            $('#global_dialog').dialog('close');
                                            $('#quotationdetail').datagrid('reload');
                                        } else {
                                            $.messager.alert('Error', result.msg, 'error');
                                        }
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
                    $('#quotationdetail-input').form('load', row);
                }
            });
        } else {
            $('#global_dialog').dialog({
                title: 'Edit Item',
                width: 400,
                closed: false,
                cache: false,
                href: base_url + 'quotation/detail_add/' + row.goodsreceiveid,
                modal: true,
                resizable: true,
                buttons: [{
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            if ($('#quotationdetail-input').form('validate')) {
                                $.post(base_url + 'quotation/detail_save/0/' + row.id, $('#quotationdetail-input').serializeObject(), function (content) {
                                    var result = eval('(' + content + ')');
                                    if (result.success) {
                                        $('#global_dialog').dialog('close');
                                        $('#quotationdetail').datagrid('reload');
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
                            $(this).dialog('center');
                            $('#global_dialog').dialog('close');
                        }
                    }],
                onLoad: function () {
                    $('#quotationdetail-input').form('load', row);
                }
            });
        }
    } else {
        $.messager.alert('Waring', 'Choose Item to Edit', 'warning');
    }
}

function quotation_detail_delete() {
    var row = $('#quotationdetail').datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'quotation/detail_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#quotationdetail').datagrid('reload');
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

function quotation_print(type) {
    var row = $('#quotation').datagrid('getSelected');
    if (row != null) {
        open_target('POST', base_url + 'quotation/prints', {
            id: row.id,
            type: type
        }, '_blank')
    } else {
        $.messager.alert('Waring', 'Choose Quotation', 'warning');
    }
}