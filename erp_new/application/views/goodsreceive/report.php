<div style="min-height:100px">
    <form id='gr_report_form' style="margin: 2px;">
        <span style="display: inline-block;padding: 2px;">
            <strong>Start Date : </strong><br/>
            <input type="text" name="start_date" required="required" style="width: 100px" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
        </span>
        <span style="display: inline-block;padding: 2px;">
            <strong>End Date : </strong><br/>
            <input type="text" name="end_date" required="required" style="width: 100px" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"/>
        </span>
        <span style="display: inline-block;padding: 2px;">
            <strong>Vendor : </strong><br/>
            <input type="text" name="vendorid" panelWidth="200" id="gr_vendor_id_s" class="easyui-combobox" data-options="
                   valueField: 'id',
                   textField: 'text',
                   url: '<?php echo site_url('vendor/get_remote_data') ?>'" 
                   mode="remote" style="width: 120px">
        </span>
        <span style="display: inline-block;padding: 2px;">
            <strong>GR No : </strong><br/>
            <input type="text" name="gr_no" class="easyui-textbox" style="width: 120px">
        </span>
        <span style="display: inline-block;padding: 2px;">
            <strong>PO No : </strong><br/>
            <input type="text" name="po_no" class="easyui-textbox" style="width: 120px">
        </span>
        <span style="display: inline-block;padding: 2px;">
            <strong>MR No : </strong><br/>
            <input type="text" name="mr_no" class="easyui-textbox" style="width: 120px">
        </span>
        <span style="display: inline-block;padding: 2px;">
            <strong>MR No : </strong><br/>
            <input type="text" name="mr_no" class="easyui-textbox" style="width: 120px">
        </span>
        <span style="display: inline-block;padding: 2px;">
            <strong>Department : </strong><br/>
            <input class="easyui-combobox" name="departmentid" data-options="
                   url: '<?php echo site_url('department/get') ?>',
                   method: 'post',
                   valueField: 'id',
                   textField: 'name',
                   panelHeight: '200',
                   panelWidth:250"
                   style="width: 150px">
        </span>
        <span style="display: inline-block;padding: 2px;">
            <strong>Item Group : </strong><br/>
            <input class="easyui-combobox" name="groupid" data-options="
                   url: '<?php echo site_url('itemgroup/get') ?>',
                   method: 'post',
                   valueField: 'id',
                   textField: 'name',
                   mode: 'remote',
                   panelHeight: '200',
                   formatter: formatGroup"
                   style="width: 150px"/>
            <script type="text/javascript">
                function formatGroup(row) {
                    var s = '<span style="font-weight:bold">' + row.code + '</span><br/>' +
                            '<span style="color:#888">Name: ' + row.name + '</span><br/>';
                    return s;
                }
            </script>
        </span>
        <span style="display: inline-block;padding: 2px;">
            <strong>Item Description : </strong><br/>
            <input type="text" name="item_description" class="easyui-textbox" style="width: 120px">
        </span><br/>
        <span style="display: inline-block;padding: 2px;">
            <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" onclick="gr_report_preview()">Preview</a>-->
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" onclick="gr_report_print()">Print</a>
            <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-excel" onclick="gr_report_excel()">Excel</a>-->
        </span>
    </form>
</div>
<script>
    function gr_report_print() {
        if ($('#gr_report_form').form('validate')) {
            open_target('POST', base_url + 'goodsreceive/report_generate', $('#gr_report_form').serializeObject(), '_blank');
        }
    }
</script>