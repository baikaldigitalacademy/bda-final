@extends( "layouts.app", [
  "icons" => true,
  "title" => $data->Full_name
] )


@section("content")
    <a href="/summaries/{{$id}}/edit" class="button">Edit</a>
    <a href="/summaries/{{$id}}/pdf" class="button">Download pdf</a>
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
