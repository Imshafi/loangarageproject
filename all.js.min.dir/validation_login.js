function validate_form(user_name,user_password){
    if(validate_user_name(user_name)){
        if(validate_password(user_password)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function validate_user_name(val)
{
    if(val!=="")
    {
        if(val.length<6 || val.length>10)
        {
            return false;
        }else if( val.search( /[0-9]/ ) ==-1 ){

            return false;

        }else if( val.search( /[a-z]/ ) ==-1){

            return false;

        }else if( val.search( /[A-Z]/ ) ==-1 ){
            
            return false;

        }else{
            return true;
        }
    }
    else
    {
        return false;
    }
}

function validate_password( val )
{
    if(val!=="")
    {
        if(val.length<8 || val.length>12)
        {
            return false;
        }else if( val.search( /[0-9]/ ) ==-1 ){

            return false;

        }else if( val.search( /[a-z]/ ) ==-1){

            return false;

        }else if( val.search( /[A-Z]/ ) ==-1 ){
            
            return false;

        }else if( val.search( /[!\@\#\$\%\^\&\*\(\)\_\-\=\+\:\;\'\"\.\/\,\<\>]/ ) ==-1 ){
            
            return false;

        }else{
            return true;
        }
    }
    else
    {
        return false;
    }
}