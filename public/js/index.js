function filters( action ){
    const classList = document.getElementById( "filters" ).classList;

    if( action === "show" ){
        classList.remove( "d-none" );
    } else {
        classList.add( "d-none" );
    }
}

function clearOneFilter( name, value = "" ){
    document.getElementsByName( name )[0].value = value;
}

function refreshClear(){
    window.location.href = window.location.pathname;
}

function filtersFormOnSubmit( e ){
    e.preventDefault();

    const formData = new FormData( e.target );
    const name = formData.get( "name" );
    const email = formData.get( "email" );
    const positionId = formData.get( "position_id" );
    const levelId = formData.get( "level_id" );
    const dateStart = formData.get( "date_start" );
    const dateEnd = formData.get( "date_end" );
    const statusId = formData.get( "status_id" );
    const urlSearchParams = new URLSearchParams( window.location.search );

    if( name ){
        urlSearchParams.set( "name", name );
    } else {
        urlSearchParams.delete( "name" );
    }

    if( email ){
        urlSearchParams.set( "email", email );
    } else {
        urlSearchParams.delete( "email" );
    }

    if( positionId !== "any" ){
        urlSearchParams.set( "position_id", positionId );
    } else {
        urlSearchParams.delete( "position_id" );
    }

    if( levelId !== "any" ){
        if( levelId === "null" ){
            urlSearchParams.set( "without_level", "true" );
        } else {
            urlSearchParams.set( "level_id", levelId );
        }
    } else {
        urlSearchParams.delete( "without_level" );
        urlSearchParams.delete( "level_id" );
    }

    if( dateStart ){
        urlSearchParams.set( "date_start", dateStart );
    } else {
        urlSearchParams.delete( "date_start" );
    }

    if( dateEnd ){
        urlSearchParams.set( "date_end", dateEnd );
    } else {
        urlSearchParams.delete( "date_end" );
    }

    if( statusId !== "any" ){
        urlSearchParams.set( "status_id", statusId );
    } else {
        urlSearchParams.delete( "status_id" );
    }

    const query = urlSearchParams.toString();
    let url = window.location.pathname;

    if( query ){
        url += `?${query}`;
    }

    window.location.href = url;
}

function applySort( orderColumn, orderDirection ){
    const urlSearchParams = new URLSearchParams( window.location.search );

    if( orderColumn !== "id" ){
        urlSearchParams.set( "order_column", orderColumn );
    } else {
        urlSearchParams.delete( "order_column" );
    }

    if( orderDirection === "desc" ){
        urlSearchParams.set( "order_direction", orderDirection );
    } else {
        urlSearchParams.delete( "order_direction" );
    }

    const query = urlSearchParams.toString();
    let url = window.location.pathname;

    if( query ){
        url += `?${query}`;
    }

    window.location.href = url;
}

function headerElementOnClickFactory( orderColumn, orderDirection ){
    return () => applySort( orderColumn, orderDirection );
}

function toggleOrderDirectionMobile(){
    const button = document.getElementById( "orderDirectionMobile" );
    const icon = button.getElementsByTagName( "i" )[0];
    const value = button.getAttribute( "data-value" );

    if( value === "asc" ){
        button.setAttribute( "data-value", "desc" );
        icon.classList.remove( "fa-sort-amount-up" );
        icon.classList.add( "fa-sort-amount-down" );
    } else {
        button.setAttribute( "data-value", "asc" );
        icon.classList.remove( "fa-sort-amount-down" );
        icon.classList.add( "fa-sort-amount-up" );
    }
}

function applySortMobile(){
    const orderColumn = document.getElementById( "orderColumnMobile" ).value;
    const orderDirection = document.getElementById( "orderDirectionMobile" ).getAttribute( "data-value" );

    applySort( orderColumn, orderDirection );
}

async function changeStatus( id ){
    const status_id = Number( document.getElementById( `summaryStatus${id}` ).value );

    const response = await fetch( `${BASE_URL}/${id}/status`, {
        method: "put",
        headers: {
            "content-type": "application/json",
            "accept": "application/json",
            "x-csrf-token": CSRF_TOKEN
        },
        body: JSON.stringify( { status_id } )
    } );

    // TODO process error

    const { payload: color } = await response.json();
    const tds = document.getElementById( `summary${id}` ).getElementsByTagName( "td" )

    for( const td of tds ){
        td.style.backgroundColor = color;
    }
}

async function changeStatus2( id ){
    const status_id = Number( document.getElementById( `summaryStatus${id}` ).value );

    const response = await fetch( `${BASE_URL}/${id}/status`, {
        method: "put",
        headers: {
            "content-type": "application/json",
            "accept": "application/json",
            "x-csrf-token": CSRF_TOKEN
        },
        body: JSON.stringify( { status_id } )
    } );

    // TODO process error

    const { payload: color } = await response.json();

    document.getElementById( `summaryStatusColor${id}` ).style.backgroundColor = color;
}

function index(){
    const filtersForm = document.getElementById( "filtersForm" );
    const headerElements = document.querySelectorAll( "[data-header]" );

    filtersForm.addEventListener( "submit", filtersFormOnSubmit );

    for( const headerElement of headerElements ){
        const [ orderColumn, orderDirection ] = headerElement.getAttribute( "data-header" ).split( " " );

        headerElement.addEventListener( "click", headerElementOnClickFactory( orderColumn, orderDirection ) );
    }
}

window.addEventListener( "load", index );
