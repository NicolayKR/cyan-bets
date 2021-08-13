<template>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div v-if="errors.length" class="mt-2 ml-3 errors-block">
                <strong>Пожалуйста исправьте указанные ошибки:</strong>
                <ul>
                    <li v-for="error in errors" :key="error">{{ error }}</li>
                </ul>
            </div>
            <div v-if="status == 1" class="alert alert-success mb-2" role="alert">
                Ваша заявка принята, скоро с вами свяжутся.
            </div>
            <div v-if="status == 0" class="alert alert-success mb-2" role="alert">
                Что-то пошло не так, сообщение не было отправлено.
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Форма обратной связи</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"> 
                <input type="text" name="name" id="name" placeholder="Введите ваше имя *" v-model="name" required class="form-control mt-2" />
                <input type="email" name="email" id="email" placeholder="Введите вашу почту *" v-model="email" required class="form-control mt-2" />
                <input type="email" name="phone" id="phone" placeholder="Введите номер телефона" v-model="phone" class="form-control mt-2" />
                <textarea rows="4" name="mess" id="mess" placeholder="Ваше сообщение" v-model="message" class="form-control mt-2"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-outline-primary ms-2" @click="postForm()">Отправить</button>
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
            message:'',
            status: null,
            errors: [],
        }
    },
    methods:{
        postForm(){
            if (this.name!='' && this.age!='') {
                axios.get(`/postMail?&name=${this.name}&email=${this.email}&phone=${this.phone}&message=${this.message}`).then(response => {
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