<div id="tracking_remark_toolbar" style="padding-bottom: 0;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="tracking_add_remark(<?php echo $joborderitembarcodeid ?>)"> Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="tracking_edit_remark()"> Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="tracking_delete_remark()"> Delete</a>
</div>
<table id="tracking_remark" data-options="
       url:'<?php echo site_url('tracking/remark_get/' . $joborderitembarcodeid) ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:false,
       pagination:true,
       striped:true,
       nowrap:false,
       toolbar:'#tracking_remark_toolbar'">
    <thead>
        <tr>
            <th field="notes" width="450">Detail</th>            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#tracking_remark').datagrid();
    });
</script>

