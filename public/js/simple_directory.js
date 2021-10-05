function clearErrors( node ){
    ( node || document.getElementById( "errorsDiv" ) ).innerHTML = "";
}

function showErrors( errors ){
    const errorsDiv = document.getElementById( "errorsDiv" );

    clearErrors( errorsDiv );

    for( const error of errors ){
        const div = document.createElement( "div" );

        div.innerHTML = error;
        errorsDiv.appendChild( div );
    }
}

async function createName(){
    const nameInput = document.getElementById( "newNameInput" );
    const name = nameInput.value;

    const response = await fetch( BASE_URL, {
        method: "post",
        headers: {
            "content-type": "application/json",
            "accept": "application/json",
            "x-csrf-token": CSRF_TOKEN
        },
        body: JSON.stringify( { name } )
    } );

    const { status, statusText } = response;
    const json = await response.json();

    if( status !== 200 ){
        if( status === 422 ){
            showErrors( json.errors.name );
        } else {
            alert( `[ERROR] ${status} ${statusText}` );
        }

        return;
    }

    const div = document.createElement( "div" );

    div.setAttribute( "id", `name${json}` );

    div.innerHTML =
        `${++totalCount}.
        <input id = "name${json}Input" type = "text" value = "${name}">
        <button onclick = "updateName( ${json} )">Сохранить</button>
        <button onclick = "deleteItem( ${json} )">Удалить</button>`;

    document.getElementById( "data" ).appendChild( div );
    nameInput.value = "";
    nameInput.focus();
}

async function updateName( id ){
    const nameInput = document.getElementById( `name${id}Input` );
    const name = nameInput.value;

    clearErrors();

    const response = await fetch( `${BASE_URL}/${id}`, {
        method: "put",
        headers: {
            "content-type": "application/json",
            "accept": "application/json",
            "x-csrf-token": CSRF_TOKEN
        },
        body: JSON.stringify( { name } )
    } );

    const { status, statusText } = response;

    if( status !== 200 ){
        if( status === 422 ){
            const json = await response.json();

            showErrors( json.errors.name );
        } else {
            alert( `[ERROR] ${status} ${statusText}` );
        }

        return;
    }

    nameInput.focus();

    // TODO на что-то почеловечнее
    alert( "Успешно" );
}

async function deleteItem( id ){
    const response = await fetch( `${BASE_URL}/${id}`, {
        method: "delete",
        headers: {
            "accept": "application/json",
            "x-csrf-token": CSRF_TOKEN
        }
    } );

    const { status, statusText } = response;

    if( status !== 200 ){
        if( status === 422 ){
            const json = await response.json();

            showErrors( json.errors.name );
        } else {
            alert( `[ERROR] ${status} ${statusText}` );
        }

        return;
    }

    totalCount--;
    document.getElementById( "data" ).removeChild( document.getElementById( `name${id}` ) );
}
