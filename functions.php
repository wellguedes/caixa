<?php
include 'constantes.php';
include 'config/conn.php';

class functions{

    function mes_extenso($referencia = NULL)
    {

        switch ($referencia){
        case 1: $mes = "JANEIRO"; break;
        case 2: $mes = "FEVEREIRO"; break;
        case 3: $mes = " MARÇO"; break;
        case 4: $mes = "ABRIL"; break;
        case 5: $mes = "MAIO"; break;
        case 6: $mes = "JUNHO"; break;
        case 7: $mes = "JULHO"; break;
        case 8: $mes = "AGOSTO"; break;
        case 9: $mes = "SETEMBRO"; break;
        case 10: $mes = "OUTUBRO"; break;
        case 11: $mes = "NOVEMBRO"; break;
        case 12: $mes = "DEZEMBRO"; break;
    }
        return $mes;
    }

    function mes_extenso2($referencia = NULL)
    {

        switch ($referencia){
        case 1: $mes = "Janeiro"; break;
        case 2: $mes = "Fevereiro"; break;
        case 3: $mes = " Março"; break;
        case 4: $mes = "Abril"; break;
        case 5: $mes = "Maio"; break;
        case 6: $mes = "Junho"; break;
        case 7: $mes = "Julho"; break;
        case 8: $mes = "Agosto"; break;
        case 9: $mes = "Setembro"; break;
        case 10: $mes = "Outubro"; break;
        case 11: $mes = "Novembro"; break;
        case 12: $mes = "Dezembro"; break;
    }
        return $mes;
    }
    
    public function getCaixa()
    {
        $sql = "SELECT * FROM lc_caixa";
        $result = mysql_query($sql);
        return $result;
    }

    public function getBanco()
    {
        $sql = "SELECT * FROM lc_banco";
        $result = mysql_query($sql);
        return $result;
    }

    public function getUsuarios()
    {
        $sql = "SELECT *
                FROM lc_usuario
                ORDER BY 2";
        $result = mysql_query($sql);
        return $result;
    }

    public function getCategoria()
    {
        $sql = "SELECT * from lc_cat";
        $result = mysql_query($sql);
        return $result;
    }

    public function data_atual()
    {

    // leitura das datas
    $dia = date('d');
    $mes = date('m');
    $ano = date('Y');

    // definindo padrão pt (dd/MM/YYYY)
    $data = "$dia/$mes/$ano";
    return $data;
    }

    public function getEntradaDia()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento WHERE tipo= 1 AND data = '$data'";
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaDia()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento WHERE tipo= 0 AND data = '$data'";
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaDiaClinica()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 AND data = '$data' AND caixa_id = 1" ;
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaDiaClinicaMesAnterior()
    {

        $mes_atual = date("m");

        $mes = $mes_atual -1;

        $data = date("Y/$mes/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 AND data = '$data' AND caixa_id in(1,2,5)" ;
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaDiaClinicaMesAnterior()
    {

        $mes_atual = date("m");

        $mes = $mes_atual -1;

        $data = date("Y/$mes/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 AND data = '$data' AND caixa_id in(1)" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaClinica()
    {
        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 and caixa_id = 1" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaClinica()
    {
        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 and caixa_id = 1" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaClinicaMenosDia()
    {
        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 and caixa_id = 1 and not data = curdate()" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaClinicaMenosDia()
    {
        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 and caixa_id = 1 and not data = curdate()" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaLoja()
    {
        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 and caixa_id = 2" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaLeandro()
    {
        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 and caixa_id = 3" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaAcademia()
    {
        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 and caixa_id = 4" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaAcademia()
    {
        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 and caixa_id = 4" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaPilates()
    {
        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 and caixa_id = 5" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaPilates()
    {
        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 and caixa_id = 5" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaLeandro()
    {
        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 and caixa_id = 3" ;
        $result = mysql_query($sql);
        return $result;
    }
    public function getSaidaLoja()
    {
        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 and caixa_id = 2" ;
        $result = mysql_query($sql);
        return $result;
    }
    public function getSaidaDiaClinica()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 AND data = '$data' AND caixa_id = 1" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaDiaLoja()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 AND data = '$data' AND caixa_id = 2" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaDiaLoja()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 AND data = '$data' AND caixa_id = 2" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaDiaLeandro()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 AND data = '$data' AND caixa_id = 3" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaDiaLeandro()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 AND data = '$data' AND caixa_id = 3" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaDiaAcademia()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 AND data = '$data' AND caixa_id = 4" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaDiaAcademia()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 AND data = '$data' AND caixa_id = 4" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaDiaPilates()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 AND data = '$data' AND caixa_id = 5" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaDiaPilates()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 AND data = '$data' AND caixa_id = 5" ;
        $result = mysql_query($sql);
        return $result;
    }

    public function formata_dinheiro($valor)
    {
        $valor = number_format($valor,2,',','.');
        
        return "R$ " . $valor;
    }

    public function getEntradaMes()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento WHERE tipo= 1 and data BETWEEN '2013-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "'";
      $result = mysql_query($sql);
      return $result;
    }

    public function getEntradaParticular()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento WHERE tipo= 1 and convenio in ('Particular 15','Particular 20','Particular 28', 'Particular 32') and data BETWEEN '2013-".MES."-01' AND '".$ano. "-" .MES. "-".$diaFim . "'";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getSaidaComercial()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento WHERE tipo= 0 and referente = 'Comercial' and data BETWEEN '2013-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "'";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getSaidaAluguel()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento WHERE tipo= 0 and referente = 'Aluguel' and data BETWEEN '2013-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "'";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getSaidaOperacional()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento WHERE tipo= 0 and referente like 'operacional%' and data BETWEEN '2013-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "'";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getSaidaOutros()
    {
        $diaFim = date('t');
        //$mes = date('m');
        $ano = date('Y');
        $mes = 11;

      $sql = "SELECT SUM(valor) as total FROM lc_movimento WHERE tipo= 0 and referente like 'outros%' and data BETWEEN '2013-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "'";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getSaidaEmprestimo()
    {
        $diaFim = date('t');
        //$mes = date('m');
        $ano = date('Y');
        $mes = 01;

      $sql = "SELECT SUM(valor) as total FROM lc_movimento WHERE tipo= 0 and referente like 'emprestimo%' and data BETWEEN '2013-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "'";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }
    public function getSaidaEscritorio()
    {
        $diaFim = date('t');
        //$mes = date('m');
        $ano = date('Y');
        $mes = 01;

      $sql = "SELECT SUM(valor) as total FROM lc_movimento WHERE tipo= 0 and referente like 'escritorio%' and data BETWEEN '2013-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "'";
     // echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getSaidaNOperacional()
    {
        $diaFim = date('t');
        //$mes = date('m');
        $ano = date('Y');
        $mes = 01;

      $sql = "SELECT SUM(valor) as total FROM lc_movimento WHERE tipo= 0 and referente like '%Nao%Operacional%' and data BETWEEN '2013-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "'";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getSaidaMes()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento WHERE tipo= 0 and data BETWEEN '2013-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "'";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getEntradaMesClinica()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento Join lc_caixa using(caixa_id) WHERE tipo= 1 and caixa_id = 1";
      $result = mysql_query($sql);
      return $result;
    }

    public function getSaidaMesClinica()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento Join lc_caixa using(caixa_id) WHERE tipo= 0 and caixa_id = 1";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getEntradaMesClinicaBalanco()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento Join lc_caixa using(caixa_id) WHERE tipo= 1 and data BETWEEN '$ano-".MES."-01' AND '".$ano. "-" .MES. "-".$diaFim . "' and caixa_id = 1";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }
    public function getSaidaMesClinicaBalanco()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento Join lc_caixa using(caixa_id) WHERE tipo= 0 and data BETWEEN '$ano-".MES."-01' AND '".$ano. "-" .MES. "-".$diaFim . "' and caixa_id = 1";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getEntradaMesLoja()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento Join lc_caixa using(caixa_id) WHERE tipo= 1 and caixa_id = 2";
      $result = mysql_query($sql);
      return $result;
    }

    public function getSaidaMesLoja()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento Join lc_caixa using(caixa_id) WHERE tipo= 0 and data BETWEEN '$ano-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "' and caixa_id = 2";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getEntradaMesLeandro()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento Join lc_caixa using(caixa_id) WHERE tipo= 1 and caixa_id = 3";
      $result = mysql_query($sql);
      return $result;
    }

    public function getSaidaMesLeandro()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento Join lc_caixa using(caixa_id) WHERE tipo= 0 and data BETWEEN '$ano-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "' and caixa_id = 3";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getEntradaMesAcademia()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento Join lc_caixa using(caixa_id) WHERE tipo= 1 and caixa_id = 4";
      $result = mysql_query($sql);
      return $result;
    }

    public function getSaidaMesAcademia()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento Join lc_caixa using(caixa_id) WHERE tipo= 0 and data BETWEEN '$ano-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "' and caixa_id = 4";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    public function getEntradaMesPilates()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento Join lc_caixa using(caixa_id) WHERE tipo= 1 and caixa_id = 5";
      $result = mysql_query($sql);
      return $result;
    }

    public function getSaidaMesPilates()
    {
        $diaFim = date('t');
        $mes = date('m');
        $ano = date('Y');

      $sql = "SELECT SUM(valor) as total FROM lc_movimento Join lc_caixa using(caixa_id) WHERE tipo= 0 and data BETWEEN '$ano-".$mes."-01' AND '".$ano. "-" .$mes. "-".$diaFim . "' and caixa_id = 5";
      //echo $sql;
      $result = mysql_query($sql);
      return $result;
    }

    function datasql($databr) {
	if (!empty($databr)){
	$p_dt = explode('/',$databr);
	$data_sql = $p_dt[2].'-'.$p_dt[1].'-'.$p_dt[0];
	return $data_sql;
	}
    }

    public function getPacientes()
    {
        $sql = "Select  distinct id,nome,endereco,paci_end_compl, paci_end_numero,paci_cidade,paci_estado,paci_cep,
            telefone,paci_celular,paci_cpf,paci_rg,paci_email,paci_sexo,DATE_FORMAT(paci_data_nascimento, '%d/%m/%Y') as paci_data_nascimento from lc_paciente";
        $result = mysql_query($sql);
        return $result;
    }

    public function getDinheiro()
    {
        $sql = "select sum(valor) as total
                    from lc_movimento
                    where data = CURDATE()
                    and pag_id = 1
                    and caixa_id = 1
                    and tipo = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function getCheque()
    {
        $sql = "select sum(valor) as total
                    from lc_movimento
                    where data = CURDATE()
                    and pag_id = 2
                    and caixa_id = 1
                    and tipo = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function getDinheiroLoja()
    {
        $sql = "select sum(valor) as total
                    from lc_movimento
                    where data = CURDATE()
                    and pag_id = 1
                    and caixa_id = 2
                    and tipo = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function getChequeLoja()
    {
        $sql = "select sum(valor) as total
                    from lc_movimento
                    where data = CURDATE()
                    and pag_id = 2
                    and caixa_id = 2
                    and tipo = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function getDinheiroLeandro()
    {
        $sql = "select sum(valor) as total
                    from lc_movimento
                    where data = CURDATE()
                    and pag_id = 1
                    and caixa_id = 3
                    and tipo = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function getChequeLeandro()
    {
        $sql = "select sum(valor) as total
                    from lc_movimento
                    where data = CURDATE()
                    and pag_id = 2
                    and caixa_id = 3
                    and tipo = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function getDinheiroAcademia()
    {
        $sql = "select sum(valor) as total
                    from lc_movimento
                    where data = CURDATE()
                    and pag_id = 1
                    and caixa_id = 4
                    and tipo = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function getChequeAcademia()
    {
        $sql = "select sum(valor) as total
                    from lc_movimento
                    where data = CURDATE()
                    and pag_id = 2
                    and caixa_id = 4
                    and tipo = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function getDinheiroPilates()
    {
        $sql = "select sum(valor) as total
                    from lc_movimento
                    where data = CURDATE()
                    and pag_id = 1
                    and caixa_id = 5
                    and tipo = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function getChequePilates()
    {
        $sql = "select sum(valor) as total
                    from lc_movimento
                    where data = CURDATE()
                    and pag_id = 2
                    and caixa_id = 5
                    and tipo = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function getFechamentoDiario()
    {
        $sql = "select sum((select valor
                from lc_fechamento l
                where l.caixa_id = c.caixa_id AND data = CURDATE()
                order by data_hora_inc desc
                limit 1)) as valor
                from lc_caixa c
                ";
        $result = mysql_query($sql);
        return $result;
    }

    public function getConta()
    {
        $sql = "select distinct lc_conta.conta_id,banco,conta,numero, c.valor
                from lc_conta
                left join lc_contabil c on (c.conta_id = lc_conta.conta_id)
                where lc_conta.conta_id > 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function getCaixaPhysiosul()
    {
        $sql = "select distinct *
                from lc_conta
                where conta_id = 1";
        $result = mysql_query($sql);
        return $result;

    }

    public function retornaDiaAnalitico()
    {
        $sql ="
            SELECT tipo, nome, referente,
            CASE tipo
            WHEN 1 THEN Valor
            END as entrada,
            CASE tipo
            WHEN 0 THEN Valor
            END as saida
            FROM lc_movimento
            Where data = CURDATE()
            and caixa_id = 1
            Order by data_hora_inc";
        $result = mysql_query($sql);
        return $result;
    }
    public function retornaDiaAnaliticoEntrada()
    {
        $sql ="
            SELECT tipo, sum(valor) as total
            FROM lc_movimento
            Where data = CURDATE()
            AND tipo = 1
            and caixa_id = 1";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
    }

    public function retornaDiaAnaliticoSaida()
    {
        $sql ="
            SELECT tipo, sum(valor) as total
            FROM lc_movimento
            Where data = CURDATE()
            AND tipo = 0
            and caixa_id = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function retornaDiaClinica()
    {
        $sql ="
            SELECT tipo,sum(valor) as total
            FROM lc_movimento
            Where data = CURDATE() - 1
            AND tipo = 1
            and caixa_id = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function retornaDiaClinicaSaida()
    {
        $sql ="
            SELECT sum(valor) as total
            FROM lc_movimento
            Where data = CURDATE() - 1
            AND tipo = 0
            and caixa_id = 1";
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaDiaClinicaBalanco()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 AND data <= '2013-".MES."-30' AND caixa_id = 1" ;
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaDiaClinicaBalanco()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 and data <= '2013-".MES."-30' AND caixa_id = 1" ;
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
    }

    public function getEntradaDiaClinicaBalancoAnterior()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 AND data = '2013-12-30' AND caixa_id = 1" ;
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaidaDiaClinicaBalancoAnterior()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 and data = '2012-12-30' AND caixa_id = 1" ;
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaldoAcademiaEntrada()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 1 and data <= '2012-12-30' AND caixa_id = 4" ;
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
    }

    public function getSaldoAcademiaSaida()
    {
        $data = date("Y/m/d");

        $sql = "SELECT SUM(valor) as total FROM lc_movimento JOIN lc_caixa using (caixa_id) WHERE tipo= 0 and data <= '2012-12-30' AND caixa_id = 4" ;
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
    }
}
?>
