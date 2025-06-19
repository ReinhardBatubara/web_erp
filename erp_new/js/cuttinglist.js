/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function cuttinglist_search() {
    $('#cuttinglist').datagrid('reload',$('#cuttinglist_search_from').serializeObject());
}

function cuttinglist_add() {
    $('#global_dialog').dialog({
        title: 'Add Cutting List',
        width: 400,
        height:'auto',
        href: base_url + 'cuttinglist/add',
        modal: true,
        top: 100,
        resizable: true,
        buttons: [{
            text: 'Save',
            iconCls: 'icon-save',
            handler: function () {
                if($('#cuttinglist-input').form('validate')){
                    $.post(base_url+'cuttinglist/save/0',$('#cuttinglist-input').serializeObject(),function(content){
                        var result = eval('(' + content + ')');
                        if (result.success) {
                            $('#global_dialog').dialog('close');
                            $('#cuttinglist').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    });
                }
            }
        },{
            text: 'Close',
            iconCls: 'icon-remove',
            handler: function () {
                $('#global_dialog').dialog('close');
            }
        }],
        onLoad:function(){
            $('#cuttinglist-input').form('clear');
        }
    });
}


function cuttinglist_edit() {
    var row = $('#cuttinglist').datagrid('getSelected');
    if (row != null) {
        $('#global_dialog').dialog({
            title: 'Edit Cutting List',
            width: 400,
            height:'auto',
            href: base_url + 'cuttinglist/add',
            modal: true,
            resizable: true,
            top: 100,
            buttons: [{
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    if($('#cuttinglist-input').form('validate')){
                        $.post(base_url+'cuttinglist/save/'+row.id,$('#cuttinglist-input').serializeObject(),function(content){
                            var result = eval('(' + content + ')');
                            if (result.success) {
                                $('#global_dialog').dialog('close');
                                $('#cuttinglist').datagrid('reload');
                            } else {
                                $.messager.alert('Error', result.msg, 'error');
                            }
                        });
                    }
                }
            },{
                text: 'Close',
                iconCls: 'icon-remove',
                handler: function () {
                    $('#global_dialog').dialog('close');
                }
            }],
            onLoad:function(){
                $('#cuttinglist_joborderitemid').combobox('reload',base_url+'joborder/item_get_distinct/'+row.joborderid);
                $('#cuttinglist-input').form('load',row);
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Cutting List to Edit', 'warning');
    }
}

function cuttinglist_delete() {
    var row = $('#cuttinglist').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'cuttinglist/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#cuttinglist').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose Cutting List to Delete', 'warning');
    }
}

