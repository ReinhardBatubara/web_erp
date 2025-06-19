/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function report_pemasukan_bahan_baku_search(){
    $('#pemasukan_bahan_baku').datagrid("reload",
        $('#pemasukan_bahan_baku_form_search').serializeObject()
        );
}

function report_pemasukan_bahan_baku_preview(){
    
    $.post(base_url + 'report/pemasukan_bahan_baku_print/preview',$('#pemasukan_bahan_baku_form_search').serializeObject(),function(respon){
        $('#rpt_preview').dialog({
            title: 'Preview',
            width: 820,
            height: 600,
            closed: false,
            cache: false,
            content: respon,
            modal: true
        });
    })
}

function report_pemasukan_bahan_baku_print(){
    if($('#pemasukan_bahan_baku_form_search').form('validate')){
        open_target('POST', base_url+'report/pemasukan_bahan_baku_print/print',
            $('#pemasukan_bahan_baku_form_search').serializeObject()
            , 'blank');
    }
}



function report_pemakaian_bahan_baku_search(){
    $('#pemakaian_bahan_baku').datagrid("reload",
        $('#pemakaian_bahan_baku_form_search').serializeObject()
        );
}

function report_pemakaian_bahan_baku_preview(){
    $.post(base_url + 'report/pemakaian_bahan_baku_print/preview',$('#pemakaian_bahan_baku_form_search').serializeObject(),function(respon){
        $('#rpt_preview').dialog({
            title: 'Preview',
            width: 820,
            height: 600,
            closed: false,
            cache: false,
            content: respon,
            modal: true
        });
    })
}

function report_pemakaian_bahan_baku_print(){
    if($('#pemakaian_bahan_baku_form_search').form('validate')){
        open_target('POST', base_url+'report/pemakaian_bahan_baku_print/print',
            $('#pemakaian_bahan_baku_form_search').serializeObject()
            , 'blank');
    }
}


function report_pemakaian_proses_sub_kontrak_search(){
    $('#pemakaian_proses_sub_kontrak').datagrid("reload",
        $('#pemakaian_proses_sub_kontrak_form_search').serializeObject()
        );
}

function report_pemakaian_proses_sub_kontrak_preview(){
    $.post(base_url + 'report/pemakaian_proses_sub_kontrak_print/preview',$('#pemakaian_proses_sub_kontrak_form_search').serializeObject(),function(respon){
        $('#rpt_preview').dialog({
            title: 'Preview',
            width: 820,
            height: 600,
            closed: false,
            cache: false,
            content: respon,
            modal: true
        });
    })
}

function report_pemakaian_proses_sub_kontrak_print(){    
    open_target('POST', base_url+'report/pemakaian_proses_sub_kontrak_print/print',
        $('#pemakaian_proses_sub_kontrak_form_search').serializeObject()
        , '_blank');
}


//------------

function report_penyelesaian_scrap_search(){
    $('#penyelesaian_scrap').datagrid("reload",
        $('#penyelesaian_scrap_form_search').serializeObject()
        );
}

function report_penyelesaian_scrap_preview(){
    $.post(base_url + 'report/penyelesaian_scrap_print/preview',$('#penyelesaian_scrap_form_search').serializeObject(),function(respon){
        $('#rpt_preview').dialog({
            title: 'Preview',
            width: 820,
            height: 600,
            closed: false,
            cache: false,
            content: respon,
            modal: true
        });
    })
}

function report_penyelesaian_scrap_print(){    
    open_target('POST', base_url+'report/penyelesaian_scrap_print/print',
        $('#penyelesaian_scrap_form_search').serializeObject()
        , 'blank');
}

//----------------------------------


function report_pemasukan_hasil_produksi_search(){
    
}

function report_pemasukan_hasil_produksi_preview(){
    $.post(base_url + 'report/pemasukan_hasil_produksi_print/preview',$('#pemasukan_hasil_produksi_form_search').serializeObject(),function(respon){
        $('#rpt_preview').dialog({
            title: 'Preview',
            width: 820,
            height: 600,
            closed: false,
            cache: false,
            content: respon,
            modal: true
        });
    })
}

function report_pemasukan_hasil_produksi_print(){
    if($('#pemasukan_hasil_produksi_form_search').form('validate')){
        open_target('POST', base_url+'report/pemasukan_hasil_produksi_print',
            $('#pemasukan_hasil_produksi_form_search').serializeObject()
            , 'blank');
    }
}

//-----------------------------------------------

function report_pengeluaran_hasil_produksi_search(){
    
}

function report_pengeluaran_hasil_produksi_preview(){
    $.post(base_url + 'report/pengeluaran_hasil_produksi_print/preview',$('#pengeluaran_hasil_produksi_form_search').serializeObject(),function(respon){
        $('#rpt_preview').dialog({
            title: 'Preview',
            width: 820,
            height: 600,
            closed: false,
            cache: false,
            content: respon,
            modal: true
        });
    })
}

function report_pengeluaran_hasil_produksi_print(){
    if($('#pengeluaran_hasil_produksi_form_search').form('validate')){
        open_target('POST', base_url+'report/pengeluaran_hasil_produksi_print',
            $('#pengeluaran_hasil_produksi_form_search').serializeObject()
            , 'blank');
    }
}
