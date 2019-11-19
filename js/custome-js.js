$(function(){
   $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
     var target = $(e.target).attr("href") // activated tab
     if(target == "#home" || target == "#about" || target == "#store" || target == "#feedback") {
       $('#upperTab a[href="#signup"]').removeClass('active');
       $('#upperTab a[href="#login"]').removeClass('active');
       $('#upperTab a[href="#cart"]').removeClass('active');
       $('#upperTab a[href="#donate"]').removeClass('active');
     }else if(target == "#signup" || target == "#login" || target == "#cart" || target == "#donate") {
       $('#lowerTab a[href="#home"]').removeClass('active');
       $('#lowerTab a[href="#about"]').removeClass('active');
       $('#lowerTab a[href="#store"]').removeClass('active');
       $('#lowerTab a[href="#feedback"]').removeClass('active');
     }
   })
});

function switchStoreSide() {
  var x = document.getElementById("store_front");
  var y = document.getElementById("store_back");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
    //window.history.pushState("object or string", "Title", "/"+window.location.href.substring(window.location.href.lastIndexOf('/') + 1).split("?")[0]);
  }
}

function removeURLParameter(url, parameter) {
    //prefer to use l.search if you have a location/link object
    var urlparts= url.split('?');
    if (urlparts.length>=2) {

        var prefix= encodeURIComponent(parameter)+'=';
        var pars= urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i= pars.length; i-- > 0;) {
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                pars.splice(i, 1);
            }
        }

        url= urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
        return url;
    } else {
        return url;
    }
}

function loading() {
  var delayInMilliseconds = 500;
  $(".se-pre-con").show();
  setTimeout(function() {
    $(".se-pre-con").fadeOut("slow", "swing");
  }, delayInMilliseconds);
}

function changeStoreName(name) {
  document.getElementById("storename").innerHTML = "STORE > " + name;
  //window.history.replaceState(null, null, "?storename=" + name.toLowerCase());
}

function changeSignupError(warning) {
  document.getElementById("signup_warning").innerHTML = "Error: " + warning;
}

function changeSigninError(warning) {
  document.getElementById("signin_warning").innerHTML = "Error: " + warning;
}

function onLoad() {
  var x = document.getElementById("store_back");
  x.style.display = "none";
  var y = document.getElementById("signup_warning");
  y.style.display = "none";
  var z = document.getElementById("signup_success");
  z.style.display = "none";
  var e = document.getElementById("signin_warning");
  e.style.display = "none";


  var url_string = window.location.href;
  var url = new URL(url_string);
  var c = url.searchParams.get("storename");
  var a = url.searchParams.get("cart");
  var b = url.searchParams.get("signup");
  var d = url.searchParams.get("login");

  if(c) {
    $('#lowerTab a[href="#store"]').tab('show');
    switchStoreSide();
    changeStoreName(c.toUpperCase());
  }else if(a) {
    if(a == "remsuccess" || a == "success") {
      $('#upperTab a[href="#cart"]').tab('show');
    }else if(a == "addsuccess"){
      $('#lowerTab a[href="#store"]').tab('show');
    }
  }else if (b) {
    if(b) {
      y.style.display = "block";
      $('#upperTab a[href="#signup"]').tab('show');
      if(b == "pass_com") {
        changeSignupError("Password does not match.");
      }else if(b == "pass_lenght") {
        changeSignupError("Password must be at least 8 characters long.");
      }else if(b == "exist") {
        changeSignupError("User already exists. Please login to the system.");
      }else if(b == "success"){
        y.style.display = "none";
        z.style.display = "block";
      }else {
        y.style.display = "none";
      }
    }
  }else if (d) {
    if(d != "success") {
      $('#upperTab a[href="#login"]').tab('show');
      if(d == "custnoexist") {
        changeSigninError("User does not currently exist in the system. Please signup to login.");
      }else if(d == "pass") {
        changeSigninError("Email or password is incorrectly input.");
      }
      e.style.display = "block";
    }
  }

  var delayInMilliseconds = 500; //half second
  setTimeout(function() {
    $(".se-pre-con").fadeOut("slow", "swing");
  }, delayInMilliseconds);
}
window.onload = onLoad;
