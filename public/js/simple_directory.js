async function updateName( id ){
    const csrf = document.getElementById( "csrf-token" ).getAttribute( "content" );
    const name = document.getElementById( `name${id}Input` ).value;

    const response = await fetch( `${BASE_URL}/${id}`, {
        method: "put",
        headers: {
            "content-type": "application/json",
            "x-csrf-token": csrf
        },
        body: JSON.stringify( { name } )
    } );

    // TODO обработка ответа
}

async function deleteItem( id ){
    const csrf = document.getElementById( "csrf-token" ).getAttribute( "content" );

    const response = await fetch( `${BASE_URL}/${id}`, {
        method: "delete",
        headers: {
            "x-csrf-token": csrf
        }
    } );

    // TODO обработка ответа
}

function index(){
    const newItemForm = document.getElementById( "newItemForm" );

    newItemForm.addEventListener( "submit", e => {
        e.preventDefault();

        const formData = new FormData( e.target );

        for( const [ key, value ] of formData.entries() ){
            console.log( key, value );
        }
    } );
}

window.addEventListener( "load", index );
