<div id="costing_tabs" tabPosition="bottom" class="easyui-tabs" data-options="tabHeight:18" fit="true" border="false">
    <div title="Calculation" fit='true' style="border: none" href="<?php echo site_url('costing/view_detail'); ?>">
    </div>
    <div title="Cost Sheet" fit='true' style="border: none">
        <div style="width:100%;height: 25px;background: none repeat scroll 0 0 #e0ecff;">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="costing_print()">Print</a>
        </div>
        <div id="t_cost_sheet" style="padding: 5px;">
        </div>
    </div>
    <div title="BOM" fit='true' style="border: none">
        <div style="width:100%;height: 25px;background: none repeat scroll 0 0 #e0ecff;">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="costing_model_print()">Print</a>
        </div>
        <div id="t_cost_bom" style="padding: 5px;">
        </div>
    </div>
    <div title="Raw Material Besi" fit='true' style="border: none">
        <div style="width:100%;height: 25px;background: none repeat scroll 0 0 #e0ecff;">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="costing_rawmaterial_print()">Print</a>
        </div>
        <?php $this->load->view('rawmaterial/view') ?>
    </div>
</div>
<script>
    $('#costing_tabs').tabs({        
        onSelect:function(title,index){
            var row = $('#costing').datagrid('getSelected');
            if(row != null){                
                switch(index) {
                    case 0:
                        $('#costingdetail').datagrid({
                            url: '<?php echo site_url('costing/get_material') ?>',
                            queryParams: {
                                costingid: row.id
                            }
                        });
                        break;
                    case 1:
                        $('#t_cost_sheet').load(base_url+'costing/prints/'+row.id);
                        break;
                    case 2:
                        $('#t_cost_bom').load(base_url+'model/prints/'+row.modelid);
                        break;
                    case 3:
                        $('#besi_pipa_kotak').datagrid('load', {
                            costingid: row.id
                        });
                        $('#besi_pipa_bulat').datagrid('load', {
                            costingid: row.id
                        });
                        $('#besi_as_kotak_or_strip_plate_or_plat').datagrid('load', {
                            costingid: row.id
                        });
                        $('#besi_as_bulat').datagrid('load', {
                            costingid: row.id
                        });
                        $('#besi_plat_siku').datagrid('load', {
                            costingid: row.id
                        });
                
                        $('#stainless_pipa_kotak').datagrid('load', {
                            costingid: row.id
                        });
                        $('#stainless_pipa_bulat').datagrid('load', {
                            costingid: row.id
                        });
                        $('#stainless_as_kotak_or_strip_plate_or_plat').datagrid('load', {
                            costingid: row.id
                        });
                        $('#stainless_as_bulat').datagrid('load', {
                            costingid: row.id
                        });
                        $('#stainless_plat_siku').datagrid('load', {
                            costingid: row.id
                        });
                
                        $('#kuningan_as_kotak_or_strip_plate_or_plat').datagrid('load', {
                            costingid: row.id
                        });
                        $('#kuningan_as_bulat').datagrid('load', {
                            costingid: row.id
                        });
                        $('#besi_total_luas').load(base_url+'costing/get_total_luas/'+row.id+'/1');
                        $('#stainless_total_luas').load(base_url+'costing/get_total_luas/'+row.id+'/2');
                        $('#kuningan_total_luas').load(base_url+'costing/get_total_luas/'+row.id+'/3');
                
                        $('#besi_total_kg').load(base_url+'costing/get_total_kg/'+row.id+'/1');
                        $('#stainless_total_kg').load(base_url+'costing/get_total_kg/'+row.id+'/2');
                        $('#kuningan_total_kg').load(base_url+'costing/get_total_kg/'+row.id+'/3');
                        break;                    
                    default:
                    }
                }
            }
        });
</script>
