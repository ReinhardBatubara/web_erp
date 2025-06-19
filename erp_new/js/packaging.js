/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function packaging_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'New Packaging',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'packaging/add/0',
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        packaging_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#packaging-input').form('clear');
            }
        });
        url = base_url + 'packaging/save/' + row.id + '/0/0';
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }
}

function packaging_add_child() {
    var row = $('#packaging').treegrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'New Packaging',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'packaging/add/' + row.id,
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        packaging_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#packaging-input').form('clear');
            }
        });
        url = base_url + 'packaging/save/' + row.modelid + '/' + row.id + '/0';
    } else {
        $.messager.alert('Warning', 'Choose Packaging', 'warning');
    }
}

function packaging_save() {
//    alert(url);
    $('#packaging-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#packaging').treegrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function packaging_edit() {
    var row = $('#packaging').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Packaging',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'packaging/add/' + row.parentid,
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        packaging_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
            onLoad: function () {
                $('#packaging-input').form('load', row);
            }
        });
        url = base_url + 'packaging/save/' + row.modelid + '/' + row.parentid + '/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Packing to edit', 'warning');
    }
}

function packaging_delete() {
    var row = $('#packaging').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'packaging/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#packaging').treegrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Packaging to delete', 'warning');
    }
}

