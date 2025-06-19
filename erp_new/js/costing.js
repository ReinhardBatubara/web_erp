/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var g_costingid = 0;

function costing_search() {
    $('#costing').datagrid('reload', $('#costing_search_form1').serializeObject());
}

function costing_product_price_list_search() {
    $('#product_price_list').datagrid('load', $('#product_price_list_search_form').serializeObject());
}

function costingdetail_search() {
    var costingmaterialgroupid = $('#costingdetail_costingmaterialgroupid_s').combobox('getValue');
    var row = $('#costing').datagrid('getSelected');
    if (row != null) {
        $('#costingdetail').datagrid('reload', {
            costingid: row.id,
            costingmaterialgroupid: costingmaterialgroupid
        });
    }
}

function costing_add() {
    $('#costing-form').dialog('open').dialog('setTitle', 'New Costing');
    $('#modelid').parent().parent().show();
    $('#costing-fileupload').parent().parent().show();
    $('#costing-input').form('clear');
    url = base_url + 'costing/save/0';
}


function costing_save() {
    $('#costing-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                if (result.msg !== '') {
                    $.messager.show({
                        title: 'Warning',
                        msg: result.msg,
                        timeout: 4000,
                        showType: 'slide'
                    });
                }
                $('#costing-form').dialog('close');
                $('#costing').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function costing_edit() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        $('#costing-form').dialog('open').dialog('setTitle', 'Edit Costing');
        $('#modelid').parent().parent().hide();
        $('#costing-fileupload').parent().parent().hide();
        $('#costing-input').form('load', row);
        url = base_url + 'costing/save/' + row.id;
    } else {
        $.messager.alert('No Costing Selected', 'Please Select Costing', 'warning');
    }
}

function costing_print() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        open_target('POST', base_url + 'costing/prints', {
            id: row.id
        }, '_blank')
    } else {
        $.messager.alert('No Costing Selected', 'Please Select Costing', 'warning');
    }
}

function costing_model_print() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        open_target('POST', base_url + 'model/prints', {
            id: row.modelid
        }, '_blank');
    } else {
        $.messager.alert('No Costing Selected', 'Please Costing Model', 'warning');
    }
}

function costing_rawmaterial_print() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        open_target('POST', base_url + 'costing/rawmaterial_prints', {
            id: row.id
        }, '_blank');
    } else {
        $.messager.alert('No Costing Selected', 'Please Costing Model', 'warning');
    }
}

function costing_delete() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'costing/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#costing').datagrid('reload');
                        $('#costing').datagrid('selectRow', 0);
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Costing Selected', 'Please Select Costing', 'warning');
    }
}

function costingdetail_save() {
    $('#costingdetail').datagrid('endEdit', temp_index);
    var rows = $('#costingdetail').datagrid('getChanges');
    if (rows.length !== 0) {
        var arr_id = new Array();
        var arr_yield = new Array();
        var arr_cost = new Array();

        for (var i = 0; i < rows.length; i++) {
            arr_id[i] = rows[i].id;
            arr_yield[i] = rows[i].yield;
            arr_cost[i] = rows[i].cost;
        }

        $.post(base_url + 'costing/detail_save', {
            id: arr_id,
            yield: arr_yield,
            cost: arr_cost
        }, function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                var row = $('#costing').datagrid('getSelected');
                var costing_index = $('#costing').datagrid('getRowIndex', row.id);
                $('#costing').datagrid('reload');
                $('#costing').datagrid('selectRow', costing_index);
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    } else {
        $.messager.alert('Warning', 'Nothing to save', 'warning');
    }
}

function costing_calculate() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure?', function (r) {
            if (r) {
                $.post(base_url + 'costing/calculate', {
                    costingid: row.id
                }, function (result) {
                    if (result.success) {
                        $('#costing').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Costing Selected', 'Please Select Costing', 'warning');
    }
}

function costingdetail_load_price() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        $('#costingdetail').datagrid({
            url: base_url + 'costing/detail_load_price',
            queryParams: {
                costingid: row.id
            }
        });
        g_costingid = row.id;
        $('#costingdetail-load-price').hide();
        $('#costingdetail-save-loaded-price').show();
        $('#costingdetail-cancel-save-loaded-price').show();
    } else {
        $.messager.alert('No Costing Selected', 'Please Select Costing', 'warning');
    }
}

function costingdetail_cancel_save_load_price() {
    var row = $('#costing').datagrid('getSelected');
    var costing_index = $('#costing').datagrid('getRowIndex', row.id);
    $('#costing').datagrid('reload');
    $('#costing').datagrid('selectRow', costing_index);
    $('#costingdetail-load-price').show();
    $('#costingdetail-save-loaded-price').hide();
    $('#costingdetail-cancel-save-loaded-price').hide();
}

function costingdetail_save_load_price() {
    var rows = $('#costingdetail').datagrid('getRows');

    var arr_id = new Array();
    for (var i = 0; i < rows.length; i++) {
        if (rows[i].remark !== null && rows[i].remark !== '' && parseInt(rows[i].id) > 0) {
            arr_id.push(rows[i].id);
        }
    }
    if (arr_id.length > 0) {
        $.messager.confirm('Confirm', 'Are you sure?', function (r) {
            if (r) {
                $.post(base_url + 'costing/detail_save_load_price', {
                    id: arr_id
                }, function (content) {
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        costingdetail_cancel_save_load_price();
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                });
            }
        });
    } else {
        $.messager.alert('Update Price', 'No Item Price Change', 'warning');
    }
}

function costing_change_image() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        $('#costing_change_image-form').dialog('open').dialog('setTitle', 'Change Image');
        $('#costing_change_fileupload').val('');
        url = base_url + 'costing/updateimage/' + row.id + '/' + row.imagename;
    } else {
        $.messager.alert('Waring', 'Choose costing to change image', 'warning');
    }
}

function costing_update_image() {
    $('#costing_change_image-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#costing_change_image-form').dialog('close');
                var row = $('#costing').datagrid('getSelected');
                var costing_index = $('#costing').datagrid('getRowIndex', row.id);
                $('#costing').datagrid('reload');
                $('#costing').datagrid('selectRow', costing_index);
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function costingdetail_move(costingmaterialgroupid) {
    var row = $('#costingdetail').datagrid('getSelected');
    if (row !== null) {
        var id = parseInt(row.id);
        if (id > 0) {
            $.messager.confirm('Confirm', 'Are you sure?', function (r) {
                if (r) {
                    $.post(base_url + 'costing/detail_move', {
                        costingmaterialgroupid: costingmaterialgroupid,
                        id: row.id
                    }, function (content) {
                        var result = eval('(' + content + ')');
                        if (result.success) {
                            $('#costingdetail').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    });
                }
            });
        } else {
            $.messager.alert('No Allowed', 'Not allowed to move sub total', 'warning');
        }
    } else {
        $.messager.alert('No Material Selected', 'Please Select Material', 'warning');
    }
}

function costingdetail_add_material() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        $('#costingmaterial-form').dialog('open').dialog('setTitle', 'New Material');
        $('#costingmaterial-input').form('clear');
        $('#costingmaterial-costingid').val(row.id);
        $('#costingmaterial-modelid').val(row.modelid);
        url = base_url + 'costing/detail_save_material/0';
    } else {
        $.messager.alert('No Costing Selected', 'Please Select Costing', 'warning');
    }
}

function costingdetail_edit_material() {
    var row = $('#costingdetail').datagrid('getSelected');
    if (row != null) {
        if (row.model_material_summary_id == 0) {
            if (row.special_material == 't') {
                $('#global_dialog').dialog({
                    title: 'Edit Special Material',
                    width: 460,
                    height: 'auto',
                    href: base_url + 'costing/add_special_material',
                    modal: false,
                    resizable: true,
                    buttons: [{
                            text: 'Save',
                            iconCls: 'icon-save',
                            handler: function () {
                                if ($('#costingmaterial_special_material_input').form('validate')) {
                                    $.post(base_url + 'costing/save_special_material/' + row.id + '/' + row.modelid + '/' + row.id, $('#costingmaterial_special_material_input').serializeObject(), function (content) {
                                        var result = eval('(' + content + ')');
                                        if (result.success) {
                                            $('#costingmaterial_special_material_input').form('clear')
                                            $('#global_dialog').dialog('close');
                                            var row = $('#costing').datagrid('getSelected');
                                            var costing_index = $('#costing').datagrid('getRowIndex', row.id);
                                            $('#costing').datagrid('reload');
                                            $('#costing').datagrid('selectRow', costing_index);
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
                        $('#costingmaterial_special_material_input').form('load', row);
                        $('#costingmaterialitemcode').val(row.itemcode);
                        $('#costingmaterialmaterialdescription').val(row.itemname);
                    }
                });
            } else {
                $('#costingmaterial-form').dialog('open').dialog('setTitle', 'New Material');
                $('#costingmaterial-input').form('load', row);
                $('#costingmaterialitemcode').val(row.itemcode);
                $('#costingmaterialmaterialdescription').val(row.itemname);
                $('#costingmaterialitemid').val(row.itemid);
                url = base_url + 'costing/detail_save_material/' + row.id;
            }
        } else {
            $.messager.alert('Action Interupted', 'Unable to edit material reference from Model ', 'error');
        }
    } else {
        $.messager.alert('No Material Selected', 'Please Select Material', 'warning');
    }
}

function costingdetail_add_special_material() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Add Special Material',
            width: 460,
            height: 'auto',
            href: base_url + 'costing/add_special_material',
            modal: false,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#costingmaterial_special_material_input').form('validate')) {
                            $.post(base_url + 'costing/save_special_material/' + row.id + '/' + row.modelid + '/0', $('#costingmaterial_special_material_input').serializeObject(), function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#costingmaterial_special_material_input').form('clear')
                                    $('#global_dialog').dialog('close');
                                    var row = $('#costing').datagrid('getSelected');
                                    var costing_index = $('#costing').datagrid('getRowIndex', row.id);
                                    $('#costing').datagrid('reload');
                                    $('#costing').datagrid('selectRow', costing_index);
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
                $('#costingmaterial_special_material_input').form('clear');
            }
        });
    } else {
        $.messager.alert('No Costing Selected', 'Please Select Costing', 'warning');
    }
}

function costingmaterial_save_material() {
    $('#costingmaterial-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#costingmaterial-form').dialog('close');
                var row = $('#costing').datagrid('getSelected');
                var costing_index = $('#costing').datagrid('getRowIndex', row.id);
                $('#costing').datagrid('reload');
                $('#costing').datagrid('selectRow', costing_index);
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function costingdetail_remove_material() {
    var row = $('#costingdetail').datagrid('getSelected');
    if (row !== null) {
        var id = parseInt(row.id);
        if (id > 0) {
            $.messager.confirm('Confirm', 'Are you sure you want to remove this data??', function (r) {
                if (r) {
                    $.post(base_url + 'costing/detail_remove_material', {
                        id: row.id
                    }, function (content) {
                        var result = eval('(' + content + ')');
                        if (result.success) {
                            var row = $('#costing').datagrid('getSelected');
                            var costing_index = $('#costing').datagrid('getRowIndex', row.id);
                            $('#costing').datagrid('reload');
                            $('#costing').datagrid('selectRow', costing_index);
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    });
                }
            });
        } else {
            $.messager.alert('No Allowed', 'Not allowed to delete sub total', 'warning');
        }
    } else {
        $.messager.alert('No Material Selected', 'Please Select Material', 'warning');
    }
}


function costing_approve() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Final Selling Price',
            width: 400,
            height: 'auto',
            href: base_url + 'costing/approve/' + row.id,
            modal: false,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#costing_final_price-input').form('submit', {
                            url: base_url + 'costing/do_approve/' + row.id,
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                //                            alert(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#costing').datagrid('reload');
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
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $(this).dialog("center");
            }
        });
    } else {
        $.messager.alert('No Material Selected', 'Please Select Material', 'warning');
    }
}

function costing_set_to_model() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Define selected costing to model',
            width: 400,
            height: 'auto',
            href: base_url + 'costing/set_to_model',
            modal: false,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#costing_set_to_model-input').form('validate')) {
                            $.post(base_url + 'costing/do_set_to_model',
                                    $('#costing_set_to_model-input').serializeObject()
                                    , function (content) {
                                        var result = eval('(' + content + ')');
                                        if (result.success) {
                                            $('#global_dialog').dialog('close');
                                            $('#costing').datagrid('reload');
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
                $('#costing_set_to_model-input').form('load', row);
                $('#set_to_model_modelid').combogrid('clear');
                $('#set_to_model_costing_id').val(row.id);
                $('#set_to_model_date').datebox('clear');
            }
        });
    } else {
        $.messager.alert('No Material Selected', 'Please Select Material', 'warning');
    }
}

function costingdetail_copy_from() {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Copy From',
            width: 300,
            height: 'auto',
            href: base_url + 'costing/detail_copy_from/' + row.id + '/' + row.modelid,
            modal: false,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#detail_copy_from').form('validate')) {
                            $.post(base_url + 'costing/do_detail_copy_from', $('#detail_copy_from').serializeObject(), function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#costing').datagrid('reload');
                                    $('#costingdetail').datagrid('reload');
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
                }]
        });
    } else {
        $.messager.alert('No Costing Selected', 'Please Select Costing', 'warning');
    }
}

function costing_add_raw_material(rawcategoryid, rawtypeid, idgrid) {
    var row = $('#costing').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Add Raw Material',
            width: 300,
            href: base_url + 'costing/add_raw_material/' + row.id + '/' + rawcategoryid + '/' + rawtypeid,
            modal: false,
            resizable: true,
            height: 'auto',
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#add_raw_material').form('validate')) {
                            $.post(base_url + 'costing/save_raw_material/' + row.id + '/' + rawcategoryid + '/' + rawtypeid + '/0', $('#add_raw_material').serializeObject(), function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#' + idgrid).datagrid('load');
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
                $('#add_raw_material').form('clear')
            }
        });
    } else {
        $.messager.alert('No Costing Selected', 'Please Select Costing', 'warning');
    }
}

function costing_edit_raw_material(idgrid) {
    var row = $('#' + idgrid).datagrid('getSelected');
    if (row != null) {
        $('#global_dialog').dialog({
            title: 'Edit Raw Material',
            width: 300,
            href: base_url + 'costing/add_raw_material/' + row.costingid + '/' + row.rawcategoryid + '/' + row.rawtypeid,
            modal: false,
            resizable: true,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#add_raw_material').form('validate')) {
                            $.post(base_url + 'costing/save_raw_material/' + row.costingid + '/' + row.rawcategoryid + '/' + row.rawtypeid + '/' + row.id, $('#add_raw_material').serializeObject(), function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#' + idgrid).datagrid('load');
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
                $('#add_raw_material').form('load', row);
            }
        });
    } else {
        $.messager.alert('No Data Selected', 'Please Select Data', 'warning');
    }
}

function costing_product_price_list_edit() {
    var row = $('#product_price_list').datagrid('getSelected');
    if (row != null) {
        $('#global_dialog').dialog({
            title: 'Edit Product Price',
            width: 400,
            href: base_url + 'costing/product_price_list_edit',
            modal: true,
            resizable: true,
            height: 'auto',
            top: 100,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        if ($('#product_price_list-input').form('validate')) {
                            $.post(base_url + 'costing/product_price_list_update/' + row.id, $('#product_price_list-input').serializeObject(), function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#product_price_list').datagrid('reload');
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
                $('#product_price_list-input').form('load', row);
            }
        });
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function costing_product_price_list_edit_rate() {
    $('#global_dialog').dialog({
        title: 'Edit Rate',
        width: 250,
        href: base_url + 'costing/product_price_list_edit_rate',
        modal: true,
        resizable: false,
        top: 100,
        height: 110,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    if ($('#product_price_list_edit_rate-input').form('validate')) {
                        $.post(base_url + 'costing/product_price_list_update_rate', $('#product_price_list_edit_rate-input').serializeObject(), function (content) {
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $('#product_price_list').datagrid('reload');
                                $.messager.show({
                                    title: 'Notification',
                                    msg: 'Update rate successfully..!!',
                                    timeout: 3000,
                                    showType: 'slide'
                                });
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

        }
    });
}

function costing_delete_raw_material(idgrid) {
    var row = $('#' + idgrid).datagrid('getSelected');
    if (row != null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data??', function (r) {
            if (r) {
                $.post(base_url + 'costing/delete_raw_material', {
                    id: row.id
                }, function (content) {
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#' + idgrid).datagrid('load');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                });
            }
        });
    } else {
        $.messager.alert('No Data Selected', 'Please Select Data', 'warning');
    }
}


function costing_product_price_list_print() {
    open_target('post', base_url + 'costing/product_price_list_print', $('#product_price_list_search_form').serializeObject(), '_blank')
}

function costing_product_price_list_excel() {
    open_target('post', base_url + 'costing/product_price_list_excel', $('#product_price_list_search_form').serializeObject(), '_blank')
}