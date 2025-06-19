/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function materialtrash_search(){
     $('#materialtrash').datagrid('reload',$('#materialtrash_search_form').serializeObject())   
}

function materialtrash_add(){
    $('#materialtrash-form').dialog('open').dialog('setTitle','New Material Trash');
    $('#materialtrash-input').form('clear');
    url = base_url + 'materialtrash/save/0';
}

function materialtrash_save(){   
    $('#materialtrash-input').form('submit',{
        url: url,        
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){
            var result = eval('('+content+')');
            if(result.success){
                $('#materialtrash-form').dialog('close');                           
                $('#materialtrash').datagrid('reload');
            } else {                
                $.messager.alert('Error',result.msg,'error');
            }
        }
    });
}

function materialtrash_edit(){
    var row = $('#materialtrash').datagrid('getSelected');
    if(row != null){
        $('#materialtrash-form').dialog('open').dialog('setTitle',' Edit Material Trash');
        $('#materialtrash-input').form('load',row);
        url = base_url + 'materialtrash/save/'+row.id;
    }else{
        $.messager.alert('Waring','Choose Material Trash','warning');
    }
}

function materialtrash_delete(){
    var row = $('#materialtrash').datagrid('getSelected');
    if(row != null){
        $.messager.confirm('Confirm','Are you sure you want to remove this data?',function(r){
            if (r){
                $.post(base_url+'materialtrash/delete',{
                    id:row.id
                },function(result){
                    if (result.success){
                        $('#materialtrash').datagrid('reload');
                    } else {
                        $.messager.alert('Error',result.msg,'error');
                    }
                },'json');
            }
        });
    }else{
        $.messager.alert('Waring','Choose Material Trash','warning');
    }
}