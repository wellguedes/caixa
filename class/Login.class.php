<?php
/**
 * Classe de login
 *
 * Classe com as funcionalidades básicas para um sistema de login de usuário
 *
 * @author		Wellington Guedes
 * @link		http://wsguedes.com
 * @since		Version 0.2
 */

class Login {

    private $tabela, $campoID, $campoLogin, $campoSenha;

    function  __construct($tabela = 'lc_usuario', $campoID = 'id', $campoLogin = 'usua_login', $campoSenha = 'usua_senha') {

            // Iniciando sessão
            session_start();

            // Definindo atributos
            $this->tabela = $tabela;
            $this->campoID = $campoID;
            $this->campoLogin = $campoLogin;
            $this->campoSenha = $campoSenha;
    }

    // ------------------------------------------------------------------------

    /**
	 * Retornando login do usuário que está na sessão
	 *
	 * @access	public
	 * @return	string
	 */

    function getLogin() {
        return $_SESSION[$this->campoLogin];
    }

    // ------------------------------------------------------------------------

    /**
	 * Retornando ID do usuário que está na sessão
	 *
	 * @access	public
	 * @return	integer
	 */

    function getID() {
        return $_SESSION[$this->campoID];
    }

    // ------------------------------------------------------------------------

    /**
	 * Trata as informações recebidas, procura o usuário no banco de dados e, se encontrado,
         * registra as informações na sessão.
	 *
	 * @access	public
         * @param	string
	 * @param	string
         * @param	string
	 * @return	boolean
	 */

    function logar($login, $senha, $redireciona = null) {
        // Tratando as informações
        $login = mysql_real_escape_string($login);
        $senha = mysql_real_escape_string($senha);

        // Verifica se o usuário existe
        $query = mysql_query("SELECT {$this->campoID}, {$this->campoLogin}, {$this->campoSenha}
                             FROM {$this->tabela}
                             WHERE {$this->campoLogin} = '{$login}' AND {$this->campoSenha} = '{$senha}'");
	
        // Se encontrado um usuário
        if(mysql_num_rows($query) > 0)
        {
            // Instanciando usuário
            $usuario = mysql_fetch_object($query);

            // Registrando sessão
            $_SESSION[$this->campoID] = $usuario->{$this->campoID};
            $_SESSION[$this->campoLogin] = $usuario->{$this->campoLogin};
            $_SESSION[$this->campoSenha] = $usuario->{$this->campoSenha};

            // Se informado redirecionamento
            if ($redireciona !== null)
                header("Location: {$redireciona}");
            else
                return true;
        }
        else
            return false;
    }

    // ------------------------------------------------------------------------

    /**
	 * Verifica se o usuário está logado
	 *
	 * @access	public
         * @param	string
	 * @return	boolean
	 */

    function verificar($redireciona = null) {
        // Se as sessões estiverem setadas
        if(isset($_SESSION[$this->campoID]) and isset($_SESSION[$this->campoLogin]) and isset($_SESSION[$this->campoSenha]))
            return true;
        else
        {
            // Se informado redirecionamento
            if ($redireciona !== null)
                header("Location: {$redireciona}");

            return false;    
        }

    }

    // ------------------------------------------------------------------------

    /**
	 * Finaliza a sessão do usuário
	 *
	 * @access	public
         * @param	string
	 * @return	void
	 */

    function logout($redireciona = null) {
        // Limpa a Sessão
        $_SESSION = array();
        // Destroi a Sessão
        session_destroy();
        // Modifica o ID da Sessão
        session_regenerate_id();
        // Se informado redirecionamento
        if ($redireciona !== null)
            header("Location: {$redireciona}");
    }

}
?>