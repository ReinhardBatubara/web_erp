/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function plywood_add() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {        
        $('#global_dialog').dialog({
            title: 'New Plywood',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'plywood/add/0',
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    plywood_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#plywood-input').form('clear');
            }
        });
        url = base_url + 'plywood/save/' + row.id + '/0/0';
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }

}

function plywood_children() {
    var row = $('#plywood').treegrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'New Plywood',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'plywood/add/'+row.id,
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    plywood_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#plywood-input').form('clear');
            }
        });
        url = base_url + 'plywood/save/' + row.modelid + '/' + row.id + '/0';
    } else {
        $.messager.alert('Warning', 'Choose Plywood', 'warning');
    }
}

function plywood_save() {
    $('#plywood-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#plywood').treegrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function plywood_edit() {
    var row = $('#plywood').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'New Solid Wood',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'plywood/add/'+row.parentid,
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    plywood_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#plywood-input').form('load', row);
            }
        });
        url = base_url + 'plywood/save/' + row.modelid + '/0/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Plywood to edit', 'warning');
    }
}

function plywood_delete() {
    var row = $('#plywood').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'plywood/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#plywood').treegrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose plywood to delete', 'warning');
    }
}

function plywood_make_as_path(){
    var row = $('#plywood').treegrid('getSelected');
    if (row !== null) {
        if(row.parentid == '0'){
            $.messager.alert('Waring', 'Selected item is path', 'warning');
        }else{
            $.messager.confirm('Confirm', 'Are you sure?', function(r) {
                if (r) {
                    $.post(base_url + 'plywood/make_as_path', {
                        id: row.id
                    }, function(result) {
                        if (result.success) {
                            $('#plywood').treegrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        }
    } else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function plywood_make_as_child(){
    var row = $('#plywood').treegrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Make as Child',
            width: 400,
            height: 100,
            closed: false,
            top:100,
            cache: false,
            href: base_url + 'plywood/make_as_child/'+row.id+'/'+row.modelid,
            modal: true,
            resizable: true,
            buttons: [
            {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }
            ]
        }).dialog('hcenter');
    }else {
        $.messager.alert('No Item Selected', 'Please Select Item', 'warning');
    }
}

function plywood_do_make_as_child(childid,parentid){
    if(parseInt(childid) !== parseInt(parentid)){
        $.messager.confirm('Confirm', 'Are you sure?', function(r) {
            if (r) {
                $.post(base_url + 'plywood/do_make_as_child', {
                    childid: childid,
                    parentid: parentid
                }, function(result) {
                    if (result.success) {
                        $('#plywood').treegrid('reload');
                        $('#global_dialog').dialog('close');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }else{
                $('#plywood_mtr').combogrid('clear');
            }
        });
    }else{
        $.messager.alert('System Interupted', 'Unable to set parent with same item', 'error');
        $('#plywood_mtr').combogrid('clear');
    }
}