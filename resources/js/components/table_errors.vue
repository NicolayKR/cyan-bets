<template>
    <div class="table-responsive">
        <div class="col-md-10 d-lg-block d-none">
            <input type="text" v-model="id_object" placeholder="Поиск по id-объекта или id-циана" class="form-control"/>
        </div> 
        <table v-if="flagTabel" class="table table-bordered bg-light mt-3 d-lg-block d-none">
            <thead>
                <tr>
                    <th scope="col" style="width: 4%">Название ФИДА</th>
                    <th scope="col" style="width: 5%">ID объекта</th>
                    <th scope="col" style="width: 9%">ID Циана</th>
                    <th scope="col" style="width: 43%">Ошибка</th>
                    <th scope="col" style="width: 39%">Предупреждение</th>
                </tr>
            </thead>
            <tbody v-if="tabelData!=0">
                <tr v-for ="(tabel_item,index) in paginatedObject" :key="index" class="flip-list">
                    <td>{{tabel_item.name_company}}</td>
                    <td>{{tabel_item.id_object}}</td>
                    <td>{{tabel_item.id_offer}}</td>
                    <td><div class="table-container">{{tabel_item.errors}}</div></td>
                    <td><div class="table-container">{{tabel_item.warning}}</div></td>
                </tr>
            </tbody>
            <tfoot v-if="flagLenght && tabelData!=0">
                <tr>
                    <td colspan="5">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-3" >
                                <li class="page-item">
                                    <a class="page-link" href="#" @click="pageClickBack">Назад</a>
                                </li>
                                <li class="page-item" v-for="page in pages" :key="page">
                                    <a class="page-link" href="#" 
                                        @click="pageClick(page)"
                                        :class="{'page_active':page === pageNumber}"
                                        >{{page}}</a>
                                </li>     
                                <li class="page-item">                             
                                    <a class="page-link" href="#" @click="pageClickUp">Вперед</a>
                                </li>
                            </ul>
                        </nav>
                    </td>
                </tr>
            </tfoot>
            <tbody v-if="tabelData==0" class="d-block">
                <tr class="d-block">
                    <td colspan="5" class="text-center d-block"><h3 class="mt-1">Ошибки отсутствуют</h3></td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-10 d-lg-none d-block">
            <input type="text" v-model="id_object" placeholder="Поиск по id-объекта или id-циана" class="form-control"/>
        </div> 
        <div class="table-wrapper d-block d-lg-none">
            <table v-if="flagTabel" class="table table-bordered bg-light mt-3 d-block">
                <thead class="d-none">
                </thead>
                <tbody class="d-block">
                    <tr v-for ="(tabel_item,index) in paginatedObject" :key="index" class="flip-list d-block">
                        <td class="d-block"><span class="xs-table-name">Название ФИДА:</span> {{tabel_item.name_company}}</td>
                        <td class="d-block"><span class="xs-table-name">ID объекта:</span> {{tabel_item.id_object}}</td>
                        <td class="d-block"><span class="xs-table-name">ID Циана:</span> {{tabel_item.id_offer}}</td>
                        <td class="d-block"><div class="table-container"><span class="xs-table-name">Ошибка:</span> {{tabel_item.errors}}</div></td>
                        <td class="d-block"><div class="table-container"><span class="xs-table-name">Предупреждение:</span> {{tabel_item.warning}}</div></td>
                    </tr>
                </tbody>
                <tfoot v-if="flagLenght" class="d-block">
                    <tr class="d-block">
                        <td colspan="5" class="d-block">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-3" >
                                    <li class="page-item">
                                        <a class="page-link" href="#" @click="pageClickBack">Назад</a>
                                    </li>
                                    <li class="page-item" v-for="page in pages" :key="page">
                                        <a class="page-link" href="#" 
                                            @click="pageClick(page)"
                                            :class="{'page_active':page === pageNumber}"
                                            >{{page}}</a>
                                    </li>     
                                    <li class="page-item">                             
                                        <a class="page-link" href="#" @click="pageClickUp">Вперед</a>
                                    </li>
                                </ul>
                            </nav>
                        </td>
                    </tr>
                </tfoot>
                <tbody class="d-block" v-if="tabelData==0">
                    <tr class="d-block">
                        <td colspan="5" class="text-center d-block"><h3 class="mt-1">Ошибки отсутствуют</h3></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
     components: {
        
    },
    data(){
        return{
            tabelData: null,
            flagTabel: false,
            objectPerPage: 100,
            pageNumber: 1,
            flagLenght:false,
            id_object: '',
        }
    },
    computed:{
        pages(){
            return Math.ceil(this.tabelData.length/100);
        },
        paginatedObject(){
            let from = (this.pageNumber -1) * this.objectPerPage;
            let to = from + this.objectPerPage;
            return this.tabelData.filter(elem => {
                if(String(this.id_object).toLowerCase()==='') return this.tabelData;
                return String(elem.id_object).toLowerCase().indexOf(String(this.id_object).toLowerCase()) !== -1
                        ||String(elem.id_offer).toLowerCase().indexOf(String(this.id_object).toLowerCase()) !== -1;
            }).slice(from,to);
        }
    },
    mounted(){
        this.getErrors();
    },
    methods:{
         pageClick(page){
            this.pageNumber = page;
        },
        pageClickBack(){
            if(this.pageNumber == 1){
                this.pageNumber = this.pages;
            }
            else{
                this.pageNumber--;
            }
        },
        pageClickUp(){
            if(this.pageNumber == this.pages){
                this.pageNumber = 1;
            }
            else{
                this.pageNumber++;
            }
        },
        async getErrors(){
            axios.get('/getErrors').then(response => {
                this.tabelData = response.data;
                if(this.tabelData.length > 50){
                    this.flagLenght = true;
                }
                this.flagTabel = true;
            }).catch(function (error) {
                this.flagTabel = false;
            });
        }
    }
}
</script>

