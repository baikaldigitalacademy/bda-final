@extends( "layouts.app", [
  "icons" => true,
  "title" => $title
] )

@push( "styles" )
    <link rel = "stylesheet" type = "text/css" href = "{{ asset( "css/index.css" ) }}">
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
    <form id = "editForm" method="post" action="{{route('summaryUpdate', ['id'=>$data->id])}}">
        @csrf
        @if(!$isNew)
            @method("put")
        @endif

        <a href="." class="button">Cancel</a>
        <input type="submit" value="Save">
        <fieldset>
            <legend>CV information</legend>
            <fieldset>
                <legend>Полное имя</legend>
                <input size="100%"
                    name="name"
                    id = "name"
                    value = "{{old('name') ?? $data->name}}"
                >
            </fieldset>
            <fieldset>
                <legend>Дата собеседования</legend>
                <input
                    type="date"
                    name="date"
                    value="{{old('date') ?? $data->date}}"
                >
            </fieldset>
            <fieldset>
                <legend>E-mail</legend>
                <input size="100%"
                    type="email"
                    id = "email"
                    name="email"
                    value="{{old('email') ?? $data->email}}"
                >
            </fieldset>
            <fieldset>
                <legend>Статус</legend>
                <select name="status_id">
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
            </fieldset>
            <fieldset>
                <legend>Уровень</legend>
                <select name="level_id">
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
            </fieldset>
            <fieldset>
                <legend>Позиция</legend>
                <select name="position_id">
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
            </fieldset>
            <fieldset>
                <legend>Навыки</legend>
                <div id = "skillsEditorDiv">
                    {!! old('skills') ?? $data->skills !!}
                </div>
            </fieldset>
            <fieldset>
                <legend>Описание</legend>
                <div id = "descriptionEditorDiv">
                    {!! old('description') ?? $data->description !!}
                </div>
            </fieldset>
            <fieldset>
                <legend>Опыт</legend>
                <div id = "experienceEditorDiv">
                    {!! old('experience') ?? $data->experience !!}
                </div>
            </fieldset>
        </fieldset>
        <input id = "skills" name = "skills" type = "text" hidden>
        <input id = "description" name = "description" type = "text" hidden>
        <input id = "experience" name = "experience" type = "text" hidden>
    </form>
@endsection
