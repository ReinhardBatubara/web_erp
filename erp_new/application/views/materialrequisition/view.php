<div id="materialrequisition_toolbar" style="padding-bottom: 0px;">
    <form id="materialrequisition_search_form" method="post" novalidate onsubmit="return false;" style="margin: 0">
        <label class="field_label">MR :</label></td>
        <input type="text" size="8" class="easyui-validatebox" name="number" id="mr_number_s" onkeypress="if (event.keyCode === 13) {
                    materialrequisition_search();
                }"/>
        <label class="field_label">Date From :</label>
        <input type="text" size="11" class="easyui-datebox" name="datefrom" id="mr_datefrom_s" data-options="formatter:myformatter,parser:myparser"/>
        <label class="field_label">To : </label>
        <input type="text" size="11" class="easyui-datebox" name="dateto" id="mr_dateto_s" data-options="formatter:myformatter,parser:myparser"/>
        <label class="field_label">Department :</label>
        <select class="easyui-combobox" name="departmentid" id="mr_departmentid_s" panelWidth="150" style="width: 100px"  data-options="onChange:function(n,o){materialrequisition_search()}">
            <option></option>
            <?php
            foreach ($department as $result) {
                echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
            }
            ?>
        </select>
        JO Number
        <input type="text" 
               class="easyui-validatebox" 
               name="jonumber"
               style="width: 100px;margin: 0 10px 0 0px;"
               onkeyup="if (event.keyCode === 13) {
                           materialrequisition_search();
                       }" 
               />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="materialrequisition_search()">Find</a>
        <!--                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-clear" plain="true" onclick="$('#materialrequisition_search_form').form('clear');
                                materialrequisition_search()" style="float: right">Clear</a>-->

        <?php if (in_array('add', $action)) { ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" id='mr-add' iconCls="icon-add" plain="true" onclick="materialrequisition_add()">Add</a>
        <?php }if (in_array('create_from_jo', $action)) { ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" id='mr-add' iconCls="icon-add2" plain="true" onclick="materialrequisition_add_from_jo()">Create from JO</a>
        <?php }if (in_array('edit', $action)) { ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" id='mr-edit' iconCls="icon-edit" plain="true" onclick="materialrequisition_edit()">Edit</a>
        <?php }if (in_array('delete', $action)) { ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" id='mr-remove' iconCls="icon-remove" plain="true" onclick="materialrequisition_delete()">Delete</a>
        <?php }if (in_array('add', $action)) { ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" id='mr-send' iconCls="icon-process_approve" plain="true" onclick="materialrequisition_send()">Submit>></a>
        <?php } ?>
        <!--            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-outstanding" plain="true" onclick="materialrequisition_outstanding()">Outstanding Purchase</a>
        <a id="materialrequisition_menu_search" href="#" class="easyui-linkbutton" plain="true" iconCls="icon-search" style="float: right;"></a>-->

    </form>
</div>
<table id="materialrequisition">
</table>
<script type="text/javascript">
    $(function () {
        $('#materialrequisition').datagrid({
            url: '<?php echo site_url('materialrequisition/get') ?>',
            method: 'post',
            singleSelect: true,
            fit: true,
            pageSize: 30,
            pageList: [30, 50, 70, 90, 110],
            border: false,
            rownumbers: true,
            fitColumns: false,
            pagination: true,
            striped: true,
            toolbar: '#materialrequisition_toolbar',
            columns: [[
                    {field: 'mr_chck', checkbox: true},
                    {field: 'number', title: 'MR NO', width: 80, sortable: true, halign: 'center'},
                    {field: 'date', title: 'Date', sortable: true, formatter: myFormatDate, width: 70, align: 'center'},
                    {field: 'departmentid', title: 'Department', sortable: true, formatter: function (value, row, index) {
                            return row.department
                        }, width: 150, halign: 'center'},
                    {field: 'job_no', title: 'JO NO / Nota', sortable: true, width: 100, align: 'center'},
                    {field: 'project_name', title: 'Project Name', sortable: true, width: 120, halign: 'center'},
                    {field: 'required_date', title: 'Required Date', formatter: myFormatDate, sortable: true, width: 100, align: 'center'},
                    {field: 'employeerequest', title: 'Requested By', width: 150, halign: 'center'},
                    {field: 'status_label', sortable: true, title: 'Status', width: 80, halign: 'center'},
                    {field: 'remark', title: 'Remark', width: 200, halign: 'center'}
                ]],
            rowStyler: function (index, row) {
                if (row.status === '0') {
                    return 'background-color:#ffecec;'; // return inline style                            
                }
            },
            onSelect: function (value, row, index) {
                $('#materialrequisitiondetail').datagrid({
                    url: '<?php echo site_url('materialrequisitiondetail/get') ?>',
                    queryParams: {
                        materialrequisitionid: row.id
                    }
                });

                if (row.status === '0') {
                    $('#mr-edit').linkbutton('enable');
                    $('#mr-remove').linkbutton('enable');
                    $('#mr-send').linkbutton('enable');

                    $('#mrd-add').linkbutton('enable');
                    $('#mrd-add2').linkbutton('enable');
                    $('#mrd-add-others').linkbutton('enable');
                    $('#mrd-edit').linkbutton('enable');
                    $('#mrd-remove').linkbutton('enable');
                    if (row.joborderid !== '0') {
                        $('#mrd-add2').linkbutton('enable');
                        $('#mrd-add-others').linkbutton('enable');
                    } else {
                        $('#mrd-add2').linkbutton('disable');
                        $('#mrd-add-others').linkbutton('disable');
                    }
                } else {
                    $('#mr-edit').linkbutton('disable');
                    $('#mr-remove').linkbutton('disable');
                    $('#mr-send').linkbutton('disable');

                    $('#mrd-add').linkbutton('disable');
                    $('#mrd-add2').linkbutton('disable');
                    $('#mrd-add-others').linkbutton('disable');
                    $('#mrd-edit').linkbutton('disable');
                    $('#mrd-remove').linkbutton('disable');
                }
            }
        });

        $('#materialrequisition_menu_search').tooltip({
            position: 'bottom',
            content: $('<div></div>'),
            showEvent: 'click',
            hideEvent: 'none',
            deltaX: -150,
            onUpdate: function (content) {
                content.panel({
                    width: 320,
                    border: true,
                    title: 'Search',
                    href: base_url + 'materialrequisition/search_form'
                });
            },
            onShow: function () {
                var t = $(this);
                t.tooltip('tip').unbind().bind('mouseenter', function () {
                    t.tooltip('show');
                });
            }
        });
    });
</script>
