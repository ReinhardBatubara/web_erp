<div id="tt-model-process" class="easyui-tabs"  data-options="fit:true,tabHeight:20" border="false">
    <div title="Model & Stock Information">
        <div class="easyui-panel" fit="true" border="false">
            <div class="easyui-layout" data-options="fit:true">        
                <div region="center" 
                     border="false"
                     href="<?php echo site_url('modelstock/model_stock') ?>">
                </div>
                <div region="east" 
                     split="true" 
                     collapsible="false"
                     border="false"
                     style="width:420px;"
                     href="<?php echo site_url('modelstock/process_stock') ?>">        
                </div>
            </div>
        </div>
    </div>
    <div title="Stok Out">
        <div class="easyui-panel" 
             fit="true" 
             title="Model & Process Stock Out"
             href="<?php echo site_url('modelstock/stock_out') ?>">

        </div>
    </div>
</div>
