function createNameRow( { id, name } ){
    const div = document.createElement( "div" );

    div.setAttribute( "id", `row${id}` );

    div.innerHTML =
        `${++totalCount}.
        <input data-edit${id} = "name" type = "text" value = "${name}">
        <button onclick = "update( ${id} )">Сохранить</button>
        <button onclick = "destroy( ${id} )">Удалить</button>`;

    document.getElementById( "data" ).appendChild( div );
}

function createSummaryStatusesRow( { id, name, color } ){
    console.log( id, name, color );
}
