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
                    <th scope="col">ОХВАТ В ПРОЦЕНТАХ</th>
                    <th scope="col">КОЛИЧЕСТВО ПОИСКОВ</th>
                    <th scope="col">КОЛИЧЕСТВО ПОКАЗОВ</th>
                    <th scope="col">КОЛИЧЕСТВО РАСХЛОПОВ ПО ДНЯМ(ПОКАЗ ТЕЛЕФОНА)</th>
                    <th scope="col">КОЛИЧЕСТВО ПРОСМОТРОВ ПО ДНЯМ</th>
                    <th scope="col">СТАВКА</th>
                    <th scope="col">ТЕКУЩАЯ СТАВКА (CRM)</th>
                    <th scope="col">ТЕКУЩАЯ СТАВКА (ЦИАН)</th>
                    <th scope="col">СТАВКА ЛИДЕРА</th>
                    <th scope="col">СТРАНИЦА</th>
                    <th scope="col">ПОЗИЦИЯ В ВЫДАЧЕ</th>
                    <th scope="col">АГЕНТ</th>
                    <th scope="col">ID ОБЪЕКТА</th>
                    <th scope="col">ID ЦИАНА</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for ="(tabel_item,index) in tabelData" :key="index">
                        <td>1,001</td>
                        <td>random</td>
                        <td>data</td>
                        <td>placeholder</td>
                        <td>{{tabel_item.top}}</td>
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
                        <td>text</td>
                        <td>text</td>
                        <td>text</td>
                        <td>{{tabel_item.agent}}</td>
                        <td>{{tabel_item.id_object}}</td>
                        <td>text</td>
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
    }
  },
  mounted(){
      this.getData();
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

        }
    }
}
</script>
