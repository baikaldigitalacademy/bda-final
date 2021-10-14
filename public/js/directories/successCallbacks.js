function createNameRow( { id, name } ){
    const div = document.createElement( "div" );

    div.setAttribute( "id", `row${id}` );
    div.setAttribute( "class", "d-flex mt-2" );

    div.innerHTML =
        `<input data-edit${id} = "name" type = "text" value = "${name}" class = "form-control me-2">
        <button class = "btn btn-success me-2" onclick = "update( ${id} )">
          <i class = "fas fa-check"></i>
        </button>
        <button class = "btn btn-danger" onclick = "destroy( ${id} )">
          <i class = "fas fa-trash"></i>
        </button>`;

    document.getElementById( "data" ).appendChild( div );
}

function createSummaryStatusesRow( { id, name, color } ){
    const div = document.createElement( "div" );

    div.setAttribute( "id", `row${id}` );
    div.setAttribute( "class", "d-flex align-items-center mb-2" );

    div.innerHTML =
        `<input
            data-edit${id} = "name"
            type = "text"
            class = "form-control"
            value = "${name}"
        >
        <input
            id = "isColorEnabledCheckbox${id}"
            type = "checkbox"
            class = "form-check-input ms-2 me-2"
            style = "padding: 5px"
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
        <label
            id = "colorDisabledSpan${id}"
            for = "isColorEnabledCheckbox${id}"
            ${color && "style = \"display: none\""}
        >
            нет
        </label>
        <button onclick = "update( ${id} )" class = "btn btn-success ms-2">
            <i class = "fas fa-check"></i>
        </button>
        <button onclick = "destroy( ${id} )" class = "btn btn-danger ms-2">
            <i class = "fas fa-trash"></i>
        </button>`;

    document.getElementById( "data" ).appendChild( div );
}
