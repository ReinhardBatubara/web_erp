/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function foam_search(){
    var code = $('#foam_code_s').val();
    var description = $('#foam_description_s').val();   
    
    $('#foam').datagrid('reload',{
        code: code,
        description: description
    });
}

function foam_add(){
    $('#foam-form').dialog('open').dialog('setTitle',' New model category');
    $('#foam-input').form('clear');
    url = base_url + 'foam/save';
}

function foam_save(){
    $('#foam-input').form('submit',{
        url: url,        
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){   
            //            alert(content);
            var result = eval('('+content+')');
            if(result.success){
                $('#foam-form').dialog('close');                           
                $('#foam').datagrid('reload');
            } else {                
                $.messager.alert('Error',result.msg,'error');
            }
        }
    });
}

function foam_edit(){
    var row = $('#foam').datagrid('getSelected');
    if(row != null){
        $('#foam-form').dialog('open').dialog('setTitle',' Edit model category');
        $('#foam-input').form('load',row);
        url = base_url + 'foam/update/'+row.code;
    }else{
        $.messager.alert('Waring','Choose model category to edit','warning');
    }
}

function foam_delete(){
    var row = $('#foam').datagrid('getSelected');
    if(row != null){
        $.messager.confirm('Confirm','Are you sure you want to remove this data?',function(r){
            if (r){
                $.post(base_url+'foam/delete',{
                    code:row.code
                },function(result){
                    if (result.success){
                        $('#foam').datagrid('reload');
                    } else {
                        $.messager.alert('Error',result.msg,'error');
                    }
                },'json');
            }
        });
    }else{
        $.messager.alert('Waring','Choose model category to delete','warning');
    }
}

