<div id="job_outsource_outstanding_toolbar" style="padding-bottom: 0;">
    <form id="job_outsource_outstanding_form_search" style="margin-bottom: 0px">
        JO
        <input type="text" 
               size="10" 
               name="jo_no" 
               onkeyup="if (event.keyCode === 13) {
                           job_outsource_outstanding_search();
                       }"/>
        Item 
        <input type="text" 
               size="10" 
               name="item_code_name"
               onkeyup="if (event.keyCode === 13) {
                           job_outsource_outstanding_search();
                       }"/>
        Type
        <select name="type" 
                id="jo_outsource_type" 
                class="easyui-combobox" 
                panelHeight="auto" 
                editable="false" 
                style="width: 80px" 
                dataoptions="onSelect:function(){job_outsource_outstanding_search()}">
            <option value="">All</option>
            <option value="1">Spare part</option>
            <option value="2">Partial</option>
            <option value="3">Full</option>
        </select>
        Vendor
        <input id="vendorid" 
               name="vendorid" 
               class="easyui-combobox" 
               data-options="
               valueField: 'id',
               textField: 'text',
               url: '<?php echo site_url('vendor/get_remote_data') ?>',
               onSelect:function(){job_outsource_outstanding_search()},
               panelWidth:200" 
               mode="remote"
               style="width: 100px" />
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" id='job_outsource_search' plain="true" onclick="job_outsource_outstanding_search()"></a>
    </form>
</div>
<table id="job_outsource_outstanding" data-options="
       url:'<?php echo site_url('joborder/get_all_outsource/1') ?>',
       method:'post',
       title:'Outstanding Receive Job Outsource',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:false,
       pageList: [30, 50, 70, 90, 110],
       pagination:true,
       striped:true,
       toolbar:'#job_outsource_outstanding_toolbar'">
    <thead>
        <tr>
            <th field="joborder_no" width="100" align="center" sortable="true">JO</th>
            <th field="modelcode" width="120" halign="center" sortable="true">Item Code</th>
            <th field="modelname" width="200" halign="center" sortable="true">Item Name</th>            
            <th field="qty" width="50" align="center">Qty</th>
            <th field="outsourcetype" width="80" halign="center" sortable="true">Type</th>
            <th field="vendor" width="180" halign="center" sortable="true">Vendor</th>
            <th field="include_material" width="80" align="center" data-options="formatter:function(value,row,index){return (value == 't' ? 'Yes' : 'No')}">Inc. Mat</th>
        </tr>
    </thead>
</table>

<script type="text/javascript">
    $(function () {
        $('#job_outsource_outstanding').datagrid({});
    });
</script>