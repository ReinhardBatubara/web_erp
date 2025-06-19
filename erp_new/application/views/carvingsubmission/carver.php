<div id="carvingsubmission_carver_toolbar" style="padding-bottom: 2px;">  
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="carvingsubmission_carver_add" onclick="carvingsubmission_carver_add()">Add</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="carvingsubmission_carver_delete" onclick="carvingsubmission_carver_delete()">Delete</a>
</div>
<table id="carvingsubmission_carver" data-options="
       url:'<?php echo site_url('carvingsubmission/carver_get') ?>',
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
       toolbar:'#carvingsubmission_carver_toolbar'">
    <thead>
        <tr> 
            <th field='carver_chck' checkbox='true'></th>
            <th field="name" width="200">Name</th>            
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function () {
        $('#carvingsubmission_carver').datagrid({
            onSelect: function (value, row, index) {
                $('#carvingsubmission_list_item').datagrid('load', {
                    carvingsubmissionperiodid: row.carvingsubmissionperiodid,
                    carvingsubmissioncarverid: row.id
                });
            }
        });
    });
</script>
<?php
$this->load->view('carvingsubmission/carver_input_form');
