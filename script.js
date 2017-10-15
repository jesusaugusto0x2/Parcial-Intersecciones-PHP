function verColor(check_radio){
	$("#form_colores").submit();
}

function setear(fil,col, ficha){
	var turno = $("#turno").val();
	console.log("turno: " + turno);

	if(turno == 0){
		$("#turno").val(1);
	}else{
		$("#turno").val(0);
	}

	$("#fil_act").val(fil);
	$("#col_act").val(col);

	$("#form_tablero").submit();
}