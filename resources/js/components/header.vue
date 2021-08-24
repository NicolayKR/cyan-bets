<template>
    <header class="header navbar navbar-dark sticky-top flex-md-nowrap p-0" id="main-header">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/index">
            <i class="fab fa-atlassian"></i>
            Циан автомат
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation" id="hamburger">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav header-padding">
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-clock me-1"></i>
                    <span class = "me-2">Осталось дней:</span>{{this.days_left}}
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">
                    <i class="far fa-registered me-1"></i>
                    Дневной расход: {{this.budget}} Р
                </span>
            </li>  
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-chess me-1"></i>
                    Выбранная стратегия: Не используется
                </span>
            </li>    
        </ul>
        <div class="nav-item col-md-3 col-lg-2 dropdown">
            <a class="nav-link dropdown-toggle text-end" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Здравствуйте, {{this.nameUser}}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                <li>
                    <a class="dropdown-item text-start" href="/logout">
                        <i class="fas fa-sign-out-alt pe-1"></i>
                        Выход
                    </a>
                </li>
            </ul>
        </div>
    </header>
</template>
<script>
export default {
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            nameUser: '',
            budget: 0,
            days_left: 0,
        }
    },
    mounted(){
        this.getUserName();
    },
    created(){

    },
    methods: {
        submit : function(){
            this.$refs.form.submit();
            },
        getUserName(){
            axios.get(`/getHeaderData`).then(response => {
                this.nameUser = response.data.name;
                this.budget = response.data.budget_days;
                this.days_left = response.data.days_left;
            });
        },
  } 
}
</script>