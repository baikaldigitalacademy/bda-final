function clearErrors( node ){
    ( node || document.getElementById( "errorsDiv" ) ).innerHTML = "";
}

function showErrors( errorBug ){
    const errorsDiv = document.getElementById( "errorsDiv" );

    for( const [ field, errors ] of Object.entries( errorBug ) ){
        const fieldset = document.createElement( "fieldset" );
        const legend = document.createElement( "legend" );

        legend.innerHTML = field;
        fieldset.appendChild( legend );

        for( const error of errors ){
            const div = document.createElement( "div" );

            div.innerHTML = error;
            fieldset.appendChild( div );
        }

        errorsDiv.appendChild( fieldset );
    }
}

async function create( successCallback ){
    clearErrors();

    const body = Array
        .from( document.querySelectorAll( "[data-create]" ) )
        .reduce( ( res, node ) => {
            if( !Boolean( node.getAttribute( "data-not-include" ) ) ){
                res[ node.getAttribute( "data-create" ) ] = node.value;
            }

            return res;
        }, {} );

    const response = await fetch( BASE_URL, {
        method: "post",
        headers: {
            "content-type": "application/json",
            "accept": "application/json",
            "x-csrf-token": CSRF_TOKEN
        },
        body: JSON.stringify( body )
    } );

    const { status, statusText } = response;
    const json = await response.json();

    if( status !== 200 ){
        if( status === 422 ){
            showErrors( json.errors );
        } else {
            alert( `[ERROR] ${status} ${statusText}` );
        }

        return;
    }

    successCallback && successCallback( { id: json, ...body } );
}

async function update( id ){
    clearErrors();

    const body = JSON.stringify( Array
        .from( document.querySelectorAll( `[data-edit${id}]` ) )
        .reduce( ( res, node ) => {
            const key = node.getAttribute( `data-edit${id}` );

            if( Boolean( node.getAttribute( "data-null" ) ) ){
                res[ key ] = null;
            } else {
                res[ key ] = node.value;
            }

            return res;
        }, {} ) );

    const response = await fetch( `${BASE_URL}/${id}`, {
        method: "put",
        headers: {
            "content-type": "application/json",
            "accept": "application/json",
            "x-csrf-token": CSRF_TOKEN
        },
        body
    } );

    const { status, statusText } = response;

    if( status !== 200 ){
        if( status === 422 ){
            const json = await response.json();

            showErrors( json.errors );
        } else {
            alert( `[ERROR] ${status} ${statusText}` );
        }

        return;
    }

    // TODO на что-то почеловечнее
    alert( "Успешно" );
}

async function destroy( id ){
    clearErrors();

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

            showErrors( json.errors );
        } else {
            alert( `[ERROR] ${status} ${statusText}` );
        }

        return;
    }

    totalCount--;
    document.getElementById( "data" ).removeChild( document.getElementById( `row${id}` ) );
}
