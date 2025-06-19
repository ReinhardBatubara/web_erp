/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function vendor_search() {
    $('#vendor').datagrid('reload', $('#vendorsearch_form').serializeObject());
}

function vendor_add(){
    $('#vendor-form').dialog('open').dialog('setTitle',' New vendor');
    $('#vendor-input').form('clear');
    url = base_url + 'vendor/save';
}

function vendor_save(){
    $('#vendor-input').form('submit',{
        url: url,        
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(content){   
            //            alert(content);
            var result = eval('('+content+')');
            if(result.success){
                $('#vendor-form').dialog('close');                           
                $('#vendor').datagrid('reload');
            } else {                
                $.messager.alert('Error',result.msg,'error');
            }
        }
    });
}

function vendor_edit(){
    var row = $('#vendor').datagrid('getSelected');
    if(row != null){
        $('#vendor-form').dialog('open').dialog('setTitle',' Edit vendor');
        $('#vendor-input').form('load',row);
        url = base_url + 'vendor/update/'+row.id;
    }else{
        $.messager.alert('Waring','Choose vendor to edit','warning');
    }
}

function vendor_delete(){
    var row = $('#vendor').datagrid('getSelected');
    if(row != null){
        $.messager.confirm('Confirm','Are you sure you want to remove this data?',function(r){
            if (r){
                $.post(base_url+'vendor/delete',{
                    id:row.id
                },function(result){
                    if (result.success){
                        $('#vendor').datagrid('reload');
                    } else {
                        $.messager.alert('Error',result.msg,'error');
                    }
                },'json');
            }
        });
    }else{
        $.messager.alert('Waring','Choose vendor to delete','warning');
    }
}