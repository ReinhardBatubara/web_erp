/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function carvingpricelist_add(){
    $('#global_dialog').dialog({
        title: 'New Carving Price',
        width: 400,
        height: 'auto',
        closed: false,
        cache: false,
        top: 50,    
        href: base_url + 'carvingpricelist/add',
        modal: true,
        resizable: true,
        buttons: [{
            text: 'Save',
            iconCls: 'icon-save',
            handler: function () {
                carvingpricelist_save()
            }
        }, {
            text: 'Close',
            iconCls: 'icon-remove',
            handler: function () {
                $('#global_dialog').dialog('close');
            }
        }],
        onLoad:function(){        
            $('#carvingpricelist_form').form('clear')
        }
    }).dialog('hcenter');
    url = base_url + 'carvingpricelist/save/0';
}

function carvingpricelist_save(){
    $('#carvingpricelist_form').form('submit',{
        url: url,        
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){   
            //            alert(content);
            var result = eval('('+content+')');
            if(result.success){
                $('#global_dialog').dialog('close');                 
                $('#carvingpricelist').datagrid('reload');
            } else {                
                $.messager.alert('Error',result.msg,'error');
            }
        }
    });
}

function carvingpricelist_edit() {
    var row = $('#carvingpricelist').datagrid('getSelected');
    if (row != null) {
        $('#global_dialog').dialog({
            title: 'Edit Carving Price',
            width: 400,
            height: 'auto',
            closed: false,
            cache: false,
            top: 50,    
            href: base_url + 'carvingpricelist/add',
            modal: true,
            resizable: true,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    carvingpricelist_save()
                }
            }, {
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){  
                $('#carvingpricelist_form').form('load',row);
            }
        }).dialog('hcenter');
        url = base_url + 'carvingpricelist/save/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose Item to Edit', 'warning');
    }
}

function carvingpricelist_delete() {
    var row = $('#carvingpricelist').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'carvingpricelist/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#carvingpricelist').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Item to Delete', 'warning');
    }
}
