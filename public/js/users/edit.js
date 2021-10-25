function index(){
    const deleteFormSubmit = document.getElementById( "deleteFormSubmit" );

    deleteFormSubmit.addEventListener( "click", () => {
        const isConfirmed = confirm( "Вы действительно хотите удалить пользователя?" );

        if( isConfirmed ){
            document.getElementById( "deleteForm" ).submit();
        }
    } );
}

window.addEventListener( "load", index );
