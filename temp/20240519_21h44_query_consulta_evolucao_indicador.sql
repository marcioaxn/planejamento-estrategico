SELECT 
	tei.num_mes,
	tei.vlr_previsto,
	tei.vlr_realizado, 
	tei.txt_avaliacao,
	CASE 
		WHEN tei.vlr_previsto > 0 AND tei.bln_atualizado = '1' 
			THEN ROUND(((tei.vlr_realizado/tei.vlr_previsto)*100), 2) 
		WHEN tei.vlr_previsto > 0 AND tei.bln_atualizado IS NULL 
			THEN 0
	END prc_realizado, 
	tei.bln_atualizado
FROM 
	pei.tab_evolucao_indicador tei
WHERE 
	tei.cod_indicador = 'e83abbd3-527e-4051-87fa-d81e68951138' 
AND 
	tei.num_ano = 2024 
AND 
	tei.deleted_at IS NULL
ORDER BY 
	tei.num_mes;