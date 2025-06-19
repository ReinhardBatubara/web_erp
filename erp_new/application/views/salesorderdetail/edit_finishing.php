<div style="width: 100%;height: 160px">    
    <table id="salesorderdetail_model_finishing_seen" 
           class="easyui-datagrid"
           url='<?php echo site_url('salesorder/detail_get_finishingseen/' . $salesorderdetailid) ?>'
           title='FINISHING SEEN FACES'           
           method ='post'
           pagination = 'true'
           border = 'false'
           singleSelect = 'true'
           fit ='true'
           rownumbers = 'true'
           fitColumns = 'true'
           idField= 'id'
           >
        <thead>
            <tr>
                <th field="id" hidden="true"></th>
                <th field="description" width="200" halign="center">Description</th>
                <th field="finishingtypeid" width="200" halign="center" data-options="
                    formatter:function(value,row){
                    return row.finishingtypename;
                    },
                    editor:{
                    type:'combobox',
                    options:{
                    valueField:'finishingtypeid',
                    textField:'finishingtypename',
                    method:'post',
                    url:'<?php echo site_url('finishingtype/get_by_position2/1') ?>',
                    required:true
                    }
                    }
                    ">Finishing Type</th>            
            </tr>
        </thead>
    </table>
    <script type="text/javascript">
        var index_seen_face = undefined;
        $(function() {
            $('#salesorderdetail_model_finishing_seen').datagrid({
                onDblClickRow: function(index, row) {
                    if(index != index_seen_face){
                        if(index_seen_face != undefined){
                            var ed_seen_face = $('#salesorderdetail_model_finishing_seen').datagrid('getEditor', {index: index_seen_face, field: 'finishingtypeid'});
                            if(ed_seen_face !== null){
                                var finishingtypename = $(ed_seen_face.target).combobox('getText');
                                $('#salesorderdetail_model_finishing_seen').datagrid('getRows')[index_seen_face]['finishingtypename'] = finishingtypename;
                            }
                            $('#salesorderdetail_model_finishing_seen').datagrid('endEdit', index_seen_face);
                        }
                        $('#salesorderdetail_model_finishing_seen').datagrid('beginEdit', index);
                    }
                    index_seen_face = index;
                }
            });
        });
    </script>
</div>
<div style = "width: 100%;height: 160px">
    <table id="salesorderdetail_model_finishing_top" 
           class="easyui-datagrid"
           url='<?php echo site_url('salesorder/detail_get_finishingtop/' . $salesorderdetailid) ?>'
           title='FINISHING TOP'
           method ='post'
           pagination = 'true'
           border = 'false'
           singleSelect = 'true'
           fit ='true'
           rownumbers = 'true'
           fitColumns = 'true'
           idField= 'id'
           >
        <thead>
            <tr>
                <th field="id" hidden="true"></th>
                <th field="description" width="200" halign="center">Description</th>
                <th field="finishingtypeid" width="200" halign="center" data-options="
                    formatter:function(value,row){
                    return row.finishingtypename;
                    },
                    editor:{
                    type:'combobox',
                    options:{
                    valueField:'finishingtypeid',
                    textField:'finishingtypename',
                    method:'post',
                    url:'<?php echo site_url('finishingtype/get_by_position2/2') ?>',
                    required:true
                    }
                    }
                    ">Finishing Type</th>            
            </tr>
        </thead>
    </table>
    <script type="text/javascript">
        var index_top = undefined;
        $(function() {
            $('#salesorderdetail_model_finishing_top').datagrid({
                onDblClickRow: function(index, row) {
                    if(index != index_top){
                        if(index_top != undefined){
                            var ed_top = $('#salesorderdetail_model_finishing_top').datagrid('getEditor', {index: index_top, field: 'finishingtypeid'});
                            if(ed_top !== null){
                                var finishingtypename = $(ed_top.target).combobox('getText');
                                $('#salesorderdetail_model_finishing_top').datagrid('getRows')[index_top]['finishingtypename'] = finishingtypename;
                            }
                            $('#salesorderdetail_model_finishing_top').datagrid('endEdit', index_top);
                        }
                        $('#salesorderdetail_model_finishing_top').datagrid('beginEdit', index);                        
                    }
                    index_top = index;
                }
            });
        });
    </script>
</div>
<div style = "width: 100%;height: 160px">
    <table id="salesorderdetail_model_finishing_unseen" 
           class="easyui-datagrid"
           url='<?php echo site_url('salesorder/detail_get_finishingunseen/' . $salesorderdetailid) ?>'
           title='FINISHING BACK & UNSEEN'
           method ='post'
           pagination = 'true'
           border = 'true'
           singleSelect = 'true'
           fit ='true'
           rownumbers = 'true'
           fitColumns = 'true'
           idField= 'id'
           >
        <thead>
            <tr>
                <th field="id" hidden="true"></th>
                <th field="description" width="200" halign="center">Description</th>
                <th field="finishingtypeid" width="200" halign="center" data-options="
                    formatter:function(value,row){
                    return row.finishingtypename;
                    },
                    editor:{
                    type:'combobox',
                    options:{
                    valueField:'finishingtypeid',
                    textField:'finishingtypename',
                    method:'post',
                    url:'<?php echo site_url('finishingtype/get_by_position2/3') ?>',
                    required:true
                    }
                    }
                    ">Finishing Type</th>            
            </tr>
        </thead>
    </table>
    <script type="text/javascript">
        var index_unseen_face = undefined;
        $(function() {
            $('#salesorderdetail_model_finishing_unseen').datagrid({
                onDblClickRow: function(index, row) {
                    if(index != index_unseen_face){
                        if(index_unseen_face != undefined){
                            var ed_unseen_face = $('#salesorderdetail_model_finishing_unseen').datagrid('getEditor', {index: index_unseen_face, field: 'finishingtypeid'});
                            if(ed_unseen_face !== null){
                                var finishingtypename = $(ed_unseen_face.target).combobox('getText');
                                $('#salesorderdetail_model_finishing_unseen').datagrid('getRows')[index_unseen_face]['finishingtypename'] = finishingtypename;
                            }
                            $('#salesorderdetail_model_finishing_unseen').datagrid('endEdit', index_unseen_face);
                        }
                        $('#salesorderdetail_model_finishing_unseen').datagrid('beginEdit', index);                        
                    }
                    index_unseen_face = index;
                }
            });
        });
    </script>
</div>
