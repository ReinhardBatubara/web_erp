/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// function users_search() {
//     $('#users').datagrid('reload', {
//         id_name: $('#users_name_s').val()
//     });
// }

function users_search() {
        $('#users').datagrid('load', {
            // Ambil value dari input search dan kirim sebagai 'id_name'
            id_name: $('#users_name_s').val()
        });
    }

function users_add() {
    $('#users-form').dialog('open').dialog('setTitle', ' New User');
    $('#users-input').form('clear');
    url = base_url + 'users/save';
}
function users_save() {
    if ($('#users-input').form('validate')) {
        var password = $('#u-password').val();
        var re_password = $('#u-re-password').val();
        if (password !== re_password) {
            $.messager.alert('Password not match', 'Please type correct password', 'error');
        } else {
            $('#users-input').form('submit', {
                url: url,
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (content) {
                    //            alert(content);
                    var result = eval('(' + content + ')');
                    if (result.success) {
                        $('#users-form').dialog('close');
                        $('#users').datagrid('reload');
                        $.messager.show({
                            title: 'Notification',
                            msg: 'Add new user successfull!!',
                            timeout: 5000,
                            showType: 'slide'
                        });
                    } else {
                        $.messager.alert('Error', result.msg, 'error');
                    }
                }
            });
        }
    }
}

function users_change_password_by_admin(id) {

    $('#user_dialog').dialog({
        title: 'Change Password',
        width: 350,
        height: 'auto',
        closed: false,
        cache: false,
        href: base_url + 'users/change_password_by_admin',
        modal: true,
        buttons: [{
                text: 'Save',
                iconCls: 'icon-ok',
                handler: function () {
                    if ($('#users-change-password').form('validate')) {

                        var newpassword = $('#u-newpassword').val();
                        var re_newpassword = $('#u-re-newpassword').val();
                        if (newpassword === re_newpassword) {

                            $.post(base_url + 'users/do_change_password_by_admin', {
                                id: id,
                                newpassword: newpassword
                            }, function (content) {
                                var result = eval('(' + content + ')');
                                if (result.success) {
                                    $('#user_dialog').dialog('close');
                                    $.messager.show({
                                        title: 'Notification',
                                        msg: 'Change Password Successfull',
                                        timeout: 5000,
                                        showType: 'slide'
                                    });
                                } else {
                                    $.messager.alert('Error', result.msg, 'error');
                                }
                            });
                        } else {
                            $.messager.alert('Password not match', 'Please type correct password', 'error');
                        }
                    }
                }
            }, {
                text: 'Cancel',
                iconCls: 'icon-cancel',
                handler: function () {
                    $('#user_dialog').dialog('close');
                }
            }]
    });
}

function users_disable(id) {
    $.messager.confirm('Confirm', 'Are you sure you want to disable this user?', function (r) {
        if (r) {
            $.post(base_url + 'users/disable', {
                id: id
            }, function (result) {
                if (result.success) {
                    $('#users').datagrid('reload');
                    $.messager.show({
                        title: 'Notification',
                        msg: 'User has been disabled',
                        timeout: 5000,
                        showType: 'slide'
                    });
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }, 'json');
        }
    });
}

function users_enable(id) {
    $.messager.confirm('Confirm', 'Are you sure you want to enable this user?', function (r) {
        if (r) {
            $.post(base_url + 'users/enable', {
                id: id
            }, function (result) {
                if (result.success) {
                    $('#users').datagrid('reload');
                    $.messager.show({
                        title: 'Notification',
                        msg: 'User has been enable',
                        timeout: 5000,
                        showType: 'slide'
                    });
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }, 'json');
        }
    });
}

function users_delete(id) {
    $.messager.confirm('Confirm', 'Are you sure you want to Delete this user?', function (r) {
        if (r) {
            $.post(base_url + 'users/delete', {
                id: id
            }, function (result) {
                if (result.success) {
                    $('#users').datagrid('reload');
                    $.messager.show({
                        title: 'Notification',
                        msg: 'User has been Deleted',
                        timeout: 5000,
                        showType: 'slide'
                    });
                } else {
                    $.messager.alert('Error', result.msg, 'error');
                }
            }, 'json');
        }
    });
}

function users_edit_privilege(id, departmentid) {
    $('#user_privilege_dialog').dialog({
        title: 'Edit Privilege',
        width: 800,
        height: 600,
        closed: false,
        cache: false,
        href: base_url + 'users/edit_privilege/' + id + '/' + departmentid,
        modal: true,
        resizable: true
    });
}

function user_privilege_click_menu(element, number_subaction) {
    var user_id = $('#privilege_user_id').val();
    var scriptview = $("#" + element).val();
    if ($("#" + element).is(":checked")) {
        for (var i = 0; i < number_subaction; i++) {
            $('#' + element + i).prop("disabled", false);
        }

        $('#o_v_1_' + element).prop("disabled", false);
        $('#o_v_2_' + element).prop("disabled", false);
        $('#o_v_3_' + element).prop("disabled", false);

        $.post(base_url + 'users/action_set_menu', {
            type: 1,
            userid: user_id,
            scriptview: scriptview
        }, function () {

        });

    } else {
        for (var i = 0; i < number_subaction; i++) {
            $('#' + element + i).attr('checked', false);
            $('#' + element + i).prop("disabled", true);
        }

        $('#o_v_1_' + element).prop("disabled", true);
        $('#o_v_2_' + element).prop("disabled", true);
        $('#o_v_3_' + element).prop("disabled", true);

        $.post(base_url + 'users/action_set_menu', {
            type: 2,
            userid: user_id,
            scriptview: scriptview
        }, function () {

        });
    }
}

function user_action_set(element, scriptview) {
    var user_id = $('#privilege_user_id').val();
    var action = $(element).val();
    if ($(element).is(":checked")) {
        $.post(base_url + 'users/action_set', {
            type: 1,
            userid: user_id,
            scriptview: scriptview,
            action: action
        }, function () {

        });
    } else {
        $.post(base_url + 'users/action_set', {
            type: 2,
            userid: user_id,
            scriptview: scriptview,
            action: action
        }, function () {

        });
    }
}

function user_privilege_option_view(element, scriptview) {
    var user_id = $('#privilege_user_id').val();
    var action = $(element).val();

    $.post(base_url + 'users/privilege_option_view', {
        userid: user_id,
        scriptview: scriptview,
        value: action
    }, function () {

    });
}