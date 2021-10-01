@extends( "layouts.app", [
  "icons" => true,
  "title" => $data->Full_name
] )

@push( "styles" )
    <link rel = "stylesheet" type = "text/css" href = "{{ asset( "css/index.css" ) }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@push("scripts")
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        const options = {
            debug: "info",
            modules: {
                toolbar: [ "bold", "italic", "underline" ]
            },
            theme: "snow",
        };

        const editor1 = new Quill( document.getElementById( "editor1" ), options );
        const editor2 = new Quill( document.getElementById( "editor2" ), options );
        const editor3 = new Quill( document.getElementById( "editor3" ), options );
    </script>
@endpush

@section("content")
    <form method="post" action="{{route('summaryUpdate', ['id'=>$id])}}">
        @csrf
        @method("put")
        <a href="." class="button">Cancel</a>
        <input type="submit" value="Save">
        <fieldset>
            <legend>CV information</legend>
            <fieldset>
                <legend>Full name</legend>
                <input size=100%
                    name="Full_name"
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
                <input size=100%
                    type="email"
                    name="email"
                    value="{{$data->Email}}"
                >
            </fieldset>
            <fieldset>
                <legend>Status</legend>
                <select name="Status">
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
                <select name="Level">
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
                <select name="Position">
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
                <div id="editor1">
                    {{$data->Skills}}
                </div>
            </fieldset>
            <fieldset>
                <legend>Description</legend>
                <div id="editor2">
                    {{$data->Description}}
                </div>
            </fieldset>
            <fieldset>
                <legend>Experience</legend>
                <div id="editor3">
                    {{$data->Experience}}
                </div>
            </fieldset>
        </fieldset>
    </form>
@endsection
