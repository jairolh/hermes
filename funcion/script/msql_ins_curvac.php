<?php
$docnroiden = $_SESSION['usuario_login'];
$cod_consul = "SELECT CAR_CUR_ASI_COD,
				       ASI_NOMBRE,
					   CAR_CUR_NRO,
					   CAR_CRA_COD,
					   CRA_NOMBRE,
					   CAR_DOC_NRO_IDEN,
					   DOC_NOMBRE ||' '||DOC_APELLIDO,
					   APE_ANO,
					   APE_PER,
					   DECODE(CUR_SEMESTRE,0,'Electiva',CUR_SEMESTRE) CUR_SEMESTRE,
					   CUR_NRO_CUPO,
					   CUR_NRO_INS,
					   INS_EST_COD,
					   EST_NOMBRE,
					   INS_NOTA,
					   INS_OBS
				  FROM ACCARGA,ACASI,ACCRA,ACDOCENTE,ACASPERI,ACCURSO,ACINS,ACEST
				 WHERE CAR_CUR_ASI_COD =".$_SESSION["A"]."
				   AND CAR_CUR_NRO =".$_SESSION["G"]."
				   AND CAR_CRA_COD =".$_SESSION["C"]."
				   AND CAR_DOC_NRO_IDEN = $docnroiden
				   AND CAR_CUR_ASI_COD = ASI_COD
				   AND CAR_CRA_COD = CRA_COD
				   AND CAR_DOC_NRO_IDEN = DOC_NRO_IDEN
				   AND APE_ESTADO = 'V'
				   AND CAR_CUR_ASI_COD = CUR_ASI_COD
				   AND CAR_CUR_NRO = CUR_NRO
   				   AND CAR_APE_ANO = CUR_APE_ANO
				   AND CAR_APE_PER = CUR_APE_PER
				   AND CAR_CUR_ASI_COD = INS_ASI_COD
				   AND CAR_CUR_NRO = INS_GR
				   AND CAR_APE_ANO = INS_ANO
				   AND CAR_APE_PER = INS_PER
				   AND INS_ANO = APE_ANO
				   AND INS_PER = APE_PER
				   AND INS_EST_COD = EST_COD
				   ORDER BY INS_EST_COD";
?>