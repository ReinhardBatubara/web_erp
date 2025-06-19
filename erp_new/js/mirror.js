/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function mirror_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Add New',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'mirror/add',
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    mirror_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#mirror-input').form('clear');
            }
        });
        url = base_url + 'mirror/save/' + row.id + '/0';
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }

}

function mirror_save() {
    $('#mirror-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#mirror').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function mirror_edit() {
    var row = $('#mirror').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'mirror/add',
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    mirror_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#mirror-input').form('load', row);
            }
        });
        url = base_url + 'mirror/save/' + row.modelid + '/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose mirror to edit', 'warning');
    }
}

function mirror_delete() {
    var row = $('#mirror').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'mirror/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#mirror').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose mirror to delete', 'warning');
    }
}

