@extends('layouts.app')

@section('title', 'Ваши аккаунты')

@section('content')  
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="user-text">
                @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
            </div>
            <a href="{{route('accounts.create')}}" class="btn btn-primary">
                Добавить фирму
            </a>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Название Фида</th>
                            <th scope="col">XML фид ЦИАН</th>
                            <th scope="col">API ключ ЦИАН</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($accounts as $account)
                            <tr>
                                <td>{{$account->name}}</td>
                                <td>{{$account->xml_feed}}</td>
                                <td>{{$account->cyan_key}}</td>
                                <td class="text-right">
                                    <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{ route('accounts.destroy', $account) }}"
                                    method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">  
                                        <a href="{{ route('accounts.edit', $account) }}" class="btn btn-default">
                                            <i class="fa fa-edit"></i>
                                        </a>                                        
                                        <button type="submit" class="btn">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                
                            <tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center"><h3>Данные отсутствуют</h3></td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
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
@endsection
  