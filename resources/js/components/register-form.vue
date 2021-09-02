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
                <h4 class="modal-title" id="RegisterModalLabel">Регистрация</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"> 
                    <label for="name-reg" class="form-label">Ваше имя <span style="color:red;">*</span></label>
                    <input type="text" name="name-reg" id="name-reg" placeholder="Введите ваше имя" v-model="name" required class="form-control" /></div>
                <div class="mb-3"> 
                <label for="email-reg" class="form-label">Email <span style="color:red;">*</span></label>
                <input type="email" name="email-reg" id="email-reg" placeholder="Введите вашу почту" v-model="email" required class="form-control " /></div>
                <div class="mb-3"> 
                <label for="phone-reg" class="form-label">Телефон <span style="color:red;">*</span></label>
                <input type="phone" name="phone-reg" id="phone-reg" v-phone placeholder="Введите номер телефона" v-model="phone" class="form-control mt-1 phone" /></div>
                <div class="form-check d-flex align-items-center mt-2">
                    <input type="checkbox" class="form-check-input" name="accses_policy" id="accses_policy_2" required :value="checked" v-model="checked" style="top: 7px;">
                    <label class="form-check-label" for="accses_policy_2">Я принимаю условия <a href="https://enterprise-it.ru/policy/" target="_blank"> политики конфиденциальности</a></label>  
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
    data(){
        return{
            name:'',
            email:'',
            phone:'',
            status: null,
            errors: [],
            checked: false,
        }
    },
    watch:{
         
    },
    methods:{
        postForm(){
            this.status = null;
            if (this.name!='' && this.email!='' && this.checked == true) {
                axios.get(`/regMail?&name=${this.name}&email=${this.email}&phone=${this.phone}`).then(response => {
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