/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function accessories_search(){
    var code = $('#accessories_code_s').val();
    var description = $('#accessories_description_s').val();   
    
    $('#accessories').datagrid('reload',{
        code: code,
        description: description
    });
}

function accessories_add(){
    $('#accessories-form').dialog('open').dialog('setTitle',' New model category');
    $('#accessories-input').form('clear');
    url = base_url + 'accessories/save';
}

function accessories_save(){
    $('#accessories-input').form('submit',{
        url: url,        
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){   
            //            alert(content);
            var result = eval('('+content+')');
            if(result.success){
                $('#accessories-form').dialog('close');                           
                $('#accessories').datagrid('reload');
            } else {                
                $.messager.allert('Error',result.msg,'error');
            }
        }
    });
}

function accessories_edit(){
    var row = $('#accessories').datagrid('getSelected');
    if(row != null){
        $('#accessories-form').dialog('open').dialog('setTitle',' Edit model category');
        $('#accessories-input').form('load',row);
        url = base_url + 'accessories/update/'+row.code;
    }else{
        $.messager.alert('Waring','Choose model category to edit','warning');
    }
}

function accessories_delete(){
    var row = $('#accessories').datagrid('getSelected');
    if(row != null){
        $.messager.confirm('Confirm','Are you sure you want to remove this data?',function(r){
            if (r){
                $.post(base_url+'accessories/delete',{
                    code:row.code
                },function(result){
                    if (result.success){
                        $('#accessories').datagrid('reload');
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

