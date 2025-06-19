/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* global base_url */

function carvingsubmission_period_add() {
    $('#carvingsubmission_period_input_dialog').dialog('open').dialog('setTitle', 'New Period');
    $('#period_input_form').form('clear');
    url = base_url + 'carvingsubmission/period_save/0';
}

function carvingsubmission_period_edit() {
    var row = $('#carvingsubmission_period').datagrid('getSelected');
    if (row !== null) {
        $('#carvingsubmission_period_input_dialog').dialog('open').dialog('setTitle', 'Edit Period');
        $('#period_input_form').form('load', row);
        url = base_url + 'carvingsubmission/period_save/' + row.id;
    } else {
        $.messager.alert('No Period Selected', 'Please Select Period', 'warning');
    }
}

function carvingsubmission_period_save() {
    $('#period_input_form').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
//            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#carvingsubmission_period_input_dialog').dialog('close');
                $('#carvingsubmission_period').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function carvingsubmission_period_delete() {
    var row = $('#carvingsubmission_period').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'carvingsubmission/period_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#carvingsubmission_period').datagrid('reload');
                        $('#carvingsubmission_carver').datagrid('reload');
                        $('#carvingsubmission_list_item').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Period Selected', 'Please Select Period', 'warning');
    }
}

function carvingsubmission_period_excel() {
    var row = $('#carvingsubmission_period').datagrid('getSelected');
    if (row !== null) {
        open_target('POST', base_url + 'carvingsubmission/period_excel', {
            id: row.id
        }, '_blank');
    } else {
        $.messager.alert('No Period Selected', 'Please Select Period', 'warning');
    }
}

/*Carver*/

function carvingsubmission_carver_add() {
    var row = $('#carvingsubmission_period').datagrid('getSelected');
    if (row !== null) {
        $('#carvingsubmission_carver_input_dialog').dialog('open').dialog('setTitle', 'New Carver');
        $('#carver_input_form').form('clear');
        url = base_url + 'carvingsubmission/carver_save/' + row.id + '/0';
    } else {
        $.messager.alert('No Period Selected', 'Please Select Period', 'warning');
    }
}


function carvingsubmission_carver_save() {
    $('#carver_input_form').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
//            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#carvingsubmission_carver_input_dialog').dialog('close');
                $('#carvingsubmission_carver').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function carvingsubmission_carver_delete() {
    var row = $('#carvingsubmission_carver').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'carvingsubmission/carver_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#carvingsubmission_carver').datagrid('reload');
                        $('#carvingsubmission_list_item').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Carver Selected', 'Please Carver Period', 'warning');
    }
}

/*List Item*/

function carvingsubmission_list_item_search() {
    var row = $('#carvingsubmission_carver').datagrid('getSelected');
    if (row !== null) {
        $('#carvingsubmission_list_item').datagrid('load', {
            carvingsubmissionperiodid: row.carvingsubmissionperiodid,
            carvingsubmissioncarverid: row.id,
            q: $('#cli_s_type').val()
        });
    } else {
        $('#carvingsubmission_list_item').datagrid('load', {
            s_type: $('#cli_s_type').val()
        });
    }

}

function carvingsubmission_list_item_add() {
    var row = $('#carvingsubmission_carver').datagrid('getSelected');
    if (row !== null) {
        $('#carvingsubmission_list_item_input_dialog').dialog('open').dialog('setTitle', 'Add Item');
        $('#carvingsubmission_list_item_input_form').form('clear');
        url = base_url + 'carvingsubmission/list_item_save/' + row.carvingsubmissionperiodid + '/' + row.id + '/0';
    } else {
        $.messager.alert('No Carver Selected', 'Please Select Carver', 'warning');
    }
}

function carvingsubmission_list_item_edit() {
    var row = $('#carvingsubmission_list_item').datagrid('getSelected');
    if (row !== null) {
        $('#carvingsubmission_list_item_input_dialog').dialog('open').dialog('setTitle', 'Edit Item');
        $('#carvingsubmission_list_item_trackingid').combogrid('reload');
        $('#carvingsubmission_list_item_input_form').form('load', row);
        url = base_url + 'carvingsubmission/list_item_save/0/0/' + row.id;
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function carvingsubmission_list_item_save() {
    $('#carvingsubmission_list_item_input_form').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
//            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#carvingsubmission_list_item_input_dialog').dialog('close');
                $('#carvingsubmission_list_item').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function carvingsubmission_list_item_delete() {
    var row = $('#carvingsubmission_list_item').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'carvingsubmission/list_item_delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#carvingsubmission_list_item').datagrid('reload');
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