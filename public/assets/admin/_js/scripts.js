/**
 * 
 * Scripts Painel Administrativo
 * 
 * Contém as funções de cada página do painel que são executadas 
 * automaticamente a cada requisição.
 * 
 * @author Aldaxis Marketing LTDA
 * 
 */
AldaxisPanel = {
    
    /**
     * Executa um método do namespace de uma página
     * específica.
     * 
     * @param {string} func
     * @param {string} funcname
     * @param {string} args
     * 
     */
    fire : function(func,funcname, args){

        //Objeto literal do namespace de páginas
        var namespace = AldaxisPanel['pages'];

        funcname = (funcname === undefined) ? 'init' : funcname;
        if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function'){
            namespace[func][funcname](args);
        }
    },
    
    /**
     * Método de inicialização chamado no evento
     * ready da página.
     * 
     */
    loadEvents : function(){
        
        //Resgata o id da página atual
        var pageId = $('.page').attr('id');
        
        //Executa funções comuns
        AldaxisPanel.fire('common');

        //Executa o método da página atual
        AldaxisPanel.fire(pageId);

    },
    
    /**
     * Namespace de páginas
     * 
     */
    pages : {
        
        /**
         * Página de login
         */
        login : {
            
            init : function(){
                
                //Declaração de variáveis
                var $form_signin = $('.form-signin');
                var $btnSubmit = $form_signin.find('.btn-submit');
                var $txtLogin = $form_signin.find('#txtLogin');
                var $txtPassword = $form_signin.find('#txtPassword');
                var $ckbRememberMe = $form_signin.find('#ckbRememberMe');
                var $box_errors = $('.errors');
                var showError = (function(text, type){

                    if(typeof(type) === 'undefined' || type === ''){
                        type = 'danger';
                    }

                    var html_error = '<div class="alert alert-' + type + ' alert-dismissable">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                        text +
                    '</div>';

                    $box_errors.hide().html(html_error).fadeIn();

                });
    
                //Focus on login field
                $txtLogin.focus();

                //Submit handler
                $form_signin.submit(function(e){      

                    if($txtLogin.val() === ''){

                        showError("Digite o seu login ou e-mail.");
                        $txtLogin.focus();
                        return false;
                    }

                    if($txtPassword.val() === ''){

                        showError("Digite a sua senha.");
                        $txtPassword.focus();
                        return false;
                    }

                    //Get data from the form
                    var post_data = $form_signin.serialize();

                    //Loading state
                    $btnSubmit.button('loading');
                    $txtLogin.attr('disabled', true);
                    $txtPassword.attr('disabled', true);
                    $ckbRememberMe.attr('disabled', true);
                    $box_errors.empty();

                    //Ajax submit
                    $.ajax({
                        type: 'POST',
                        url: $form_signin.attr('action'),
                        dataType: 'json',
                        data: post_data,
                        success: function(response){

                            if(response.status === 0){

                                showError(response.text);

                            }else{

                                showError(response.text, 'success');

                                window.location = '/' + response.location; 

                            }
                        }

                    }).always(function(){

                        //Enable fields
                        $txtLogin.removeAttr('disabled');
                        $txtPassword.removeAttr('disabled');
                        $ckbRememberMe.removeAttr('disabled');
                        $btnSubmit.button('reset');
                    });

                    e.preventDefault();
                });
                
            }
        } //login
        
    }
};

//Evento ready
$(document).ready(AldaxisPanel.loadEvents);
