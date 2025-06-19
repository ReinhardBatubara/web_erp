/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function additionalmaterial_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {        
        $('#global_dialog').dialog({
            title: 'New Additional Material',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'additionalmaterial/add',
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    additionalmaterial_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#additionalmaterial-input').form('clear');
            }
        });
        url = base_url + 'additionalmaterial/save/' + row.id + '/0';
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }

}

function additionalmaterial_save() {
    $('#additionalmaterial-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#model_additionalmaterial').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function additionalmaterial_edit() {
    var row = $('#model_additionalmaterial').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Additional Material',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'additionalmaterial/add',
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    additionalmaterial_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#additionalmaterial-input').form('load', row);
            }
        });
        url = base_url + 'additionalmaterial/save/' + row.modelid + '/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose additionalmaterial to edit', 'warning');
    }
}

function additionalmaterial_delete() {
    var row = $('#model_additionalmaterial').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'additionalmaterial/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#model_additionalmaterial').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Additional Material to delete', 'warning');
    }
}

