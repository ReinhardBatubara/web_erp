/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function modelcategory_search(){
    var code = $('#modelcategory_code_s').val();
    var description = $('#modelcategory_description_s').val();   
    
    $('#modelcategory').datagrid('reload',{
        code: code,
        description: description
    });
}

function modelcategory_add(){
    $('#modelcategory-form').dialog('open').dialog('setTitle',' New model category');
    $('#modelcategory-input').form('clear');
    url = base_url + 'modelcategory/save';
}

function modelcategory_save(){
    $('#modelcategory-input').form('submit',{
        url: url,        
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){   
            //            alert(content);
            var result = eval('('+content+')');
            if(result.success){
                $('#modelcategory-form').dialog('close');                           
                $('#modelcategory').datagrid('reload');
            } else {                
                $.messager.allert('Error',result.msg,'error');
            }
        }
    });
}

function modelcategory_edit(){
    var row = $('#modelcategory').datagrid('getSelected');
    if(row != null){
        $('#modelcategory-form').dialog('open').dialog('setTitle',' Edit model category');
        $('#modelcategory-input').form('load',row);
        url = base_url + 'modelcategory/update/'+row.code;
    }else{
        $.messager.alert('Waring','Choose model category to edit','warning');
    }
}

function modelcategory_delete(){
    var row = $('#modelcategory').datagrid('getSelected');
    if(row != null){
        $.messager.confirm('Confirm','Are you sure you want to remove this data?',function(r){
            if (r){
                $.post(base_url+'modelcategory/delete',{
                    code:row.code
                },function(result){
                    if (result.success){
                        $('#modelcategory').datagrid('reload');
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

