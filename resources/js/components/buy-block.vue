<template>
<div>
    <section class="section bg-gray">
        <div class="container">
            <div class="row gap-y align-items-center">
                <div class="col-md-6 col-xl-5">
                    <p class="lead-7 text-dark fw-600 lh-2">Цены</p>
                    <div class="btn-group btn-group-toggle my-7" data-toggle="buttons">
                        <button class="btn btn-round btn-outline-dark w-150" @click="getTariph(1)">
                            <input type="radio" name="pricing" value="monthly" autocomplete="off"> Месячный
                        </button>
                        <button class="btn btn-round btn-outline-dark w-150 active" @click="getTariph(2)">
                            <input type="radio" name="pricing" value="yearly" autocomplete="off" checked> Годовой
                        </button>
                    </div>
                    <p class="lead">Стоимость оптимизатора гораздо ниже экономии бюджета.</p>
                    <p class="fw-400">
                        <a target="_blank" href="storage/Тарифы.pdf">Узнать подробнее о тарифах<i class="fas fa-arrow-right ms-1"></i></a>
                    </p>
                </div>
                <div class="col-md-6 col-xl-7 ml-auto">
                    <div class="row gap-y">
                        <div class="col-md-12 col-xl-6">
                            <div class="card text-center shadow-1 hover-shadow-9 pb-6">
                                <div class="card-img-top text-white bg-img h-200 d-flex align-items-center" style="background-image: url(assets/img/standart.jpg)" data-overlay="1">
                                    <div class="position-relative w-100">
                                        <p class="lead-4 fw-600 ls-1 mb-0">Стандартный</p>
                                        <p><span data-bind-radio="pricing" data-monthly="Месячный" data-yearly="Годовой">Месячный</span> Пакет</p>
                                    </div>
                                </div>
                                <div class="card-body py-6">
                                    <p class="lead-6 fw-600 text-dark mb-0">
                                        <span data-bind-radio="pricing" data-monthly="От 6000" data-yearly="От 4000" id="cost-1">6000 ₽/мес.</span><br>
                                    </p>
                                    <p>
                                        <span class="badge bg-success mb-1" style="color:white; font-size:16px;">1 месяц бесплатно</span><br>
                                        Количество объявлений не ограничено. Обновление в сутки не ограничено. 
                                    </p>
                                </div>
                                <div class="d-flex mr-auto ml-auto">
                                    <a href="#" data-toggle="modal" data-target="#BuyModal" class="btn btn-round btn-primary w-200" data-bind-href="pricing" data-monthly="#monthly" data-yearly="#yearly" @click="getFullTariph(1)">Купить</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-6">
                            <div class="card text-center shadow-1 hover-shadow-9 pb-6">
                                <div class="card-img-top text-white bg-img h-200 d-flex align-items-center" style="background-image: url(assets/img/advanced.jpg)" data-overlay="2">
                                    <div class="position-relative w-100">
                                        <p class="lead-4 fw-600 ls-1 mb-0">Расширенный</p>
                                        <p><span data-bind-radio="pricing" data-monthly="Месячный" data-yearly="Годовой">Годовой</span> Пакет</p>
                                    </div>
                                </div>
                                <div class="card-body py-6">
                                    <p class="lead-6 fw-600 text-dark mb-0">
                                        <span data-bind-radio="pricing" data-monthly="От 10000" data-yearly="От 7000" id="cost-2">10000 ₽/мес</span><br>
                                    </p>
                                    <p>
                                        3 часа времени нашего маркетолога для анализа ставок/консультации по любым вопросам лидогенерации.
                                    </p>
                                </div>
                                <div class="d-flex mr-auto ml-auto">
                                    <a class="btn btn-round btn-primary w-200" href="#" data-toggle="modal" data-target="#BuyModal" data-bind-href="pricing" data-monthly="#monthly" data-yearly="#yearly" @click="getFullTariph(2)">Купить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section bg-gray text-center">
        <div class="container">
        <h2 class="mb-6"><strong>Получите преимущество над конкурентами.</strong></h2>
        <p class="lead text-muted">Побеждайте интеллектом, а не бюджетами</p>
        <hr class="w-5 my-7">
            <a href="#" data-toggle="modal" data-target="#RegisterModal" class="btn btn-lg btn-round btn-primary">Попробуйте бесплатно</a>
        </div>
    </section>
    <div class="modal fade" id="BuyModal" tabindex="-1" role="dialog" aria-labelledby="BuyModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div v-if="errors.length" class="mt-2 ml-3 errors-block">
                    <strong>Пожалуйста исправьте указанные ошибки:</strong>
                    <ul>
                        <li v-for="error in errors" :key="error">{{ error }}</li>
                    </ul>
                </div>
                <div v-if="status==1" class="alert alert-success mb-2" role="alert">
                    Ваша заявка принята, скоро с вами свяжутся.
                </div>
                <div v-if="status==0" class="alert alert-success mb-2" role="alert">
                    Что-то пошло не так.
                </div>
                <div class="modal-header">
                    <h4 class="modal-title" id="BuyModalLabel">Купить</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body"> 
                    <div class="mb-3">
                        <label for="name-buy" class="form-label">Ваше имя:</label>
                        <input type="text" name="name-buy" id="name-buy" placeholder="Введите ваше имя *" v-model="name" required class="form-control" />
                    </div>
                    <div class="mb-3">
                    <label for="email-buy" class="form-label">Email:</label>
                    <input type="email" name="email-buy" id="email-buy" placeholder="Введите вашу почту *" v-model="email" required class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="phone-buy" class="form-label">Телефон:</label>
                        <input type="phone" name="phone-buy" id="phone-buy" placeholder="Введите номер телефона *" v-model="phone" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="select-tariph" class="form-label">Выберите тариф:</label>
                        <select class="form-select form-control mt-1" aria-label="Default select example" name="select-tariph" id="select-tariph">
                            <option v-if="this.activeTariph == 1 && this.BuyTariph == 1" selected>Стандартный Месячный Пакет, от 6000 ₽/мес.</option>
                            <option v-else>Стандартный Месячный Пакет, от 6000 ₽/мес.</option>
                            <option v-if="this.activeTariph == 1 && this.BuyTariph == 2" selected>Расширенный Месячный Пакет, от 10000 ₽/мес.</option>
                            <option v-else>Расширенный Месячный Пакет, от 10000 ₽/мес.</option>
                            <option v-if="this.activeTariph == 2 && this.BuyTariph == 1" selected>Стандартный Годовой Пакет, от 4000 ₽/мес.</option>
                            <option v-else>Стандартный Годовой Пакет, от 4000 ₽/мес.</option>
                            <option v-if="this.activeTariph == 2 && this.BuyTariph == 2" selected>Расширенный Годовой Пакет, от 7000 ₽/мес.</option>
                            <option v-else>Расширенный Годовой Пакет, от 7000 ₽/мес.</option>
                        </select>
                    </div>
                    <p class="mt-2">
                        <a target="_blank" href="storage/Тарифы.pdf">Узнать подробнее о тарифах</a>
                    </p>
                    <div class="form-check d-flex align-items-center mt-2">
                        <input type="checkbox" class="form-check-input" name="accses_policy" id="accses_policy_3" required :value="checked" v-model="checked">
                        <label class="form-check-label" for="accses_policy_3">Я принимаю условия <a href="https://enterprise-it.ru/policy/" target="_blank"> политики конфиденциальности</a></label>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary ms-2" @click="postForm()">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return{
            activeTariph: 2,
            BuyTariph: null,
            name:'',
            email:'',
            phone:'',
            status: null,
            errors: [],
            select_tariph: '',
            checked: false,
        }
    },
    methods:{
        getTariph(a){
            this.activeTariph = a;
        },
        getFullTariph(a){
            this.BuyTariph = a;
            if(this.activeTariph == 1 && this.BuyTariph == 1){
                this.select_tariph = 'Стандартный месячный пакет';
            }else if(this.activeTariph == 1 && this.BuyTariph == 2){
                this.select_tariph = 'Расширенный месячный пакет';
            }else if(this.activeTariph == 2 && this.BuyTariph == 2){
                this.select_tariph = 'Расширенный годовой пакет';
            }else if(this.activeTariph == 2 && this.BuyTariph == 1){
                this.select_tariph = 'Стандартный годовой пакет';
            } 
        },
        postForm(){
            this.status = null;
            if (this.name!='' && this.email!='' && this.checked == true) {
                axios.get(`/buyMail?&name=${this.name}&email=${this.email}&phone=${this.phone}&tariph=${this.select_tariph}`).then(response => {
                    this.errors = [];
                    this.name = '';
                    this.email = '';
                    this.phone = '';
                    this.message = '';
                    this.status = response.data;
                })
            }else{
            this.errors = [];
            if (this.name == '') {
                this.errors.push('Требуется указать имя.');
                }
            if ( this.email == '') {
                this.errors.push('Требуется указать почту.');
                }
            if ( this.phone == '') {
                this.errors.push('Требуется указать номер телефона.');
                }
            if ( this.checked == false) {
                this.errors.push('Примите политику конфидконфиденциальности.');
            }
            
            }
            
        },
        getFinalTariph(){
            switch (this.tariph) {
                case 1:
                    return 'Стандартный Месячный Пакет, от 6000 ₽/мес.';
                case 2:
                    return 'Расширенный Месячный Пакет, от 10000 ₽/мес.';
                case 3:
                    return 'Стандартный Годовой Пакет, от 4000 ₽/мес.';
                case 4:
                    return 'Расширенный Годовой Пакет, от 7000 ₽/мес.';
                }
        }
    }
}
</script>

<style lang="scss">
.errors-block{
    li{
        color: #DC143C;
    }
}
</style>