/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function solidwood_addpath() {
    var row = $('#model').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'New Solid Wood',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'solidwood/add/0',
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    solidwood_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#solidwood-input').form('clear');
            }
        });
        url = base_url + 'solidwood/save/' + row.id + '/0/0';
    } else {
        $.messager.alert('Warning', 'Choose Model', 'warning');
    }
}

function solidwood_children() {
    var row = $('#solidwood').treegrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'New Solid Wood',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'solidwood/add/'+row.id,
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    solidwood_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#solidwood-input').form('clear');
            }
        });
        url = base_url + 'solidwood/save/' + row.modelid + '/' + row.id + '/0';
    } else {
        $.messager.alert('Warning', 'Choose Solid Wood', 'warning');
    }
}



function solidwood_edit() {
    var row = $('#solidwood').treegrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Solid Wood',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'solidwood/add/'+row.parentid,
            modal: true,
            resizable: true,
            top: 50,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    solidwood_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#solidwood-input').form('load', row);
            }
        });
        
        url = base_url + 'solidwood/save/' + row.modelid + '/' + row.parentid + '/' + row.id;
    } else {
        $.messager.alert('Warning', 'Choose Solid Wood', 'warning');
    }
}

function solidwood_save() {
    $('#solidwood-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#solidwood').treegrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function solidwood_delete() {
    var row = $('#solidwood').treegrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'solidwood/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#solidwood').treegrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose unit to delete', 'warning');
    }
}

function solidwood_make_as_path(){
    var row = $('#solidwood').treegrid('getSelected');
    if (row !== null) {
        if(row.parentid == '0'){
            $.messager.alert('Waring', 'Selected item is path', 'warning');
        }else{
            $.messager.confirm('Confirm', 'Are you sure?', function(r) {
                if (r) {
                    $.post(base_url + 'solidwood/make_as_path', {
                        id: row.id
                    }, function(result) {
                        if (result.success) {
                            $('#solidwood').treegrid('reload');
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

function solidwood_make_as_child(){
    var row = $('#solidwood').treegrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Make as Child',
            width: 400,
            height: 100,
            closed: false,
            top:100,
            cache: false,
            href: base_url + 'solidwood/make_as_child/'+row.id+'/'+row.modelid,
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

function solidwood_do_make_as_child(childid,parentid){
    if(parseInt(childid) !== parseInt(parentid)){
        $.messager.confirm('Confirm', 'Are you sure?', function(r) {
            if (r) {
                $.post(base_url + 'solidwood/do_make_as_child', {
                    childid: childid,
                    parentid: parentid
                }, function(result) {
                    if (result.success) {
                        $('#solidwood').treegrid('reload');
                        $('#global_dialog').dialog('close');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }else{
                $('#solidwood_mtr').combogrid('clear');
            }
        });
    }else{
        $.messager.alert('Error', 'Unable to set parent with same item', 'error');
        $('#solidwood_mtr').combogrid('clear');
    }
}