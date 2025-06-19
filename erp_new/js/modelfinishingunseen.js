/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function modelfinishingunseen_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'New Finishing Unseen',
            width: 400,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'modelfinishingunseen/add',
            modal: true,
            resizable: true,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    modelfinishingunseen_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#modelfinishingunseen-input').form('clear');
            }
        });
        url = base_url + 'modelfinishingunseen/save/' + row.id;
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }

}

function modelfinishingunseen_save() {
    $('#modelfinishingunseen-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#modelfinishingunseen').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function modelfinishingunseen_edit() {
    var row = $('#modelfinishingunseen').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Finishing Unseen',
            width: 400,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'modelfinishingunseen/add',
            modal: true,
            resizable: true,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    modelfinishingunseen_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#modelfinishingunseen-input').form('load',row);
            }
        });
        url = base_url + 'modelfinishingunseen/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Finishing to Edit', 'warning');
    }
}

function modelfinishingunseen_delete() {
    var row = $('#modelfinishingunseen').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'modelfinishingunseen/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#modelfinishingunseen').datagrid('reload');
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

