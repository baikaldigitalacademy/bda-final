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
    const addNewNameButton = document.getElementById( "addNewNameButton" );

    addNewNameButton.addEventListener( "click", async () => {
        const csrf = document.getElementById( "csrf-token" ).getAttribute( "content" );
        const newName = document.getElementById( "newNameInput" ).value;

        const response = await fetch( BASE_URL, {
            method: "post",
            headers: {
                "content-type": "application/json",
                "x-csrf-token": csrf
            },
            body: JSON.stringify( { name: newName } )
        } );

        // TODO обработка ответа
    } );
}

window.addEventListener( "load", index );
