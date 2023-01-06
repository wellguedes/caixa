## C�digo HTML ##

<html>
<head>
<script type="text/javascript" src="teste/js/jquery-1.3.2.min.js"></script>
<title>Pop Up</title>

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

		var maskHeight = $(document).height();
		var maskWidth = $(window).width();

		$('#mask').css({'width':maskWidth,'height':maskHeight});

		$('#mask').fadeIn(1000);
		$('#mask').fadeTo("slow",0.8);

		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();

		$('#dialog2').css('top',  winH/2-$('#dialog2').height()/2);
		$('#dialog2').css('left', winW/2-$('#dialog2').width()/2);

		$('#dialog2').fadeIn(2000);

	$('.window .close').click(function (e) {
		e.preventDefault();

		$('#mask').hide();
		$('.window').hide();
	});

	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});

});
</script>

<style type="text/css">

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:transparent;
  display:none;
}

#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:440px;
  height:200px;
  display:none;
  z-index:9999;
  padding:20px;
}

#boxes #dialog2 {
  background:transparent;
  width:650px;
  margin:0 auto;
  margin-top:-160px;
}

.close{display:block; text-align:right;}

</style>
</head>
<body>
	<div id="boxes">

<!-- Janela Modal -->
		<div id="dialog2" class="window">
			<div align="right">
				<input type="button" value="Fechar" class="close"/>
			</div>
				<img src="mensagem.jpg" width="650" height="655" /><br />
			</div>
<!-- Fim Janela Modal-->

<!-- M�scara para cobrir a tela -->
<div id="mask"></div>

</div>

</body>
</html>
