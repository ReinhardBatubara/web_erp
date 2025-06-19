/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function materialwithdraw_search() {
    $('#materialwithdraw').datagrid('load',$('#materialwithdraw_search_form').serializeObject());
}
function materialwithdraw_search2() {
    var number = $('#mw_number_s').val();
    var datefrom = $('#mw_datefrom_s').datebox('getValue');
    var dateto = $('#mw_dateto_s').datebox('getValue');
    var departmentid = $('#mw_departmentid_s').combobox('getValue');
    $('#materialwithdraw').datagrid('load', {
        number: number,
        datefrom: datefrom,
        dateto: dateto,
        departmentid: departmentid
    });
}

function mw_list_material_jo_search(){
    $('#mw_add_detail_jo').datagrid('load',$('#mw_list_material_jo_search_form').serializeObject());
}
function materialwithdraw_add() {
    $('#materialwithdraw-form').dialog('open').dialog('setTitle', 'New Material Withdraw');
    $('#materialwithdraw-input').form('clear');
    url = base_url + 'materialwithdraw/save';
}

function materialwithdraw_edit() {
    var row = $('#materialwithdraw').datagrid('getSelected');
    if (row !== null) {
        var row_item = $('#materialwithdrawdetail').datagrid('getRows');
        $('#materialwithdraw-form').dialog('open').dialog('setTitle', 'Edit Material Withdraw');
        $('#materialwithdraw-input').form('load', row);
        url = base_url + 'materialwithdraw/update/' + row.id;
        if(row_item.length > 0){
            $('#joborderid_').combogrid('disable');            
        }else{
            $('#joborderid_').combogrid('enable');
        }
    } else {
        $.messager.alert('No Material Withdraw Choose', 'Please Choose Material Withdraw', 'error');
    }

}

function materialwithdraw_delete() {
    var row = $('#materialwithdraw').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'materialwithdraw/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#materialwithdraw').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Material Withdraw Choose', 'Please Choose Material Withdraw', 'error');
    }
}

function materialwithdraw_save() {
    if ($('#materialwithdraw-input').form('validate')) {
        $.post(url, 
            $('#materialwithdraw-input').serializeObject()
            , function(content) {
            
                var result = eval('(' + content + ')');
                if (result.success) {
                    $('#materialwithdraw-form').dialog('close');
                    $('#materialwithdraw').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            });
    }
}

function materialwithdraw_submit() {
    var row = $('#materialwithdraw').datagrid('getSelected');
    if (row !== null) {
        var row_detail = $('#materialwithdrawdetail').datagrid('getRows');
        if (row_detail.length === 0) {
            $.messager.alert('No Item to Send', 'Please Input Item to Submit', 'error');
        } else {
            $.messager.confirm('Confirm', 'You Can\'t modified this withdraw after send. \n Are you Sure?', function(r) {
                if (r) {
                    $.post(base_url + 'materialwithdraw/submit', {
                        id: row.id
                    }, function(result) {
                        if (result.success) {
                            $('#materialwithdraw').datagrid('reload');
                            $('#materialwithdrawdetail').datagrid('reload');
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        }
    } else {
        $.messager.alert('No Material Withdraw Choose', 'Please Choose Material Withdraw', 'error');
    }
}







//Detail

function materialwithdrawdetail_search() {
    var row = $('#materialwithdraw').datagrid('getSelected');
    var itemcode = $('#materialwithdrawdetail_code_s').val();
    var description = $('#materialwithdrawdetail_description_s').val();
    var materialwithdrawid = 0;

    if (row !== null) {
        materialwithdrawid = row.id;
    }

    $('#materialwithdrawdetail').datagrid('reload', {
        materialwithdrawid: materialwithdrawid,
        itemcode: itemcode,
        description: description
    });
}

function materialwithdrawdetail_add() {
    var row = $('#materialwithdraw').datagrid('getSelected');
    if (row !== null) {
        if(row.joborderid != 0){
            $('#global_dialog').dialog({
                title: 'Job Order Material',
                width: 700,
                height: 420,
                closed: false,
                cache: true,
                href: base_url + 'materialwithdrawdetail/add_from_joborder/'+row.joborderid,
                modal: true,
                resizable: true,
                buttons: [{
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        materialwithdrawdetail_save_from_joborder();
                    }
                }, {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }]
            });
            url = base_url + 'materialwithdrawdetail/save_from_joborder/' + row.id;
        }else{
            $('#materialwithdrawdetail-form').dialog('open').dialog('setTitle', 'Choose Material');
            $('#materialwithdrawdetail-input').form('clear');
            url = base_url + 'materialwithdrawdetail/save/' + row.id;
        }
    } else {
        $.messager.alert('No Material Withdraw Choosed', 'Please Choose Material Withdraw', 'error');
    }
}

function materialwithdrawdetail_save_from_joborder(){
    $('#mw_add_detail_jo').datagrid('endEdit', lastIndex);
    var rows = $('#mw_add_detail_jo').datagrid('getChanges');
    if(rows.length > 0){
        var r_mrpid = new Array();
        var r_itemid = new Array();
        var r_unitcode = new Array();
        var r_qty = new Array();
        var msg = '';
        for(var i=0;i<rows.length;i++){
            if(rows[i].qty != ''){
                if(parseFloat(rows[i].ots) < parseFloat(rows[i].qty)){
                    msg = msg + '-Item : ' + rows[i].itemcode+', Outstanding: '+rows[i].ots+', Request '+rows[i].qty+'<br/>';
                }
                r_mrpid[i] = rows[i].id;
                r_itemid[i] = rows[i].itemid;
                r_unitcode[i] = rows[i].unitcode;
                r_qty[i] = rows[i].qty;
            }
        }
        if(msg == ''){
            $.post(url,{
                mrpid: r_mrpid,
                itemid: r_itemid,
                unitcode: r_unitcode,
                qty: r_qty
            },function(content){
                var result = eval('(' + content + ')');
                if (result.success) {
                    $.messager.show({
                        title:'Saving Status',
                        msg:'Succesfull...',
                        timeout:3000,
                        showType:'slide'
                    });
                    $('#mw_add_detail_jo').datagrid('reload');
                    $('#materialwithdrawdetail').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            });
        }else{
            $.messager.alert('Out of Outstanding', 'Out of outstanding for Item request below:\n'+msg, 'error');
        }
    }else{
        $.messager.alert('Nothing to save', 'Please set qty to request', 'warning');
    }
}

function materialwithdrawdetail_save() {
    $('#materialwithdrawdetail-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#materialwithdrawdetail-form').dialog('close');
                $('#materialwithdrawdetail').datagrid('reload');
            } else {
                $.messager.alert('Save Error', result.msg, 'error');
            }
        }
    });
}

function materialwithdrawdetail_update_from_jo(){
    //alert(url);
    $('#materialwithdrawdetail_from_jo-input').form('submit', {
        url: url,
        onSubmit: function() {
            return $(this).form('validate');
        },
        success: function(content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#materialwithdrawdetail').datagrid('reload');
            } else {
                $.messager.alert('Save Error', result.msg, 'error');
            }
        }
    });
}

var mrp_frst_id = 0;
function materialwithdrawdetail_edit() {
    var row = $('#materialwithdrawdetail').datagrid('getSelected');
    if (row !== null) {
        if(row.joborderid != 0){
            var row_jo = $('#materialwithdraw').datagrid('getSelected');
            mrp_frst_id = row.mrpid;
            $('#global_dialog').dialog({
                title: 'Edit Item',
                width: 450,
                height: 'auto',
                closed: false,
                cache: false,
                top: 100,
                href: base_url + 'materialwithdrawdetail/edit_from_joborder/'+row_jo.joborderid,
                modal: true,
                resizable: true,
                buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        materialwithdrawdetail_update_from_jo();
                    }
                },
                {
                    text: 'Close',
                    iconCls: 'icon-remove',
                    handler: function () {
                        $('#global_dialog').dialog('close');
                    }
                }
                ],
                onLoad:function(){
                    $('#mrdetail_itemid_from_jo').val(row.itemid);
                    $('#mrdetail_code_from_jo').val(row.itemcode);
                    $('#mrdetail_description_from_jo').val(row.itemdescription);
                    $('#mrdetail_unitcode_from_jo').val(row.unitcode);                    
                    var ots = parseFloat(row.ots_withdraw) + parseFloat(row.qty)
                    $('#ots_qty_from_jo').val(ots);
                    $('#mrpid_').val(row.mrpid);
                    $('#qty_from_jo').numberbox('setValue',row.qty);
                    $('#mrdetail_qty_inputed').val(row.qty);
                }
            }).dialog('hcenter');
        }else{
            $('#materialwithdrawdetail-form').dialog('open').dialog('setTitle', 'Edit Item');
            $('#materialwithdrawdetail-input').form('load', row);
        }        
        url = base_url + 'materialwithdrawdetail/update/' + row.id;
    } else {
        $.messager.alert('No Item Choosed', 'Please Choose Item Requisition', 'error');
    }
}

function materialwithdraw_dialog_item_search_from_jo(joborderid){
    $('#mw_dialog').dialog({
        title: 'Add Item to Requisition',
        width: 700,
        height: 'auto',
        closed: false,
        cache: false,
        top: 100,
        href: base_url + 'materialwithdraw/dialog_item_search_from_jo/'+joborderid,
        modal: true,
        resizable: true,
        buttons: [
        {
            text: 'Close',
            iconCls: 'icon-remove',
            handler: function () {
                $('#mw_dialog').dialog('close');
            }
        }
        ]
    }).dialog('hcenter');
}

function materialwithdrawdetail_set_selected_from_mrp(){
    var row = $('#mrp_list_to_request').datagrid('getSelected');
    if(row !== null){
        $('#mrdetail_itemid_from_jo').val(row.itemid);
        $('#mrdetail_code_from_jo').val(row.itemcode);
        $('#mrdetail_description_from_jo').val(row.itemdescription);
        $('#mrdetail_unitcode_from_jo').val(row.unitcode);
        $('#mrpid_').val(row.id);                    
        if(mrp_frst_id === row.id){
            var new_ots = parseFloat($('#mrdetail_qty_inputed').val()) + parseFloat(row.ots_withdraw);
            $('#ots_qty_from_jo').val(new_ots);
        }else{
            $('#ots_qty_from_jo').val(row.ots_withdraw);
        }
        $('#mw_dialog').dialog('close');
    }
}

function materialwithdrawdetail_delete() {
    var row = $('#materialwithdrawdetail').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function(r) {
            if (r) {
                $.post(base_url + 'materialwithdrawdetail/delete', {
                    id: row.id
                }, function(result) {
                    if (result.success) {
                        $('#materialwithdrawdetail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('No Item Choosed', 'Please Choose Item', 'error');
    }
}