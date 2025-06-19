/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function hardware_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: ' New Hardware / Accessories',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'hardware/add',
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    hardware_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#hardware-input').form('clear');
            }
        });
        url = base_url + 'hardware/save/' + row.id + '/0';
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }

}

function hardware_add_new_material(){
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: ' New Hardware / Accessories',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'hardware/add2',
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    hardware_save2();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#hardware-input2').form('clear');
            }
        });        
        url = base_url + 'hardware/save/' + row.id + '/0';
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }
}

function hardware_save() {
    $('#hardware-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#hardware').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function hardware_save2() {
    $('#hardware-input2').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#hardware').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function hardware_edit() {
    var row = $('#hardware').datagrid('getSelected');
    if (row !== null) {
        if(row.itemid != '0'){
            $('#global_dialog').dialog({
                title: ' New Hardware / Accessories',
                width: 450,
                height: 'auto',
                closed: false,
                cache: true,
                href: base_url + 'hardware/add',
                modal: true,
                resizable: true,
                top: 50,
                buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        hardware_save();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
                onLoad:function(){
                    $('#hardware-input').form('load', row);
                }
            });
        }else{
            $('#global_dialog').dialog({
                title: ' New Hardware / Accessories',
                width: 450,
                height: 'auto',
                closed: false,
                cache: true,
                href: base_url + 'hardware/add2',
                modal: true,
                resizable: true,
                top: 50,
                buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        hardware_save2();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }],
                onLoad:function(){
                    $('#hardware-input2').form('load', row);
                }
            });
        }
        url = base_url + 'hardware/save/' + row.modelid + '/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Material to edit', 'warning');
    }
}

function hardware_delete() {
    var row = $('#hardware').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'hardware/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#hardware').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose hardware to delete', 'warning');
    }
}

