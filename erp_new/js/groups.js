/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function groups_search() {
    $('#groups').datagrid('reload', $('#groups_search_form').serializeObject());
}
function groups_add(){
    $('#groups-form').dialog('open').dialog('setTitle',' New item group');
    $('#groups-input').form('clear');
    url = base_url + 'groups/save';
}

function groups_save(){
    $('#groups-input').form('submit',{
        url: url,        
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){   
            //            alert(content);
            var result = eval('('+content+')');
            if(result.success){
                $('#groups-form').dialog('close');                           
                $('#groups').datagrid('reload');
            } else {                
                $.messager.alert('Error',result.msg,'error');
            }
        }
    });
}

function groups_edit(){
    var row = $('#groups').datagrid('getSelected');
    if(row != null){
        $('#groups-form').dialog('open').dialog('setTitle',' Edit item group');
        $('#groups-input').form('load',row);
        url = base_url + 'groups/update/'+row.id;
    }else{
        $.messager.alert('Waring','Choose groups to Edit','warning');
    }
}

function groups_delete(){
    var row = $('#groups').datagrid('getSelected');
    if(row != null){
        $.messager.confirm('Confirm','Are you sure you want to remove this data?',function(r){
            if (r){
                $.post(base_url+'groups/delete',{
                    id:row.id
                },function(result){
                    if (result.success){
                        $('#groups').datagrid('reload');
                    } else {
                        $.messager.alert('Error',result.msg,'error');
                    }
                },'json');
            }
        });
    }else{
        $.messager.alert('Waring','Choose item group to Delete','warning');
    }
}

