<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    
    <a class="nav-link" href="/home">
        <i class="fas fa-home"></i><span>Inicio</span>
    </a>
    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-building"></i>Inmobiliaria
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a class="dropdown-item custom-link" href="/propiedad"><i class="fas fa-home"></i><span>Propiedades</span></a>
            <a class="dropdown-item custom-link" href="/ventas"><i class="fas fa-shopping-cart"></i><span>Ventas</span></a>
            <!-- <div class="dropdown-divider"></div> -->
            <a class="dropdown-item custom-link" href="/seguimiento"><i class="fas fa-route"></i><span>Seguimiento</span></a>
            <a class="dropdown-item custom-link" href="/cliente"><i class="fas fa-user"></i><span>Clientes</span></a>
          </div>
    </li>
    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-book"></i>Cursos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a class="dropdown-item" href="/curso"><i class="fas fa-book"></i><span>Cursos</span></a>
            <a class="dropdown-item" href="/ventasCurso"><i class="fas fa-shopping-cart"></i><span>Ventas</span></a>
            <!-- <div class="dropdown-divider"></div> -->
            <a class="dropdown-item" href="/pago"><i class="fas fa-money-check-alt"></i><span>Pagos</span></a>
            <a class="dropdown-item" href="/cliente"><i class="fas fa-user"></i><span>Clientes</span></a>
          </div>
    </li>
    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-users"></i>Usuarios
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a class="dropdown-item" href="{{route('usuarios.create')}}"><i class="fas fa-user"></i><span>Nuevo usuario</span></a>
            <a class="dropdown-item" href="/usuarios"><i class="fas fa-users"></i><span>Listar usuarios</span></a>
          </div>
    </li>
    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-chart-bar"></i>Reportes
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a class="dropdown-item" href="/reporte"><i class="fas fa-circle"></i><span>Reportes</span></a>
          </div>
    </li>
    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-university"></i>Créditos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a class="dropdown-item" href="{{route('usuarios.create')}}"><i class="fas fa-university"></i><span>Nuevo crédito</span></a>
            <a class="dropdown-item" href="/usuario"><i class="fas fa-list"></i><span>Listar créditos</span></a>
            <a class="dropdown-item" href="/seguimiento"><i class="fas fa-route"></i><span>Seguimiento</span></a>
            <a class="dropdown-item" href="/cliente"><i class="fas fa-user"></i><span>Clientes</span></a>
          </div>
    </li>
    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-calendar"></i>Calendario
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a class="dropdown-item" href="{{route('usuarios.create')}}"><i class="fas fa-calendar"></i><span>Inicio</span></a>
          </div>
    </li>
    
</li>

