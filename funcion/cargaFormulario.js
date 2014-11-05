		function negative(id) {
		    document.getElementById(id).style.display='none'
		}
		/******************************
		 Capa estática. Por Carlitos. carlosbernad@teleline.es
		 Si usas este script, deja intactas estas líneas (créditos). Vale?
		 También te agradecería un e-mail con tus comentarios.
		*******************************/

		function ini()
		{
			NS6 = (document.getElementById&&!document.all)
			IE = (document.all)
			iniY = document.getElementById('capa').style.top
			iniZ = document.getElementById('capa_pdf').style.top
			iniX = document.getElementById('capa_excel').style.top
			cursor()
		}

		function cursor()
		{
			if (NS6) coorY = window.pageYOffset
			if (IE) coorY = document.body.scrollTop
			document.getElementById('capa').style.top =  coorY + parseInt(iniY)
			document.getElementById('capa_pdf').style.top =  coorY + parseInt(iniY)
			document.getElementById('capa_excel').style.top =  coorY + parseInt(iniY)
			setTimeout("cursor()",1)
		}

