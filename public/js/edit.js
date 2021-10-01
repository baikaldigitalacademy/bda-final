function index(){
    const options = {
        modules: {
            toolbar: [ "bold", "italic", "underline" ]
        },
        theme: "snow"
    };

    const skillsEditor = new Quill( document.getElementById( "skillsEditorDiv" ), options );
    const descriptionEditor = new Quill( document.getElementById( "descriptionEditorDiv" ), options );
    const experienceEditor = new Quill( document.getElementById( "experienceEditorDiv" ), options );

    const editForm = document.getElementById( "editForm" );

    editForm.addEventListener( "submit", e => {
        const name = document.getElementById( "name" ).value.trim();
        const oldEmail = document.getElementById( "email" ).value.trim();

        document.getElementById( "skills" ).value = skillsEditor.container.firstChild.innerHTML;
        document.getElementById( "description" ).value = descriptionEditor.container.firstChild.innerHTML;
        document.getElementById( "experience" ).value = experienceEditor.container.firstChild.innerHTML;

        if( !oldEmail ){
            const [ error, newEmail ] = generateEmail( name, EMAIL_POSTFIX );

            if( error ){
                return;
            }

            const answer = confirm( `Вы не ввели email. Вам подходит такой ${newEmail}?` );

            if( !answer ){
                e.preventDefault();

                return;
            }

            document.getElementById( "email" ).value = newEmail;
        }
    } );
}

window.addEventListener( "load", index );
