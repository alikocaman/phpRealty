<?
/* ------------------------------------------------------------------------------------------------
phpRealty site index page.
Copyright 2007 John Carlson
Created By: John Carlson
Contact: johncarlson21@gmail.com
Date Created: 08-23-2007
Version: 0.05
------------------------------------------------------------------------------------------------ */
$error = '';

extract($config); // extract config variables

if(isset($_GET['delID']) && is_numeric($_GET['delID'])){
	// this is a delete action
	if($phprealty->dbQuery("DELETE FROM ".$phprealty->db."comm_feat WHERE id='".$_GET['delID']."'")){
		$error = $lang['admincomunfeat1'];
	}else{
		$error = $lang['admincomunfeat2'];
	}
}

if(isset($_POST['submit']) && $_POST['submit'] && !empty($_POST['name'])){
	// lets do an insert for the feature
	if($phprealty->putIntTableRow($fields=array("name"=>$_POST['name']), $into="comm_feat")){
		$error = $lang['admincomunfeat3'];
	}else{
		$error = $lang['admincomunfeat4'];
	}
}

?>
<div id="post-1" class="post">
<h2 class="title"><a href="<? echo $homeFeatURL; ?>"><?=$lang['admincomunfeat5'];?></a></h2>

<div class="entry">
<? if($error){ ?>
<div class="error"><? echo $error; ?></div>
<? } ?>
<form method="post" action="<? echo $commFeatURL; ?>" name="home_feat">
<span class="featName"><?=$lang['admincomunfeat6'];?>:</span> <input type="text" name="name" size="30" /> &nbsp;<input type="submit" name="submit" value="<?=$lang['add'];?>" />
</form>
<hr size="1">
<table width="100%" id="featList" cellpadding="3" cellspacing="3">
<?
// get features list
$result = $phprealty->getIntTableRows($fields="*", $from="comm_feat", $where="", $sort="name", $dir="ASC", $limit="", $push=true);
if($result && $result[0]['name'] != "" && $result[0]['name'] != NULL){
	$a = count($result);
	$b = 0;
	while($b<$a){
?>
<tr>
	<td class="featTD"><? echo ucwords($result[$b]['name']); ?> <a href="<? echo $phprealty->makeUrl(21,false,'?p=8&delID='.$result[$b]['id']); ?>" style="color:#ff0000;font-style:oblique;" title="<?=$lang['delete'];?>">X</a></td>
</tr>
<?
	$b++;
	}
}
?>
</table>
</div>
</div>
