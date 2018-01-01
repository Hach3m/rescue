/**
 * Created by marwen on 21/04/2016.
 */
function avis($btn){
    var classe=$btn.getAttribute('class');
    var file_id=$btn.parentNode.parentNode.parentNode.parentNode.id;
    var content=$btn.parentNode.parentNode.parentNode.parentNode;
    var posProgress=content.getElementsByClassName("progress-bar progress-bar-success");
    var negProgress =content.getElementsByClassName("progress-bar progress-bar-danger");
        if (classe==='btn-icons fa-lg fa fa-level-up'){
        data={"plus":1,"id_file":file_id};
    }
    else if(classe==='btn-icons fa-lg fa fa-level-down'){
        data={"moins":1,"id_file":file_id};
    }
    $.ajax({
        type:'GET',
        url:'../MonSitePhp/FileAction.php',
        data:data,
        dataType:"json",
        success:function(data){
            var total=Number(data['pos'])+Number(data['neg']);
            if(total!=0){
                var plus=(Number(data['pos'])/total)*100;
                var moins=(Number(data['neg'])/total)*100;
                posProgress[0].style.width=plus+"%";
                negProgress[0].style.width=moins+"%";
            }
            else {
                posProgress[0].style.width="50%";
                negProgress[0].style.width="50%";
            }

        }

    });
}
function login($btn){
    var lol;
    var errorzone=document.getElementById('errorText');
    if($btn.value==="Log In") {
        if(checkEmailLog()){
        var user=document.getElementById("user-email").value;
        var pass=document.getElementById("user-pw").value;
        if(pass.length>2){
        $(document).ready(function () {
            errorzone.innerHTML = "validation de données en cours";
            errorzone.style.color="#4CAF50";
            errorzone.style.display="block";
            $.ajax({
                type: "POST",
                url: "../MonSitePhp/Login.php",
                data: "logIn=" + $btn.value + "&email=" + user + "&password=" + pass,
                dataType: "json",
                success: function (result, statu) {
                    lol = result;
                    if (lol[0].username==null) {

                        errorzone.innerHTML = "Vérifier vos données S.V.P.";
                        errorzone.style.color="#f44336";
                        errorzone.style.display="block";

                    }
                    if(lol[0].username!=null) {

                        errorzone.innerHTML="Bonjour "+lol[0].username;
                        errorzone.style.color="#4CAF50";
                        window.location.replace("../MonSitePhp/Accueil.php");
                    }
                },
                error: function (msg, string) {
                    //alert("barri raw7i"+string+msg);
                },
            });
            //alert('djngbldld');
        });
        }
        else{

            errorzone.innerHTML = "votre mot de passe est très court";
            errorzone.style.color="#f44336";
            errorzone.style.display="block";
        }
        }


    }
    else if($btn.value==="createAccount"){
        var emailCreate=document.getElementById("user-email-create").value;
        var passCreate=document.getElementById("user-pw-create").value;
        var repeatPass=document.getElementById("user-pw-repeat").value;
        var username=document.getElementById("username-create").value;
        var erreurzone=document.getElementById('errorTxt');
        if(checkEmail()){
        if(emailCreate&&passCreate&&repeatPass){
            if (passCreate>3){
            if (passCreate===repeatPass) {

                $(document).ready(function () {
                    $.ajax({
                        type: "POST",
                        url: "../MonSitePhp/Login.php",
                        data: "createAccount=" + $btn.value + "&email=" + emailCreate + "&password=" + passCreate+"&repeatPassword="+repeatPass+"&username="+username,
                        dataType: "json",
                        success: function (result, statu) {
                            //alert("succée");
                            lol = result;
                            if (lol[0].username != null) {
                                if (lol[0].username=="null"){
                                    erreurzone.innerHTML = "username non disponible";
                                    erreurzone.style.color="#f44336";
                                    erreurzone.style.display="block";
                                }
                                erreurzone.innerHTML="Bonjour "+lol[0].username;
                                erreurzone.style.color="#4CAF50";
                                window.location.replace("../MonSitePhp/Accueil.php");
                            }
                            else{
                                erreurzone.innerHTML = "email non disponible";
                                erreurzone.style.color="#f44336";
                                erreurzone.style.display="block";
                            }
                        },
                        error: function (msg, string) {
                        },
                    });
                });
            }
                else{
                erreurzone.innerHTML = "mot de passe et confirmation doivent etre identique";
                erreurzone.style.color="#f44336";
                erreurzone.style.display="block";
            }
        }
            else {
                erreurzone.innerHTML = "votre mot de passe est très court";
                erreurzone.style.color="#f44336";
                erreurzone.style.display="block";
            }
        }
        else {
            erreurzone.innerHTML = "Veuillez remlir tous les champs";
            erreurzone.style.color="#f44336";
            erreurzone.style.display="block";
        }
    }
}
}
function setVisibilite($visibilite){
    var id=$visibilite.children[0].id;
    $visibilite=$visibilite.children[0];
    id=id.replace("visibilite-","");
    var data={"id_Pub":id};
    if ((!imported)&&($visibilite.getAttribute('class','glyphicon glyphicon-eye-open')))
    {
      $.ajax({
          type: "POST",
          url: showCommentsUrl,
          data: data,
          dataType: "html",
          success: function (result) {
            $("#file-comment-"+id).append(result);
              $visibilite.setAttribute('class','glyphicon glyphicon-eye-close');
              imported=true;
          },
          error: function (msg, string) {

          }
      });

    }
    else if (imported) {
      if($("#file-comment-"+id).css('display')=='block'){
        $visibilite.setAttribute('class','glyphicon glyphicon-eye-open');
      }
      else {
        $visibilite.setAttribute('class','glyphicon glyphicon-eye-close');
      }
      $("#file-comment-"+id).toggle('slow');
    }
}
;
function deleteFile($delete){
    var id=$delete.id;
    id=id.replace("delete-","");
    var fileUrl=$("#"+id+":last").attr(id);
    $(document).ready(function () {
        $.ajax({
            type: "POST",
            url: "../MonSitePhp/FileAction.php",
            data: "delete_file=delete&id_file="+id,
            dataType: "html",
            success: function (result) {
                $("#"+id).toggle('slow');
            },
            error: function (msg, string) {
            },
        });
    });
}
;
function deleteComment($delete){
    var id=$delete.id;

    id=id.replace("delete-com-","");
    var commentContent=document.getElementById("com-"+id);
    $(document).ready(function () {
        $.ajax({
            type: "POST",
            url: "../MonSitePhp/CommentAction.php",
            data: "delete_com=delete&id_comment="+id,
            dataType: "html",
            success: function (result) {
                commentContent.innerHTML="";
                //$("#com-"+id).toggle('slow');
            },
            error: function (msg, string) {
            }
        });
    });
}
;
function viewPdf($input){
    var url_file=$input.firstChild.src;
    url_file=url_file.replace('jpg','pdf');
    document.getElementById("pdf-file-viewer").setAttribute('src',url_file);
    $("#viser").toggle('fast');
}
function closePdfViewer(){
    $("#viser").toggle('fast');
}
function commenter(input,event){
    if (event.keyCode==13){
        var text=input.value;
        var fileid=input.parentNode.parentNode.id;
        fileid=fileid.replace("your-comment","");
        var data={"id_Pub":fileid,"comText":text,"type":false};
        $(document).ready(function () {
            $.ajax({
                type: "POST",
                url: addCommentUrl,
                data: data,
                dataType: "json",
                success: function (result) {
                  input.value="";
                    /*d=JSON.stringify(result)
                    $.ajax({
                        type: "POST",
                        url: "../MonSitePhp/views/CommentContent.php",
                        data: "pubs="+d,
                        dataType: "html",
                        success: function (d) {
                            $("#file-comment-"+fileid).append(d);
                            $("#loader").hide();
                            input.value="";
                        },
                        error: function (msg, string) {
                            //alert("barri raw7i"+string+msg);
                        },
                    });
                */},
                error: function (msg, string) {
                },
            });
        });
    }
}
function conseiller(input,event){
    if (event.keyCode==13){
        var text=input.value;
        var fileid=input.parentNode.parentNode.id;
        fileid=fileid.replace("your-advice","");
        var data={"id_Pub":fileid,"comText":text,"type":true};
        $(document).ready(function () {
            $.ajax({
                type: "POST",
                url: addCommentUrl,
                data: data,
                dataType: "json",
                success: function (result) {
                  input.value="";
                },
                error: function (msg, string) {
                },
            });
        });
    }
}
function toggler($sp){
    var retour=$sp.id;
    retour=retour.replace("mod_","");
    $("#"+retour).toggle('slow');
}
// Semicolon (;) to ensure closing of earlier scripting
// Encapsulation
// $ is assigned to jQuery
;
$(document).ready(function (e) {
    $("#upload-profile-image").on('submit',(function(e) {
        e.preventDefault();
        $("#message-profile").empty();
        $('#loading-profile').show();
        $.ajax({
            url: "../MonSitePhp/MembreAction.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                $('#loading-profile').hide();
                $("#message-profile").html(data);
            }
        });
    }));

    // Function to preview image after validation
    $(function() {
        $("#profile-file").change(function() {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
            {
                $('#previewing-profile').attr('src','noimage.png');
                $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                return false;
            }
            else
            {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    function imageIsLoaded(e) {
        $("#profile-file").css("color","green");
        $('#image-profile-preview').css("display", "block");
        $('#previewing-profile').attr('src', e.target.result);
        $('#previewing-profile').attr('width', '200px');
        $('#previewing-profile').attr('height', 'auto');
    };
});

$(document).ready(function (e) {
    $("#uploading_cover").on('submit',(function(e) {
        e.preventDefault();
        $("#message-cover").empty();
        $('#loading-cover').show();
        $.ajax({
            url: "../MonSitePhp/MembreAction.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                $('#loading-cover').hide();
                $("#message-cover").html(data);
            }
        });
    }));

// Function to preview image after validation
    $(function() {
        $("#cover-file").change(function() {
            $("#message-cover").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
            {
                $('#previewing-cover').attr('src','noimage.png');
                $("#message-cover").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                return false;
            }
            else
            {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    function imageIsLoaded(e) {
        $("#cover-file").css("color","green");
        $('#image-cover-preview').css("display", "block");
        $('#previewing-cover').attr('src', e.target.result);
        $('#previewing-cover').attr('width', '200px');
        $('#previewing-cover').attr('height', 'auto');
    };
});
$(document).ready(function (e){
    $('#modifier-pw').on('submit',function(e){
        e.preventDefault();
        $("#message-pw").empty();
        var ancien=document.getElementById('ancien-pw').value;
        var nouveau=document.getElementById('new_pass').value;
        var confirm=document.getElementById('conf_pass').value;
        if(ancien!=""){
            if((nouveau!="")&&(nouveau===confirm)){

                $.ajax({
                    url: "../MonSitePhp/MembreAction.php",
                    type: "POST",
                    data: "valider-pw=valider&ancien="+ancien+"&new="+nouveau+"&conf="+confirm,
                    dataType:'html',
                    success: function(data)
                    {
                        $("#message-pw").html(data);
                    }
                });
            }
            else
                $('#message-pw').html("<p style='color: red;word-wrap: break-word;'> nouveau password et confirm ne sont pas identique</p>");

        }
        else
        {
            $('#message-pw').html("<p style='color: red;word-wrap: break-word;'> vous de devez saisir votre ancien mot de passe</p>");

        }


    })  ;
});
$(document).ready(function (e){
    $('#modifier-username').on('submit',function(e){
        e.preventDefault();
        $("#message-username").empty();
        var username=document.getElementById('new-username').value;
        if(username!=""){
            $.ajax({
                url: "../MonSitePhp/MembreAction.php",
                type: "POST",
                data: "valider-username=valider&new-username="+username,
                dataType:'html',
                success: function(data)
                {
                    $("#message-username").html(data);
                }
            });
        }
        else
        {
            $('#message-username').html("<p style='color: red;word-wrap: break-word;'> vous de devez saisir votre nouveau nom d\'utilisateur</p>");

        }


    })  ;
});
function post($sp){
    var retour=$sp.children[0].id;
    retour=retour.replace("commenter-","your-comment")
    $("#"+retour).toggle('slow');
}
function postAdvice($sp){
    var retour=$sp.children[0].id;
    retour=retour.replace("advice-","your-advice")
    $("#"+retour).toggle('slow');
}
// Semicolon (;) to ensure closing of earlier scripting
// Encapsulation
// $ is assigned to jQuery
;
function logout(){
    $.ajax({
        url:'Profile.php',
        type:'GET',
        data:'logOut=1',
        dataType:"json",
        success:function(data)
        {
            if (data[0].success===1){
                document.location.href="../MonSitePhp/MonSite.php";
            }
            else{
                alert("essayer une autre fois");
            }
        }
    })
}
function fermerParametre(){
    $("#parametre_content").hide();
}
function fermerLogin(){
    $("#log").hide();
}
function viewLoginPopUp(){
    $(".overlayInner").load("views/login.view.php",
        // the following is the callback
        function() {
            $(".overlayOuter").fadeIn(0);
        })}
function checkEmail() {

    var email = document.getElementById('user-email-create');
    var errorzone=document.getElementById('errorTxt');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
        errorzone.innerHTML="Format email incorrect<br>S.V.P. entrer une format valide";
        errorzone.style.color="#f44336";
        errorzone.style.display="block";
        return false;
    }
    else if(filter.test(email.value)){
        errorzone.style.display="none";
        return true;
    }
}
function checkEmailLog() {

    var email = document.getElementById('user-email');
    var errorzone=document.getElementById('errorText');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
        errorzone.innerHTML="Format email incorrect<br>S.V.P. entrer une format valide";
        errorzone.style.color="#f44336";
        errorzone.style.display="block";
        return false;
    }
    else if(filter.test(email.value)){
        errorzone.style.display="none";
        return true;
    }
}
