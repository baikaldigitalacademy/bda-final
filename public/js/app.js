function headerMenu( action ){
    const classList = document.getElementById( "headerMenu" ).classList;

    if( action === "show" ){
        classList.remove( "d-none" );
    } else {
        classList.add( "d-none" );
    }
}
