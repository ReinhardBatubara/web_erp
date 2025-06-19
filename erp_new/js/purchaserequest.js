/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* global base_url */

function purchaserequest_search() {
    $('#purchaserequest').datagrid('reload', $('#purchaserequest_search-form').serializeObject());
}

function purchaserequest_search2() {
    $('#purchaserequest').datagrid('reload', $('#purchaserequest_search-form2').serializeObject());
}

function purchaserequest_clear_search() {
    $('#purchaserequest_search-form').form('clear');
    purchaserequest_search();
}

function purchaserequest_add() {
    $('#global_dialog').dialog({
        title: 'New Purchase Request',
        width: 400,
        height: 'auto',
        top: 100,
        closed: false,
        cache: false,
        href: base_url + 'purchaserequest/add',
        modal: true,
        resizable: true,
        buttons: [
            {
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    purchaserequest_save()
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
        onLoad: function () {
            $('#purchaserequest-input').form('clear');
        }
    }).dialog('hcenter');
    url = base_url + 'purchaserequest/save';
}

function purchaserequest_save() {
    $('#purchaserequest-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#purchaserequest').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function purchaserequest_edit_information() {
    var row = $('#purchaserequest').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit Purchase Request',
            width: 400,
            height: 'auto',
            top: 100,
            closed: false,
            cache: false,
            href: base_url + 'purchaserequest/add',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        purchaserequest_save()
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
            onLoad: function () {
                $('#purchaserequest-input').form('load', row);
            }
        }).dialog('hcenter');
        url = base_url + 'purchaserequest/update/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose purchase request to edit', 'warning');
    }
}

function purchaserequest_edit_price() {
    var row = $('#purchaserequest').datagrid('getSelected');
    if (row !== null) {
        $('#purchaserequest_edit_price-form').dialog('open').dialog('setTitle', ' Edit Purchase Request Price');
        $('#edit_price_form-input').form('load', row);
        url = base_url + 'purchaserequest/update_price/' + row.id;
    } else {
        $.messager.alert('Waring', 'Choose purchase request to edit', 'warning');
    }
}

function purchaserequest_update_price() {
    if ($(this).form('validate')) {
        var total = $('#edit_price_total').val();
        var discount = $('#edit_price_discount').val();
        var tax = $('#edit_price_tax').val();
        var amount = $('#edit_price_amount').val();
        $.post(url, {
            total: total,
            discount: discount,
            tax: tax,
            amount: amount
        }, function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#purchaserequest').datagrid('reload');
                $('#purchaserequest_edit_price-form').dialog('close');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    }
}

function purchaserequest_comment(purchaserequestid) {
    $('#comment').dialog('open').dialog('setTitle', 'Comment');
    $('#purchaserequestid').val(purchaserequestid);
    purchaserequest_comment_get(purchaserequestid);
}

function purchaserequest_comment_get(purchaserequestid) {
    $.get(base_url + 'purchaserequestcomment/get_comment/' + purchaserequestid, function (content) {
        $('#commentlist').empty();
        $('#commentlist').append(content);
    });
}

function purchaserequest_comment_post() {
    var purchaserequestid = $('#purchaserequestid').val();
    var content = $('#comment_content').val();
    if (content === '') {
        $.messager.alert('No Comment', 'No Comment to Post', 'warning');
    } else {
        $.post(base_url + 'purchaserequestcomment/post', {
            purchaserequestid: purchaserequestid,
            content: content
        }, function (content) {
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#comment_content').val('');
                purchaserequest_comment_get(purchaserequestid);
                $('#purchaserequest').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        });
    }
}

function purchaserequest_comment_delete(id, purchaserequestid) {
    $.messager.confirm('Confirm', 'Are you sure you want to remove this comment?', function (r) {
        if (r) {
            $.post(base_url + 'purchaserequestcomment/delete', {
                id: id
            }, function (result) {
                if (result.success) {
                    $('#comment_content').val('');
                    purchaserequest_comment_get(purchaserequestid);
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }, 'json');
        }
    });
}

function purchaserequest_attachment(purchaserequestid) {
    $('#purchaserequest_attachment').dialog('open').dialog('setTitle', 'Attachment');
    $('#attachment_purchaserequestid').val(purchaserequestid);
    purchaserequest_attachment_get(purchaserequestid);
}

function purchaserequest_attachment_get(purchaserequestid) {
    $.get(base_url + 'purchaserequestattachment/get/' + purchaserequestid, function (content) {
        $('#purchaserequest_attachment_list').empty();
        $('#purchaserequest_attachment_list').append(content);
    });
}

function purchaserequest_attachment_upload() {

    if ($('#purchaserequest-attachment').form('validate')) {
        var purchaserequestid = $('#attachment_purchaserequestid').val();
        var attachment_title = $('#attachment_title').val();
        var attachment_file = $('#attachment_file').val();
        if (attachment_title === '' || attachment_file === '') {

        } else {
//        alert(purchaserequestid + '#' + attachment_title);
            $.ajaxFileUpload({
                url: base_url + 'purchaserequestattachment/upload',
                secureuri: false,
                fileElementId: 'attachment_file',
                dataType: 'json',
                data: {
                    'purchaserequestid': purchaserequestid,
                    'title': attachment_title
                },
                success: function (data, status) {
                    var result = eval('(' + data + ')');
                    if (result.status) {
                        $('#attachment_title').val('');
                        $('#attachment_file').val('');
                        purchaserequest_attachment_get(purchaserequestid);
                        $('#purchaserequest').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                },
                error: function (data, status, e) {
                    console.log(e);
                }
            });
        }
    }
}

function purchaserequest_attachment_delete(id, purchaserequestid, filename) {
    $.messager.confirm('Confirm', 'Are you sure you want to remove this attachment?', function (r) {
        if (r) {
            $.post(base_url + 'purchaserequestattachment/delete', {
                id: id,
                filename: filename
            }, function (result) {
                if (result.success) {
                    purchaserequest_attachment_get(purchaserequestid);
                    $('#purchaserequest').datagrid('reload');
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }, 'json');
        }
    });
}

function purchaserequest_process_to_approve() {
    var row = $('#purchaserequest').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Submit to Process Approval',
            width: 400,
            height: 'auto',
            top: 100,
            closed: false,
            cache: false,
            href: base_url + 'purchaserequestapproval/load_default_approval_dialog',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        purchaserequest_approval_default_save();
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
            onLoad: function () {
                $(this).dialog('center');
                $.get(base_url + 'purchaserequest/get_default_aprroval', function (content) {
                    var data = content.split('#');
                    $('#checked').combogrid('setValue', data[0]);
                    $('#acknowledge').combogrid('setValue', data[1]);
                    $('#approved').combogrid('setValue', data[2]);
                });
            }
        });
        url = base_url + 'purchaserequestapproval/save/' + row.id;
    } else {
        $.messager.alert('No Purchase Request', 'Choose Purchase Request to Process', 'warning');
    }
}

function purchaserequest_config_default_aprroval() {
    $('#global_dialog').dialog({
        title: 'Default Approval',
        width: 400,
        height: 'auto',
        top: 100,
        closed: false,
        cache: false,
        href: base_url + 'purchaserequestapproval/load_default_approval_dialog',
        modal: true,
        resizable: true,
        buttons: [
            {
                text: 'Save',
                iconCls: 'icon-save',
                handler: function () {
                    purchaserequest_approval_default_save();
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
        onLoad: function () {
            $(this).dialog('center');
            $.get(base_url + 'purchaserequest/get_default_aprroval', function (content) {
                var data = content.split('#');
                $('#checked').combogrid('setValue', data[0]);
                $('#acknowledge').combogrid('setValue', data[1]);
                $('#approved').combogrid('setValue', data[2]);
            });
        }
    });
    url = base_url + 'purchaserequest/save_default_aprroval';
}

function purchaserequest_approval_default_save() {
    $('#purchaserequest_approval_default-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#global_dialog').dialog('close');
                $('#purchaserequestapproval').datagrid('reload');
                $('#purchaserequest').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function purchaserequest_approval_action_approve(status) {
    var row = $('#purchaserequest').datagrid('getSelected');
    if (row !== null) {
        if (status === 1) {
            $.messager.confirm('Confirm', 'Are you sure you want to Approve this Request?', function (r) {
                if (r) {
                    $.post(base_url + 'purchaserequestapproval/action_approve/' + row.id + '/' + row.purchaserequestapprovalid + '/' + status, {
                        notes: ''
                    }, function (result) {
                        if (result.success) {
                            $('#purchaserequestapproval').datagrid('reload');
                            $('#purchaserequest').datagrid('reload');
                            if (result.approval_changed == 't') {
                                $('#mm_action_approve').menubutton('disable');
                            }
                        } else {
                            $.messager.alert('Error', result.msg, 'error');
                        }
                    }, 'json');
                }
            });
        } else {
            var msg = '';
            var icon_cls = '';
            if (status === 2) {
                msg = 'Pending';
                icon_cls = 'icon-wait';
            } else {
                msg = 'Reject';
                icon_cls = 'icon-reject';
            }

            $('#global_dialog').dialog({
                title: msg + ' Purchase Request',
                width: 300,
                height: 'auto',
                href: base_url + 'purchaserequestapproval/load_dialog',
                modal: false,
                iconCls: icon_cls,
                resizable: false,
                shadow: false,
                maximizable: true,
                collapsible: true,
                buttons: [{
                        text: 'Save',
                        iconCls: 'icon-save',
                        handler: function () {
                            $('#pending_or_reject-input').form('submit', {
                                url: base_url + 'purchaserequestapproval/action_approve/' + row.id + '/' + row.purchaserequestapprovalid + '/' + status,
                                onSubmit: function () {
                                    return $(this).form('validate');
                                },
                                success: function (content) {
                                    console.log(content);
                                    var result = eval('(' + content + ')');
                                    if (result.success) {
                                        $('#global_dialog').dialog('close');
                                        $('#purchaserequestapproval').datagrid('reload');
                                        $('#purchaserequest').datagrid('reload');
                                    } else {
                                        $.messager.alert('Error', result.msg, 'error');
                                    }
                                }
                            });
                        }
                    }, {
                        text: 'Close',
                        iconCls: 'icon-remove',
                        handler: function () {
                            $('#global_dialog').dialog('close');
                        }
                    }],
                onLoad: function () {

                }
            });

//            $('#pending_or_reject-form').dialog({
//                title: msg + ' Purchase Request',
//                iconCls: icon_cls
//            }).dialog('open');
//            $('#pending_or_reject-input').form('clear');
//            url = base_url + 'purchaserequestapproval/action_approve/' + row.id + '/' + row.purchaserequestapprovalid + '/' + status;
        }
    } else {
        var msg = '';
        if (status === 1) {
            msg = 'Approve';
        } else if (status === 2) {
            msg = 'Pending';
        } else {
            msg = 'Reject';
        }
        $.messager.alert('No Purchase Request', 'Choose Purchase Request to ' + msg, 'warning');
    }
}

function purchaserequest_approval_action_pending_or_reject() {

    $('#pending_or_reject-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            console.log(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#pending_or_reject-form').dialog('close');
                $('#purchaserequestapproval').datagrid('reload');
                $('#purchaserequest').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function purchaserequest_approval_change() {
    var row = $('#purchaserequestapproval').datagrid('getSelected');
    if (row !== null) {
        if (row.status === '0') {
            $('#purchaserequest_approval_change').dialog('open').dialog('setTitle', 'Change Approval');
            url = base_url + 'purchaserequestapproval/do_change/' + row.id;
            $('#employeeid').combogrid('setValue', row.employeeid);
        } else {
            $.messager.alert('No Allowed', 'Not Allowed', 'warning');
        }
    } else {
        $.messager.alert('No Approval Choose', 'Choose Approval', 'warning');
    }
}

function purchaserequest_approval_do_change() {
    $('#purchaserequest_approval_change-input').form('submit', {
        url: url,
        onSubmit: function () {
            return $(this).form('validate');
        },
        success: function (content) {
            //            alert(content);
            var result = eval('(' + content + ')');
            if (result.success) {
                $('#purchaserequest_approval_change').dialog('close');
                $('#purchaserequestapproval').datagrid('reload');
                $('#purchaserequest').datagrid('reload');
            } else {
                $.messager.alert('Error', result.msg, 'error');
            }
        }
    });
}

function purchaserequest_delete() {
    var row = $('#purchaserequest').datagrid('getSelected');
    if (row !== null) {
        $.messager.confirm('Confirm', 'Are you sure you want to remove this data?', function (r) {
            if (r) {
                $.post(base_url + 'purchaserequest/delete', {
                    id: row.id
                }, function (result) {
                    if (result.success) {
                        $('#purchaserequest').datagrid('reload');
                        $('#purchaserequestdetail').datagrid('reload');
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }, 'json');
            }
        });
    } else {
        $.messager.alert('Waring', 'Choose purchase request to delete', 'warning');
    }
}

function purchaserequest_calculate() {

    var edit_price_total = $('#edit_price_total').val() === '' ? 0 : $('#edit_price_total').val();
    var edit_price_discount = $('#edit_price_discount').val() === '' ? 0 : $('#edit_price_discount').val();
    var edit_price_tax = $('#edit_price_tax').val() === '' ? 0 : $('#edit_price_tax').val();
    var total = parseFloat(edit_price_total);
    var discount = parseFloat(edit_price_discount);
    var tax = parseFloat(edit_price_tax);
    var temp_amount = '' + ((total + tax) - discount);
    var amount = parseFloat(temp_amount).toFixed(2);
    $('#edit_price_amount').val(amount);
}

function purchaserequest_by_item_search() {
    $('#pr_by_item').datagrid('reload', $('#purchaserequest_by_item_search-form').serializeObject())
}


function purchaserequest_po_plan_edit() {
    var row = $('#po_plan').datagrid('getSelected');
    if (row !== null) {
        $('#global_dialog').dialog({
            title: 'Edit P.O Planning',
            width: 500,
            height: 'auto',
            top: 100,
            closed: false,
            cache: false,
            href: base_url + 'purchaserequest/po_plan_edit',
            modal: true,
            resizable: true,
            buttons: [
                {
                    text: 'Save',
                    iconCls: 'icon-save',
                    handler: function () {
                        $('#po_plan_edit_form').form('submit', {
                            url: base_url + 'purchaserequest/po_plan_update/' + row.id,
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (content) {
                                //            alert(content);
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#global_dialog').dialog('close');
                                    $('#po_plan').datagrid('reload');
                                    $('#purchaserequest').datagrid('reload');
                                } else {
                                    $.messager.alert('Error', result.msg, 'error');
                                }
                            }
                        });
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
            onLoad: function () {
                $(this).dialog('center');
                $('#po_plan_edit_form').form('load', row);
                if (row.tax_percent !== '0') {
                    $('#ppn_check').prop('checked', true);
                    console.log(row.tax_percent);
                }
            }
        });
    } else {
        $.messager.alert('No P.O Planning Selected', 'Please Select P.O Plan', 'warning');
    }
}
