<div id="solidwood_toolbar" style="padding-bottom: 2px;">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" id="solidwood_addpath" onclick="solidwood_addpath()">Add Path</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add-child" plain="true" id="solidwood_children" onclick="solidwood_children()">Add Child</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" id="solidwood_edit" onclick="solidwood_edit()">Edit</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" id="solidwood_delete" onclick="solidwood_delete()">Delete</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-arrow-up" plain="true" id="solidwood_make_as_path" onclick="solidwood_make_as_path()">Make as Path</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-arrow-down" plain="true" id="solidwood_make_as_child" onclick="solidwood_make_as_child()">Make as Child</a>
</div>
<table id="solidwood" data-options="
       url:'<?php echo site_url('solidwood/get') ?>',
       method:'post',
       border:false,
       singleSelect:true,
       fit:true,
       title:'Solidwood',
       rownumbers:true,
       fitColumns:false,
       animate:true,
       lines:true,
       striped:true,
       idField: 'id',
       toolbar:'#solidwood_toolbar'"
       treeField="description">
    <thead>
        <tr>
            <th field="description" width="200" halign="center" rowspan="2">Description</th>     
            <th field="code" width="90" align="center" rowspan="2">Material Code</th>
            <th field="materialdescription" width="220" halign="center" rowspan="2">Material Description</th>
            <th width="120" align="center" colspan="3">Finished Size</th>
            <th field="qty" width="50" align="center" rowspan="2" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">Qty</th>
            <th width="120" align="center" colspan="3">Raw Size</th>
            <th width="120" align="center" colspan="2">Wood</th>
            <th field="remark" width="220" halign="center" rowspan="2">Remark</th>
        </tr>
        <tr>
            <th field="finishedsize_l" width="40" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">L</th>
            <th field="finishedsize_w" width="40" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">W</th>
            <th field="finishedsize_t" width="40" align="center" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">T</th>
            <th field="rawsize_l" width="40" align="center" data-options="formatter:function(value,row,index){return (row.finishedsize_l == 0) ? '' : value;}">L</th>
            <th field="rawsize_w" width="40" align="center" data-options="formatter:function(value,row,index){return (row.finishedsize_w == 0) ? '' : value;}">W</th>
            <th field="rawsize_t" width="40" align="center" data-options="formatter:function(value,row,index){return (row.finishedsize_t == 0) ? '' : value;}">T</th>
            <th field="vol_finished" width="80" halign="center" align="right" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">Fin Size M3</th>
            <th field="vol_raw" width="80" halign="center" align="right" data-options="formatter:function(value,row,index){return (value == 0) ? '' : value;}">Raw Size M3</th>
        </tr>
    </thead>
</table>
<script type="text/javascript">
    $(function() {
        $('#solidwood').treegrid();
    });
</script>