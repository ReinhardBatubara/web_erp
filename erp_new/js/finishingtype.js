/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function finishingtype_search() {
    var name = $('#finishingtype_name_s').val();
    var positionid = $('#finishingtype_positionid_s').combobox('getValue');

    $('#finishingtype').datagrid('reload', {
        name: name,
        positionid: positionid
    });
}

function finishingtype_add() {
    $('#finishingtype-form').dialog('open').dialog('setTitle', ' New Finishing Type');
    $('#finishingtype-input').form('clear');
    url = base_url + 'finishingtype/save';
}

function finishingtype_save() {
    $('#finishingtype-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#finishingtype-form').dialog('close');
                $('#finishingtype').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function finishingtype_edit() {
    var row = $('#finishingtype').datagrid('getSelected');
    if (row != null) {
        $('#finishingtype-form').dialog('open').dialog('setTitle', ' Edit Finishing Type');
        $('#finishingtype-input').form('load', row);
        url = base_url + 'finishingtype/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose finishingtype to Edit', 'warning');
    }
}

function finishingtype_delete() {
    var row = $('#finishingtype').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'finishingtype/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#finishingtype').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Finishing Type to Delete', 'warning');
    }
}

function finishingtype_material_search(){
    var finishingtypeid = 0;
    var row = $('#finishingtype').datagrid('getSelected');
    if(row != null){
        finishingtypeid = row.id;
    }
    $('#finishingtype_material').datagrid('reload',{
        finishingtypeid: finishingtypeid,
        itemcode: $('#finishingtype_material_search_itemcode').val(),
        itemdescription: $('#finishingtype_material_search_itemdescription').val()
    });
}


function finishingtype_material_add(){
    var row = $('#finishingtype').datagrid('getSelected');
    if(row != null){
        $('#global_dialog').dialog({
            title: 'Add Item Material',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'finishingtype/material_add',
            modal: true,
            resizable: true,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    finishingtype_material_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#finishingtype_material-input').form('clear');
            }
        });
        url = base_url + 'finishingtype/material_save/'+row.id;
    }else{
        $.messager.alert('Waring','Choose Stock In to Edit','warning');
    }
}

function finishingtype_material_edit(){
    var row = $('#finishingtype_material').datagrid('getSelected');
    if(row != null){
        $('#global_dialog').dialog({
            title: 'Add Item Material',
            width: 450,
            height: 'auto',
            closed: false,
            cache: true,
            href: base_url + 'finishingtype/material_add',
            modal: true,
            resizable: true,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    finishingtype_material_save();
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#finishingtype_material-input').form('load',row);
            }
        });
        url = base_url + 'finishingtype/material_update/'+row.id;
    }else{
        $.messager.alert('Waring','Choose Item Material to Edit','warning');
    }
}

function finishingtype_material_save(){
    //alert(url);
    $('#finishingtype_material-input').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){   
            //alert(content);
            var result = eval('('+content+')');
            if(result.success){
                //$('#global_dialog').dialog('close');      
                $('#finishingtype_material-input').form('clear');
                $('#finishingtype_material').datagrid('reload');
            } else {
                $.messager.alert('Error',result.msg,'error');
            }
        }
    });
}

function finishingtype_material_delete(){
    var row = $('#finishingtype_material').datagrid('getSelected');
    if(row != null){
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'finishingtype/material_delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#finishingtype_material').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    }else{
        $.messager.alert('Waring','Choose Item Material to Edit','warning');
    }
}

