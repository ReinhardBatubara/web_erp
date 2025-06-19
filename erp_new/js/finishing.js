/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function finishing_search(){
    var code = $('#finishing_code_s').val();
    var description = $('#finishing_description_s').val();   
    
    $('#finishing').datagrid('reload',{
        code: code,
        description: description
    });
}

function finishing_add(){
    $('#finishing-form').dialog('open').dialog('setTitle',' New model category');
    $('#finishing-input').form('clear');
    url = base_url + 'finishing/save';
}

function finishing_save(){
    $('#finishing-input').form('submit',{
        url: url,        
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){   
            //            alert(content);
            var result = eval('('+content+')');
            if(result.success){
                $('#finishing-form').dialog('close');                           
                $('#finishing').datagrid('reload');
            } else {                
                $.messager.allert('Error',result.msg,'error');
            }
        }
    });
}

function finishing_edit(){
    var row = $('#finishing').datagrid('getSelected');
    if(row != null){
        $('#finishing-form').dialog('open').dialog('setTitle',' Edit model category');
        $('#finishing-input').form('load',row);
        url = base_url + 'finishing/update/'+row.code;
    }else{
        $.messager.alert('Waring','Choose model category to edit','warning');
    }
}

function finishing_delete(){
    var row = $('#finishing').datagrid('getSelected');
    if(row != null){
        $.messager.confirm('Confirm','Are you sure you want to remove this data?',function(r){
            if (r){
                $.post(base_url+'finishing/delete',{
                    code:row.code
                },function(result){
                    if (result.success){
                        $('#finishing').datagrid('reload');
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

