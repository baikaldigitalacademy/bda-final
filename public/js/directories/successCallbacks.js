function createNameRow( { id, name } ){
    const div = document.createElement( "div" );

    div.setAttribute( "id", `row${id}` );
    div.setAttribute( "class", "d-flex mt-2" );

    div.innerHTML =
        `<input data-edit${id} = "name" type = "text" value = "${name}" class = "form-control me-2">
        <button class = "btn btn-success me-2" onclick = "update( ${id} )">
          <i class = "fas fa-check me-2"></i>
        </button>
        <button class = "btn btn-danger me-2" onclick = "destroy( ${id} )">
          <i class = "fas fa-trash"></i>
        </button>`;

    document.getElementById( "data" ).appendChild( div );
}

function createSummaryStatusesRow( { id, name, color } ){
    const div = document.createElement( "div" );

    div.setAttribute( "id", `row${id}` );

    div.innerHTML =
        `${++totalCount}.
        <input data-edit${id} = "name" type = "text" value = "${name}">
        <input
            id = "isColorEnabledCheckbox${id}"
            type = "checkbox"
            onchange = "toggleIsColorInclude( ${id} )"
            ${color && "checked"}
        >
        <input
            id = "colorEnabledInput${id}"
            data-edit${id} = "color"
            type = "color"
            ${color && `value = "${color}"`}
            ${!color && "data-null = \"true\""}
            ${!color && "style = \"display: none\""}
        >
        <span
            id = "colorDisabledSpan${id}"
            ${color && "style = \"display: none\""}
        >
            нет
        </span>
        <button onclick = "update( ${id} )">Сохранить</button>
        <button onclick = "destroy( ${id} )">Удалить</button>`;

    document.getElementById( "data" ).appendChild( div );
}
