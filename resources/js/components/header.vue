<template>
    <header class="header navbar navbar-dark sticky-top flex-md-nowrap p-0">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/index">
            <i class="fab fa-atlassian"></i>
            Циан автомат
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav col-lg-8">
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-clock me-1"></i>
                    <span class = "me-2">{{this.time}}</span>{{this.date}}
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-gavel me-1"></i>
                    {{this.remain}}
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fas fa-dollar-sign me-1"></i>
                    {{this.balance}}
                </span>
            </li> 
            <li class="nav-item">
                <span class="nav-link">
                    <i class="far fa-registered me-1"></i>
                    {{this.auction_points}}
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
            date: null,
            interval: null,
            time: null,
            remain: null,
            balance: 0,
            auction_points: 0,
        }
    },
    beforeDestroy() {
        clearInterval(this.interval);
    },
    mounted(){
        this.getUserName();
        this.getBalance();
    },
    created(){

        this.interval = setInterval(()=>{
            const today = new Date();
            let day = '';
            let month = '';
            let minutes = '';
            let remain = '';
            let remain_minutes = '';
            if(today.getDate()<10){
                day = '0'+ today.getDate();
            }
            else{
                day = String(today.getDate());
                
            }
            if(today.getMonth()+1<10){
                month = '0'+ (today.getMonth()+1);    
            }
            else{
                month  = String(today.getMonth()+1);
                
            }
            if(today.getMinutes()<10){
                minutes = '0'+ today.getMinutes();
            }
            else{
                minutes = String(today.getMinutes());
                
            }
            if(60 - today.getMinutes() < 10){
                remain_minutes = '0'+ String(60 - today.getMinutes());
            }
            else{
                remain_minutes = String(60 - today.getMinutes());
                
            }
            this.time = today.getHours()+ ":" + minutes;
            this.remain = String(24 - today.getHours())+":"+ remain_minutes; 
            this.date = day + '.'+ month + "." + today.getFullYear();
        }, 1000);
    },
    methods: {
        submit : function(){
            this.$refs.form.submit();
            },
        getUserName(){
            axios.get('/getName').then(response => {
                this.nameUser = response.data;
            });
        },
        getBalance(){
            axios.get('/getBalance').then(response => {
                this.balance = response.data.balance;
                this.auction_points = response.data.auction_points;
            });
        },
  } 
}
</script>