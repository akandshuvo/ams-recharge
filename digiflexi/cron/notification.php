<?php
  session_start();
  include ('../dbconfig.php');
  $merchant_username = $_SESSION['username'];
  $row = $conn->query("SELECT * from notification WHERE status = 0 AND merchant_username='$merchant_username' LIMIT 1")->fetch();
  if($row != NULL){
    if($row['response_code']==200){
?>

<script>
    PNotify.desktop.permission();
    (new PNotify({
        title: 'Success!',
        text: '<?php echo $row['message'];?>;',
        type: 'success',
        desktop: {
            desktop: true
        },
        Mobile: {
            //swipe_dismiss: true, //- Let the user swipe the notice away.
            styling: true // Styles the notice to look good on mobile.
        }
    })).get().click(function(e) {
        if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
        alert('Hey! You clicked the desktop notification!');
    });
</script>

<?php
}
if($row['response_code']!=200){
?>
<script>
    PNotify.desktop.permission();
    (new PNotify({
        title: 'Error!',
        text: '<?php echo $row['message'];?>;',
        type: 'Error',
        desktop: {
            desktop: true
        },
        Mobile: {
            //swipe_dismiss: true, //- Let the user swipe the notice away.
            styling: true // Styles the notice to look good on mobile.
        }
    })).get().click(function(e) {
        if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
        alert('Hey! You clicked the desktop notification!');
    });
</script>
<?php
}
    $id = $row['id'];
    $update = $conn->query("UPDATE notification SET status=1 WHERE id='$id'")->execute();
}else{

}

?>
