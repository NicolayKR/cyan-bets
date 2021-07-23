@extends('layouts.app')

@section('title', 'Вопросы и ответы')

@section('content')
<div class="row justify-content-center">
    <main class="py-4 col-md-8 px-md-4">
        <div class="dropdown d-grid gap-2">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown button
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
    </main>
</div>
@endsection