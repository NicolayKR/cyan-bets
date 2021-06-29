<template>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Циан Автомат</h1>
        </div>
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
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label label-check-top" for="flexCheckDefault">
                    Топ
                </label>
            </div>
            <div class="col-1 flex" style="padding-left: 0; margin-left: -20px;">
                <button type="button" class="btn btn-outline-dark">OK</button>
            </div>
        </div>
        <div class="budge-block mt-4 flex">
            <div class=budge-item>
                <button type="button" class="btn btn-primary">
                    ВСЕГО <span class="badge bg-secondary">251</span>
                </button>
            </div>
            <div class=budge-item>
                <button type="button" class="btn btn-primary">
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
              <tr>
                <td>1,001</td>
                <td>random</td>
                <td>data</td>
                <td>placeholder</td>
                <td>text</td>
                <td>
                    <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,002</td>
                <td>placeholder</td>
                <td>irrelevant</td>
                <td>visual</td>
                <td>layout</td>
                <td>
                    <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,003</td>
                <td>data</td>
                <td>rich</td>
                <td>dashboard</td>
                <td>tabular</td>
                <td>
                     <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,003</td>
                <td>information</td>
                <td>placeholder</td>
                <td>illustrative</td>
                <td>data</td>
                <td >
                    <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,004</td>
                <td>text</td>
                <td>random</td>
                <td>layout</td>
                <td>dashboard</td>
                <td>
                     <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,005</td>
                <td>dashboard</td>
                <td>irrelevant</td>
                <td>text</td>
                <td>placeholder</td>
                <td>
                     <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,006</td>
                <td>dashboard</td>
                <td>illustrative</td>
                <td>rich</td>
                <td>data</td>
                <td >
                     <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,007</td>
                <td>placeholder</td>
                <td>tabular</td>
                <td>information</td>
                <td>irrelevant</td>
                <td >
                    <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,008</td>
                <td>random</td>
                <td>data</td>
                <td>placeholder</td>
                <td>text</td>
                <td>
                     <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,009</td>
                <td>placeholder</td>
                <td>irrelevant</td>
                <td>visual</td>
                <td>layout</td>
                <td>
                     <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,010</td>
                <td>data</td>
                <td>rich</td>
                <td>dashboard</td>
                <td>tabular</td>
                <td>
                     <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,011</td>
                <td>information</td>
                <td>placeholder</td>
                <td>illustrative</td>
                <td>data</td>
                <td >
                     <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,012</td>
                <td>text</td>
                <td>placeholder</td>
                <td>layout</td>
                <td>dashboard</td>
                <td >
                     <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,013</td>
                <td>dashboard</td>
                <td>irrelevant</td>
                <td>text</td>
                <td>visual</td>
                <td >
                     <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,014</td>
                <td>dashboard</td>
                <td>illustrative</td>
                <td>rich</td>
                <td>data</td>
                <td >
                     <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
              <tr>
                <td>1,015</td>
                <td>random</td>
                <td>tabular</td>
                <td>information</td>
                <td>text</td>
                <td>
                    <div class ="flex">
                        <input type="text" name="bets" class="form-control" placeholder="" id="bets" v-model="bets" style="margin-right: 15px;">
                        <button type="button" class="btn btn-outline-dark">OK</button>
                    </div>
                </td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
                <td>text</td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    
</template>
