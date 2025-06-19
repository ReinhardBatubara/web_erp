/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function top_search(){
    var code = $('#top_code_s').val();
    var description = $('#top_description_s').val();   
    
    $('#top').datagrid('reload',{
        code: code,
        description: description
    });
}

function top_add(){
    $('#top-form').dialog('open').dialog('setTitle',' New model category');
    $('#top-input').form('clear');
    url = base_url + 'top/save';
}

function top_save(){
    $('#top-input').form('submit',{
        url: url,        
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){   
            //            alert(content);
            var result = eval('('+content+')');
            if(result.success){
                $('#top-form').dialog('close');                           
                $('#top').datagrid('reload');
            } else {                
                $.messager.alert('Error',result.msg,'error');
            }
        }
    });
}

function top_edit(){
    var row = $('#top').datagrid('getSelected');
    if(row !== null){
        $('#top-form').dialog('open').dialog('setTitle',' Edit model category');
        $('#top-input').form('load',row);
        url = base_url + 'top/update/'+row.code;
    }else{
        $.messager.alert('Waring','Choose model category to edit','warning');
    }
}

function top_delete(){
    var row = $('#top').datagrid('getSelected');
    if(row != null){
        $.messager.confirm('Confirm','Are you sure you want to remove this data?',function(r){
            if (r){
                $.post(base_url+'top/delete',{
                    code:row.code
                },function(result){
                    if (result.success){
                        $('#top').datagrid('reload');
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

