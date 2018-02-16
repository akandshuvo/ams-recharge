<?php
 include ('../dbconfig.php');

 $row = $conn->query("SELECT * from notification WHERE status = 1 LIMIT 1")->fetch();
  if($row != NULL){
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
    $id = $row['id'];
    $update = $conn->query("UPDATE notification SET status=0 WHERE id='$id'")->execute();
}else{

}

?>