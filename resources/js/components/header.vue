<template>
    <header class="header navbar navbar-dark sticky-top flex-md-nowrap p-0">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">
            <i class="fab fa-atlassian"></i>
            Циан автомат
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav col-lg-8">
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-cog me-2"></i>
                    Версия 1.4.14
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-clock me-2"></i>
                    13:00 25.06.2021
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-gavel me-2"></i>
                    13:00 25.06.2021
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-search-plus me-2"></i>
                    100% (55 из 100)
                </span>
            </li> 
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-user-clock me-2"></i>
                    19 мин
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">  
                    <i class="fas fa-chart-bar me-2"></i>
                    0%
                </span>
            </li>
            
        </ul>
        <div class="nav-item col-lg-2 dropdown">
            <a class="nav-link dropdown-toggle text-end" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Здравствуйте, {{nameUser}}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                <li>
                    <a class="dropdown-item text-start" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt pe-1"></i>
                        Выход
                    </a>
                </li>
                <b-form id="logout-form" action="/logout" method="POST" class="d-none">
                    <input type="hidden" name="_token" :value="csrf">
                </b-form>
            </ul>
        </div>
    </header>
</template>
<script>
export default {
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            nameUser: null,
        }
    },
    mounted(){
        this.getUserName();
    },
    methods: {
        submit : function(){
            this.$refs.form.submit();
            },
        getUserName(){
            axios.get('/getName').then(response => {
                this.nameUser = response.data;
            });
        }
  } 
}
</script>