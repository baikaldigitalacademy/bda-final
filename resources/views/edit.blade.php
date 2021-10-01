@extends( "layouts.app", [
  "icons" => true,
  "title" => $data->Full_name
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
    <form id = "editForm" method="post" action="{{route('summaryUpdate', ['id'=>$id])}}">
        @csrf
        @method("put")
        <a href="." class="button">Cancel</a>
        <input type="submit" value="Save">
        <fieldset>
            <legend>CV information</legend>
            <fieldset>
                <legend>Full name</legend>
                <input size="100%"
                    name="name"
                    id = "name"
                    value="{{$data->Full_name}}"
                >
            </fieldset>
            <fieldset>
                <legend>Date</legend>
                <input
                    type="date"
                    name="date"
                    value="{{$data->Date}}"
                >
            </fieldset>
            <fieldset>
                <legend>E-mail</legend>
                <input size="100%"
                    type="email"
                    id = "email"
                    name="email"
                    value="{{$data->Email}}"
                >
            </fieldset>
            <fieldset>
                <legend>Status</legend>
                <select name="status_id">
                    @foreach($statuses as $it)
                        <option value = {{$it->id}}
                        @if($it->name == $data->Status)
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
                <legend>Level</legend>
                <select name="level_id">
                    <option
                        value = ""
                        {{ !$data->Level ? "selected" : "" }}
                    >
                        Без уровня
                    </option>
                    @foreach($levels as $it)
                        <option value = {{$it->id}}
                        @if($it->name == $data->Level)
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
                <legend>Position</legend>
                <select name="position_id">
                    @foreach($positions as $it)
                        <option value = {{$it->id}}
                        @if($it->name == $data->Position)
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
                <legend>Skills</legend>
                <div id = "skillsEditorDiv">
                    {!! $data->Skills !!}
                </div>
            </fieldset>
            <fieldset>
                <legend>Description</legend>
                <div id = "descriptionEditorDiv">
                    {!! $data->Description !!}
                </div>
            </fieldset>
            <fieldset>
                <legend>Experience</legend>
                <div id = "experienceEditorDiv">
                    {!! $data->Experience !!}
                </div>
            </fieldset>
        </fieldset>
        <input id = "skills" name = "skills" type = "text" hidden>
        <input id = "description" name = "description" type = "text" hidden>
        <input id = "experience" name = "experience" type = "text" hidden>
    </form>
@endsection
