var $nf = jQuery.noConflict();
$nf(document).ready(function(){

   //alert( 'jQuery iniciado!' );

$nf('#nome').blur(nome_check);
$nf('#caixa_id').blur(nome_check);

});

function nome_check(){
var nome = $nf('#nome').val();
var caixa_id = $nf('#caixa_id').val();
if(nome == ""){
$nf('#nome').css('border', '1px #CCC solid');
$nf('#tick').hide();
}else{
//   alert(caixa_id );

$nf.ajax({

   type: "POST",
   url: "check.php",
   data:{"nome":nome,"caixa_id":caixa_id},
   cache: false,
   success: function(response){

if(response == 1){
	$nf('#nome').css('border', '3px #C33 solid');
	$nf('#tick').hide();
	$nf('#cross').fadeIn();
           //alert( 'jQuery iniciado3!' );

	}else{
	   //alert( 'jQuery iniciado4!' );

	$nf('#nome').css('border', '1px #7AC6E7 solid');
	$nf('#cross').hide();
	$nf('#tick').fadeOut();
	     }

            }
        });
    }
}

$nf(document).ready(function() {
    $nf('a[href=#top]').click(function(){
    $nf('html, body').animate({scrollTop:0}, 'slow');
    return false;
    });
});

