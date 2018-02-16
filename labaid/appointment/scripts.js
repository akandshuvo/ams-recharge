/*

<script type="text/javascript">
  // APPOINTMENT SLOT IN PREVIEW WINDOW
    $("#preview").click(function() {
      var val = $('input[name=appointment_time]:checked').val();
      var mystr = val;
      //Splitting it with : as the separator
      var myarr = mystr.split("_");
      //PRINTING DATA IN PREVIEW WINDOWS
      $("#appointment_serial_preview").text(myarr[0]);
    });
</script>



<script type="text/javascript">
  $(document).ready(function(){

  // on click preview data
        var Customer_Name       = document.getElementById("customer_name").value;
        $("#customer_name_preview").text(Customer_Name);

        var Customer_Reg_Number       = document.getElementById("reg_number").value;
        $("#customer_reg_number_preview").text(Customer_Reg_Number);


        var Mobile_Number       = document.getElementById("mobile_number").value;
        $("#mobile_number_preview").text(Mobile_Number);

        var Alt_Number       = document.getElementById("alt_number").value;
        $("#alt_number_preview").text(Alt_Number);

        $('#chamber_location').on('change',function(){
          var Chamber_Location       = document.getElementById("chamber_location").value;
          $("#chamber_location_preview").text(Chamber_Location);
        });

        $('#speciality').on('change',function(){
          var Doctor_Speciality       = document.getElementById("speciality").value;
          $("#speciality_preview").text(Doctor_Speciality);
        });

        $('#doctor_id').on('change',function(){
          var Doctor_ID       = document.getElementById("doctor_id").value;
          $("#doctor_id_preview").text(Doctor_ID);
        });



        $('#appointment_date').on('change',function(){
          var Appointment_date       = document.getElementById("appointment_date").value;
          $("#appointment_date_preview").text(Appointment_date);
        });
 });
</script>




<script type="text/javascript">
   function hello(){
      var val = $('input[name=appointment_time]:checked').val();
      var mystr = val;
      //Splitting it with : as the separator
      var myarr = mystr.split("_");
      //PRINTING DATA IN PREVIEW WINDOWS
      //$("#appointment_serial_preview").text(myarr[0]);
      //alert();

      var id = "<?php echo $_GET['lastId']?>";
      var appointment_slot = myarr[0];

      if(appointment_slot){
              $.ajax({
                  type:'POST',
                  url:'ajax_appointment_slot.php',
                  data:'appointment_slot='+appointment_slot+'&id='+id,
                  success:function(html){
                    $('#appointment_slot_booked').html(html).fadeIn('5000');
                    //alert(html);
                  }
              });
          }

}
</script>

<script type="text/javascript">
    $(document).ready(function(){

    // MAKING AJAX REQUEST WHILE CHANGINg DOCTOR SPECIALITY
        $('#speciality').on('change',function(){
            var Speciality = $(this).val();
            var chamberLocation = document.getElementById("chamber_location").value;

            if(Speciality){
                $.ajax({
                    type:'POST',
                    url:'ajax.php',
                    data:'chamber_location='+chamberLocation+'&speciality='+Speciality,
                    success:function(html){
                      $('#doctor_list').html(html);
                      //alert(html);
                    }
                });
            }
        });
    // MAKING AJAX CALL WHILE SELECTING DOCTOR LIST DATE

        $('#doctor_id').on('change',function(){
          var doctorList2            = document.getElementById("doctor_id").value;
          var appointmentDate2       = document.getElementById("appointment_date").value;


          if(appointmentDate2){
              $.ajax({
                  type:'POST',
                  url:'ajax.php',
                  data:'doctor_id='+doctorList2+'&appointment_date='+appointmentDate2,
                  success:function(html){
                    $('#serial_slot').html(html).fadeIn('slow');
                    //alert(html);
                  }
              });
          }
        });

    // for doctor profile
      $('#doctor_id').on('change',function(){
          var doctorlist            = document.getElementById("doctor_id").value;
          if(doctorlist){
              $.ajax({
                  type:'POST',
                  url:'ajax_doctor_profile.php',
                  data:'doctor_id='+doctorlist,
                  success:function(html){
                    $('#doctor_profile').html(html).fadeIn('slow');
                    //alert(html);
                  }
              });
          }

        });

    // MAKING AJAX CALL WHILE SELECTING APPOINTMENT DATE
        $('#appointment_date').on('change',function(){
          var doctorList2            = document.getElementById("doctor_id").value;
          var appointmentDate2       = document.getElementById("appointment_date").value;
          var id = "<?php echo $_GET['lastId']?>";




         // function fetchdata(){
            if(appointmentDate2){
                $.ajax({
                    type:'POST',
                    url:'ajax.php',
                    data:'doctor_id='+doctorList2+'&appointment_date='+appointmentDate2+'&id='+id,
                    success:function(html){
                      $('#serial_slot').html(html).fadeIn('1000');
                      //alert(html);
                    }
                });
            }
         // }

         // $(document).ready(function(){
        //   setInterval(fetchdata,1000);
        //  });

        });

    // VALIDATING APPOITMENT DATE
        $('#appointment_date').on('change',function(){
          var appointmentDate2       = document.getElementById("appointment_date").value;


          if(appointmentDate2){
              $.ajax({
                  type:'POST',
                  url:'ajax.php',
                  data:'appointment_date_validation='+appointmentDate2,
                  success:function(html){
                    $('#appointment_validation').html(html).fadeIn('5000');
                    //alert(html);
                  }
              });
          }
        });

  });

</script>
*/
