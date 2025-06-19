<div class="easyui-layout" data-options="fit:true">        
    <div data-options="region:'center'" title="Material Withdraw">
        <div id="materialwithdraw_toolbar" style="padding-bottom: 0px;min-height: 25px">
            <form id="materialwithdraw_search_form" method="post" novalidate onsubmit="return false;">
                <table border="0">
                    <tr>
                        <td><label class="field_label">MW No# :</label></td>
                        <td>
                            <input type="text" size="8" class="easyui-validatebox" id="mw_number_s" onkeypress="if (event.keyCode === 13) {
                          materialwithdraw_search();
                      }"/>
                        </td>
                        <td><label class="field_label">Date From :</label></td>
                        <td>
                            <input type="text" size="11" class="easyui-datebox" name="datefrom" id="mr_datefrom_s" data-options="formatter:myformatter,parser:myparser"/>
                            <label class="field_label">To : </label>
                            <input type="text" size="11" class="easyui-datebox" name="dateto" id="mr_dateto_s" data-options="formatter:myformatter,parser:myparser"/>
                        </td>
                        <td><label class="field_label">Department :</label></td>
                        <td>
                            <select class="easyui-combobox" name="departmentid" id="mr_departmentid_s" panelWidth="150" style="width: 100px"  data-options="onChange:function(n,o){materialwithdraw_search()}">
                                <option></option>
                                <?php
                                foreach ($department as $result) {
                                    echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>JO Number</td>
                        <td>
                            <input type="text" 
                                   class="easyui-validatebox" 
                                   name="jonumber"
                                   style="width: 100px;margin: 0 10px 0 0px;"
                                   onkeyup="if (event.keyCode === 13) {
                                 materialwithdraw_search();
                             }" 
                                   />

                        </td>
                        <td style="padding-top: 10px">
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="materialwithdraw_search()">Find</a>
                            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="$('#materialwithdraw_search_form').form('clear');
                      materialwithdraw_search()" style="float: right">Clear</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10">
                            <?php if (in_array('add', $action)) { ?>
                                <a href = "javascript:void(0)" class = "easyui-linkbutton" id = 'mw-add' iconCls = "icon-add" plain = "true" onclick = "materialwithdraw_add()">Add</a>
                            <?php } if (in_array('edit', $action)) { ?>
                                <a href = "javascript:void(0)" class = "easyui-linkbutton" id = 'mw-edit' iconCls = "icon-edit" plain = "true" onclick = "materialwithdraw_edit()">Edit</a>
                            <?php } if (in_array('delete', $action)) { ?>
                                <a href = "javascript:void(0)" class = "easyui-linkbutton" id = 'mw-remove' iconCls = "icon-remove" plain = "true" onclick = "materialwithdraw_delete()">Delete</a>
                            <?php } if (in_array('add', $action)) { ?>
                                <a href = "javascript:void(0)" class = "easyui-linkbutton" id = 'mw-submit' iconCls = "icon-process_approve" plain = "true" onclick = "materialwithdraw_submit()">Submit>></a>
                            <?php } ?>
                            <!--              <a id="materialwithdraw_menu_search" href="#" class = "easyui-linkbutton" plain = "true" iconCls = "icon-search" style = "float: right;"></a>-->
                        </td>
                    </tr>
                </table>   
            </form>
        </div>
        <table id = "materialwithdraw"></table>
        <script type = "text/javascript">
            $(function () {
                $('#materialwithdraw').datagrid({
                    url: '<?php echo site_url('materialwithdraw/get') ?>',
                    method: 'post',
                    singleSelect: true,
                    fit: true,
                    pageSize: 30,
                    pageList: [30, 50, 70, 90, 110],
                    border: false,
                    rownumbers: true,
                    fitColumns: true,
                    pagination: true,
                    striped: true,
                    sortName: 'number',
                    sortOrder: 'desc',
                    toolbar: '#materialwithdraw_toolbar',
                    columns: [[
                            {field: 'id', hidden: true},
                            {field: 'mw_chck', checkbox: true},
                            {field: 'number', title: 'MW NO', sortable: true, width: 100, halign: 'center', styler: function (value, row, index) {
                                    if (row.submited == 'f') {
                                        return 'color:#660000;';
                                    }
                                }},
                            {field: 'joborder_no', title: 'JO NO', sortable: true, width: 100, halign: 'center'},
                            {field: 'date', title: 'Date', formatter: myFormatDate, sortable: true, width: 100, align: 'center'},
                            {field: 'departmentid', title: 'Department', sortable: true, formatter: function (value, row, index) {
                                    return row.department
                                }, width: 150, halign: 'center'},
                            {field: 'employeerequest', title: 'Requested By', sortable: true, width: 170, halign: 'center'},
                            {field: 'must_receive_at', formatter: myFormatDate, sortable: true, sortable:true, title: 'Must Receive At', width: 100, align: 'center'},
                            {field: 'submited', formatter: function (value, row, index) {
                                    return (value == 'f' ? 'Not Submitted' : 'Submitted')
                                }, sortable: true, title: 'Status', width: 120, halign: 'center'},
                            {field: 'remark', title: 'Remark', width: 300, halign: 'center'},
                        ]],
                    rowStyler: function (index, row) {
                        if (row.submited == 'f') {
                            return 'background-color:#ffecec;'; // return inline style                            
                        }
                    },
                    onSelect: function (value, row, index) {
                        //alert(row.id);
                        $('#materialwithdrawdetail').datagrid({
                            url: '<?php echo site_url('materialwithdrawdetail/get') ?>',
                            queryParams: {
                                materialwithdrawid: row.id
                            }
                        });
                        $('#stockout_wating_to_receive').datagrid('reload', {
                            materialwithdrawid: row.id
                        });
                        if (userid === row.requestedby) {
                            if (row.submited === 'f') {
                                $('#mw-edit').linkbutton('enable');
                                $('#mw-remove').linkbutton('enable');
                                $('#mw-submit').linkbutton('enable');

                                $('#mwd-add').linkbutton('enable');
                                $('#mwd-edit').linkbutton('enable');
                                $('#mwd-remove').linkbutton('enable');
                            } else {
                                $('#mw-edit').linkbutton('disable');
                                $('#mw-remove').linkbutton('disable');
                                $('#mw-submit').linkbutton('disable');

                                $('#mwd-add').linkbutton('disable');
                                $('#mwd-edit').linkbutton('disable');
                                $('#mwd-remove').linkbutton('disable');
                            }
                            $('#btn_stockout_receive').linkbutton('enable');
                        } else {
                            $('#mw-edit').linkbutton('disable');
                            $('#mw-remove').linkbutton('disable');
                            $('#mw-submit').linkbutton('disable');

                            $('#mwd-add').linkbutton('disable');
                            $('#mwd-edit').linkbutton('disable');
                            $('#mwd-remove').linkbutton('disable');
                            $('#btn_stockout_receive').linkbutton('disable');
                        }

                    }
                }).datagrid('getPager').pagination({
                    pageList: [30, 50, 70, 90, 110]
                });

                $('#materialwithdraw_menu_search').tooltip({
                    position: 'left',
                    content: function () {
                        return $('#materialwithdraw_dialog_search');
                    },
                    showEvent: 'click',
                    onShow: function () {
                        var t = $(this);
                        t.tooltip('tip').unbind().bind('mouseenter', function () {
                            t.tooltip('show');
                        });
                    }
                });
            });
        </script>
    </div>
    <div data-options="region:'south'" split='true' style="height: 250px" border='false'>
        <div class="easyui-layout" data-options="fit:true"> 
            <div data-options="region:'center'" title="Item to Withdraw" href="<?php echo site_url('materialwithdrawdetail') ?>"></div>
            <div data-options="region:'east'" title="Stock Out Receive" split='true' href="<?php echo site_url('stockout/waiting_to_receive') ?>" style="width: 500px;" collapsible='false'>

            </div>
        </div>
    </div>
</div>
<div style="display:none">
    <div id="materialwithdraw_dialog_search">
        <?php $this->load->view('materialwithdraw/dialog_search'); ?>
    </div>
</div>
<div id="mw_dialog"></div>
<?php
$this->load->view('materialwithdraw/add');
