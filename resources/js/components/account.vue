<template>
    <div class="table d-none d-sm-block">
        <a class="btn btn-primary" href="add-form">
            Добавить
        </a>
        <table class="mt-4">
            <thead>
                <tr>
                    <th scope="col">Название Фирмы</th>
                    <th scope="col">XML фид ЦИАН</th>
                    <th scope="col">API ключ ЦИАН</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for ="(firms_item,index) in firmsData">
                    <td>{{firms_item.name}}</td>
                    <td>{{firms_item.xml_feed}}</td>
                    <td>{{firms_item.cyan_key}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                // csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                firmsData: null
            }
        },
        mounted(){
            this.getFirmsData();
        },
        methods: {
            async getFirmsData(){
                try{
                    const response = await axios.get('/getFirmsData');
                    this.firmsData = response.data;
                    }
                    catch{
                    }                            
            },
        }
    }
</script>