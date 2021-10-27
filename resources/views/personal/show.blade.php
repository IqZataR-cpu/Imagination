@extends ('layouts.personal')

@section('title', 'personal area')

@section('content')
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <b>Личные данные</b>
                <br>
                Имя: {{ $User->name }}
                <br>
                Почта: {{ $User->email }}
            </div>
            <br>
            <div class="p-6">
                <b>Сменить данные</b>
                <br>
                <form action="{{ route('personal.index') }}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <input type="email" name="email" id="email" placeholder="Почта"> <br>
                    <input type="text" name="name" id="name" placeholder="Имя"> <br>
                    <input type="password" name="password" id="password" placeholder="Пароль"> <br>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Повторите пароль"> <br>
                    <input type="submit" name="ready">
                </form>
            </div>
        </div>
    </div>
@endsection
