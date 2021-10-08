async function destroy( URL ){
    const answer = confirm( "Вы действительно хотите удалить резюме?" );

    if( !answer ) return;

    const response = await fetch( URL, {
        method: "delete",
        headers: {
            "x-csrf-token": CSRF_TOKEN
        }
    } );

    // TODO process error

    window.location.href = DASHBOARD_URL;
}
