window.fbAsyncInit = function() {
    FB.init({
        appId      : '118410878982064',
        cookie     : true,
        xfbml      : true,
        version    : 'v2.8'
    });

    //FB.AppEvents.logPageView();

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function statusChangeCallback(response) {

    if(response.status === 'connected'){
        console.log("logged");

        FB.logout(function(response) {
            console.log(response);
        })
    }
    else {
        console.log('not logged');
    }

}

function checkLoginState() {
    console.log("logged");
    FB.api('/me', {fields: 'id,name'}, function(response) {
        console.log(response);
    });

}