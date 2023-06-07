<?php  

function getUser($NomeUsuario, $conn){
   $sql = "SELECT * FROM cadastro 
           WHERE NomeUsuario=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$NomeUsuario]);

   if ($stmt->rowCount() === 1) {
   	 $user = $stmt->fetch();
   	 return $user;
   }else {
   	$user = [];
   	return $user;
   }
}