<?php
# ============ Classe Pedido ============

class Paciente{

    private $id;
    private $nome;

    public function setid($id)
    {
       $this -> id = $id;
    }

    public function setNome($nome)
    {
       $this -> nome = $nome;
    }

    public function getid()
    {
     	return $this -> id;
    }

    public function getNome()
    {
     	return $this -> nome;
    }

    public function save()
	{
		if ($this->getid() == 0){
			$this->insert();
		} else {
			$this->update();
		}
	}

	public function get($id)
	{
		$sql = 'SELECT * FROM pedido WHERE id ="'.$id.'"';
		$query = mysql_query($sql);
		$result = mysql_fetch_assoc($query);
		$result = $this->getFromResult($result);
		return $result;
	}


	public function delete()
	{
		$sql ='DELETE FROM pedido WHERE id = \''.$this->getid().'\' ';
		$result = mysql_query($sql);
		$this->setid(0);
	}


	private function getFromResult($result) {
        $this->setid($result['id']);
        $this->setNome($result['nome']);
	}


	private function update() {
        $sql = 'UPDATE pedido SET
        id = \''.$this->getid().'\',
        nome = \''.$this->getNome().'\'
        WHERE id = \''.$this->getid().'\'';
		mysql_query($sql) or die (mysql_error());
	}


	private function insert()
	{
        $sql = 'INSERT INTO lc_paciente (nome)
				VALUES ('.$this->getNome().'\')';
		mysql_query($sql) or die (mysql_error());
		$this->setid(mysql_insert_id());
	}

} // fim da class

?>