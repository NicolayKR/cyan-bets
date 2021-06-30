<template>
    <div class="card">
        <div class="card-header">Добавить</div>
        <div class="card-body">
            <form method="POST" action="save-form">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-group row">
                    <label for="company-name" class="col-md-4 col-form-label text-md-right">Название фирмы</label>
                    <div class="col-md-6">
                        <input id="company-name" type="text" class="form-control" name="company-name" required>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="xml-feed" class="col-md-4 col-form-label text-md-right">Ваш XML фид ЦИАН</label>
                    <div class="col-md-6">
                        <input id="xml-feed" type="text" class="form-control" name="xml-feed" required aria-describedby="xml-feed-Help">
                        <div id="xml-feed-Help" class="form-text">
                            Укажите ссылку на Ваш XML фид для ЦИАН
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="key-cyan" class="col-md-4 col-form-label text-md-right">API ключ ЦИАН</label>
                    <div class="col-md-6">
                        <input id="key-cyan" type="text" class="form-control" name="key-cyan" required
                        aria-describedby="key-cyan-Help">
                        <div id="xml-feed-Help" class="form-text">
                            Для работы сервиса необходимо получить API ключ ЦИАН. Для получения ключа нужно написать письмо на 
                            <a href="import@cian.ru">import@cian.ru</a> с темой "ACCESS KEY" и названием агентства, которое вы представляете. Менеджер уточнит подробности и пришлет ACCESS KEY. После получения ключа, пропишите его в разделе Настройки, в поле "API ключ ЦИАН".
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0 mt-4">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Сохранить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        props:{
            textFromForm: null
        },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
            submit : function(){
                this.$refs.form.submit();
            }
        }
    }
</script>