function clearErrors( node ){
    const errorsDiv = node || document.getElementById( "errorsDiv" );

    errorsDiv.classList.add( "d-none" );
    errorsDiv.innerHTML = "";
}

function showErrorsByFields( errorBug ){
    const errorsDiv = document.getElementById( "errorsDiv" );

    for( const [ field, errors ] of Object.entries( errorBug ) ){
        // const fieldset = document.createElement( "fieldset" );
        // const legend = document.createElement( "legend" );
        //
        // legend.innerHTML = field;
        // fieldset.appendChild( legend );

        for( const error of errors ){
            const div = document.createElement( "div" );

            div.innerHTML = error;
            // fieldset.appendChild( div );
            errorsDiv.appendChild( div );
        }

        // errorsDiv.appendChild( fieldset );
    }

    errorsDiv.classList.remove( "d-none" );
}

function showUnnamedErrors( errors ){
    const errorsDiv = document.getElementById( "errorsDiv" );

    for( const error of errors ){
        const div = document.createElement( "div" );

        div.innerHTML = error;
        errorsDiv.appendChild( div );
    }

    errorsDiv.classList.remove( "d-none" );
}

async function create( successCallback ){
    clearErrors();

    const body = Array
        .from( document.querySelectorAll( "[data-create]" ) )
        .reduce( ( res, node ) => {
            const key = node.getAttribute( "data-create" );

            if( node.getAttribute( "data-null" ) === "true" ){
                res[ key ] = null;
            } else {
                res[ key ] = node.value;
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
            showErrorsByFields( json.errors );
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

            if( node.getAttribute( "data-null" ) === "true" ){
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

            showErrorsByFields( json.errors );
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

            showErrorsByFields( json.errors );
        }
        else if( status === 400 ){
            const error = await response.text();

            showUnnamedErrors( [ error ] );
        } else {
            alert( `[ERROR] ${status} ${statusText}` );
        }

        return;
    }

    totalCount--;
    document.getElementById( "data" ).removeChild( document.getElementById( `row${id}` ) );
}
