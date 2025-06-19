<table id="tracking_history" data-options="
       url:'<?php echo site_url('tracking/history_get/' . $serial) ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       toolbar:'#tracking_history_toolbar'">
    <thead>
        <tr>         
            <th field="process_name" width="150" halign="center">Process Name</th>
            <th field="startdate" width="80" align="center">Start Date</th>
            <th field="stopdate" width="80" align="center">Stop Date</th>
            <th field="duration" width="100" align="center">Duration (days)</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#tracking_history').datagrid({
        }).datagrid('getPager').pagination({
            pageList: [30, 50, 70, 90, 110]
        });
    });
</script>

