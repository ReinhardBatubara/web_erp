/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var ds_i_id = '';
var ds_i_code = '';
var ds_i_description = '';
var ds_i_unit = '';
var ds_i_warehouseid = '';


function item_search2() {
    $('#item').datagrid('reload', $('#item_search_form2').serializeObject());
}

function item_search() {
    $('#item').datagrid('reload', $('#item_search_form').serializeObject());
}

function item_excel() {
    open_target('POST', base_url + 'item/export_to_excel', $('#item_search_form').serializeObject(), '_blank');
}

function item_add() {
    $('#item-form').dialog('open').dialog('setTitle', ' New item');
    $('#item-input').form('clear');
    url = base_url + 'item/save';

//    $('#global_dialog').dialog({
//        title: 'Add New Item Material',
//        width: 700,
//        height: 'auto',
//        closed: false,
//        top:100,
//        cache: false,
//        href: base_url + 'item/add',
//        modal: true,
//        resizable: true
//    }).dialog('hcenter');
}

function item_save() {
    $('#item-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#item-form').dialog('close');
                $('#item').datagrid('reload');
            } else if (result.warning) {
                $.messager.alert('Warning', 'Upload image faild', 'warning');
                $('#item-form').dialog('close');
                $('#item').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function item_edit() {
    var row = $('#item').datagrid('getSelected');
    if (row !== null) {
        $('#item_edit-form').dialog('open').dialog('setTitle', ' Edit item');
        $('#item_edit-input').form('load', row);
        url = base_url + 'item/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose item to edit', 'warning');
    }
}

function item_update() {
    $('#item_edit-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#item_edit-form').dialog('close');
                $('#item').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function item_delete() {
    var row = $('#item').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'item/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#item').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose item to delete', 'warning');
    }
}

function item_disable() {
    var row = $('#item').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to disable this data?', function (r) {
            if (r) {
                $.post(base_url + 'item/disable', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#item').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose item to disable', 'warning');
    }
}

function item_enable() {
    var row = $('#item').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to enable this data?', function (r) {
            if (r) {
                $.post(base_url + 'item/enable', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#item').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose item to enable', 'warning');
    }
}

function item_dialogsearch(temp_id, temp_code, temp_description, temp_unit, temp_warehouseid) {
    $('#itemdialogsearch-form').dialog('open').dialog('setTitle', 'Search Item');
    ds_i_id = temp_id;
    ds_i_code = temp_code;
    ds_i_description = temp_description;
    ds_i_unit = temp_unit;
    ds_i_warehouseid = temp_warehouseid;
}

function item_searchfordialog() {
    var code = $('#itemdialogsearch_code_s').val();
    var description = $('#itemdialogsearch_description_s').val();
    var groupid = $('#itemdialogsearch_groupid_s').combobox('getValue');
    $('#itemdialogsearch').datagrid('reload', {
        code: code,
        description: description,
        groupid: groupid
    });
}

function item_setselected() {
    var row_search = $('#itemdialogsearch').datagrid('getSelected');
    if (row_search === null) {
        $.messager.alert('Waring', 'Choose item to set', 'warning');
    } else {
        //        alert(ds_i_warehouseid);
        $('#' + ds_i_id).val(row_search.id);
        $('#' + ds_i_code).val(row_search.code);
        $('#' + ds_i_description).val(row_search.description);
        if ($('#' + ds_i_unit).length > 0) {
            $('#' + ds_i_unit).combobox('clear');
            $('#' + ds_i_unit).combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row_search.id);
            $('#' + ds_i_unit).combobox('setValue', row_search.unitcode);
        }
        if ($('#' + ds_i_warehouseid).length) {
            $('#' + ds_i_warehouseid).combobox('clear');
            $('#' + ds_i_warehouseid).combobox('reload', base_url + 'itemwarehousestock/get_warehouse_for_combo_by_item_id/' + row_search.id);
        }

        if ($('#solidwoodunitcode').length) {
            $("solidwoodunitcode").prop('required', true);
        }
        $('#itemdialogsearch-form').dialog('close');
    }
}

function item_change_image() {
    var row = $('#item').datagrid('getSelected');
    if (row !== null) {
        $('#item_change_image-form').dialog('open').dialog('setTitle', ' Change Image');
        url = base_url + 'item/updateimage/' + row.id + '/' + row.images;
    } else {
        $.messager.alert('Waring', 'Choose item to change image', 'warning');
    }
}

function item_update_image() {
    $('#item_change_image-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#item_change_image-form').dialog('close');
                $('#item').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function item_change_admin() {
    $('#global_dialog').dialog({
        title: 'Change Admin',
        width: 300,
        height: 'auto',
        href: base_url + 'item/change_admin',
        modal: false,
        resizable: true,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    $.post(base_url + 'item/do_change_admin',
                            $('#item_change_admin_form').serializeObject()
                            , function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $.messager.show({
                                        title: 'Notification',
                                        msg: 'Change Admin Successful',
                                        timeout: 5000,
                                        showType: 'slide'
                                    });
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
}

function item_stock_card() {
    $('#global_dialog').dialog({
        title: 'Stock Card',
        width: 600,
        height: 500,
        href: base_url + 'item/stock_card',
        modal: true,
        resizable: true,
        buttons: [{
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
}

function item_stock_out_preview() {
    if ($('#stock_card_form').form('validate')) {
        $.post(base_url + 'item/print_stock_card', $('#stock_card_form').serializeObject(), function (content) {
            $('#stock_card_temp').empty();
            $('#stock_card_temp').append(content);
        });
    }
}