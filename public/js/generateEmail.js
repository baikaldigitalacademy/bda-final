function generateEmail( name, postfix ){
    const nameParts = name.split( " " );

    if( nameParts.length < 2 ){
        return [ 1, null ];
    }

    const emailParts = [
        transliteration( nameParts[0].toLocaleLowerCase() ),
        ".",
        transliteration( nameParts[1].toLocaleLowerCase()[0] )
    ];

    if( nameParts.length > 2 ){
        emailParts.push( ".", transliteration( nameParts[2].toLocaleLowerCase()[0] ) );
    }

    emailParts.push( postfix );

    return [ null, emailParts.join( "" ) ];
}
