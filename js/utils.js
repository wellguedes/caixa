function get(_id){
	return document.getElementById(_id);
}
function valor(_id, _valor){
	var obj = get(_id);
	if(obj) obj.value = _valor;
}
function abreFecha(_id){
	var obj = get(_id);
	if(obj){
		if(obj.style.display == 'none') mostra(_id);
		else oculta(_id);
	}
}

function mostra(_id){
	obj = get(_id);
	if(obj) obj.style.display = '';
}

function oculta(_id){
	obj = get(_id);
	if(obj) obj.style.display = 'none';
}

function altera_pagamento(opcao){
	if (opcao == 'dinheiro') {
		$(".tp_cheque").css("display","none");
		$(".tp_dinheiro").css("display","block");
		$("#tp_pagamento_d").attr("checked",true); //input[@name='tp_cliente']:checked
	} else {
		$(".tp_cheque").css("display","block");
		$(".tp_dinheiro").css("display","none");
		$("#tp_pagamento_d").attr("checked",true);
	}
}