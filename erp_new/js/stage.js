/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function stage_search(){
    var code = $('#stage_code_s').val();
    var description = $('#stage_description_s').val();   
    
    $('#stage').datagrid('reload',{
        code: code,
        description: description
    });
}

function stage_add(){
    $('#stage-form').dialog('open').dialog('setTitle',' New model category');
    $('#stage-input').form('clear');
    url = base_url + 'stage/save';
}

function stage_save(){
    $('#stage-input').form('submit',{
        url: url,        
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){   
            //            alert(content);
            var result = eval('('+content+')');
            if(result.success){
                $('#stage-form').dialog('close');                           
                $('#stage').datagrid('reload');
            } else {                
                $.messager.allert('Error',result.msg,'error');
            }
        }
    });
}

function stage_edit(){
    var row = $('#stage').datagrid('getSelected');
    if(row !== null){
        $('#stage-form').dialog('open').dialog('setTitle',' Edit model category');
        $('#stage-input').form('load',row);
        url = base_url + 'stage/update/'+row.code;
    }else{
        $.messager.alert('Waring','Choose model category to edit','warning');
    }
}

function stage_delete(){
    var row = $('#stage').datagrid('getSelected');
    if(row !== null){
        $.messager.confirm('Confirm','Are you sure you want to remove this data?',function(r){
            if (r){
                $.post(base_url+'stage/delete',{
                    code:row.code
                },function(result){
                    if (result.success){
                        $('#stage').datagrid('reload');
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

