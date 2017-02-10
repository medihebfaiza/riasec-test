/**
 * Created by ENZO on 20/12/2016.
 */
// js sur mes formulaire



// fonction sur modification des questions
$(".updateQuestion").each(function () {


    $(this).parent().hover(
        function () { // lorsque la souris entre
            $(this).find(".updateQuestion").show();
    },
    function () { // lorsque la souris sors
        if($(this).find(".inputQuestion").css('display') == 'none')
            $(this).find(".updateQuestion").hide(); // cache le bouton si le champs de texte n'est pas visible
    });

    $(this).click(function (e) {
        e.preventDefault();
        input = $(this).parent().find(".inputQuestion");
        if(input.css('display') == "none"){// si le champs est caché
            input.parent().find("span").hide(); //
            input.show(); //on le montre
        }

        else { // sinon on modifie la question dans la base de données
            $.post(
                "index.php?control=admin&action=updateQuestion",
                {
                    idProp: $(this).parent().find(".idQuestion").text(),
                    libProp: input.val()
                    // parametres renvoyés en post
                },function (resultat) {
                    if(resultat == "succes"){
                        location.reload(true); // recharge la page
                    }else {
                        console.log(resultat);
                        $("#questionnaireError").html("la question n'a pas été modifiée");
                        $("#questionnaireError").fadeIn('slow'); // effet animation
                    }

                },
                'text'
            );

        }
    });
});



// fonction de modifications sur les code promos
$(".promoName").each(function () {

    $(this).hover(
        function () {
            if($(this).find(".codePromo").css("display") == "none"){
                $(this).find(".codePromo").show();
                $(this).find("input").hide();
            }

        },
        function () {
            if( $(this).find("input").css("display") == "none"){
                // cela signifie que l'admin n'a pas cliqué sur le bouton
                $(this).find(".codePromo").hide();
            }

        }
    );

    button = $(this).find("#modifierCodeProm");

    button.click(function (e) {
        e.preventDefault();

        if( $(this).parent().find("input").css("display") == "none"){
            // la zone de texte est caché on l'affiche et on cache le code
            // sachant que le code est affiché dans la zone de texte
            $(this).parent().find("i").hide();
            $(this).parent().find("input").show();
        }else{ // on modifie le code la promo
            // ajax
            $.post(
                "index.php?control=admin&action=updatePromo",
                {
                    nomPromo: $(this).parent().parent().
                    find(".nom_de_la_promo").attr('id'),
                    code: $(this).parent().find("input").val()
                    // parametres renvoyés en post
                },function (resultat) {
                    if(resultat == "succes"){
                        console.log(resultat);
                        location.reload(true); // recharge la page
                    }else {
                        console.log(resultat);
                        $("#promoError").html("le code n'a pas été modifié");
                        $("#promoError").fadeIn('slow'); // effet animation
                    }

                },
                'text'
            );

        }


    });
});



/*
pour le formulaire etudiant idée
avoir un compteur que l'on initialise à 0, cacher tous les groupe de question
n'afficher que celui correspondant au compteur.
A chaque fois qu'on appuie sur suivant incremente le compteur
(on cache le groupe de question actuel puis on incremente et on affiche le suivant)
lorsque le compteur est à 0 on bloque le bouton précedent
lors que le compteur est 11 on change le bouton suivant par envoyer
 */


/*
dans les css on fait cacher tous les groupe
donne un dislay none de la classe
et on fait un show() du groupe correspondant au numGroupe
 */


/*
  Variables :
*/

//compteur sur le numéro du groupe actuel
var numGroupe = 1;

//Matrice pour stocker la réponse, les 3 choix pour chaque groupe
var reponses = [
 ['','',''],
 ['','',''],
 ['','',''],
 ['','',''],
 ['','',''],
 ['','',''],
 ['','',''],
 ['','',''],
 ['','',''],
 ['','',''],
 ['','',''],
 ['','','']
 ];

//Tableau de dictionnaires pour atribuer les points à chaque proposition selon l'ordre de préférence
var points = [
 {A:0,B:0,C:0,D:0,E:0,F:0},
 {A:0,B:0,C:0,D:0,E:0,F:0},
 {A:0,B:0,C:0,D:0,E:0,F:0},
 {A:0,B:0,C:0,D:0,E:0,F:0},
 {A:0,B:0,C:0,D:0,E:0,F:0},
 {A:0,B:0,C:0,D:0,E:0,F:0},
 {A:0,B:0,C:0,D:0,E:0,F:0},
 {A:0,B:0,C:0,D:0,E:0,F:0},
 {A:0,B:0,C:0,D:0,E:0,F:0},
 {A:0,B:0,C:0,D:0,E:0,F:0},
 {A:0,B:0,C:0,D:0,E:0,F:0},
 {A:0,B:0,C:0,D:0,E:0,F:0}
 ] ;

//Matrice contenant les propositions concernant chaque profil par
var ordre = [
 ["A","D","F","A","F","B","F","B","C","F","B","D"], //REALISTE
 ["B","E","E","F","D","A","C","A","B","D","E","E"], //INVESTIGATIF
 ["C","F","B","B","A","F","B","E","E","E","F","F"], //ARTISTIQUE
 ["D","A","A","E","C","D","E","C","A","C","A","C"], //SOCIAL
 ["E","C","D","D","B","E","A","D","D","A","D","B"], //ENTREPRENEUR
 ["F","B","C","C","E","C","D","F","F","B","C","A"] //CONVENTIONNEL
 ]

//Tableau pour stocker le resultat pour chaque profil en fonction des points
var resultat = [0,0,0,0,0,0] ;

//Tableau contenant les libellées des profils
var profils = ['Réaliste','Investigatif','Artistique','Social','Entrepreneur','Conventionnel'] ;

/*
  Fonctions :
*/

//une fonction qui vérifie si un tableau ne contient aucun élément vide
function tabComplet(T){
  var i = 0 ;
  while(i<T.length){
    if (T[i] == ''){
      return false ;
    }
    i++;
  }
  return true ;
}

//fonction qui decoche le bouton radio sur la même colonne que le bouton radio selectionné, si il existe un
 $("input[type='radio']").click(function(){
     if ($(this).prop('value').length == 4) {
         var groupe = $(this).prop('value')[0]+$(this).prop('value')[1] ;
         var prop = $(this).prop('value')[2] ; //la proposition selectionné
         var ordre = $(this).prop('value')[3] ; //l'ordre de la proposition
     } else {
         var groupe = $(this).prop('value')[0] ;
         var prop = $(this).prop('value')[1] ; //la proposition selectionné
         var ordre = $(this).prop('value')[2] ; //l'ordre de la proposition
    }

    //si la proposition est déjà dans le tableau, on l'efface
    for (i=0 ; i<3 ; i++){
      if (reponses[groupe-1][i] == prop){
        reponses[groupe-1][i] = '' ;
      }
    }

    if (reponses[groupe-1][ordre-1] == ''){
      reponses[groupe-1][ordre-1] = prop ;
    }

    else {
      document.getElementById(groupe+reponses[groupe-1][ordre-1]+ordre).checked = false ;
      reponses[groupe-1][ordre-1] = prop ;
    }
    console.log("Groupe "+groupe+" Propositions par ordre : "+reponses[groupe-1].toString()) ; //Messages sur console pour les v�rifications
  })

//fonction qui vérifie que l'utilisateur a choisit 3 propositions pour chaque groupe
function verifier(n){
  if (!tabComplet(reponses[n-1])){
    $("#verif").show(); //affiche le message de vérification
    return false;
  }
  else {
    $("#verif").hide(); // sinon on remplace le texte par du vide
    return true;
  }
}

//fonction qui calcule les points pour chaque profil
function calculerResultat(){
  //enregistre les reponses dans points
    for (i=0 ; i<12 ; i++){
      for (j=0 ; j<3 ; j++){
        points[i][reponses[i][j]] = 3-j ;// 3-j = les points pour la proposition
      }
    }
  //calcule la somme des points pour chaque profil
  for (i=0 ; i<6 ; i++){ // i parcour les profils
    for (j=0 ; j<12 ; j++){ // j c'est le groupe
      resultat[i] += points[j][ordre[i][j]] ;
    }
  }
  //calcule les pourcentages
  for (i=0; i<6 ; i++){
    resultat[i] = Math.round((resultat[i]/72.0)*10000)/100 ; // math.round(pourcentage*100)/100 pour arrondir à deux décimales prés
  }
}

//fonction qui passe au groupe de propositions suivant
function suivant(){
  if (verifier(numGroupe)){
    document.getElementById(numGroupe).style.display='none'; //cacher le groupe precedent
    numGroupe+=1 ; //incremente le compteur sur les groupes
    document.getElementById(numGroupe).style.display='block'; //afficher le nouveau groupe
  }
  //quand on passe au groupe 2 on affiche le bouton precedent
  if (numGroupe == 2) {
    $('#precedent').show();
  }
  //quand on arrive au dernier groupe on cache le bouton Suivant et on afficher Envoyer
  if (numGroupe == 12) {
    cacherSuivant() ;
    $('#envoyer').show();
  }
}

//fonction qui revient au groupe de propositions precedent
function precedent(){
  $('.verif').html("");
  if (numGroupe>1){
    document.getElementById(numGroupe).style.display='none'; //cacher le groupe actuel
    numGroupe-- ; //decremente le compteur sur les groupes
    document.getElementById(numGroupe).style.display='block'; //afficher le groupe precedent
  }
  //si on est au groupe 1 on cache le bouton precedent
  if (numGroupe == 1) {
    cacherPrecedent() ;
  }
  //quand on revient au groupe 11 on cache Envoyer et on affiche le bouton suivant
  if (numGroupe == 11) {
    cacherEnvoyer() ;
    $('#suivant').show();
  }
}

//fonction qui cache le bouton precedent
function cacherPrecedent(){
    $("#precedent").hide();
}

//fonction qui cache le bouton suivant
function cacherSuivant(){
    $("#suivant").hide();
}

//fonction qui cache le bouton envoyer
function cacherEnvoyer(){
    $("#envoyer").hide();
}

$("#precedent").click(function (e) {
    e.preventDefault(); //desactive l'action par default du bouton
    precedent();
});

$("#suivant").click(function (e) {
    e.preventDefault();
    suivant();
});

$("#envoyer").click(function (e) {
    e.preventDefault();
    if (verifier(numGroupe)){
        calculerResultat() ; //calculer les pourcentages
        console.log("resultat : "+resultat.toString()) ; //Messages sur console pour les vérifications du resultat
        $.post(
            "index.php?control=etu&action=sendQuestionnaire",
            {
               resultat: resultat,
               profils: profils
            },function (resultat) {
                if(resultat == "succes"){
                    hideForm();
                    $("#resultatInsertion").html("<div class='alert alert-success' role='alert'>Formulaire envoyé avec succès</div>");
                    $("#resultatInsertion").fadeIn("slow");
                    $("#resultatByMail").show(); // affiche le bouton
                    afficherResultat() ; //afficher le graph et les pourcentages
                }else {
                    $("#resultatInsertion").html("<div class='alert alert-danger' role='alert'>Une erreur s'est produite</div>");
                    $("#resultatInsertion").fadeIn("slow");
                }

            },
            'text'
        );

    }
});

function hideForm(){
    $("#envoyer").hide(); // on cache le bouton envoyer et retour
    $("#precedent").hide();
    $('#questionnaire').hide();
}



//fonction qui renvoie l'indice de l'élément max dans un tableau
function IndiceMax(T){
  max = 0
  for (i=0 ; i<T.length ; i++){
    if (resultat[max]<resultat[i]){
      max = i
    }
  }
  return max ;
}

//la focntion qui génére le radar chart et l'affiche
function afficherResultat(){
  $('#RChart').html("<canvas id='cvs' width='600' height='400'> </canvas> <p id='resultat'></p>") ;
  new RGraph.Radar({
      id: 'cvs',
      data: resultat,
      options: {
        labels: profils,
        textAccessible: false,
        color: 'rgba(0, 26, 255, 0.59)'
      }
  }).grow({frames: 60},afficherLegendeResultat())
}

//affiche les détails du résultat, pourcentages et profil étudiant 
function afficherLegendeResultat(){
  var string = "<h3>Vous êtes <button type='button' class='btn' data-toggle='collapse' data-target='#descriptionprofil'><strong>"+profils[IndiceMax(resultat)]+"</strong></button></h3> <div id='descriptionprofil' class='collapse'></div>" ;
  //Charger la description du profil
  $.post(
      "index.php?control=userSimple&action=descriptionProfil",
      {
         profil: profils[IndiceMax(resultat)]
      },function (description) {
        $('#descriptionprofil').html("</br>"+description+"</br></br>") ;
      },
      'text'
  );
  for (i=0 ; i<6 ; i++){
    string += "<strong>"+profils[i]+"</strong> "+resultat[i]+"%</br>" ;
  }
  $('#resultat').html(string) ;
}

$("#resultatByMail").click(function (e) {
    e.preventDefault();
    console.log($("#RChart"));
    $.post(
      "index.php?control=etu&action=resultatByMail",
      {
        profil: profils[IndiceMax(resultat)],
      },function(data){
          console.log(data);
            if (data=="succes") {
                $("#resultatInsertion").html("<div class='alert alert-success' role='alert'>E-mail envoyé avec succès</div>");
                $("#resultatInsertion").fadeIn("slow");
            } else {
                $("#resultatInsertion").html("<div class='alert alert-danger' role='alert'>Une erreur s'est produite</div>");
                $("#resultatInsertion").fadeIn("slow");
            }
      },
      'text'
    ); // envoyer par les resultat par mail
});

/*
Instructions qui s'execute au début de chaque test
*/

//cacher le bouton Precedent au début
cacherPrecedent() ;
//cacher le bouton Envoyer au début
cacherEnvoyer() ;

$("#"+numGroupe).show();
