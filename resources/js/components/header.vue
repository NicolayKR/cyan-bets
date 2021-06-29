<template>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
            <i class="fab fa-atlassian"></i>
            Циан автомат
        </a>
        <ul class="nav col-lg-8">
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-cog"></i>
                    Версия 1.4.14
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-clock"></i>
                    13:00 25.06.2021
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-gavel"></i>
                    13:00 25.06.2021
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-search-plus"></i>
                    100% (55 из 100)
                </span>
            </li> 
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-user-clock"></i>
                    19 мин
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">  
                    <i class="fas fa-chart-bar"></i>
                    0%
                </span>
            </li>
            
        </ul>
        <div class="nav-item col-lg-2 dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-align: end;">
                Здравствуйте, Пользователь
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" >
                <li><a class="dropdown-item" href="logout" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    Выход
                </a></li>
                <form id="logout-form" action="logout" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </div>
    </nav>
</template>