<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>To do list</title>
</head>

<body>
	
	<div id="myList" style="width:300px; height:400px" >

        <?php include "contenu.php"; ?>
    
    </div>

    <br/><br/>

	<hr/>

    <br/><br/>

    <div style="border:1px solid black">
    	<form action="" method="GET">
        	<h1 style="size:12px">Ajouter une tâche</h1>
    		<p style="color:green; font-weight: bold;">La tâche a effectuer: <input style="color:black; font-weight: normal" id="id_tache" type="text" name="tache"></p>

    		<input onclick="addTask()" type="submit" value="Ajouter">
            <br/><br/>
    	</form> 
    </div>

</body>
</html>


