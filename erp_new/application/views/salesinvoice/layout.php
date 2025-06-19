<div class="easyui-layout" fit='true'>
    <div region='center' 
         title="Sales Invoice" 
         href='<?php echo site_url('salesinvoice/view') ?>'></div>
    <div region='south'  
         style="height: 250px" 
         title="Invoice For Item" 
         split='true'
         collapsible='false'
         href='<?php echo site_url('salesinvoice/view_detail') ?>'></div>
</div>

