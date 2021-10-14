@extends( "layouts.app", [ "title" => $title ] )

@push( "styles" )
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@push("scripts")
    <script>
        const EMAIL_POSTFIX = "{{ env( "EMAIL_POSTFIX" ) }}";
    </script>

    <script src = "https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src = "{{ asset( "js/transliteration.js" ) }}"></script>
    <script src = "{{ asset( "js/generateEmail.js" ) }}"></script>
    <script src = "{{ asset( "js/edit.js" ) }}"></script>
@endpush

@section("content")
    <div class = "container-lg mt-3">
        <form id = "editForm" method="post" action="{{route('summaryUpdate', ['id'=>$data->id])}}">
            @csrf
            @if(!$isNew)
                @method("put")
            @endif

            <div class = "d-flex justify-content-between d-lg-block mb-2">
                <button type = "submit" class = "btn btn-success">Сохранить</button>
                <a href = "." class = "btn btn-primary">Назад</a>
            </div>
            <label for = "name">Полное имя</label>
            <input
                type = "text"
                class = "form-control"
                id = "name"
                name = "name"
                value = "{{old('name') ?? $data->name}}"
            >
            <label for = "date">Дата собеседования</label>
            <input
                type = "date"
                class = "form-control"
                id = "date"
                name = "date"
                value = "{{old('date') ?? $data->date}}"
            >
            <label for = "email">E-mail</label>
            <input
                type = "email"
                class = "form-control"
                id = "email"
                name = "email"
                value = "{{old('email') ?? $data->email}}"
            >
            <label for = "status_id">Статус</label>
            <select id = "status_id" name = "status_id" class = "form-select">
                @foreach($statuses as $it)
                    <option value = {{$it->id}}
                        @if($it->id == old("status_id") or $it->name == $data->status)
                            selected>
                        @else
                            >
                        @endif
                        {{$it->name}}
                    </option>
                @endforeach
            </select>
            <label for = "level_id">Уровень</label>
            <select id = "level_id" name = "level_id" class = "form-select">
                <option
                    value = ""
                    {{ !$data->level ? "selected" : "" }}
                >
                    Без уровня
                </option>
                @foreach($levels as $it)
                    <option value = {{$it->id}}
                        @if($it->id == old("level_id") or $it->name == $data->level)
                            selected>
                        @else
                            >
                        @endif
                        {{$it->name}}
                    </option>
                @endforeach
            </select>
            <label for = "position_id">Позиция</label>
            <select id = "position_id" name = "position_id" class = "form-select">
                @foreach($positions as $it)
                    <option value = {{$it->id}}
                        @if($it->id == old("position_id") or $it->name == $data->position)
                            selected>
                        @else
                            >
                        @endif
                        {{$it->name}}
                    </option>
                @endforeach
            </select>
            <div class = "card mt-3 text-black">
                <div class = "card-header">Навыки</div>
                <div id = "skillsEditorDiv">
                    {!! old('skills') ?? $data->skills !!}
                </div>
            </div>
            <div class = "card mt-3 text-black">
                <div class = "card-header">Описание</div>
                <div id = "descriptionEditorDiv" class = "editor">
                    {!! old('description') ?? $data->description !!}
                </div>
            </div>
            <div class = "card mt-3 text-black">
                <div class = "card-header">Опыт</div>
                <div id = "experienceEditorDiv" class = "editor">
                    {!! old('experience') ?? $data->experience !!}
                </div>
            </div>
            <div class = "d-flex justify-content-between d-lg-block mt-3">
                <button type = "submit" class = "btn btn-success">Сохранить</button>
                <a href = "." class = "btn btn-primary">Назад</a>
            </div>
            <input id = "skills" name = "skills" type = "text" hidden>
            <input id = "description" name = "description" type = "text" hidden>
            <input id = "experience" name = "experience" type = "text" hidden>
        </form>
    </div>
@endsection
