<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">

    </script>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/checkout/">
    <script src="js/change.js"></script>


    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery.js"></script>

    <script>
        $(function(){
            $("#includeNavBar").load("navBar.php");
        });
    </script>
    <meta charset="UTF-8">
    <title>Historique</title>
</head>
<body class="bg-light ">
<header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="includeNavBar">

    </nav>
</header>
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="list-group" style="
    padding: 2%;
">
                <?php
                require(dirname(__FILE__).'\SPDO.php');
                $res = SPDO::getInstance();
                session_start();
                $bon = $res->query('SELECT * FROM `bonechange` where  `id_user` = '.$_SESSION["user_id"] );
                $i=0;
                $j=0;
                foreach  (  $bon as $row)
                {
                    echo '
  <a href="#"  id = "false"  onclick="showList('.$i.' , this.id ,this,'.$j.' )" class="list-group-item-action ">
<table class="table ">
  <thead class="thead-dark">
    <tr>';

                    $i++;

                    $sql = "SELECT * FROM `client` where  `id` = ".$row["id_client"];
                    $result = $res->query($sql);
                    $rowclient = $result->fetch();

                    $sqlUser = "SELECT * FROM `users` where id   = ".$row["id_user"];
                    $resultUser = $res->query($sqlUser);
                    $rowUser= $resultUser->fetch();

                    echo '<th scope="col"> '; echo 'date de création :'.$row["date_creation"].' </th>';
                    echo '<th scope="col"> ';  echo 'client :'.$rowclient['nom'].' </th>';
                    echo '<th scope="col"> '; echo 'passeport : '.$rowclient['numpassport'].' </th>';
                    echo '<th scope="col"> '; echo 'user :'.$rowUser['username'].' </th>';
                    echo '<th scope="col"> '; echo 'Totale : '.$row["totale"].' </th>';


                    echo '    <th scope="col">    <form action ="services/bon/DaoBonService.php">

                 <input type="hidden" name="id_bon" value='.$row["id_bon"].'  > 
                 <input type="hidden" name="client_num" value='.$rowclient['numpassport'].'  > 
                 <input type="hidden" name="client_name" value='.$rowclient['nom'].'  > 
                 <input type="hidden" name="client_id" value='.$row["id_client"].'  > 
                 <button type="submit" class="btn btn-warning" style="width:100%">Modifier</button>
             
	  	  </form
	  	  
	  	  >
	  	  
	  	  </th>
             
             <th scope="col">   
              <form action ="services/bon/DaoBonService.php">
                               <input type="hidden" name="id_bon" value='.$row["id_bon"].'  > 
                               <input type="hidden" name="remove" value= "1" /> 

             <button type="submit" class=" btn btn-danger" style="width:100%">supprimer</button>
             </form>
</th>
    
    
    </tr>
  </thead>
  </table>
            </a>
            
            
            
            
                  <div class="'.$j.'list" style="display: none" >
  
            ';
                    $dev=   $res->query('SELECT * FROM `devise` where id_bon =  '. $row["id_bon"] );

                    foreach  (  $dev as $row)

                    {  echo '
<table class="table ">
  <thead>
     <th scope="col">code :'.$row['id'].'</th>
          <th scope="col">montant:'.$row['montant'].'</th>
          <th scope="col">montant_ml:'.$row['montant_ml'].'</th>
          
          ';

                        $sqlPrix = "SELECT * FROM `tauxdevise`  where id   = ".$row["ID_Taux"];
                        $resultPrix = $res->query($sqlPrix);
                        $rowPrix= $resultPrix->fetch();
                        echo '
                  <th scope="col">prix:'.$rowPrix['prix'].'</th>


     </thead></table>

       ';}
                    echo '</div>';

                    $j++;
                }
                ?>
            </div>
        </div>

    </div>

</div>
</body>
</html>
