@extends( "layouts.app", [
  "icons" => true,
  "title" => $data->name
] )


@section("content")
    <a href = "{{ route( "summaries_edit", [ "id" => $id ] ) }}" class = "button">Изменить</a>
    <a href = "{{ route( "pdf", [ "id" => $id ] ) }}" class = "button">Скачать PDF</a>
    <fieldset>
        <legend>CV information</legend>
        <fieldset>
            <legend>Полное имя</legend>
            {{$data->name}}
        </fieldset>
        <fieldset>
            <legend>Дата собеседования</legend>
            {{$data->date}}
        </fieldset>
        <fieldset>
            <legend>E-mail</legend>
            {{$data->email}}
        </fieldset>
        <fieldset>
            <legend>Статус</legend>
            {{$data->status}}
        </fieldset>
        <fieldset>
            <legend>Уровень</legend>
            {{$data->level}}
        </fieldset>
        <fieldset>
            <legend>Позиция</legend>
            {{$data->position}}
        </fieldset>
        <fieldset>
            <legend>Навыки</legend>
                {!! $data->skills !!}
        </fieldset>
        <fieldset>
            <legend>Описание</legend>
                {!! $data->description !!}
        </fieldset>
        <fieldset>
            <legend>Опыт</legend>
                {!! $data->experience !!}
        </fieldset>
    </fieldset>
@endsection
