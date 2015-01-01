@extends('layouts.default')
 
@section('page')
    
<div id="orcamento" class="page pg-orcamento">
    
    <div class="banner"><div class="strip"></div>
        <div class="container"><div class="art-brand"></div>
            <div class="title">
                {{ HTML::image('images/icon_orcamento.png') }}
                <span>meu orçamento</span>
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="container">
            <div class="subtitle">
                {{ HTML::image('images/icon_lista_large.png') }}
                <span>Lista de orçamento</span>
            </div>
            <div class="lista-orcamento">
                <ul class="itens">
                    @if(count($orcamento) > 0)
                        @foreach($orcamento as $item)
                        <li data-id="{{ $item['id'] }}"><button class="btn-remover" title="Remover"></button>
                            <a href="/produtos/item/{{ $item['slug'] }}">
                                <div class="foto"></div>
                                <div class="info">
                                    <p class="nome">{{ str_limit($item['nome'], 15) }}<br /><span>{{ str_limit($item['fabricante'], 20) }}</span></p>
                                    <p class="quantidade">{{ $item['quantidade'] }} @if($item['quantidade'] == 1)unid. @else unids. @endif</p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    @else
                        <li class="empty">Nenhum item adicionado.</li>
                    @endif
                </ul>
                @if(count($pagination['links']) - 2 > 1)
                <div class="box-pagination">
                    <ul class="pagination">
                        @foreach($pagination['links'] as $lnk)
                            {{ $lnk }}
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            @if(count($orcamento) > 0)
            <div class="envio-orcamento"><div class="shadow"></div>
                
                <div class="header">
                    <div class="title">
                        {{ HTML::image('images/icon_orcamento2.png') }}
                        <span>Siga os passos para<br />o envio de seu orçamento.</span>
                    </div>
                    <button id="btnJaSou" class="btn-action btn-jasou" data-target="#frmJaSou"></button>
                    <button id="btnNaoSou" class="btn-action btn-naosou" data-target="#frmNaoSou"></button>
                </div>
                <div class="form-box frm-jasou" id="frmJaSou">
                    <p class="form-text">Dados de confirmação</p>
                    
                    {{ Form::open(array('url' => 'meu-orcamento/submit-registered')) }}
                    <div class="col left-col">
                        <div class="form-group">
                            <input type="text" class="form-control" name="empresa" id="txtEmpresa" maxlength="255" placeholder="empresa" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="cnpj" id="txtCnpj" maxlength="18" value="" placeholder="CNPJ" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="txtEmail" maxlength="255" placeholder="e-mail" value="" />
                        </div>
                    </div>
                    <div class="col middle-col">
                        <div class="form-group">
                            <textarea class="form-control textarea" name="observacoes" id="txtObservacoes" placeholder="observações do pedido"></textarea>
                        </div>
                        <input type="hidden" name="tipo" value="cadastrado" />
                        <input type="submit" class="btn-enviar" value="" />
                    </div>
                    {{ Form::close() }}
                </div>
                <div class="form-box frm-naosou" id="frmNaoSou">
                    <p class="form-text">Preencha os campos para efetuar o cadastro</p>
                    
                    {{ Form::open(array('url' => 'meu-orcamento/submit-nonregistered')) }}
                    <div class="col left-col">
                        <div class="form-group">
                            <input type="text" class="form-control" name="empresa" id="txtEmpresa" maxlength="255" placeholder="empresa" value="" />
                            {{ $errors->first('empresa'); }}
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control cnpj" name="cnpj" id="txtCnpj" maxlength="18" placeholder="CNPJ" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="inscricao_estadual" id="txtInscricaoEstadual" placeholder="inscrição estadual" maxlength="100" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="endereco" id="txtEndereco" maxlength="100" placeholder="endereço" value="" />
                        </div>
                        <div class="row">
                            <div class="input-col col-xs-4">
                                <div class="form-group">
                                    <select class="form-control" name="estado" id="txtEstado">
                                        <option value="">estado</option>
                                        @foreach($estados as $estado)
                                        <option value="{{ $estado->id }}">{{ $estado->sigla }}</option>
                                        @endforeach
                                    </select>  
                                </div>
                            </div>
                            <div class="input-col col-xs-8">
                                <div class="form-group">
                                    <select class="form-control" name="cidade" id="txtCidade">
                                        <option value="">cidade</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col middle-col">
                        <div class="row">
                            <div class="input-col col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="complemento" id="txtComplemento" maxlength="255" placeholder="complemento" value="" />
                                </div>
                            </div>
                            <div class="input-col col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="form-control cep" name="cep" id="txtCep" maxlength="9" placeholder="CEP" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-col col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="form-control phone" name="telefone" id="txtTelefone" maxlength="15" placeholder="telefone" value="" />
                                </div>
                            </div>
                            <div class="input-col col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="form-control phone" name="celular" id="txtCelular" maxlength="15" placeholder="celular" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="txtEmail" 
                                   maxlength="255" placeholder="e-mail" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nome" id="txtNome" maxlength="255" placeholder="nome" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="cargo" id="txtCargo" maxlength="255" placeholder="cargo" value="" />
                        </div>
                    </div>
                    <div class="col right-col">
                        <div class="form-group">
                            <textarea class="form-control textarea" name="observacoes" id="txtObservacoes" placeholder="observações do pedido"></textarea>
                        </div>
                        <input type="hidden" name="tipo" value="nao-cadastrado" />
                        <input type="submit" class="btn-enviar" value="" />
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            @endif
        </div>
    </div>
    
</div>

@stop