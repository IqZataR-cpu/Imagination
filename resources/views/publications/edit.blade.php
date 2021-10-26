@extends ('layouts.personal')

@section('title', 'edit publication')

@section('content')
    <a  href="{{ route('publication.destroy', [$publication->id]) }}"> удалить</a>

    <form action="{{ route('publication.edit', $publication->id) }}" method="post" enctype='multipart/form-data'>
        @csrf
        <div>
            <b>Предыдущий текст: </b>{{ $publication->description }}
        </div>
        <input type="text" name="description" id="description" placeholder="Описание"> <br>
        <input type="submit" name="ready">
    </form>
@endsection
