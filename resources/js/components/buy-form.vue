<template>
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
                <h4 class="modal-title" id="BuyModalLabel">Форма покупки</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"> 
                <label for="name-buy" class="form-label">Ваше имя:</label>
                <input type="text" name="name-buy" id="name-buy" placeholder="Введите ваше имя *" v-model="name" required class="form-control mt-1" />
                <label for="email-buy" class="form-label">Ваша почта:</label>
                <input type="email" name="email-buy" id="email-buy" placeholder="Введите вашу почту *" v-model="email" required class="form-control mt-1" />
                <label for="phone-buy" class="form-label">Ваш номер телефона:</label>
                <input type="phone" name="phone-buy" id="phone-buy" placeholder="Введите номер телефона *" v-model="phone" class="form-control mt-1" />
                <label for="select-tariph" class="form-label">Выберите тариф:</label>
                <select class="form-select form-control mt-1" aria-label="Default select example" name="select-tariph" id="select-tariph">
                    <option selected>Стандартный Месячный Пакет, от 6000 ₽/мес.</option>
                    <option value="1">Расширенный Месячный Пакет, от 10000 ₽/мес.</option>
                    <option value="2">Стандартный Годовой Пакет, от 4000 ₽/мес.</option>
                    <option value="3">Расширенный Годовой Пакет, от 7000 ₽/мес.</option>
                </select>
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
</template>

<script>
export default {
    props: ['tariph'],
    data(){
        return{
            name:'',
            email:'',
            phone:'',
            status: null,
            errors: [],
            select_tariph: '',
            checked: false,
        }
    },
    mounted(){
        console.log(this.tariph);
   },
    methods:{
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
        getTariph(){
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