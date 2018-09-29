        <div class="sidebar" data-color="blue">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="{{ route('home') }}" class="simple-text">
                        Consagre Imoveis
                    </a>
                </div>

                <ul class="nav">
                    <li class="{{ Route::current()->getName() == 'home' ? 'active' : ''}}">
                        <a href="{{ route('home') }}">
                            <i class="pe-7s-graph"></i>
                            <p>Painel</p>
                        </a>
                    </li>

                    <li class="{{ Route::current()->getName() == 'perfil.show' || 
                                Route::current()->getName() == 'account.show' ? 'active' : ''}}">
                        <a href="{{ route('perfil.show')}}">
                            <i class="pe-7s-user"></i>
                            <p>Meu Perfil</p>
                        </a>
                    </li> 

                    <li class="{{ Route::current()->getName() == 'anuncios.listar' ? 'active' : '' }}">
                        <a href="{{ route('anuncios.listar') }}">
                            <i class="pe-7s-note2"></i>
                            <p>Anuncios Ativos</p>
                        </a>
                    </li>                     
                    
                    <li class="active-pro">
                        <a href="upgrade.html">
                            <i class="pe-7s-rocket"></i>
                            <p>Upgrade VIP</p>
                        </a>
                    </li>                    


                </ul>
            </div>
        </div> 