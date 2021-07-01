@extends('layouts.app')
  @section('content')
  <div id="app">
    <header-component ></header-component>
    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky pt-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">
                  <i class="fas fa-gavel feather feather-home"></i>
                  Ставки
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-clipboard-list feather feather-home"></i>
                  Стратегия
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fas fa-chart-bar feather feather-home"></i>
                  Статистика
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <table-component></table-component>
      </div>
    </div>
  </div>
  @endsection
    
