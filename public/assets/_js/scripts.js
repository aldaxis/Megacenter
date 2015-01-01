/**
 * 
 * Scripts Mega center
 * 
 * Contém as funções de cada página do site que são executadas 
 * automaticamente a cada requisição.
 * 
 * @author Aldaxis Marketing LTDA
 * 
 */
Megacenter = {
    
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
        var namespace = Megacenter['pages'];

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
        Megacenter.fire('common');

        //Executa o método da página atual
        Megacenter.fire(pageId);

    },
    
    /**
     * Namespace de páginas
     * 
     */
    pages : {
        
        /**
         * Página home
         */
        home : {
            
            init : function(){
                
                var $boxCarrossel = $('.box-marcas');
                
                $boxCarrossel.find('ul').carouFredSel({
                    items : {
                        visible : 5, 
                        minimum : 6
                    },
                    scroll : {
                        items			: 4,
                        duration		: 1000,
                        timeoutDuration	: 5000
                    },
                    prev	: $boxCarrossel.find('.btn-left'),
                    next	: $boxCarrossel.find('.btn-right')
                }).parent().css("margin", "auto");
                
            }
        },
        
         /**
         * Página empresa
         */
        empresa : {
            
            init : function(){      
                
                var $boxCarrossel = $('.box-marcas');
                
                $boxCarrossel.find('ul').carouFredSel({
                    items : {
                        visible : 1, 
                        minimum : 2
                    },
                    scroll : {
                        items			: 1,
                        duration		: 500,
                        timeoutDuration	: 4000,
                        fx              : 'crossfade'
                    }
                }).parent().css("margin", "auto");
                
            }
        },
        
        /**
         * Página de produtos
         */
        produtos : {
            
            init : function(){
                
                var $categorias = $('.categorias');
                
                //Operações sobre o menu de categorias
                $.each($categorias.find('li'), function(i, c){
                    
                    $c = $(c);
                    
                    if($c.children('ul').length > 0){
                        
                        $c.addClass('dropdown');
                        
                        //Verifica se está ativo e exibe as subcategorias
                        if($c.hasClass('active')){
                            $c.children('ul').show();
                        }   
                    }
                    
                });
                
                
                //Busca
                $btnBuscar = $('#btnBuscar');
                $txtBusca = $('#txtBusca');
                
                $btnBuscar.bind('click', function(e){
                    
                    var chave = $txtBusca.val();
                    
                    if(!chave || 0 === chave.length){
                        $txtBusca.focus();
                        return false;
                    }
                    
                    window.location.href = '/produtos/busca/' + chave;
                    
                    e.preventDefault();
                });
                
                
                //Orçamento
                var $boxProduto = $('.box-produto');
                var $btnAdicionar = $('#btnAdicionar');
                var $txtQuantidade = $('#txtQuantidade');
                var $listaItens = $('.lista-orcamento .itens');
                
                //Mask
                $txtQuantidade.mask('000000');
                
                //Adiciona um item à lista de orçamento
                $btnAdicionar.bind('click', function(e){
                    
                    var id = $boxProduto.attr('data-id');
                    var nome = $boxProduto.find('#txtNome').val();
                    var slug = $boxProduto.find('#txtSlug').val();
                    var fabricante = $boxProduto.find('#txtFabricante').val();
                    var qtde = parseInt($txtQuantidade.val());
                    
                    //Validação da quantidade
                    if(typeof qtde === "undefined" || isNaN(qtde) || qtde <= 0){
                        qtde = 1;
                    }

                    $.ajax({
                        type: 'post',
                        url: '/meu-orcamento/adicionar',
                        dataType: 'json',
                        data: {'id': id, 'slug': slug, 'nome': nome, 'fabricante': fabricante, 'qtde':qtde},
                        success: function(response) {
                            
                            var item = response.itens[id];
                            var qtdeText = item.quantidade + ' ' + ((item.quantidade == 1) ? "unid." : "unids.");

                            if(response.status === 1) {
                                
                                $listaItens.find('li.empty').remove();
                                
                                var $li = $(
                                '<li data-id="' + item.id + '">' +
                                '<div class="box">' +
                                '<button class="btn-remover" title="Remover"></button>' +
                                '<p class="nome">' + item.nome + '<br /><span>' + item.fabricante + '</span></p>' +
                                '<p class="quantidade">' + qtdeText + '</p>' +
                                '</div>' +
                                '</li>').css({'margin-top': '-100px'});

                                $li.prependTo($listaItens).animate({'margin-top':'0'}, {duration: 500, queue: false, easing: 'elastic', complete: function(){

                                    /*if($listaItens.children().length > 2){
                                        $listaItens.find('li:last').remove();
                                    }*/

                                }}).effect("highlight", 500);
 
                            }
                            //O produto já foi adicionado
                            else if (response.status === 2){

                                var $li = $listaItens.find('li[data-id="' + item.id + '"]');
                                
                                $li.find('.quantidade').html(qtdeText).stop(true, true).effect('highlight');
                                
                                $txtQuantidade.val(item.quantidade);

                                //Verifica se não está visível na lista
                                if($li.index() > 1){
                                    
                                    alert('Esse produto já foi adicionado!\nA quantidade foi alterada para ' + qtdeText);
                                }
                            }
                            
                        }
                    });
                    
                    e.preventDefault();
                });
                
                //Remove o item selecionado
                $listaItens.delegate('li .btn-remover', 'click', function(e){
                    
                    var $self = $(this);
                    var $li = $self.parent().parent();
                    var id = $li.attr('data-id');
                    
                     $.ajax({
                        type: 'post',
                        url: '/meu-orcamento/remover',
                        dataType: 'json',
                        data: {'id': id},
                        success: function(response) {
                           
                            if(response.status === 1){
                                
                                $li.slideUp(150, function(){
                                    
                                    $li.remove();
                                    $txtQuantidade.val('');
                                    
                                    if($listaItens.find('li').length === 0){
                                        
                                        $liEmpty = $('<li class="empty">Nenhum item adicionado.</li>').hide();
                                        $liEmpty.appendTo($listaItens).fadeIn(200);
 
                                    }
                                });
                                
                            }
                            
                        }
                        
                     });

                    e.preventDefault();
                });
                
            }
        },
        
        /**
         * Página de orçamento
         */
        contato: {
            
            init: function() {
               // 
            }
            
        },
        
        /**
         * Página de orçamento
         */
        orcamento: {
            
            init: function() {
                
                var $listaOrcamento = $('.lista-orcamento');
                var $listaItens = $listaOrcamento.find('.itens');
                var $envioOrcamento = $('.envio-orcamento');
                
                //Remove o item selecionado
                $listaItens.delegate('li .btn-remover', 'click', function(e){
                    
                    var $self = $(this);
                    var $li = $self.parent();
                    var id = $li.attr('data-id');
                    
                     $.ajax({
                        type: 'post',
                        url: '/meu-orcamento/remover',
                        dataType: 'json',
                        data: {'id': id},
                        success: function(response) {
                           
                            if(response.status === 1){
                                
                                $li.fadeOut(200, function(){
                                    
                                    $li.remove();
                                    
                                    if($listaItens.find('li').length === 0){
                                        
                                        $liEmpty = $('<li class="empty">Nenhum item adicionado.</li>').hide();
                                        $liEmpty.appendTo($listaItens).fadeIn(200);
                                        
                                        //Remove as opções de envio
                                        $envioOrcamento.remove();
 
                                    }
                                });
                                
                            }
                            
                        }
                        
                     });

                    e.preventDefault();
                });
                
                var $buttons = $envioOrcamento.find('.btn-action');
                var $formBoxes = $envioOrcamento.find('.form-box');
                
                //Evento dos botões de ação
                $buttons.bind('click', function(){
                    
                    var $self = $(this);
                    var target = $self.attr('data-target');
                    var $formBox = $formBoxes.filter(target);
                    
                    $buttons.not($self).fadeOut();
                    
                    $self.animate({'right':'126px'}, 400);
                    
                    $formBox.slideDown();
                        
                });
                
                //Form validation
                $formBoxes.find('form').bind('submit', function(e){
                    
                    var $form = $(this);

                    $.ajax({
                        type: 'POST',
                        url: $form.attr('action'),
                        dataType: 'json',
                        data: $form.serialize(),
                        success: function(response){
                            
                            //Verifica se não passou na validação
                            if(response.success === false){
                                
                                if(response.status === 1){
                                    
                                    var $input;
                                    var $e;
                                    
                                    //Remove as mensagems de erro anteriores
                                    $form.find('span.error').remove();
                                    
                                    $.each(response.errors, function(i, erro){
                                        
                                        //Define o input atual
                                        $input = $form.find('.form-control[name="' + i + '"]');
                                        //$input.parent().addClass('has-error');
                                        
                                        //Exibe a mesagem de erro abaixo da input
                                        $e = $('<span class="error text-danger">' + erro[0] + '</span>').hide();
                                        $e.insertAfter($input).fadeIn(300);
                                        
                                    });
                                    
                                }
                                else if(response.status === 2){
                                    
                                    alert('No momento não foi possível enviar seu orçamento.\nTente novamente...');
                                    
                                }
                                
                            }else {
                                
                                //Remove os itens da pagina
                                $listaOrcamento.remove();
                                $envioOrcamento.remove();
                                
                                //Exibe a mensagem de sucesso
                                $success = $('<div class="success"><p class="text-success">Seu orçamento foi enviado! <br />Em breve entraremos em contato.</p></div>').hide();
                                $success.appendTo("#orcamento .content .container").fadeIn();
                            }
                            
                        }
                    });
                    
                    e.preventDefault();
                });

                //Masks
                $formBoxes.find('.form-control.cnpj').mask('00.000.000/0000-00');
                $formBoxes.find('.form-control.phone').mask('(00) 00000-0000');
                $formBoxes.find('.form-control.cep').mask('00000-000');
                
                //Select de estado e cidade
                var $selectEstado = $formBoxes.filter('#frmNaoSou').find('form #txtEstado');
                var $selectCidade = $formBoxes.filter('#frmNaoSou').find('form #txtCidade');

                $selectEstado.change(function(){

                    var $self = $(this);
                    var estado = $self.val();
                    
                    if(typeof estado !== 'undefined' && estado !== ''){

                        $selectCidade.empty().html('<option value="">Carregando...</option>');

                        $.ajax({
                            type: 'GET',
                            url: '/cidades/get/' + estado,
                            dataType: 'json',
                            success: function(cidades){

                                $selectCidade.empty().html('<option value="">selecione a cidade</option>');

                                $.each(cidades, function(i, cidade){

                                    $selectCidade.append('<option value="' + cidade.id + '">' + cidade.nome + '</option>');

                                });

                            }

                        });
                        
                    }else {
                        
                        $selectCidade.empty().html('<option value="">cidade</option>');
                    }

                });
                
            }
            
        }
        
    }
};

//Evento ready
$(document).ready(Megacenter.loadEvents);
