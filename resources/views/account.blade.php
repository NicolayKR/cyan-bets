<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Аккаунты</title>
    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="user-text">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <a href="{{route('accounts.create')}}" class="btn btn-primary pull-right">
                            Добавить фирму
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
                                @forelse($accounts as $account)
                                    <tr>
                                        <td>{{$account->name}}</td>
                                        <td>{{$account->xml_feed}}</td>
                                        <td>{{$account->cyan_key}}</td>
                                        <td class="text-right">
                                            <a href="{{ route('accounts.edit', $account) }}" class="btn btn-default">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{ route('accounts.destroy', $account) }}"
                                            method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">                                          
                                                <button type="submit" class="btn">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                        
                                    <tr>
                                @empty
                                    <tr>
                                        <td cplspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <ul class="pagination pull-right">
                                            {{$accounts->links()}}
                                        </ul>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>