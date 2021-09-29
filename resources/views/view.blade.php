@extends( "layouts.app", [
  "icons" => true,
  "title" => $data->Full_name
] )

@push( "styles" )
    <link rel = "stylesheet" type = "text/css" href = "{{ asset( "css/index.css" ) }}">
@endpush

@push( "scripts" )
    <script src = "{{ asset( "js/index.js" ) }}"></script>
@endpush

@section("content")
    <a href="/summaries/{{$id}}/edit" type="button">Edit</a>
    <a href="/summaries/{{$id}}/pdf" type="button">Download pdf</a>
    <fieldset>
        <legend>CV information</legend>
        @foreach($data as $it => $val)
            <fieldset>
                <legend>{{$it}}</legend>
                @if(isset($val))
                    {{$val}}
                @else
                    N/A
                @endif
            </fieldset>
        @endforeach
    </fieldset>
@endsection
