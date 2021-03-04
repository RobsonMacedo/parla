

<nav class="navbar navbar-expand-lg navbar-dark navbar-default">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">


                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/">Capa <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Outras Edições
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                        <span v-for="edition in editions">
                            <a class="dropdown-item" :href="'/editions/'+edition.number">Edição nº@{{ edition.number }} - @{{ edition.month_name }} de @{{ edition.year }}
                            </a>
                        </span>

                    </div>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">

                <div class="input-group">
                    <input class="form-control mr-sm-2 nav-search" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <div class="input-group-text" id="btnGroupAddon"><i class="fas fa-search"></i></div>
                    </div>
                </div>

            </form>
        </div>

    </div>

</nav>
