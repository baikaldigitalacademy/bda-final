function toggleIsColorInclude( id = "" ){
    const isColorEnabled = document.getElementById( `isColorEnabledCheckbox${id}` ).checked;
    const colorEnabledInput = document.getElementById( `colorEnabledInput${id}` );
    const colorDisabledSpan = document.getElementById( `colorDisabledSpan${id}` );

    if( isColorEnabled ){
        colorEnabledInput.style.display = "inline-block";
        colorDisabledSpan.style.display = "none";
        colorEnabledInput.removeAttribute( "data-null" );
    } else {
        colorEnabledInput.style.display = "none";
        colorDisabledSpan.style.display = "inline-block";
        colorEnabledInput.setAttribute( "data-null", "true" );
    }
}
