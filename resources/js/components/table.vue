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
                    <b-form-datepicker id="example-datepicker-end" v-model="end" locale="ru" placeholder="Выберите дату" class="margin-datepicker"></b-form-datepicker>
                </div>
                <div class="col-1 form-check form-check-padding flex">
                    <input class="form-check-input" type="checkbox" v-model="checked" id="flexCheckDefault" @click="getTop()">
                    <label class="form-check-label label-check-top" for="flexCheckDefault">
                        Топ
                    </label>
                </div>
                <div class="col-1 flex">
                    <button type="button" class="btn btn-outline-dark">OK</button>
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
                        АУКЦИОН <span class="badge bg-secondary">765</span>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                    <th scope="col"><button @click="sortTable('coverage'); activeSortParam='coverage'">ОХВАТ В ПРОЦЕНТАХ</button></th>
                    <th scope="col"><button @click="sortTable('searches_count'); activeSortParam='searches_count'">КОЛИЧЕСТВО ПОИСКОВ</button></th>
                    <th scope="col"><button @click="sortTable('shows_count'); activeSortParam='shows_count'">КОЛИЧЕСТВО ПОКАЗОВ</button></th>
                    <th scope="col"><button @click="sortTable('phone_shows'); activeSortParam='phone_shows'">КОЛИЧЕСТВО РАСХЛОПОВ ПО ДНЯМ(ПОКАЗ ТЕЛЕФОНА)</button></th>
                    <th scope="col"><button @click="sortTable('views'); activeSortParam='views'">КОЛИЧЕСТВО ПРОСМОТРОВ ПО ДНЯМ</button></th>
                    <th scope="col">СТАВКА</th>
                    <th scope="col"><button @click="sortTable('crm_bet'); activeSortParam='crm_bet'">ТЕКУЩАЯ СТАВКА (CRM)</button></th>
                    <th scope="col"><button @click="sortTable('cyan_bet'); activeSortParam='cyan_bet'">ТЕКУЩАЯ СТАВКА (ЦИАН)</button></th>
                    <th scope="col"><button @click="sortTable('leader_bet'); activeSortParam='leader_bet'">СТАВКА ЛИДЕРА</button></th>
                    <th scope="col"><button @click="sortTable('page'); activeSortParam='page'">СТРАНИЦА</button></th>
                    <th scope="col"><button @click="sortTable('position'); activeSortParam='position'">ПОЗИЦИЯ В ВЫДАЧЕ</button></th>
                    <th scope="col"><button @click="sortTable('agent'); activeSortParam='agent'">АГЕНТ</button></th>
                    <th scope="col"><button @click="sortTable('id_object'); activeSortParam='id_object'">ID ОБЪЕКТА</button></th>
                    <th scope="col"><button @click="sortTable('id_offer'); activeSortParam='id_offer'">ID ЦИАНА</button></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for ="(tabel_item,index) in tabelData" :key="index">
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
      copyTabelData: null,
      checked: false,
      flagTable: false,
      activeSortParam: '',
    }
  },
  mounted(){
      this.getData();
  },
  watch:{
      activeSortParam(){
          console.log(this.activeSortParam);
      }
  },
  methods:{
        async getData(){
            try{
                const response = await axios.get('/getData');
                this.tabelData = response.data;
                this.copyTabelData = response.data;
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
        getTop(){
            this.checked = !this.checked;
            if(this.checked){
                this.tabelData.sort(function (a, b) {
                    if (a.top < b.top) {
                        return 1;
                    }
                    if (a.top > b.top) {
                        return -1;
                    }
                    return 0;
                });
            }
            else{
               this.tabelData.sort(function (a, b) {
                    if (a.top > b.top) {
                        return 1;
                    }
                    if (a.top < b.top) {
                        return -1;
                    }
                    return 0;
                });
            }
        },
        sortTable(par){
            switch(par){
                case 'coverage': return this.tabelData.sort(sortByCoverage);
                case 'searches_count': return this.tabelData.sort(sortBySearchesCount);
                case 'shows_count': return this.tabelData.sort(sortByShowsCount);
                case 'phone_shows': return this.tabelData.sort(sortByPhoneShows);
                case 'views': return this.tabelData.sort(sortByViews);
                case 'crm_bet': return this.tabelData.sort(sortByCrmBet);
                case 'cyan_bet': return this.tabelData.sort(sortByCyanBet);
                case 'leader_bet': return this.tabelData.sort(sortByLeaderBet);
                case 'page': return this.tabelData.sort(sortByPage);
                case 'position': return this.tabelData.sort(sortByPosition);
                case 'agent': return this.tabelData.sort(sortByAgent);
                case 'id_object': return this.tabelData.sort(sortByIdObject);
                case 'id_offer': return this.tabelData.sort(sortByIdOffer);
               id_offer
               
                
            }
        }
    }
}
var sortByCoverage = function (d1, d2) {return (d1.coverage < d2.coverage) ? 1 : -1;};                   
var sortBySearchesCount = function (d1, d2) { return (d1.searches_count < d2.searches_count) ? 1 : -1; };
var sortByShowsCount = function (d1, d2) { return (d1.shows_count < d2.shows_count) ? 1 : -1; };
var sortByPhoneShows = function (d1, d2) { return (d1.phone_shows < d2.phone_shows) ? 1 : -1; };
var sortByViews = function (d1, d2) { return (d1.views < d2.views) ? 1 : -1; };
var sortByCrmBet = function (d1, d2) { return (d1.crm_bet < d2.crm_bet) ? 1 : -1; };
var sortByCyanBet = function (d1, d2) { return (d1.cyan_bet < d2.cyan_bet) ? 1 : -1; };
var sortByLeaderBet = function (d1, d2) { return (d1.leader_bet < d2.leader_bet) ? 1 : -1; };
var sortByPage = function (d1, d2) { return (d1.page < d2.page) ? 1 : -1; };
var sortByPosition = function (d1, d2) { return (d1.position < d2.position) ? 1 : -1; };
var sortByAgent = function (d1, d2) { return (d1.agent.toLowerCase() < d2.agent.toLowerCase()) ? 1 : -1; };
var sortByIdObject= function (d1, d2) { return (d1.id_object < d2.id_object) ? 1 : -1; };
var sortByIdOffer= function (d1, d2) { return (d1.id_offer < d2.id_offer) ? 1 : -1; };
</script>
