@extends( "layouts.app", [
  "icons" => true,
  "title" => $data->Full_name
] )


@section("content")
    <a href = "{{ route( "summaries_edit", [ "id" => $id ] ) }}" class = "button">Изменить</a>
    {{-- TODO change to route --}}
    <a href = "{{ url( "/summaries/$id/pdf" ) }}" class = "button">Скачать PDF</a>
    <fieldset>
        <legend>CV information</legend>
        {{-- TODO remove cycle --}}
        @foreach($data as $it => $val)
            <fieldset>
                <legend>{{$it}}</legend>
                @if(isset($val))
                    @if( !in_array( $it, [ "Skills", "Description", "Experience" ] ) )
                        {{$val}}
                    @else
                        {!! $val !!}
                    @endif
                @else
                    N/A
                @endif
            </fieldset>
        @endforeach
    </fieldset>
@endsection
