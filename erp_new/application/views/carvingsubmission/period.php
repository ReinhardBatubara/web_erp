<div id="carvingsubmission_period_toolbar" style="padding-bottom: 2px;">  
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="carvingsubmission_period_add" onclick="carvingsubmission_period_add()">Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="carvingsubmission_period_edit"  onclick="carvingsubmission_period_edit()">Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="carvingsubmission_period_delete" onclick="carvingsubmission_period_delete()">Delete</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-excel" plain="true" id="carvingsubmission_period_excel" onclick="carvingsubmission_period_excel()">Excel</a>
</div>
<table id="carvingsubmission_period" data-options="
       url:'<?php echo site_url('carvingsubmission/period_get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       pageSize:30,
       pageList: [30, 50, 70, 90, 110],
       rownumbers:true,
       fitColumns:true,
       pagination:true,
       striped:true,
       idField:'id',
       toolbar:'#carvingsubmission_period_toolbar'">
    <thead>
        <tr> 
            <th field='period_chck' checkbox='true'></th>
            <th field="startdate" width="70" align="center" formatter="myFormatDate">Start Date</th>
            <th field="stopdate" width="70" align="center" formatter="myFormatDate">Stop Date</th>
            <th field="week" width="40" align="center">Week</th>
            <th field="remark" width="200">Remark</th>            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#carvingsubmission_period').datagrid({
            onSelect: function (value, row, index) {
                $('#carvingsubmission_carver').datagrid('load', {
                    carvingsubmissionperiod_id: row.id
                });
            }
        });
    });
</script>
<?php
$this->load->view('carvingsubmission/period_input_form');
