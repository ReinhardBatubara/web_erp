/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function upholstry_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'New Upholstry',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'upholstry/add',
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    upholstry_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#upholstry-input').form('clear');
            }
        });        
        url = base_url + 'upholstry/save/' + row.id + '/0';
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }

}

function upholstry_save() {
    $('#upholstry-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#upholstry').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function upholstry_edit() {
    var row = $('#upholstry').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Upholstry',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'upholstry/add',
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    upholstry_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#upholstry-input').form('load', row);
            }
        });        
        url = base_url + 'upholstry/save/' + row.modelid + '/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Upholstry to edit', 'warning');
    }
}

function upholstry_delete() {
    var row = $('#upholstry').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'upholstry/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#upholstry').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose upholstry to delete', 'warning');
    }
}

