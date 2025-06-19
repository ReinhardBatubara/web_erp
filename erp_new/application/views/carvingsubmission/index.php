<div class="easyui-layout" data-options="fit:true" style="border: none">        
    <div region="center" border="false">
        <div class="easyui-layout" fit="true" border="false">
            <div region="center" 
                 title="Carving Period" 
                 href="<?php echo site_url('carvingsubmission/period') ?>">
            </div>
            <div region="east" 
                 title="Carvener" 
                 style="width: 550px" 
                 collapsible="false" 
                 split="true"
                 href="<?php echo site_url('carvingsubmission/carver') ?>">
            </div>
        </div>
    </div>
    <div region="south" 
         split="true" 
         title="List Item Carvered" 
         style="height:380px;" 
         collapsible="false"
         href="<?php echo site_url('carvingsubmission/list_item') ?>">
    </div>
</div>