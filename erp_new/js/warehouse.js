/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function warehouse_search(){
    var code = $('#warehouse_code_s').val();
    var name = $('#warehouse_name_s').val();
    var description = $('#warehouse_description_s').val();
    
    $('#warehouse').datagrid('reload',{
        code: code,
        name: name,
        description: description
    });
}

function warehouse_add(){
    $('#warehouse-form').dialog('open').dialog('setTitle',' New Warehouse');
    $('#warehouse-input').form('clear');
    url = base_url + 'warehouse/save';
}

function warehouse_save(){
    $('#warehouse-input').form('submit',{
        url: url,        
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){   
            //            alert(content);
            var result = eval('('+content+')');
            if(result.success){
                $('#warehouse-form').dialog('close');                           
                $('#warehouse').datagrid('reload');
            } else {                
                $.messager.allert('Error',result.msg,'error');
            }
        }
    });
}

function warehouse_edit(){
    var row = $('#warehouse').datagrid('getSelected');
    if(row != null){
        $('#warehouse-form').dialog('open').dialog('setTitle',' Edit warehouse');
        $('#warehouse-input').form('load',row);
        url = base_url + 'warehouse/update/'+row.id;
    }else{
        $.messager.alert('Waring','Choose Warehouse to Edit','warning');
    }
}

function warehouse_delete(){
    var row = $('#warehouse').datagrid('getSelected');
    if(row != null){
        $.messager.confirm('Confirm','Are you sure you want to remove this data?',function(r){
            if (r){
                $.post(base_url+'warehouse/delete',{
                    id:row.id
                },function(result){
                    if (result.success){
                        $('#warehouse').datagrid('reload');
                    } else {
                        $.messager.alert('Error',result.msg,'error');
                    }
                },'json');
            }
        });
    }else{
        $.messager.alert('Waring','Choose Warehouse to Delete','warning');
    }
}

