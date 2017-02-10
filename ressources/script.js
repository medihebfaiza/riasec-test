//ajax permet de tester la connextion admin
$(document).ready(function () {

/*
Données : deux tableaux de chaines de caractères des même taille
Resultat : renvoie un tableau contenant la concatenation case par case de T1 et T2
*/
  function concat(T1,T2){
    var T3 =[] ;
    for (i=0 ; i<6 ; i++){
      T3[i] = T1[i] + " " + T2[i] ;
    }
    return T3;
  }

  $("#statPromo").ready(function () {
    $('#tabStats').hide();
     console.log("ici");
     data = JSON.parse($('#tabStats').text());
     var pie = new RGraph.Pie({
          id: 'tarte',
          data: data,
          options: {
              strokestyle: 'white',
              colors: ['#D93380','#5F38C2','#33A5D9','#36B85C','#CF7D46','#FFDF3F'],
              linewidth: 3,
              exploded: [10],
              shadowOffsetx: 2,
              shadowOffsety: 2,
              shadowBlur: 5,
              labels: concat(profils,data),
              labelsSticksList: true,
              labelsSticksUsecolors: false,
              textColor: '#000',
              textSize:12,
              textAccessible: true
          }
      }).roundRobin();

    /*function PieChart(data){
      new RGraph.Pie({
              id: 'tarte',
              data: data,
              options: {
                  strokestyle: 'white',
                  colors: ['#D93380','#5F38C2','#33A5D9','#36B85C','#CF7D46','#FFDF3F'],
                  linewidth: 3,
                  exploded: [10],
                  shadowOffsetx: 2,
                  shadowOffsety: 2,
                  shadowBlur: 5,
                  labels: profils,
                  labelsSticksList: true,
                  labelsSticksUsecolors: false,
                  textColor: '#000',
                  textSize:12,
                  textAccessible: true
              }
          }).roundRobin();
    }*/

});

    $("#lancerQuestionnaire").click(function (e) {
        e.preventDefault();
        window.location = "index.php?control=etu&action=questionnaire";
    });

    $(".icon").tooltip({
        position: { my: "left+15 center", at: "right center" }
    }); // petit text affiché sur les images


    $("#sendCode").click(function (e) {
        pere =  $(this).parent();
        e.preventDefault();
        $.post(
            'index.php?control=etu&action=sendByMail', // la destination
            //
            {
                mail:$("#mail").val()
            },
            function (data) {
              console.log(data)
                if(data == "succes"){
                   pere.fadeOut();
                    $("#resultat").html("<div class='alert alert-success' role='alert'> Le mail a été envoyé sur votre mail étudiant. </br>Attention, " +
                        "il est susceptible de se trouver dans les courriers indésirables</div>");
                }else {
                    $("#resultat").html("<div class='alert alert-warning' role='alert'> Une erreur est survenue. Vérifiez que votre mail existe </div>");
                }
            },
            'text'
        );
    });

    /*
     les deux boutons d'accueil redirigent sur les pages
     données par window.location
      */
    $("#btnEtu").click(function(e){
        e.preventDefault();
        window.location = "index.php?control=etu";
    });

    $("#btnAdm").click(function(e){
        e.preventDefault();
        window.location = "index.php?control=admin";
    });

    $('#mail').autocomplete({// fonction d'autocompletion
        minLength: 1,
        source: "index.php?control=etu&action=autoComplete"
    });


    /*

     */
    $("a[href='index.php?control=etu&action=infoQuestionnaire']").click(function (e) {
        e.preventDefault();
        $("#questionnaireImpossible").html("");
        // on va verifier si l'utilisateur à deja réalisé le questionnaire
        // si oui il ne pourra pas le refaire
        $.post(
            "index.php?control=etu&action=dejaFait",
            {

            },
            function (data) {
                if(data == "fait"){
                    $("#questionnaireImpossible").html("<div class='alert alert-warning' role='alert' >Vous ne pouvez réaliser le questionnaire qu'une seule fois</div>");
                }else {
                    window.location = $("a[href='index.php?control=etu&action=infoQuestionnaire']").attr('href');
                }
            },
            'text'
        );

        // si l'action est a false alors on n'execute pas le lien et on reste sur la page
    });


    $(".supprimerQuestionnaire").each(function () {
        $(this).click(function (e) {
            e.preventDefault();
            $.post(
                "index.php?control=admin&action=suppr",
                {
                    mail: $(this).parent().find("b").text()
                },function (data) {
                    if(data == "succes"){
                        $("#succes").html("Suppresion avec succès");
                        setTimeout(function () { // avec un delai de 1s
                            location.reload(true);
                        }, 1000);
                    }else {
                        $("#echec").html("Une erreur s'est produite");
                    }
                },'text'
            );
        })

    });

    /*
     cacher les messages d'erreur
     lorsqu'on clique sur les zones de texte va cacher les messages d'erreurs
     */
    $('#mail').click(function () {
        $("#erreurConnexion").html(''); // on replace le texte de la div par '' (vide)
        $("#erreurConnexion").fadeOut(100);
    });

    $('#mdp').click(function () {
        $("#erreurConnexion").html('');
        $("#erreurConnexion").fadeOut(100);
    });


   $(".icon").each(function () {
       $(this).mouseover(function () {
           $(this).parent().parent().effect('highlight');
            //
           $(this).effect('bounce');
       });

       $(this).click(function (e) {
           e.preventDefault();
           $(this).effect('size');
                //effet de diminution
           window.location = $(this).parent().attr('href');
                // on charge la page associé
           return false;

       })
   });
    /*
     AJAX CONNEXION
     */


    $("#connexionAdm").click(function () {
        $.post(
            'index.php?control=admin&action=verifConnexion', // la destination
                //
            {
                mail :$("#mailAdm").val(), // on recupere la valeur des champs input
                mdp : $("#mdpAdm").val()
            },
            function (data) {
               switch (data){

                   case 'succes':
                       window.location = "index.php?control=admin&action=connecte";
                       // en cas de succes on charge l'url suivant

                       break;
                   case 'echec':
                       $("#erreurConnexion").html("<p>Erreur lors de la connexion...</p>");
                            //ajoute un texte à la div
                       $("#erreurConnexion").fadeIn('slow'); // effet animation
                       break;
               }
            },
            'text'
        );
        return false;
    });


    $("#connexionEtu").click(function () {
        $.post(
            'index.php?control=etu&action=verifConnexion', // la destination
            //
            {
                mail :$("#mail").val(), // on recupere la valeur des champs input
                mdp : $("#mdp").val()
            },
            function (data) {
                if(data == "succes"){
                        window.location = "index.php?control=etu&action=connecte";
                        // en cas de succes on charge l'url suivant
                }
                else{
                    $("#erreurConnexion").html("Une erreur est survenue lors de la connexion" +
                        "</br>Vérifiez que votre code d'accès est valable ou que votre adresse correspond bien à " +
                        "un compte étudiant</p>");
                    //ajoute un texte à la div
                    $("#erreurConnexion").fadeIn('slow'); // effet animation
                }


            },
            'text'
        );
        return false;
    });

    /*
     FIN DES METHODES DE CONNEXIONS
     */

    function chargerEtudiant(promo){
        window.location = "index.php?control=admin&action=etudiants&promo="+promo;
    }

    $(".displayAllEtu").each(function () {
        $(this).click(function (e) {
            e.preventDefault();
            chargerEtudiant($(this).attr('id'));
        });
    });

    /*
        Methode de Deconnexions
     */

    /**
     *
     * @param url
     * @param path
     * le chemin sur lequel ce trouve le fichier executé par ajax
     * path la page affiché à la fin
     */
    function deconnexion(url,path) {
        $.post(
            url,
            {},
            function (retour) {
                if(retour=="succes"){
                    setTimeout(function () { // avec un delai de 1s
                        window.location = path;
                    }, 1000);
                    /*
                     on ajoute un delai car la destruction d'une session est plus lent que le changement de page
                     du coup sans le delai on se retrouvait avec la barre de navigation etudiante ou admin
                     alors qu'on est pas connecté
                     */

                }else {
                    location.reload(true); // recharge la page
                }
            },'text'
        );
    }

    $("#deconnexionAdmin").click(function (e) {
        e.preventDefault();
        url ="index.php?control=admin&action=deconnexion";
        path ="index.php?control=admin&action=identification";
        deconnexion(url,path);

    });

    $("#deconnexionEtu").click(function (e) {
        e.preventDefault();
        url ="index.php?control=etu&action=deconnexion";
        path ="index.php?control=etu&action=identification";
        deconnexion(url,path);

    });

});
