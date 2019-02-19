        <div class="sidebar" data-color="blue">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="{{ route('index') }}" class="simple-text">                        
                        Consagre Imoveis
                    </a>
                </div>

                <ul class="nav">
                    <li class="{{ Route::current()->getName() == 'home' ? 'active' : ''}}">
                        <a href="{{ isset(Auth::user()->tipo) ? route('anunciante.plano') : route('home') }}">
                            <i class="pe-7s-graph"></i>
                            <p>{{ isset(Auth::user()->tipo) ? 'Plano' : 'Painel' }}</p>
                        </a>
                    </li>

                    <li class="{{ Route::current()->getName() == 'perfil.show' || 
                                Route::current()->getName() == 'account.show' ? 'active' : ''}}">
                        <a href="{{ isset(Auth::user()->tipo) ? route('anunciante.profile') :route('perfil.show')}}">
                            <i class="pe-7s-user"></i>
                            <p>Meu Perfil</p>
                        </a>
                    </li> 

                    <li class="{{ Route::current()->getName() == 'anuncios.listar' ? 'active' : '' }}">
                        <a href="{{ isset(Auth::user()->tipo) ? route('anunciantes.listar.anuncios') :route('anuncios.listar') }}">
                            <i class="pe-7s-note2"></i>                            
                            <p>{{ isset(Auth::user()->tipo) ? "Meus Anuncios" : "Anuncios Ativos" }}</p>
                        </a>
                    </li>  

                    @isset(Auth::user()->tipo) 
                        <li>
                            <a href="{{ route('anunciante.integrar.xml') }}">
                                <i class="pe-7s-door-lock"></i>
                                <p>Integrações</p>
                            </a>
                        </li> 
                    @endif   

                    @isset(Auth::user()->tipo) 
                        <li>
                            <a href="#">
                                <i class="pe-7s-home"></i>
                                <p>Captação de Imóveis</p>
                            </a>
                        </li> 
                    @endif  

                    
                    <li class="active-pro">
                        <a href="{{ isset(Auth::user()->tipo) ?  route('adicionaImovelAnunciante') : route('anunciar') }}">
                            <i class="pe-7s-news-paper"></i>
                            <p>Novo Anúncio</p>
                        </a>
                    </li>                    


                </ul>
            </div>
        </div> 