<?php

class OrcamentoController extends BaseController {

    /**
     * Página home
     * 
     * @return View
     */
	public function getIndex()
	{
        //Resgata o numero da página
        $pg = intval(Input::get('page', 1));
        
        //Resgata os produtos da lista de orçamento
        $orcamento = ListaOrcamento::getAll();
        
        //Divide o array
        $pages = array_chunk($orcamento, 8);
        $total = count($pages);
        
        //Valida a página
        if($pg <= 0){
            $pg = 1;
        }
        
        if($pg > $total){
           $pg = $total; 
        }
        
        //Itens que serão exibidos
        $display_itens = array();
        
        if(isset($pages[$pg - 1])){
        
            //Resgata os itens da pagina atual
            $display_itens = $pages[$pg - 1]; 
        }
        
        //Variáveis da paginação
        $pagination = array();
        $base_link = '/meu-orcamento';
        
        //Faz a paginação
        if($pg == 1){
            $pagination['links'][] = '<li class="disabled"><span>&laquo;</span></li>';
        }else{
            $pagination['links'][] = '<li><a href="' . $base_link . '?page=' . ($pg - 1) . '" rel="prev">&laquo;</a></li>';
        }
        
        for($i = 1; $i < $total + 1; $i++){
   
            if($pg == $i){
                $pagination['links'][] = '<li class="active"><span>' . $i . '</span></li>';
            }else {
                $pagination['links'][] = '<li><a href="/meu-orcamento?page=' . $i . '">' . $i . '</li></a>';
            }

        }
        
        if($pg >= $total){
            $pagination['links'][] = '<li class="disabled"><span>&raquo;</span></li>';
        }else{
            $pagination['links'][] = '<li><a href="' . $base_link . '?page=' . ($pg + 1) . '" rel="next">&raquo;</a></li>';
        }
        
        //Resgata os estados cadastrados
        $estados = Estado::all(array('id', 'sigla'));
        
        //Define o título da página
        View::share('title', "Megacenter | Meu orçamento");
        
        return View::make('meuorcamento', array('orcamento' => $display_itens, 'pagination' => $pagination, 'estados' => $estados));
	}
    
    /**
     * Adiciona um item ao orçamento
     * 
     * @return Response Json
     */
    public function postAddItem(){
        
        //Resgata as variáveis
        $id = Input::get('id');
        $slug = Input::get('slug');
        $nome = Input::get('nome');
        $fab = Input::get('fabricante');
        $qtde = Input::get('qtde');
        
        $item = array('id' => $id, 'slug' => $slug, 'nome' => $nome, 'fabricante' => $fab, 'quantidade' => $qtde);
        
        $status = 1;
        
        //Verifica se o item já foi adicionado
        if(ListaOrcamento::has($id)){
            
            $sessItem = ListaOrcamento::getItem($id);
            
            //Se for a mesma quantidade incrementamos 1
            if($qtde == $sessItem['quantidade'] && $qtde < 999999){
                
                $item['quantidade'] = $item['quantidade'] + 1;
            }
            
            $status = 2;
        }
        
        ListaOrcamento::add($item);
        
        $itens = ListaOrcamento::getAll(true);
        
        return Response::json(array('status' => $status, 'itens' => $itens));
    }
    
    /**
     * Remove um item do orçamento
     * 
     * @return Response Json
     */
    public function postRemoveItem(){
        
        $id = Input::get('id');
        
        ListaOrcamento::remove($id);
        
        return Response::json(array('status' => 1));
        
    }
    
    /**
     * Realiza o envio do formulário de orçamento
     * para empresas já cadastradas
     */
    public function postSubmitRegistered(){
        
        $cnpj = Common::soNumeros(Input::get('cnpj'));
        
        //Make validator
        $validator = Validator::make(
            array(
                'cnpj' => $cnpj,
                'email' => Input::get('email')
            ),
            array(
                'cnpj' => 'required|cnpj|exists:empresas,cnpj|max:18',
                'email' => 'required|email|exists:empresas,email_contato',
            ),
            array(
                'cnpj.required' => 'Digite o CNPJ da empresa.',
                'cnpj.cnpj' => 'Número de CNPJ inválido.',
                'cnpj.exists' => 'O CNPJ informado não foi encontrado.',
                'email.required' => 'Digite o endereço de e-mail.',
                'email.email' => 'Endereço de e-mail inválido.',
                'email.exists' => 'O endereço de e-mail não foi encontrado.',
                'min' => 'Esse campo deve ter no mínimo :min caracteres.',
                'max' => 'Esse campo deve ter no máximo :max caracteres.',
            )
        );
        
        //Se não passar na validação
        if ($validator->fails())
        { 
            
            return Response::json(array(
                'success' => false,
                'status' => 1,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }
        
        //Resgata a empresa pelo cnpj
        $empresa = Empresa::where('cnpj', $cnpj)->firstOrFail();
          
        //Default response
        $response = array('success' => false, 'status' => 2);
        
        //Envia os emails
        $response = array('success' => true);
        
        //Limpa a lista de orçamento
        ListaOrcamento::clear();
        
        //Retorna a mensagem de sucesso
        return Response::json($response);
        
    }
    
    /**
     * Realiza o envio do formulário de orçamento
     * para empresas não cadastradas
     */
    public function postSubmitNonRegistered(){
        
        //Make validator
        $validator = Validator::make(
            array(
                'empresa' => Input::get('empresa'),
                'cnpj' => Common::soNumeros(Input::get('cnpj')),
                'inscricao_estadual' => Input::get('inscricao_estadual'),
                'endereco' => Input::get('endereco'),
                'estado' => Input::get('estado'),
                'cidade' => Input::get('cidade'),
                'complemento' => Input::get('complemento'),
                'cep' => Input::get('cep'),
                'telefone' => Input::get('telefone'),
                'celular' => Input::get('celular'),
                'email' => Input::get('email'),
                'nome' => Input::get('nome'),
                'cargo' => Input::get('cargo')
            ),
            array(
                'empresa' => 'required|min:5|max:200',
                'cnpj' => 'required|cnpj|unique:empresas|max:18',
                'inscricao_estadual' => 'numeric:max:20',
                'endereco' => 'required|max:200',
                'estado' => 'required',
                'cidade' => 'required',
                'cep' => 'required|max:9',
                'telefone' => 'required_without:celular',
                'celular' => 'required_without:telefone',
                'email' => 'required|email',
                'nome' => 'required|min:5|max:200',
                'cargo' => 'max:100',
            ),
            array(
                'empresa.required' => 'Digite o nome da empresa.',
                'cnpj.required' => 'Digite o CNPJ da empresa.',
                'cnpj.cnpj' => 'Número de CNPJ inválido.',
                'cnpj.unique' => 'O CNPJ informado já está cadastrado no sistema.',
                'inscricao_estadual.ie' => 'Inscrição Estadual inválida para o estado selecionado.',
                'endereco.required' => 'Digite o endereço da empresa.',
                'estado.required' => 'Selecione o estado.',
                'cidade.required' => 'Selecione a cidade.',
                'cep.required' => 'Digite o CEP.',
                'telefone.required_without' => 'Informe um telefone',
                'celular.required_without' => 'ou celular.',
                'email.required' => 'Digite um endereço de e-mail.',
                'email.email' => 'Endereço de e-mail inválido.',
                'nome.required' => 'Digite seu nome',
                'min' => 'Esse campo deve ter no mínimo :min caracteres.',
                'max' => 'Esse campo deve ter no máximo :max caracteres.',
                'numeric' => 'Esse campo deve conter somente números.'
            )
        );
        
        //Se não passar na validação
        if ($validator->fails())
        { 
            
            return Response::json(array(
                'success' => false,
                'status' => 1,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }
        
        //Cria um novo model Empresa
        $empresa = new Empresa();
        $empresa->nome = Input::get('empresa');
        $empresa->cnpj = Common::soNumeros(Input::get('cnpj'));
        $empresa->inscricao_estadual = Input::get('inscricao_estadual');
        $empresa->endereco = Input::get('endereco');
        $empresa->estado_id = Input::get('estado');
        $empresa->cidade_id = Input::get('cidade');
        $empresa->complemento = Input::get('complemento');
        $empresa->cep = Input::get('cep');
        $empresa->telefone = Input::get('telefone');
        $empresa->celular = Input::get('celular');
        $empresa->email_contato = Input::get('email');
        $empresa->nome_contato = Input::get('nome');
        $empresa->cargo_contato = Input::get('cargo');
        
        //Default response
        $response = array('success' => false, 'status' => 2);
        
        //Envia os emails
        
        
        //Limpa a lista de orçamento
        ListaOrcamento::clear();
        
        //Salva a empresa no banco de dados
        if($empresa->save()){
            $response = array('success' => true);   
        }
        
        //Retorna a mensagem de sucesso
        return Response::json($response);
        
    }

}
