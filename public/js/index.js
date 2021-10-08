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
    const urlSearchParams = new URLSearchParams();

    if( name ){
        urlSearchParams.set( "name", name );
    }

    if( email ){
        urlSearchParams.set( "email", email );
    }

    if( positionId !== "any" ){
        urlSearchParams.set( "position_id", positionId );
    }

    if( levelId !== "any" ){
        if( levelId === "null" ){
            urlSearchParams.set( "without_level", "true" );
        } else {
            urlSearchParams.set( "level_id", levelId );
        }
    }

    if( dateStart ){
        urlSearchParams.set( "date_start", dateStart );
    }

    if( dateEnd ){
        urlSearchParams.set( "date_end", dateEnd );
    }

    if( statusId !== "any" ){
        urlSearchParams.set( "status_id", statusId );
    }

    const query = urlSearchParams.toString();
    let url = window.location.pathname;

    if( query ){
        url += `?${query}`;
    }

    window.location.href = url;
}

function headerElementOnClickFactory( orderColumn, orderDirection ){
    return () => {
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
    };
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
        body: JSON.stringify( {status_id } )
    } );

    // TODO process error

    const { payload: color } = await response.json();
    const tds = document.getElementById( `summary${id}` ).getElementsByTagName( "td" )

    for( const td of tds ){
        td.style.backgroundColor = color;
    }
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
