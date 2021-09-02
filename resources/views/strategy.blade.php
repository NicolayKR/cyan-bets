@extends('layouts.app')

@section('title', 'Стратегии')

@section('content')
<div class="row justify-content-center">
    <main class="py-4 col-md-10 px-md-4">
        <allert-paid></allert-paid>
        <div class="alert alert-primary">
            Программа проанализирует Вашу базу объектов и предложит различные стратегии при наборе необходимого массива данных. Примерный срок 1-2 недели.
        </div>
    </main>
</div>
@endsection