<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Циан Автомат</h1>
        </div>
        <div v-if="!flagTable">
            <div class="d-flex justify-content-center mt-4">
                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>    
        <div v-if="flagTable">
            <div class="row">
                <div class="col-3 flex">
                    <label for="example-datepicker-start">С</label>
                    <b-form-datepicker id="example-datepicker-start" v-model="start"  locale="ru" placeholder="Выберите дату" class="margin-datepicker"></b-form-datepicker> 
                </div>
                <div class="col-3 flex">
                    <div class="label-wrapper">
                        <label for="example-datepicker-end">По</label>
                    </div>
                    <b-form-datepicker id="example-datepicker-end" v-model="end" :min="start" locale="ru" placeholder="Выберите дату" class="margin-datepicker"></b-form-datepicker>
                </div>
                <div class="col-1 form-check form-check-padding flex">
                    <input class="form-check-input" type="checkbox" v-model="checked" id="flexCheckDefault" @click="sortTable('top')">
                    <label class="form-check-label label-check-top" for="flexCheckDefault">
                        Топ
                    </label>
                </div>
                <div class="col-1 flex">
                    <button type="button" class="btn btn-outline-dark" @click="getData()">OK</button>
                </div>
            </div>
            <div class="budge-block mt-4">
                <div class=budge-item>
                    <button type="button" class="btn btn-outline-dark">
                        ВСЕГО <span class="badge bg-secondary">{{this.tabelData.length}}</span>
                    </button>
                </div>
                <div class=budge-item>
                    <button type="button" class="btn btn-outline-dark">
                        АУКЦИОН <span class="badge bg-secondary">{{this.auction_lenght}}</span>
                    </button>
                </div>
                <div class="input-group">
                    <input type="text" v-model="id_object" placeholder="Поиск по id-объекта или id-циана" class="form-control btn-outline-dark ms-3"/>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                    <th scope="col"><a @click="sortTable('coverage')">ОХВАТ В ПРОЦЕНТАХ</a></th>
                    <th scope="col"><a @click="sortTable('searches_count') ">КОЛИЧЕСТВО ПОИСКОВ</a></th>
                    <th scope="col"><a @click="sortTable('shows_count')">КОЛИЧЕСТВО ПОКАЗОВ</a></th>
                    <th scope="col"><a @click="sortTable('phone_shows')">КОЛИЧЕСТВО РАСХЛОПОВ ПО ДНЯМ(ПОКАЗ ТЕЛЕФОНА)</a></th>
                    <th scope="col"><a @click="sortTable('views')">КОЛИЧЕСТВО ПРОСМОТРОВ ПО ДНЯМ</a></th>
                    <th scope="col">СТАВКА</th>
                    <th scope="col"><a @click="sortTable('crm_bet')">ТЕКУЩАЯ СТАВКА (CRM)</a></th>
                    <th scope="col"><a @click="sortTable('cyan_bet')">ТЕКУЩАЯ СТАВКА (ЦИАН)</a></th>
                    <th scope="col"><a @click="sortTable('leader_bet')">СТАВКА ЛИДЕРА</a></th>
                    <th scope="col"><a @click="sortTable('page')">СТРАНИЦА</a></th>
                    <th scope="col"><a @click="sortTable('position')">ПОЗИЦИЯ В ВЫДАЧЕ</a></th>
                    <th scope="col"><a @click="sortTable('agent')">АГЕНТ</a></th>
                    <th scope="col"><a @click="sortTable('id_object')">ID ОБЪЕКТА</a></th>
                    <th scope="col"><a @click="sortTable('id_offer')" >ID ЦИАНА</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for ="(tabel_item,index) in filteredList" :key="index" class="flip-list">
                        <td>{{tabel_item.coverage}}</td>
                        <td>{{tabel_item.searches_count}}</td>
                        <td>{{tabel_item.shows_count}}</td>
                        <td>{{tabel_item.phone_shows}}</td>
                        <td>{{tabel_item.views}}</td>
                        <td>
                            <form>
                                <div class ="flex">
                                    <input type="text" class="form-control me-2 form-control-sm input-value" name="bet" placeholder="" v-model="bets[index]">
                                    <button type="button" @click="postNewBet(bets[index],tabel_item.id_object, tabel_item.id_company,index)" 
                                    class="btn btn-sm btn-outline-dark">OK</button>
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
                            <ul class="pagination pull-right">
                                <li v-for="page in pages" :key="page">
                                    {{page}}
                                </li>
                            </ul>
                        </td>
                    </tr>
                </tfoot>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  data(){
    return{
      bets: [],
      start: null,
      end: null,
      tabelData: null,
      checked: false,
      flagTable: false,
      activeSortParam: '',
      id_object: '',
      auction_lenght: 0,
      objectPerPage: 100,
    }
  },
  computed:{
    filteredList(){
        return this.tabelData.filter(elem => {
            if(String(this.id_object).toLowerCase()==='') return this.tabelData;
            return String(elem.id_object).toLowerCase().indexOf(String(this.id_object).toLowerCase()) !== -1
                    ||String(elem.id_offer).toLowerCase().indexOf(String(this.id_object).toLowerCase()) !== -1;
        })
    },
    pages(){
        return Math.ceil(this.tabelData.lenght/100);
    }
},
  mounted(){
      this.getData();
  },
  methods:{
        async getData(){
            try{
                const response = await axios.get(`/getData?&start=${this.start}&end=${this.end}`);
                this.tabelData = response.data;
                this.tabelData.forEach(element => {
                    if(element.auction != null){
                        this.auction_lenght++;
                    }
                });
                this.flagTable = true;
            }
            catch{
                this.flagTable = false;
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
<style scoped>
.flip-list-move {
  transition: transform 1s;
}
</style>
