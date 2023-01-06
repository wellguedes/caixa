// Quando carregado a página
$(function($) {

    // Quando enviado o formulário
    $('#frmLogin').submit(function() {

        // Limpando mensagem de erro
        $('div.mensagem-erro').html('');

        // Mostrando loader
        $('div.loader').show();

        // Enviando informações do formulário via AJAX
        $(this).ajaxSubmit(function(resposta) {

            // Se não retornado nenhum erro
            if (!resposta)
                // Redirecionando para o painel
                window.location.href = 'painel.php';
            else
            {
                // Encondendo loader
                $('div.loader').hide();

                // Exibimos a mensagem de erro
                $( "div.dialog" ).dialog({
                    modal: true,
                    height:200,
                    show: "fold",
                    hide: "explode",
                    buttons: {
                        "Fechar": function() {
                            $( this ).dialog( "close" );

                        }
                    }
                });
            }
        });
        // Retornando false para que o formulário não envie as informações da forma convencional
        return false;

    });
});
 