<?php
session_start();

require('./SPDO.php');
$msg =null;
if(!isset( $_SESSION["user_id"])){

    header("Location: ./auth.php");

}else{

}
if(isset($_GET['action']) && isset($_GET['msg'])){

    $action= $_GET['action'];
    $msg= $_GET['msg'];
}
$res = SPDO::getInstance();

?>
<?php
// Start the session
?>
<html lang="fr"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- stulesheet-->
    <title>Devise</title>
    <!-- stulesheet-->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">

    </script>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/checkout/">


    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery.js"></script>

    <script>
        $(function(){
            $("#includeNavBar").load("navBar.php");
        });
    </script>
</head>
<header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="includeNavBar">

    </nav>
</header>
<body class="bg-light ">
<form action="remove.php" id="formsupp">
    <input id="idInputsupp" type="hidden" name="idchange" value =''>

</form>
<div class="alert alert-light" role="alert">

<?php
if(isset($_SESSION["client_id"])) {
    echo '    <span class="badge badge-pill badge-primary">ID client : ' . $_SESSION["client_id"] . '</span>';
    echo '    <span class="badge badge-pill badge-success">passport : ' . $_SESSION["client_num"] . '</span>';
    echo '    <span class="badge badge-pill  badge-warning">nom : ' . $_SESSION["client_name"] . '</span>';

}
?>
</div>
<div class="container">
 <div style=" margin-top: 5%">
    <form id ="formAdd" action="model.php" method="POST" >
        <div class="row "  >
            <div class="col-md-2 " >
                <label for="s1">Type de change</label>

                <select name="TypeEchange" id="TypeEchange" oninput='typeEchange(value, 0)' class="form-control" >
                    <option value ="vente"selected ="selected" > vante devise</option>
                    <option value="achat" > achat devise</option>

                </select>
            </div>
            <div class="col-md-2 " >
                <label for="s1">code</label>
                <select  oninput ="codeToPrix(this.value,0)" name="code"  class="form-control"  id="my_select">
                    <?php
                    $i=0;
                    foreach  ( $res->query('SELECT * FROM tauxdevise')  as $row)

                    {

                        echo

                        '<option  ' ;
                        if($i == 0){
                            echo ' selected="selected"';
                            $prixdefault=$row["prix"];
                        }
                        echo ' id ='.$row["id"].' value = '.$row["prix"].'> '.$row["code"].'</option>'   ;
                        $i =1;
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2 ">
                <label for="cc-cvv">Montant</label>
                <input oninput="changeAdd(this.value)" type="number" step="0.001" class="form-control" name="montant" id="montant" value="0"
                       placeholder="" required="">
                <div class="invalid-feedback">
                    Security code required
                </div>
            </div>
            <div class="col-md-2 ">
                <label for="cc-cvv">Prix</label>
                <input id="prix" type="number" step="0.001" class="form-control" name="prix"
                       value =""
                       placeholder="" required="">
                <div class="invalid-feedback">
                    Security code required
                </div>
            </div>
            <div class="col-md-2 ">
                <label for="cc-cvv">Montant ml </label>
                <input type="number" class="form-control" step="0.001" id="montant_ml" name="montant-ml"

                       value ="0"

                >
                <div class="invalid-feedback">
                    Security code required
                </div>
            </div>
            <div id ="idTaux">
            </div>
            <div class="col" style ="margin-top:5%">
                <?php
                if(isset($_SESSION["client_id"])) {

                  echo '      <button class ="btn btn-success"onclick="submitValue()">Ajouter</button>';
                    }




                ?>

            </div>
        </div>
        </div>
    </form>
    <?php
                if(!isset($_SESSION["client_id"])) {


    echo '      <button class ="btn btn-success"onclick="valider()">Ajouter client</button>';

    }      else
                {
                    echo '      <button class ="btn btn-info"onclick="valider()">Ajouter un autre client </button>';


                }
    ?>

    <div class="row">
        <div class="col-md-9">

            <!-- Update !-->
            <table class="table">
                <thead class="thead-light">
                <tr>

                    <th scope="col"> Type de change</th>
                    <th scope="col">code</th>
                    <th scope="col">montant</th>
                    <th scope="col">prix</th>
                    <th scope="col">montant_ml</th>
                    <th scope="col">ancien montant</th>

                    <th scope="col">Action:1</th>
                    <th scope="col">Action:2</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $i=0;
                if(isset($_SESSION['id_bon']))

              {
                  if($_SESSION['id_bon'] !="" )
{
                      $qall = $res->query('SELECT * FROM  devise   where id_bon ='.$_SESSION['id_bon']);
                foreach  ( $qall  as $rows) {
                    $i++;
                    echo '
	<form action ="model.php"  method ="POST">

	<tr>
      <td>

                <select name="TypeEchange" id="TypeEchange" oninput="typeEchange(value, '.$i.')" class="form-control">
                ';if($rows["type"] == "vente")
                   {
                       echo
                     '  <option value="vente" selected="selected"> vante devise</option>
                    <option value="achat"> achat devise</option>';
}else{
                        echo
                        '  <option value="vente"> vante devise</option>
                    <option value="achat"  selected="selected"> achat devise</option>';
                }
                echo '
                </select>
           </td>
      <td>
<select  class ="form-control selectW" oninput ="codeToPrix(this.value ,'. $i .')" name="code"  id="sUpdate">  
';?>
                    <?php


                    foreach  ( $res->query('SELECT * FROM tauxdevise')  as $row)
                    {

                        echo'
 <option  class ="selectW"';
                        if($row["id"] == $rows["ID_Taux"])
                        {echo ' selected="selected" ';
                            $prixSelected = $row[2];
                        }
                        echo'
 id ='.$row[0].' value = '.$row[2].'> '.$row[1].'</option>';

                    }
                    ?>
                    <?php
                    $prixUpadate = 0;
                    echo '
 </select> 	  
	  </td>
	    <td>
		
	 <input type="number"  step="0.001" oninput ="changeUpadte(this.value,'.$prixSelected.', '. $i .' )"  
	 class="form-control selectW" value =   '.$rows["montant"].' name ="montant"/>
	  
	  </td>
	      <td>
		  ';
                    foreach  ($res->query("SELECT prix FROM  tauxdevise  where id = ".$rows["ID_Taux"]) as $row )
                    {
                        if($rows["type"] == "vente")
                            $prixUpadate = $row['prix'] ;

                        else
                            $prixUpadate = round(1/$row['prix'],3) ;

                        break;
                    }

                    echo'
	  <input class="form-control selectW" type="number" step="0.0000001" value =  '. $prixUpadate.' name ="prix"/>
	  
	  </td>
	    <td>

	

	<input name="montant-ml" class="form-control" step="0.001" type ="number" value ="">
	 </td>
	 <td>

'.$rows["montant_ml"].' 
	<input type="hidden" class="montant_total" value='.$rows["montant_ml"].'/> 

	  </td>
	 
	  <td>
	

	    <input type="hidden" name="idAction" value ='.$rows["id"].'>
	  	  <input type="hidden" name="id" value ='.$rows["ID_Taux"].'>
	  <button type="submit" class="btn btn-warning" style="width:100%">Modifier</button>
		  
		  
 
	  	  </form>


	  
	   
</td>
		<td>

	  	  <button onclick="Block(\'supp\','.$rows["id"].')"   class="btn btn-danger" style="width:100%">supprimer</button>

	  </td>
	  </tr>
	 
		  
		
	  ';
              }  }}

                ?>

                </tbody>
            </table>

        </div>

        <div class ="col-md-3">


            <?php

            if($msg != null){
                if($msg == 1){


                    echo'
<div  class="alert alert-success">
opération ('.$action.') terminée avec succès
</div>
	';}else{
                    echo'
		<div class="alert alert-danger" >  opération ('.$action.') échouée  </div>
';
                }
            }



            ?>

        </div>
    </div>


    <div class="row">


        <div class ="col-md-8">
		 		
		 <?php

         $total =0;
if(isset($_SESSION['id_bon']) )

        {
            if($_SESSION['id_bon'] !="" )
{
                echo 	' <span style="  margin-left: 85% ;height:30px  " class="badge badge-danger">';


            foreach  ( $res->query('SELECT * FROM  devise   where id_bon ='.$_SESSION['id_bon'])  as $row) {
             $total = $total + $row["montant_ml"];
         }

         echo'<input type="hidden" value= '.$total.' id="T"/>
 '.$total.''   ;}
}
         ?>
	
	</span>


        </div>
        <div class ="col-md-3">
            <form id="formValider"  action="services/bon/DaoBonService.php">

                <input type="hidden"  name ="totale" value=<?php   echo $total  ?> />

            </form>
            <?php
            echo '
                        <button onclick="Block(\'card\')" class="btn btn-primary">Valider </button>\';

            ';
            ?>



        </div>
    </div>
    <div class="commit center " id="commit" >
    <div class="card">
        <h5 class="card-header">Client bon échange  <button   class="badge badge-danger" onclick="annule()"> annuler</button></h5>
        <div class="card-body">
            <h5 class="card-title"> création client </h5>
            <p class="card-text">numéro passport </p>
            <form  action="services/client/ClientService.php" method="post">
                <input type="hidden" name="Action" value="add"/>
            <input type="number" class="form-control"  name = "num" />
            <p class="card-text">Nom</p>
            <input type="text" class=" form-control  " name="nom"/>
            <p class="card-text">pronom</p>
            <input type="text" class="form-control"  name = "pren" />

                <button type="submit"  class="btn btn-primary">Valider </button>
            </form>
        </div>
    </div></div>
</div>

<div class="card text-center commit" id ="card">

    <div class="card-body" >
        <h5 class="card-title"> Message du confirmation </h5>
        <p class="card-text">Voulez-vous sure dû confirmer tous les échanges </p>
        <a href="#" class="btn btn-danger" onclick="hiddenBlock('card')" id="true" >annuler</a>

        <a href="#" class="btn btn-primary" onclick="showBlock('card','formValider')" id="true" >Confirmer</a>

    </div>

</div>
<div class="card text-center commit" id ="supp">

    <div class="card-body" >
        <h5 class="card-title"> message de suppression  </h5>
        <p class="card-text">Voulez-vous vraiment supprimer cet échange </p>
        <a href="#" class="btn btn-danger" onclick="hiddenBlock('supp')" id="true" >Annuler</a>

        <a href="#" class="btn btn-primary" onclick="showBlock('supp','formsupp')" id="true" >Confirmer</a>

    </div>

</div>
</body>

<script src="js/change.js"></script>

<script >
    codeToPrix( <?php echo $prixdefault ?> ,0);
</script>
<?php
if(isset($_GET["destory"])){
    session_destroy();

echo "<script>

    location.reload();

</script>" ;
}

?>
</html>
