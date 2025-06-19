/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function mirrorglass_search(){
    var code = $('#mirrorglass_code_s').val();
    var description = $('#mirrorglass_description_s').val();   
    
    $('#mirrorglass').datagrid('reload',{
        code: code,
        description: description
    });
}

function mirrorglass_add(){
    $('#mirrorglass-form').dialog('open').dialog('setTitle',' New model category');
    $('#mirrorglass-input').form('clear');
    url = base_url + 'mirrorglass/save';
}

function mirrorglass_save(){
    $('#mirrorglass-input').form('submit',{
        url: url,        
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){   
            //            alert(content);
            var result = eval('('+content+')');
            if(result.success){
                $('#mirrorglass-form').dialog('close');                           
                $('#mirrorglass').datagrid('reload');
            } else {                
                $.messager.allert('Error',result.msg,'error');
            }
        }
    });
}

function mirrorglass_edit(){
    var row = $('#mirrorglass').datagrid('getSelected');
    if(row != null){
        $('#mirrorglass-form').dialog('open').dialog('setTitle',' Edit model category');
        $('#mirrorglass-input').form('load',row);
        url = base_url + 'mirrorglass/update/'+row.code;
    }else{
        $.messager.alert('Waring','Choose model category to edit','warning');
    }
}

function mirrorglass_delete(){
    var row = $('#mirrorglass').datagrid('getSelected');
    if(row != null){
        $.messager.confirm('Confirm','Are you sure you want to remove this data?',function(r){
            if (r){
                $.post(base_url+'mirrorglass/delete',{
                    code:row.code
                },function(result){
                    if (result.success){
                        $('#mirrorglass').datagrid('reload');
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

