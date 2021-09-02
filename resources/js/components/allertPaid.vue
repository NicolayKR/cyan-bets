<template>
<div>
    <div v-if="flag_paid" class="alert alert-danger">
        У вас закончилась подписка, поэтому обновления и сбор статистике по вашему аккаунту остановлены. Продлите оплату для дальнейшей работы.
    </div>
</div>
</template>

<script>
export default {
    props: ['strategy'],
    data() {
        return {
            days_left: 0,
            flag_paid: false,
        }
    },
    mounted(){
        this.getUserName();
    },
    methods: {
        getUserName(){
            axios.get(`/getHeaderData`).then(response => {
                this.days_left = response.data.days_left;
                if((Number(this.days_left))==0){
                    this.flag_paid = true;
                }
            });
        },
  } 
}
</script>
