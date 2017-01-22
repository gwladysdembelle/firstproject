$(document).ready(function() {
    $.ajax( {
        type: "GET",
        url: "../donnees/liste_qte_editions.xml",
        dataType: "xml",
        success: function(xml) { 
            var quantitetotal = 0;
            var editionsselectionnees = [];
            $('#listeeditions option:selected').each( function(){
                editionsselectionnees.push($(this).val());
            });
            //console.log($('#listeeditions option:selected').length);
            $(xml).find('ligne').each( function(){
                var edition = $(this).find('edition').text();
                var quantite = $(this).find('quantite').text();
                if(jQuery.inArray(edition,editionsselectionnees) != -1){
                    quantitetotal += parseInt(quantite,10);
                }
            });
            if ($('#listeeditions option:selected').length > 0) {
                $('#quantite').val(quantitetotal);
            }
        }
    });
    
    if ($('#listeeditions option:selected').length > 0){
        $("#showEditions").prop('checked', true);
        $( "#editions" ).show();
        $( "#quantity" ).hide();
    }
    if ($('#listeeditions option:selected').length == 0 && $("#quantite").val() > 0){
        $("#showQuantite").prop('checked', true);
        $( "#quantity" ).show();
        $( "#editions" ).hide();
    }
    
    $("#showEditions").click(function() {
        $( "#editions" ).show();
        $( "#quantity" ).hide();
    });
    
    $("#showQuantite").click(function() {
        $( "#quantity" ).show();
        $( "#editions" ).hide();
    });
    
    $("#quantite").change(function() {
        $('#listeeditions').val('').removeAttr('selected');
    });
    
    $('#resetform').click(function() {
        $('#contactHappy :input').not(':button, :submit, :reset, :hidden').val('').removeAttr('checked').removeAttr('selected');
        return false;
    });
    
});
jQuery(function($){
    triSelect('#listeeditions');
    
    $('#btnexport').click(function() {
        if(!isIElt9){
            html2canvas(document.body, {
                onrendered: function(canvas) {
                    $.post("savecanvas/save.php", {
                            data: canvas.toDataURL("image/png")
                        }, function (file) {
                        window.location.href =  "savecanvas/download.php?path=" + file;
                    });
                }
            });
        }else{
            var el = document.createElement('canvas');
            G_vmlCanvasManager.initElement(el);
            var ctx = el.getContext('2d');
            var_dump(ctx);
        }
    });
    
    
    
    /************************************************/
    /*      	  Masques de saisie                 */
    /************************************************/
    $("#telephone").mask("?9999999999");
    
    /************************************************/
    /*      	  Selection des editions            */
    /************************************************/  
    $('#listeeditions').change(function() {        
        $.ajax( {
            type: "GET",
            url: "../donnees/liste_qte_editions.xml",
            dataType: "xml",
            success: function(xml) { 
                var quantitetotal = parseInt(0,10);
                var editionsselectionnees = [];
                $('#listeeditions option:selected').each( function(){
                    editionsselectionnees.push($(this).val());
                });
                $(xml).find('ligne').each( function(){
                    var edition = $(this).find('edition').text();
                    var quantite = $(this).find('quantite').text();
                    if(jQuery.inArray(edition,editionsselectionnees) != -1){
                        quantitetotal += parseInt(quantite,10);
                    }
                });
                $('#quantite').val(quantitetotal);
            }
        });    
        
        return true;
    });
});

jQuery.webshims.polyfill('forms');


function triSelect(idselect){
	$(idselect+" > option").sort(function(a,b){
		return a.innerHTML > b.innerHTML ? 1 : -1;
	}).remove().appendTo(idselect);
}

function var_dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }

    alert(out);

    // or, if you wanted to avoid alerts...

    var pre = document.createElement('pre');
    pre.innerHTML = out;
    document.body.appendChild(pre)
}