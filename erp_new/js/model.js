/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function model_search_s() {
    $('#model').datagrid('reload', {
        q: $('#model_cat_s').val()
    });
}
function model_search() {
    //    var code = $('#model_code_s').val();
    //    var name = $('#model_name_s').val();
    //    var description = $('#model_description_s').val();
    $('#model').datagrid('reload', $('#model_search_form').serializeObject());
}

function model_export_to_excel() {
    open_target('POST', base_url + 'model/export_to_excel', $('#model_search_form').serializeObject(), '_blank');
}

function model_add() {
    $('#global_dialog').dialog({
        title: 'New Model',
        width: 600,
        height: 'auto',
        closed: false,
        cache: false,
        top: 50,
        href: base_url + 'model/add',
        modal: true,
        resizable: true,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    model_save()
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $('#model-input').form('clear');
        }
    }).dialog('hcenter');
    url = base_url + 'model/save/0';
}

function model_save() {
    $('#model-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#model').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function model_edit() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Model',
            width: 600,
            height: 'auto',
            closed: false,
            cache: false,
            top: 50,
            href: base_url + 'model/add',
            modal: true,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        model_save()
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#model-input').form('load', row);
            }
        }).dialog('hcenter');
        url = base_url + 'model/save/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose model to edit', 'warning');
    }
}

function model_delete() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'model/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#model').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose model to delete', 'warning');
    }
}

function model_close() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Close Model', 'Selected model will be disabled for production process.<br/>Are you sure?', function (r) {
            if (r) {
                $.post(base_url + 'model/close', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#model').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose model to delete', 'warning');
    }
}

function model_open() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        if (row.bom_generated == 1) {
            $.messager.confirm('Open Model', 'Selected model will available for production process and can not modify.<br/>Are you sure?', function (r) {
                if (r) {
                    $.post(base_url + 'model/open', {
                        id: row.id
                    }, function (result) {
                        if (result.success) {
                            $('#model').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.alert('Action Interupted', 'Please generate BOM to open this model for production', 'warning');
        }
    } else {
        $.messager.alert('Waring', 'Choose model to delete', 'warning');
    }
}

function model_complete() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Complete Model', 'Sign selected model as complete model.<br/>Are you sure?', function (r) {
            if (r) {
                $.post(base_url + 'model/complete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#model').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose model to delete', 'warning');
    }
}

function model_change_image() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#model_change_image-form').dialog('open').dialog('setTitle', 'Change Image');
        url = base_url + 'model/updateimage/' + row.id + '/' + row.images;
        $('#model_change_image-input').form('clear');
    } else {
        $.messager.alert('Waring', 'Choose model to change image', 'warning');
    }
}

function model_update_image() {
    //alert(url);
    $('#model_change_image-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#model_change_image-form').dialog('close');
                $('#model').datagrid('reload');
                if (result.msg_upload !== '') {
                    $.messager.show({
                        title: 'Server Notify',
                        msg: result.msg_upload,
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

function model_dialog_search_list(temp) {
    $('#global_dialog').dialog({
        title: 'Model List',
        width: 800,
        height: 500,
        closed: false,
        cache: false,
        href: base_url + 'model/dialog_search_list/' + temp,
        modal: true,
        resizable: true
    });
}

function model_search_list_do_search() {
    var originalcode = $('#msl_originalcode_s').val();
    var mastercode = $('#msl_mastercode_s').val();
    var code = $('#msl_code_s').val();
    var modelcategorycode = $('#msl_modelcategorycode_s').combogrid('getValue');
    $('#model_search_list').datagrid('reload', {
        originalcode: originalcode,
        mastercode: mastercode,
        code: code,
        modelcategorycode: modelcategorycode
    });
}

function model_search_list_do_set(form) {
    var row = $('#model_search_list').datagrid('getSelected');
    if (row !== null) {
        $("#" + form).form('load', row);
        $('#global_dialog').dialog('close');
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item to Set', 'warning');
    }
}

function model_copy() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Copy Model ' + row.originalcode + ' ' + row.mastercode + ' ' + row.name,
            width: 400,
            height: 200,
            closed: false,
            cache: false,
            href: base_url + 'model/copy/' + row.id,
            modal: true,
            buttons: [{
                    iconCls: 'icon-save',
                    text: 'Save',
                    handler: function () {
                        model_do_copy();
                    }
                }, {
                    iconCls: 'icon-remove',
                    text: 'Close',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }]
        });
    } else {
        $.messager.alert('No Model Selected', 'Please Select Model to Copy', 'warning');
    }
}

function model_do_copy() {
    if ($('#model_copy-input').form('validate')) {
        $.post(base_url + 'model/do_copy',
                $('#model_copy-input').serialize(),
                function (content) {
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#global_dialog').dialog('close');
                        $('#model').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                });
    }

}

function model_generate_bom() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Generate Bill Of Material (BOM) Summary?', function (r) {
            if (r) {
                $.post(base_url + 'model/generate_bom', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#model').datagrid('reload');
                        $.messager.show({
                            title: 'Server Notify',
                            msg: 'Generated BOM Summary Successfull',
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
        $.messager.alert('Waring', 'Choose model to delete', 'warning');
    }
}

function model_view_bom() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Model Material Summary',
            width: 700,
            height: 'auto',
            top: 50,
            closed: false,
            cache: false,
            href: base_url + 'model/view_bom/' + row.id,
            modal: true,
            buttons: [{
                    iconCls: 'icon-remove',
                    text: 'Close',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }]
        });

    } else {
        $.messager.alert('No Model Selected', 'Please Select Model', 'warning');
    }
}

function model_bom_search() {
    $('#view_bom').datagrid('reload', $('#view_bom_search_form').serializeObject())
}

function model_bom_print(modelid) {
    open_target('POST', base_url + 'model/bom_print/' + modelid, $('#view_bom_search_form').serializeObject(), '_blank')
}

function model_detail_layout_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#model_detail_layout-form').dialog('open').dialog('setTitle', 'New Model Layout');
        url = base_url + 'model/detail_layout_save/' + row.id;
        $('#model_detail_layout-input').form('clear');

    } else {
        $.messager.alert('No Model Selected', 'Please Select Model', 'warning');
    }
}

function model_detail_layout_delete() {
    var row = $('#model-detail-layout').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'model/detail_layout_delete', {
                    id: row.id,
                    imagename: row.imagename
                }, function (result) {
                    if (result.success) {
                        $('#model-detail-layout').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Image Selected', 'Please Select Image', 'warning');
    }
}

function model_detail_layout_save() {
    $('#model_detail_layout-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#model_detail_layout-form').dialog('close');
                $('#model-detail-layout').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}


function model_stock_edit() {
    var row = $('#model_stock').datagrid('getSelected');
    if (row !== null) {
        $('#model_stock-form').dialog('open').dialog('setTitle', 'Edit Model Stock');
        $('#model_stock-input').form('load', row);
        url = base_url + 'modelstock/update_model_stock/' + row.id;
    } else {
        $.messager.alert('No Model Selected', 'Please Select Model', 'warning');
    }
}

function model_stock_save() {
    $('#model_stock-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#model_stock-form').dialog('close');
                $('#model_stock').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function model_process_stock_edit() {
    var row = $('#model_process_stock').datagrid('getSelected');
    if (row !== null) {
        $('#model_process_stock-form').dialog('open').dialog('setTitle', 'Edit Model Process Stock');
        $('#model_process_stock-input').form('load', row);
        url = base_url + 'modelstock/update_model_process_stock/' + row.id;
    } else {
        $.messager.alert('No Model Process', 'Please Select Process', 'warning');
    }
}

function model_process_stock_save() {
    $('#model_process_stock-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#model_process_stock-form').dialog('close');
                $('#model_process_stock').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}


function model_stock_search() {
    $('#model_stock').datagrid('reload', $('#model_stock_form_search').serializeObject());
}


function model_stock_view_process() {
    var row = $('#model_stock').datagrid('getSelected');
    $('#model_process_stock').datagrid('reload', {
        modelid: row.id
    });
}

function model_process_stock_search() {
    $('#model_process_stock').datagrid('reload', $('#model_process_stock_search').serializeObject());
}

function model_create_stock_out() {
    $('#global_dialog').dialog({
        title: 'Create Stock Out',
        width: 450,
        height: 'auto',
        resizable: true,
        closed: false,
        top: 100,
        cache: false,
        href: base_url + 'modelprocess/create_stock_out',
        modal: true,
        buttons: [{
                iconCls: 'icon-save',
                text: 'Save',
                handler: function () {
                    model_save_stock_out();
                }
            }, {
                iconCls: 'icon-remove',
                text: 'Close',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
        onLoad: function () {
            $('#create_stock_out_form').form('clear');
        }
    }).dialog('hcenter');
    url = base_url + 'modelprocess/save_stock_out/0';
}

function model_save_stock_out() {
    if ($('#create_stock_out_form').form('validate')) {
        $.post(url, $('#create_stock_out_form').serializeObject(), function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#modelprocess_stock_out').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    }
}


function model_delete_stock_out() {
    var row = $('#modelprocess_stock_out').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'modelprocess/delete_stock_out', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#modelprocess_stock_out').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Data Selected', 'Please Select Row', 'warning');
    }
}

function model_edit_stock_out() {

    var row = $('#modelprocess_stock_out').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Stock Out',
            width: 450,
            height: 'auto',
            resizable: true,
            closed: false,
            top: 100,
            cache: false,
            href: base_url + 'modelprocess/create_stock_out',
            modal: true,
            buttons: [{
                    iconCls: 'icon-save',
                    text: 'Save',
                    handler: function () {
                        model_save_stock_out();
                    }
                }, {
                    iconCls: 'icon-remove',
                    text: 'Close',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#create_stock_out_proessid_').combobox('reload', base_url + 'modelprocess/get_for_combo/' + row.modelid);
                $('#create_stock_out_form').form('load', row);
            }
        }).dialog('hcenter');
        url = base_url + 'modelprocess/save_stock_out/' + row.id;
    } else {
        $.messager.alert('No Data Selected', 'Please Select Row', 'warning');
    }
}

function model_print() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        open_target('POST', base_url + 'model/prints', {
            id: row.id
        }, '_blank');
    } else {
        $.messager.alert('No Model Selected', 'Please Select Model', 'warning');
    }
}


function model_search_stock50() {
    $('#model_stock50').datagrid('reload', $('#model_stock50_search_form').serializeObject());
}


function model_print_stock50() {
    open_target('POST', base_url + 'model/print_stock50', $('#model_stock50_search_form').serializeObject(), '_blank');
}

function model_add_stock50() {
    $('#global_dialog').dialog({
        title: 'Add New Stock',
        width: 300,
        height: 'auto',
        resizable: false,
        closed: false,
        top: 100,
        cache: false,
        href: base_url + 'model/add_stock50',
        modal: true,
        buttons: [{
                iconCls: 'icon-save',
                text: 'Save',
                handler: function () {
                    if ($('#model_add_stock50_input').form('validate')) {
                        $.post(base_url + 'model/save_stock50', $('#model_add_stock50_input').serializeObject(), function (content) {
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $('#global_dialog').dialog('close');
                                $('#model_stock50').datagrid('reload');
                            } else {
                                $.messager.alert('Error', result.msg, 'error');
                            }
                        });
                    }
                }
            }, {
                iconCls: 'icon-remove',
                text: 'Close',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }]
    }).dialog('hcenter');
}

function model_delete_stock50() {
    var row = $('#model_stock50').datagrid('getSelected');
    if (row !== null) {
        if (row.joborderid == 0) {
            $.messager.confirm('Confirm', 'Are you sure?', function (r) {
                if (r) {
                    $.post(base_url + 'model/delete_stock50', {
                        id: row.id
                    }, function (result) {
                        if (result.success) {
                            $('#model_stock50').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            $.messager.confirm('Confirm', 'This stock from Job Order.<br/>Production will continue for this item.<br/><b>Are you sure?</b>', function (r) {
                if (r) {
                    $.post(base_url + 'model/remove_stock50', {
                        id: row.id
                    }, function (result) {
                        if (result.success) {
                            $('#model_stock50').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        }
    } else {
        $.messager.alert('Waring', 'Choose model to delete', 'warning');
    }
}

function load_model_part(part) {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#' + part).treegrid('load', {
            modelid: row.id
        });
    }
}
