<div class="easyui-layout" fit="true">
    <div data-options="region:'north'" 
         border="true" href="<?php echo site_url('joborder/view') ?>" 
         title="Job Order" 
         collapsible="true"
         split="true"
         style="height: 30%;">        
    </div>
    <div 
        collapsible="true"
        region="center"
        border="false">
        <div class="easyui-layout" data-options="fit:true" border="false">
            <div data-options="region:'center'" 
                 href="<?php echo site_url('joborder/item_view') ?>"
                 split="true"
                 border="true"
                 title="Item"
                 collapsible="true">
            </div>
            <div region="south" 
                 split="true"
                 border="false"
                 style="height: 50%">
                <div class="easyui-layout" data-options="fit:true" border="false">
                    <div data-options="region:'center'" 
                         title='Outsource'
                         href="<?php echo site_url('joborder/outsource/0') ?>">
                    </div>
                    <div region="east" 
                         collapsible="false"
                         split="true" style="width: 50%;"
                         href="<?php echo site_url('joborder/allocated_process') ?>"
                         border="false">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
