        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
          <div class="mm-logo-buttons-w">
            <a class="mm-logo" href=""><span>Consagre Admin</span></a>
            <div class="mm-buttons">
              <div class="content-panel-open">
                <div class="os-icon os-icon-grid-circles"></div>
              </div>
              <div class="mobile-menu-trigger">
                <div class="os-icon os-icon-hamburger-menu-1"></div>
              </div>
            </div>
          </div>


          <div class="menu-and-user">
            <div class="logged-user-w">
              <div class="avatar-w">
                <img alt="" src="{{ asset('/images/profile.png') }}">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                  Nome do Usuário
                </div>
                <div class="logged-user-role">
                  Função
                </div>
              </div>
            </div>

            <!--------------------
            START - Mobile Menu List
            -------------------->
            <ul class="main-menu">

              <li class="has-sub-menu">

                <a href="">
                  <div class="icon-w">
                    <div class="os-icon os-icon-layout"></div>
                  </div>
                  <span>Painel Administrativo</span>
                </a>

                <ul class="sub-menu">
                  <li>
                    <a href="{{ route('admin.dashboard') }}"> Home </a>
                  </li>
                </ul>

              </li>

              <li class="has-sub-menu">

                <a href="#">
                  <div class="icon-w">
                    <div class="os-icon os-icon-users"></div>
                  </div>
                  <span> Usuários </span>
                </a>

                <ul class="sub-menu">

                  <li>
                    <a href="">Adicionar <strong class="badge badge-danger">Novo</strong></a>
                  </li>

                  <li>
                    <a href=""> Listar Imobiliárias / Corretores </a>
                  </li>

                  <li>
                    <a href="">Listar Usuários Simples</a>
                  </li>

                </ul>

              </li>

              <li class="has-sub-menu">

                <a href="#">
                  <div class="icon-w">
                    <div class="os-icon os-icon-package"></div>
                  </div>
                  <span>Anúncios / Imóveis </span>
                </a>

                <ul class="sub-menu">

                    <li>
                        <a href=""> Adicionar <strong class="badge badge-danger">Novo</strong></a>
                    </li>

                    <li>
                       <a href=""> Listar Ativos </a>
                    </li>
                    <li>
                        <a href="">LIstar Inativos</a>
                    </li>

                    <li>
                        <a href=""> Super Destaques</a>
                    </li>

                </ul>
              </li>

              <li class="has-sub-menu">

                <a href="#">
                  <div class="icon-w">
                    <div class="os-icon os-icon-file-text"></div>
                  </div>
                  <span>Relátorios</span>
                </a>

                <ul class="sub-menu">

                  <li>
                    <a href="misc_charts.html"> Pagamentos Recebidos </a>
                  </li>
                </ul>
              </li>


              <li class="has-sub-menu">
                <a href="#">
                  <div class="icon-w">
                    <div class="os-icon os-icon-grid"></div>
                  </div>
                  <span>Configurações</span></a>

                <ul class="sub-menu">
                  <li>
                    <a href="">Informações de Contato</a>
                  </li>
                  <li>
                    <a href="">Alterar Senha de Acesso</a>
                  </li>
                  <li>
                    <a href="">Perfil</a>
                  </li>

                </ul>
              </li>

            </ul>
            <!--------------------
            END - Mobile Menu List
            -------------------->

          </div>

        </div>


       <div class="menu-w color-scheme-light color-style-default menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover">
          <div class="logo-w">
            <a class="logo" href="">
              <div class="logo-element"></div>
              
              <div class="logo-label">
                Consagre Admin
              </div>
            </a>
          </div>

          <div class="element-search autosuggest-search-activator">
            <input placeholder="Pesquisar..." type="text">
          </div>

          <ul class="main-menu">

            <li class="sub-header">
              <span>Opções</span>
            </li>

            <li class="has-sub-menu">

              <a href="">
                <div class="icon-w">
                  <div class="os-icon os-icon-users"></div>
                </div>
                <span>Usuários</span>
              </a>

              <div class="sub-menu-w">

                <div class="sub-menu-header">
                  Usuários
                </div>

                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-users"></i>
                </div>

                <div class="sub-menu-i">

                  <ul class="sub-menu">
                    <li>
                      <a href="{{ route('options.admin', ['usuarios', 'add']) }}">Adicionar <strong class="badge badge-danger">Novo</strong></a>
                    </li>
                    <li>
                      <a href="{{ route('options.admin', ['usuarios', 'anunciantes']) }}"> Listar Imobiliárias / Corretores </a>
                    </li>
                    <li>
                      <a href="{{ route('options.admin', ['usuarios', 'list_user_simple']) }}">Listar Usuários Simples</a>
                    </li>
                  </ul>

                </div>
              </div>
            </li>

            <li class="has-sub-menu">
              <a href="">                
                <div class="icon-w">
                  <div class="os-icon os-icon-home"></div>
                </div>
                <span>Anúncios/Imóveis</span>
              </a>

              <div class="sub-menu-w">
                
                <div class="sub-menu-header">
                  Anúncios
                </div>

                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-home"></i>
                </div>

                <div class="sub-menu-i">

                  <ul class="sub-menu">
                    
                    <li>
                      <a href="{{ route('options.admin', ['anuncios', 'super_destaques']) }}">
                      Super Destaques</a>
                    </li>
                    <li>
                      <a href="{{ route('options.admin', ['anuncios', 'destaques']) }}">
                      Destaques</a>
                    </li>
                    <li>
                      <a href="{{ route('options.admin', ['anuncios', 'simples']) }}">
                      Anúncios Simples</a>
                    </li>
                    <li>
                      <a href="{{ route('options.admin', ['anuncios', 'captacao']) }}">
                      Anúncios Para Captação</a>
                    </li>

                  </ul>

                </div>

              </div>
            </li>

            <li class="has-sub-menu">
              <a href="">                
                <div class="icon-w">
                  <div class="os-icon os-icon-window-content"></div>
                </div>
                <span>Planos</span>
              </a>

              <div class="sub-menu-w">
                
                <div class="sub-menu-header">
                  Planos
                </div>

                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-window-content"></i>
                </div>

                <div class="sub-menu-i">

                  <ul class="sub-menu">
                    
                    <li>
                      <a href="{{ route('options.admin', ['planos', 'gerenciar']) }}"> Gerenciar Planos </a>
                    </li>                   

                  </ul>

                </div>

              </div>
            </li>

            <li class="has-sub-menu">

              <a href="{{ route('options.admin', ['tickets', 'listar']) }}">                
                <div class="icon-w">
                  <div class="os-icon os-icon-ui-54"></div>
                </div>
                <span>Ticket Suporte</span>
              </a>

            </li>

            <li class="has-sub-menu">

              <a href="{{ route('options.admin', ['mensagens', 'all']) }}">                
                <div class="icon-w">
                  <div class="os-icon os-icon-mail"></div>
                </div>
                <span>Email/Mensagens</span>
              </a> 

            </li>

            <li class="sub-header">
              <span>Informações de Pagamentos</span>
            </li>

            <li class=" has-sub-menu">
              <a href="apps_bank.html">
                <div class="icon-w">
                  <div class="os-icon os-icon-wallet-loaded"></div>
                </div>
                <span>Pagamentos </span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Gerencia Net
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-wallet-loaded"></i>
                </div>
                <div class="sub-menu-i">

                  <ul class="sub-menu">

                    <li>
                      <a href="{{ route('options.admin', ['payment_methods', 'config']) }}">Cadastrar Novo</a>
                    </li>

                    <li>
                      <a href="{{ route('options.admin', ['payment', 'gerencia_net']) }}">Listar Integrações</a>
                    </li>

                    <li>
                      <a href="{{ route('options.admin', ['payment', 'subscriptions']) }}"> Assinaturas <strong class="badge badge-danger">New</strong></a>
                    </li>
                    <li>
                      <a href="{{ route('options.admin', ['payment', 'received']) }}"> Pagamentos Recebidos </a>
                    </li>
                  </ul>

                </div>
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-file-text"></div>
                </div>
                <span>Boletos</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Boletos
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-file-text"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">

                    <li>
                      <a href="{{ route('options.admin', ['billet', 'paid']) }}">Boletos Pagos<strong class="badge badge-danger">New</strong></a>
                    </li>
                    <li>
                      <a href="{{ route('options.admin', ['billet', 'canceled']) }}">Boletos Vencidos / Cancelados</a>
                    </li>
                    <li>
                      <a href="{{ route('options.admin', ['billet', 'waiting']) }}">Em Aberto</a>
                    </li>

                  </ul>
                </div>
              </div>
            </li>


            <li class="sub-header">
              <span>Configurações</span>
            </li>

            <li class=" has-sub-menu">

              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-user-male-circle2"></div>
                </div>
                <span>Dados de Login</span>
              </a>

            </li>

            <li class="has-sub-menu">
              
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-ui-46"></div>
                </div>
                <span>Sistema</span>
              </a>

            </li>

            <li class="has-sub-menu">

              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-facebook"></div>
                </div>
                <span>Redes Sociais</span>
              </a> 

              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Perfil Social
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-file-text"></i>
                </div>
                <div class="sub-menu-i">

                  <ul class="sub-menu">

                    <li>
                      <a href="">Facebook</a>
                    </li>
                    <li>
                      <a href="">Instagram</a>
                    </li>
                    <li>
                      <a href="">Twitter</a>
                    </li>
                    <li>
                      <a href="">Youtube</a>
                    </li>
                    <li>
                      <a href="">Pinterest</a>
                    </li>

                  </ul>

                </div>
              </div>

            </li>


          </ul>

          <div class="side-menu-magic">
            <h4>
              Consagre Imóveis
            </h4>
            <p>
              O melhor sistema de Imóveis da Baixada Santista
            </p>
            <div class="btn-w">
              <a class="btn btn-white btn-rounded" href="https://www.consagreimoveis.com.br" target="_blank">
                Anuncie seu Imóvel
              </a>
            </div>
          </div>



        </div>