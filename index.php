<?php

require_once "conexao.php";

/* Session */

session_start();

/* Button send*/

if(isset($_POST['btnEntrar'])):
 $erros=array();
 $login = mysqli_escape_string($connect, $_POST['login'] );
 $senha =  mysqli_escape_string($connect, $_POST['senha']);

  if(empty($login) or empty($senha)):
      $erros[] = "Preencha os campos Usuario e Senha";

    else:
      $sql ="SELECT login FROM usuarios WHERE login = '$login'";
      $resultado = mysqli_query($connect, $sql);

       if(mysqli_num_rows($resultado) > 0):
      
        $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha= '$senha' ";
        $resultado = mysqli_query($connect, $sql);
           
          if(mysqli_num_rows($resultado)== 1):
            $dados = mysqli_fetch_array($resultado);
            $_SESSION['lohado']= true;
            $_SESSION['id_usuario'] = $dados['id'];
            header('location: home.php');

          else:
              $erros[] = "O usuario ou senha esta incorreto";
          endif;   

        else:
        $erros[]= "<li>Usuario inexistente</li>";
        $endif;
       endif;


    endif;
endif;


?>

<html>

<head>
<div class="form">

<title>Login </title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <link rel="stylesheet" href="stylo.css">

</head>

<body>
  <div class="title">  

   <h1>Login</h1>

  </div> 

   <div class=>
     <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <div class="user">

       <span class="glyphicon glyphicon-user"><input type="text" name="login" placeholder=" USUARIO"><br></span>

      </div>
      <div class="pass">

       <span class="glyphicon glyphicon-lock"><input type="password" name="senha" placeholder=" SENHA"><br></span>

      </div>
     

    <div class="alert">  
      <?php
      if(!empty($erros)){

       foreach($erros as $erro){
         echo $erro;
         } 
       }

      ?>  
    </div> 
    
     <div class="btn">
       <button type="submit" name="btnEntrar">Entrar</button>

      </div>
     </form>
   </div>
</div>
</body>
</html>