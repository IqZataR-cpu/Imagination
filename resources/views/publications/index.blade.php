@extends ('layouts.personal')

@section('title', 'Add publication')

@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        @foreach($publications as $publication)

            <br>
            <form>
                <a href="{{ route('publication.show', [$publication->id]) }}"> <b>редактировать</b></a>
            </form>
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        {{ $publication->author->name }} {{ $publication->created_at->format('d-m-Y') }}
                    </div>
                    <br>
                    <div class="p-6">
                        <img src="{{ asset('images/publication/' . $publication->previewImage->path) }}" alt="">
                    </div>
                    <div class="p-6">
                        <div class="p-6">
                            like {{ $publication->likes->count() }}
                            dislike {{ $publication->dislikes->count() }}
                        </div>
                        <div class="p-6">
                            <b>Описание</b> <br>
                            <b>{{ $publication->author->name }} </b>{{ $publication->description }}
                        </div>
                        <div class="p-6">
                            <b>Комментарии</b> <br>
                            <b>{{ $publication->author->name }} </b>{{ $publication->description }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
