/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function itemunitrelation_add() {
    var row = $('#item').datagrid('getSelected');
    if (row !== null) {
        $('#itemunitrelation-form').dialog('open').dialog('setTitle', 'New Unit Item');
        $('#itemunitrelation-input').form('clear');
        url = base_url + 'itemunitrelation/save/' + row.id;
        $('#unitfrom').combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row.id);
        $('#unitto').combobox('reload', base_url + 'itemunitprice/get_remote_unit/' + row.id);
    } else {
        $.messager.alert('No Choose Item', 'Choose Item', 'warning');
    }
}

function itemunitrelation_save() {
    $('#itemunitrelation-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#itemunitrelation-form').dialog('close');
                $('#itemunitrelation').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function itemunitrelation_delete(){
    var row = $('#itemunitrelation').datagrid('getSelected');
    if (row !== null){
        $.messager.confirm('Confirm', 'Are you sure?', function(r) {
            if (r) {
                $.post(base_url + 'itemunitrelation/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#itemunitrelation').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    }else{
        $.messager.alert('No coversion selected', 'Please select conversion', 'warning');
    }
}