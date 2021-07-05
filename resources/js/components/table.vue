<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Циан Автомат</h1>
        </div>
        <div v-if="flagTable" class="row">
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
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label label-check-top" for="flexCheckDefault">
                    Топ
                </label>
            </div>
            <div class="col-1 ms-n3 flex">
                <button type="button" class="btn btn-outline-dark">OK</button>
            </div>
        </div>
        <div class="budge-block mt-4">
            <div class=budge-item>
                <button type="button" class="btn btn-outline-dark">
                    ВСЕГО <span class="badge bg-secondary">251</span>
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
                <tr v-for ="(tabel_item,index) in tabelData">
                    <td>1,001</td>
                    <td>random</td>
                    <td>data</td>
                    <td>placeholder</td>
                    <td>text</td>
                    <td>
                        <div class ="flex">
                            <input type="text" class="form-control me-2 form-control-sm" placeholder="" v-model="bets">
                            <button type="button" class="btn btn-sm btn-outline-dark">OK</button>
                        </div>
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
</template>
<script>
export default {
  data(){
    return{
      bets: null,
      start: null,
      end: null,
      tabelData: null,
      flagTable:false,
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
                console.log(this.tabelData);
                //console.log(typeof(this.tabelData));
                this.flagTable = true;
            }
            catch{
                console.log('Ошибка');
            }          
        }
    }
}
</script>
