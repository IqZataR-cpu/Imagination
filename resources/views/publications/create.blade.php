@extends ('layouts.personal')

@section('title', 'create publication')

@section('content')
    <form action="{{ route('publication.store') }}" method="post" enctype='multipart/form-data'>
        @csrf
        <input type="file" name="preview_image" id="preview_image" placeholder="Картинка"> <br>
        <input type="text" name="description" id="description" placeholder="Описание"> <br>
        <input type="submit" name="ready">
    </form>
@endsection
