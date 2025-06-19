/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function modelfinishingseen_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'New Finishing Seen',
            width: 400,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'modelfinishingseen/add',
            modal: true,
            resizable: true,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    modelfinishingseen_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#modelfinishingseen-input').form('clear');
            }
        });
        url = base_url + 'modelfinishingseen/save/' + row.id;
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }

}

function modelfinishingseen_save() {
    $('#modelfinishingseen-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#modelfinishingseen').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function modelfinishingseen_edit() {
    var row = $('#modelfinishingseen').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Finishing Seen',
            width: 400,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'modelfinishingseen/add',
            modal: true,
            resizable: true,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    modelfinishingseen_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#modelfinishingseen-input').form('load',row);
            }
        });
        url = base_url + 'modelfinishingseen/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Finishing to Edit', 'warning');
    }
}

function modelfinishingseen_delete() {
    var row = $('#modelfinishingseen').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'modelfinishingseen/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#modelfinishingseen').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Finishing to Delete', 'warning');
    }
}

