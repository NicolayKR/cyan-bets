<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Циан Автомат</h1>
        </div>
        <div v-if="flagEmptyFeed">       
            <div class="alert alert-primary" role="alert">
                Введите свой xml-feed в личном кабинете!
            </div>
        </div>
        <div class="main-content">
            <div v-if="!flagReady && !flagEmptyFeed"> 
                <div class="d-flex justify-content-center m-5">
                    <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>    
            <div v-if="flagReady">
                <h3 class="h3 mt-3">Общая статистика</h3>
                <div class="gy-2 gx-3 align-items-center">
                    <div class="row ">
                        <div class="col-md-3 col-12 d-flex mt-3">
                            <div class="label-wrapper d-flex">
                                <label for="example-datepicker-start">С</label>
                            </div>
                            <b-form-datepicker id="example-datepicker-start" v-model="start"  locale="ru" placeholder="Выберите дату"></b-form-datepicker>
                        </div>
                        <div class="col-md-3 col-12 d-flex mt-3">
                            <div class="label-wrapper d-flex">
                                <label for="example-datepicker-end">По</label>
                            </div>
                            <b-form-datepicker id="example-datepicker-end" v-model="end" :min="start" locale="ru" placeholder="Выберите дату"></b-form-datepicker>
                        </div>
                        <div class="col-md-1 col-12 d-grid gap-2  mt-3">
                            <button type="button" class="btn btn-primary" @click="getData()">OK</button>
                        </div>
                    </div>
                </div>
                <div class="circle-wrapper mt-logic-block">
                    <div class="blackcircle">
                        <div class="whitecircle">
                            <span class="statistic_numeral">{{shows_count}}</span>
                            <span class ="statistic_text">Показов объявлений</span> 
                            </div>
                    </div>
                    <div class="blackcircle">
                        <div class="whitecircle">
                            <span class="statistic_numeral">{{phone_shows}}</span>
                            <span class ="statistic_text">Показов телефона</span> 
                        </div>
                    </div>
                    <div class="blackcircle">
                        <div class="whitecircle">
                            <span class="statistic_numeral">{{views}}</span> 
                            <span class ="statistic_text">Просмотров объявлений</span> 
                        </div>
                    </div>
                </div>  
                <div class="graph mt-logic-block">
                    <div class = "graph_wrapper">
                        <graph :chartData ="datacollection" :windowWidth="windowWidth"/>
                    </div>
                </div>
                <h3 class="h3 mt-logic-block">Таблица ставок</h3>
                <div class="row mt-4">
                    <div class="col-md-9 col-xxl-8">
                        <div class="row">
                            <div class="col-md-2 d-grid gap-2">
                                <button type="button" class="btn btn-info budge-item-text d-flex align-items-center">
                                    ВСЕГО 
                                    <span class="badge bg-primary">{{this.tabelData.length}}</span>
                                </button>
                            </div>
                            <div class="col-md-2 d-grid gap-2">
                                <button type="button" class="btn btn-info budge-item-text d-flex align-items-center">
                                    АУКЦИОН 
                                    <span class="badge bg-primary">{{this.auction_lenght}}</span>
                                </button>
                            </div>
                            <div class="col-md-7">
                                <input type="text" placeholder="Поиск по id-объекта или id-циана" class="form-control">
                                </div> 
                                <div class="col-md-1 d-flex align-items-center">
                                    <input type="checkbox" id="flexCheckDefault" class="form-check-input"> 
                                    <label for="flexCheckDefault" class="form-check-label label-check-top ms-1">
                                        Топ
                                    </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"><a @click="sortTable('coverage') " class="filter-link">Охват в процентах</a></th>
                            <th scope="col"><a @click="sortTable('searches_count') " class="filter-link">Количество поисков</a></th>
                            <th scope="col"><a @click="sortTable('shows_count')" class="filter-link">Количество показов</a></th>
                            <th scope="col"><a @click="sortTable('phone_shows')" class="filter-link">Количество расхлопов по дням(Показ телефона)</a></th>
                            <th scope="col"><a @click="sortTable('views')" class="filter-link">Количество просмотров по дням</a></th>
                            <th scope="col" style="width: 8%">Ставка</th>
                            <th scope="col"><a @click="sortTable('crm_bet')" class="filter-link">Текущая ставка (CRM)</a></th>
                            <th scope="col"><a @click="sortTable('cyan_bet')" class="filter-link">Текущая ставка (ЦИАН)</a></th>
                            <th scope="col"><a @click="sortTable('leader_bet')" class="filter-link">Ставка лидера</a></th>
                            <th scope="col"><a @click="sortTable('page')" class="filter-link">Страница</a></th>
                            <th scope="col"><a @click="sortTable('position')" class="filter-link">Позиция в выдаче</a></th>
                            <th scope="col"><a @click="sortTable('agent')" class="filter-link">Агент</a></th>
                            <th scope="col"><a @click="sortTable('id_object')" class="filter-link">ID Объекта</a></th>
                            <th scope="col"><a @click="sortTable('id_offer')" class="filter-link">ID Циана</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for ="(tabel_item,index) in paginatedObject" :key="index" class="flip-list">
                            <td>{{tabel_item.coverage}}</td>
                            <td>{{tabel_item.searches_count}}</td>
                            <td>{{tabel_item.shows_count}}</td>
                            <td>{{tabel_item.phone_shows}}</td>
                            <td>{{tabel_item.views}}</td>
                            <td>
                                <form class="row gy-2 gx-3 align-items-center">
                                    <div class="d-flex">
                                        <input type="text" class="form-control form-control-sm input-value" name="bet" placeholder="" v-model="bets[index]">
                                        <button type="button" @click="postNewBet(bets[index],tabel_item.id_object, tabel_item.id_company,index)" 
                                        class="btn btn-primary btn-sm ms-1">OK</button>
                                    </div>
                                </form>
                            </td>
                            <td>{{tabel_item.crm_bet}}</td>
                            <td>{{tabel_item.cyan_bet}}</td>
                            <td>{{tabel_item.leader_bet}}</td>
                            <td>{{tabel_item.page}}</td>
                            <td>{{tabel_item.position}}</td>
                            <td>{{tabel_item.agent}}</td>
                            <td>{{tabel_item.id_object}}</td>
                            <td>{{tabel_item.id_offer}}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="14">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center mt-3" >
                                        <li class="page-item">
                                            <a class="page-link" href="#" @click="pageClickBack">Назад</a>
                                        </li>
                                        <li class="page-item" v-for="page in pages" :key="page">
                                            <a class="page-link" href="#" 
                                                @click="pageClick(page)"
                                                :class="{'page_active':page === pageNumber}"
                                                >{{page}}</a>
                                        </li>     
                                        <li class="page-item">                             
                                            <a class="page-link" href="#" @click="pageClickUp">Вперед</a>
                                        </li>
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                    </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import graph from './Graph'

export default {
     components: {
        graph,
    },
    data(){
        return{
        bets: [],
        start: null,
        end: null,
        tabelData: null,
        checked: false,
        flagReady: false,
        activeSortParam: '',
        id_object: '',
        auction_lenght: 0,
        objectPerPage: 100,
        pageNumber: 1,
        shows_count: 0,
        phone_shows: 0,
        views: 0,
        datacollection: null,
        windowWidth: window.innerWidth,
        flagEmptyFeed: false
        }
    },
    computed:{
        pages(){
            return Math.ceil(this.tabelData.length/100);
        },
        paginatedObject(){
            let from = (this.pageNumber -1) * this.objectPerPage;
            let to = from + this.objectPerPage;
            return this.tabelData.filter(elem => {
                if(String(this.id_object).toLowerCase()==='') return this.tabelData;
                return String(elem.id_object).toLowerCase().indexOf(String(this.id_object).toLowerCase()) !== -1
                        ||String(elem.id_offer).toLowerCase().indexOf(String(this.id_object).toLowerCase()) !== -1;
            }).slice(from,to);
        }
    },
    mounted(){
        this.getData();
        window.onresize = () => {
            this.windowWidth = window.innerWidth
        }
    },
    methods:{
        pageClick(page){
            this.pageNumber = page;
        },
        pageClickBack(){
            if(this.pageNumber == 1){
                this.pageNumber = this.pages;
            }
            else{
                this.pageNumber--;
            }
        },
        pageClickUp(){
            if(this.pageNumber == this.pages){
                this.pageNumber = 1;
            }
            else{
                this.pageNumber++;
            }
        },
        async getData(){
            try{
                const response = await axios.get(`/getData?&start=${this.start}&end=${this.end}`);
                if(response.data != 0){
                    this.tabelData = response.data.table_data;
                    this.auction_lenght = response.data.lenght_auction;
                    this.shows_count = response.data.shows_count;
                    this.phone_shows = response.data.phone_shows;
                    this.views = response.data.views;
                    this.datacollection = response.data.datacollection;
                    this.flagReady = true;
                }
                else{
                    this.flagEmptyFeed = true;
                }
            }
            catch{
                this.flagReady = false;
            }          
        },
        async postNewBet(bets,id_object, id_company,index){
            let fd = new FormData();
            fd.set('bet', bets);
            fd.set('id_object', id_object);
            fd.set('id_company', id_company);
            await axios.post('/saveNewBet', fd).then(function (response) { 
                })
            .catch(function (error) {
                console.log(error);
            })
            await this.getDataFromNewBet(id_object, id_company,index);
        },
        async getDataFromNewBet(id_object,id_company,index){
            try{
                const response = await axios.get(`/getDataFromNewBet?&id_object=${id_object}&id_company=${id_company}`);
                this.tabelData.forEach(function(item){
                    if(item.id_object == id_object){
                        item.crm_bet = response.data;
                    } 
                });
                this.bets[index] = '';
            }catch{
                console.log("Ошибка");
            }
        },
        onSort(name, nameFunc){
            this.activeSortParam = name;
            if(this.activeSortParam == 'top'){
                this.checked=true;
            }else{
                this.checked=false;
            }
            return this.tabelData.sort(nameFunc);
        },
        offSort(nameFunc){
            this.checked=false;
            this.activeSortParam = '#'; 
            return this.tabelData.sort(nameFunc);
        },
        sortTable(par){
            switch(par){
                case 'top': if(this.activeSortParam != 'top'){ return this.onSort('top', sortByTopTop)}
                                else{return this.offSort(sortByTopBottom);}
                case 'coverage': if(this.activeSortParam != 'coverage'){ return this.onSort('coverage', sortByCoverageTop);}
                                else{return this.offSort(sortByCoverageBottom);}
                case 'searches_count': if(this.activeSortParam != 'searches_count'){ return this.onSort('searches_count', sortBySearchesCountTop);}
                                else{return this.offSort(sortBySearchesCountBottom);}          
                case 'shows_count': if(this.activeSortParam != 'shows_count'){ return this.onSort('shows_count', sortByShowsCountTop);}
                                else{return this.offSort(sortByShowsCountBottom);} 
                case 'phone_shows': if(this.activeSortParam != 'phone_shows'){ return this.onSort('phone_shows', sortByPhoneShowsTop);}
                                else{return this.offSort(sortByPhoneShowsBottom);} 
                case 'views': if(this.activeSortParam != 'views'){ return this.onSort('views', sortByViewsTop);}
                                else{return this.offSort(sortByViewsBottom);} 
                case 'crm_bet': if(this.activeSortParam != 'crm_bet'){ return this.onSort('crm_bet', sortByCrmBetTop);}
                                else{return this.offSort(sortByCrmBetBottom);} 
                case 'cyan_bet': if(this.activeSortParam != 'cyan_bet'){ return this.onSort('cyan_bet', sortByCyanBetTop);}
                                else{return this.offSort(sortByCyanBetBottom);} 
                case 'leader_bet': if(this.activeSortParam != 'leader_bet'){ return this.onSort('leader_bet', sortByLeaderBetTop);}
                                else{return this.offSort(sortByLeaderBetBottom);} 
                case 'page': if(this.activeSortParam != 'page'){ return this.onSort('page', sortByPageTop);}
                                else{return this.offSort(sortByPageBottom);} 
                case 'position': if(this.activeSortParam != 'position'){ return this.onSort('position', sortByPositionTop);}
                                else{return this.offSort(sortByPositionBottom);} 
                case 'agent': if(this.activeSortParam != 'agent'){ return this.onSort('agent', sortByAgentTop);}
                                else{return this.offSort(sortByAgentBottom);} 
                case 'id_object': if(this.activeSortParam != 'id_object'){ return this.onSort('id_object', sortByIdObjectTop);}
                                else{return this.offSort(sortByIdObjectBottom);} 
                case 'id_offer': if(this.activeSortParam != 'id_offer'){ return this.onSort('id_offer', sortByIdOfferTop);}
                                else{return this.offSort(sortByIdOfferBottom);}         
            }
        }
    }
}
var sortByTopTop = function (d1, d2) {return (d1.top < d2.top) ? 1 : -1;};   
var sortByTopBottom = function (d1, d2) {return (d1.top > d2.top) ? 1 : -1;};   
var sortByCoverageTop = function (d1, d2) {return (d1.coverage < d2.coverage) ? 1 : -1;};   
var sortByCoverageBottom = function (d1, d2) {return (d1.coverage > d2.coverage) ? 1 : -1;};                   
var sortBySearchesCountTop  = function (d1, d2) { return (d1.searches_count < d2.searches_count) ? 1 : -1; };
var sortBySearchesCountBottom  = function (d1, d2) { return (d1.searches_count > d2.searches_count) ? 1 : -1; };
var sortByShowsCountTop  = function (d1, d2) { return (d1.shows_count < d2.shows_count) ? 1 : -1; };
var sortByShowsCountBottom  = function (d1, d2) { return (d1.searches_count > d2.searches_count) ? 1 : -1; };
var sortByPhoneShowsTop  = function (d1, d2) { return (d1.phone_shows < d2.phone_shows) ? 1 : -1; };
var sortByPhoneShowsBottom  = function (d1, d2) { return (d1.searches_count > d2.searches_count) ? 1 : -1; };
var sortByViewsTop  = function (d1, d2) { return (d1.views < d2.views) ? 1 : -1; };
var sortByViewsBottom  = function (d1, d2) { return (d1.searches_count > d2.searches_count) ? 1 : -1; };
var sortByCrmBetTop  = function (d1, d2) { return (d1.crm_bet < d2.crm_bet) ? 1 : -1; };
var sortByCrmBetBottom  = function (d1, d2) { return (d1.searches_count > d2.searches_count) ? 1 : -1; };
var sortByCyanBetTop  = function (d1, d2) { return (d1.cyan_bet < d2.cyan_bet) ? 1 : -1; };
var sortByCyanBetBottom  = function (d1, d2) { return (d1.searches_count > d2.searches_count) ? 1 : -1; };
var sortByLeaderBetTop  = function (d1, d2) { return (d1.leader_bet < d2.leader_bet) ? 1 : -1; };
var sortByLeaderBetBottom  = function (d1, d2) { return (d1.searches_count > d2.searches_count) ? 1 : -1; };
var sortByPageTop  = function (d1, d2) { return (d1.page < d2.page) ? 1 : -1; };
var sortByPageBottom  = function (d1, d2) { return (d1.searches_count > d2.searches_count) ? 1 : -1; };
var sortByPositionTop  = function (d1, d2) { return (d1.position < d2.position) ? 1 : -1; };
var sortByPositionBottom  = function (d1, d2) { return (d1.searches_count > d2.searches_count) ? 1 : -1; };
var sortByAgentTop  = function (d1, d2) { return (d1.agent.toLowerCase() < d2.agent.toLowerCase()) ? 1 : -1; };
var sortByAgentBottom  = function (d1, d2) { return (d1.searches_count > d2.searches_count) ? 1 : -1; };
var sortByIdObjectTop = function (d1, d2) { return (d1.id_object < d2.id_object) ? 1 : -1; };
var sortByIdObjectBottom  = function (d1, d2) { return (d1.searches_count > d2.searches_count) ? 1 : -1; };
var sortByIdOfferTop = function (d1, d2) { return (d1.id_offer < d2.id_offer) ? 1 : -1; };
var sortByIdOfferBottom  = function (d1, d2) { return (d1.searches_count > d2.searches_count) ? 1 : -1; };
</script>
