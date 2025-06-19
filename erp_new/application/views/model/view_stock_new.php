<div id="model_stock50_toolbar" style="padding-bottom: 0px;">
    <form style="margin-bottom: 0px" id="model_stock50_search_form">
        Model : 
        <input name="modelid" 
               class="easyui-combobox"
               url="<?php echo site_url('model/get') ?>"
               method="post"
               valueField="id"
               textField="name"
               panelHeight="300"
               panelWidth="180"
               data-options="formatter:formatComboModel50,onSelect(o,n){model_search_stock50()}"
               style="width: 140px"
               mode="remote"
               />
        <script type="text/javascript">
            function formatComboModel50(row) {
                return '<span>Code: ' + row.code + '</span><br/>' +
                        '<span>Name: ' + row.name + '</span><br/>' +
                        '<span style="color:#888">Desc:  </span>';
            }
        </script>   
        Process : 
        <input name="processid"
               class="easyui-combobox"
               url="<?php echo site_url('tracking/get_tracking_process_for_combo') ?>"
               mode="remote"
               method="post"
               valueField="id"
               textField="name"
               panelWidth="180"
               panelHeight="auto"
               style="width: 120px"
               data-options="onSelect(){
                model_search_stock50();
               }"
               />
        Serial :
        <input type="text" style="width: 120px" name="serial_number" onkeyup="if(event.keyCode===13){model_search_stock50()}"/>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="model_search_stock50()">Search</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="model_print_stock50()">Print</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="model_add_stock50()">Add</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="model_delete_stock50()">Delete</a>
    </form>
</div>
<table id="model_stock50" data-options="
       url:'<?php echo site_url('model/get_process_stock50') ?>',
       method:'post',
       title:'Process Stock',
       border:true,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       sortName:'id',
       sortOrder:'desc',
       toolbar:'#model_stock50_toolbar'">
    <thead>
        <tr>
            <th field="id" hidden="true"></th>            
            <th field="serial" width="120" halign="center" sortable="true">Serial</th>
            <th field="process_name" width="150" halign="center" sortable="true">Process Name</th>
            <th field="model_name" width="450" halign="center" sortable="true">Model Name</th>
        </tr>
    </thead>
</table>
<script>
    $(function () {
        $('#model_stock50').datagrid({});
    });
</script>

