<?php
function redirect_to($location)
{
  if($location != NULL){
    header('Location:' .$location);
    exit();
  }
}
function generate_password()
{
    //GENERATE PASSWORD (a more user friendly password, it is good for apps that do not have a large amount of admins, as I imagine this is. If it was an app with a large number of admins I would use a more generic password generation system)
    $psw = '';
    $word1 = array('Poem','Film','Wooden','Silent','Comedy','Lazy','Strong','Purple','Happy','Young','Funny','Rocky','Action','Sick','Horror','Ballet','Cold','Tiny','Big','Silly', 'Beauty','Black');
    $word2 = array('Ship','Barrel','Cannon','Sword','Wall','Truck','Tasty','Shovel','Palace','Shoe','Wire','Car','Store','Forest','Hammer','Path','Picture','Box','Table','Glass','Beast', 'Star');
    $word3 = array('Rabbit','Kitten','Zebra','Cricket','Panther','Wasp','Puppy','Lion','Snake','Bird','Lizard','Giraffe','Rhino','Hawk','Frog','Bear','Beetle','Hamster','Ant','Gorilla','Wars', 'Logan');
    $top = count($word1) - 1;
    $psw = $word1[rand(0,$top)].$word2[rand(0,$top)].$word3[rand(0,$top)];
    return $psw;
}
function send_email($username, $fname, $email, $psw)
{
      $to = $email;
		  $subj = "Welcome to Movie Review - Important Information";
		  $msg = '<h4>Hello</h4><p>'.$fname.'</p>
      <p>You are now an admin at Movie Review! Your username is '.$username.', and your password is '.$psw.'; In a Web browser, go to www.movie-review/admin/admin_login.php, and log in with your password to get started.</p>';
      
       //Additional headers
       $headers = "From: Movie Review Team<noreply@movie-review.ca>". "\n";
		  mail($to,$subj,$msg,$headers);
}
function greeting()
{
  date_default_timezone_set('America/Toronto');
  $now = date('G');
  // echo $now;
  if($now < 12){
    return "<h3>Good Mourning</h3>";
    
  } elseif($now >= 12 && $now < 18){
    return "<h3>Good Afternoon</h3>";
  } elseif($now >= 18 && $now < 22){
    return "<h3>Good Evening</h3>";
  } else {
    return "<h3>Good Night</h3>";
  }
}

// Trim paragraph function
function trim_length($text, $maxLength, $trimIndicator = '...')
{
  if (strlen($text) > $maxLength) {

    $shownLength = $maxLength - strlen($trimIndicator);

    if ($shownLength < 1) {

      throw new \InvalidArgumentException('Second argument for ' . __METHOD__ . '() is too small.');
    }

    preg_match('/^(.{0,' . ($shownLength - 1) . '}\w\b)/su', $text, $matches);

    return (isset($matches[1]) ? $matches[1] : substr($text, 0, $shownLength)) . $trimIndicator;
  }

  return $text;
}

//! Image Resize
function imageResize($imageResourceId, $width, $height)
{
  $targetWidth = 300;
  $targetHeight = 300;
  $targetLayer = imagecreatetruecolor($targetWidth, $targetHeight);

  imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

  return $targetLayer;
}