/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function finishingtop_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'New Finishing Top',
            width: 400,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'finishingtop/add',
            modal: true,
            resizable: true,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    finishingtop_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#finishingtop-input').form('clear');
            }
        });
        url = base_url + 'finishingtop/save/' + row.id;
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }

}

function finishingtop_save() {
    $('#finishingtop-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#finishingtop').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function finishingtop_edit() {
    var row = $('#finishingtop').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Finishing Top',
            width: 400,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'finishingtop/add',
            modal: true,
            resizable: true,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    finishingtop_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#finishingtop-input').form('load',row);
            }
        });
        url = base_url + 'finishingtop/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Finishing to Edit', 'warning');
    }
}

function finishingtop_delete() {
    var row = $('#finishingtop').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'finishingtop/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#finishingtop').datagrid('reload');
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

