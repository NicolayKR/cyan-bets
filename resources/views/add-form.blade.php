@extends('layouts.app')

@section('title', 'Добавление фида')

@section('content')
<div class="row justify-content-center">
    <main class="py-4 col-md-8 px-md-4">
        <div class="user-text">
            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
        </div>
        <div class="card">
            <div class="card-header">Добавить</div>
            <div class="card-body">
                <form method="POST" action="{{route('accounts.store')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Название Фида</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="company_name" required>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label for="xml-feed" class="col-md-4 col-form-label text-md-end">Ваш XML фид ЦИАН</label>
                        <div class="col-md-6">
                            <input id="xml-feed" type="text" class="form-control" name="xml_feed" required aria-describedby="xml-feed-Help">
                            <div id="xml-feed-Help" class="form-text">
                                Укажите ссылку на Ваш XML фид для ЦИАН
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label for="key-cyan" class="col-md-4 col-form-label text-md-end">API ключ ЦИАН</label>
                        <div class="col-md-6">
                            <input id="key-cyan" type="text" class="form-control" name="key_cyan" required
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
                            <a href="/accounts" class="btn btn-primary">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection