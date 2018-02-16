<?php
//SESSION,DB CONNECTION,OTHER QUERIES
 include ('../dbconfig.php'); // database connection
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::LABAID::</title>
<!--include header-->
  <?php include('../header.php')?>

</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<!--INCLUDING NAVIGATION-->
  <?php include('../nav.php');?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        Customer Information
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                
              
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                            <!--COMPLAIN TAKING FORM AREA-->
                          <form action="create_ticket.php" method="POST" name="ticket">
                          			<div class="col-sm-12" align="center">
                                        	<input class="form-control" style="background:#A7D29B; font-weight:bold" type="tel" name="customer_no" placeholder="Customer Number" input pattern=".{11,13}"   required title="11-13 characters">
                                        </div>
                                    <div class="container span12">
                                        <!--CATAGORIES WITH SUB-CATAGORIES-->
                                        <div class="row">
                                           <!--MASTER CATAGORY-->
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <div class="form-group">
                                                    <label>Problem Catagory</label>
                                                    <select class="form-control" size="6" id="selection" style="width:300px" name="master"> 
                                                        <option value="cat1">Recharge</option>
                                                        <option value="cat2">TV Viewing Problem</option>
                                                        <option value="cat3">Activation</option>
                                                        <option value="cat4">Trade Partner</option>
                                                        <option value="cat5">Back Office Request</option>
                                                        <option value="cat6">Website</option>
                                                        <option value="cat7">Recall through TP</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--SLAVE CATAGORY-->
                                            <div class="col-sm-4">
                                               <div class="form-group">
                                                   <!--3G RELATED COMPLAIN-->
                                                    <div id="cat1"  style="display:none">
                                                       <label>Problem Sub-Catagory</label>
                                                      <select class="form-control" size="6" id="selection" style="width:300px" name="slave"> 
                                                            <option></option>
                                                            <option value="Recharge1">Scratch Recharge Problem</option>
                                                            <!--<option value="Recharge2">SMS based recharge is not working</option>-->
                                                            <option value="Recharge3">IVR based recharge is not working</option>
															<option value="Recharge4">bKash Recharge</option>
                                                            <option value="Recharge5">Sure Cash</option>
                                                            <option value="Recharge6">Ucash</option>
															<option value="Recharge7">DBBL</option>
                                                            <option value="Recharge8">IFIC Bank Ltd.</option>
															<option value="Recharge9">Online Recharge Through Website</option>
                                                            <option value="Recharge10">Terminal Based</option>
                                                        </select>
                                                    </div>
													
													<div id="cat2"  style="display:none">
                                                       <label>Problem Sub-Catagory</label>
                                                        <select class="form-control" size="6" id="selection" style="width:300px" name="slave"> 
                                                            <option></option>
                                                            <option value="TV1">Scrambled All Channels</option>
                                                            <option value="TV2">Scrambled Few Channels</option>
                                                            <option value="TV3">TV Screen Blank</option>
                                                            <option value="TV4">Pixel Break or Pixel Distortion</option>
															<option value="TV10">Audio Problem</option>
															<option value="TV5">All Bangladeshi Channels are not Available</option>
                                                            <!--<option value="TV6">All Channels are not Available</option>-->
                                                            <option value="TV6">All Channels are not Available Except Bangladeshi Channels</option>
                                                            <option value="TV8">Signal Fluctuation</option>
															<option value="TV9">No Signal</option>
                                                        </select>
                                                    </div>
													<div id="cat3"  style="display:none">
                                                           <label>Problem Sub-Catagory</label>
                                                           <select class="form-control" size="6" id="selection" style="width:300px" name="slave"> 
                                                                <option></option>
                                                                <option value="activation1">Unable to Activate the STB</option>
                                                                <option value="activation2">Unable to Catch the Signal</option>
																<option value="activation3">Signal does not establish or Fluctuate</option>
                                                                <option value="activation5">STB Heat & Restart</option>
																<option value="activation6">Remote does not work properly</option>
																<option value="activation7">Installation Problem</option>
																<option value="activation8">STB Hang</option>
																<!--<option value="activation4">Activation</option>-->
                                                            </select>
													</div>
													
													<div id="cat4"  style="display:none">
                                                        <label>Problem Sub-Catagory</label>
                                                        <select class="form-control" size="6" id="selection" style="width:300px" name="slave"> 
                                                            <option></option>
                                                            <option value="trade1">Dealership Request</option>
															<option value="trade2">Installation service from retail point</option>
															<!--<option value="trade3">Installer does not provide support</option>-->
															<option value="trade4">Retail Price Observation with TP</option>
														</select>
                                                    </div>
													<div id="cat5" style="display:none">
                                 <label>Problem Sub-Catagory</label>
                                 <select class="form-control" size="6" id="selection" style="width:300px" name="slave"> 
                                      <option></option>
                                      <option value="contact_request">Contact Request</option>
                                  </select>
                          </div>
													
													<div id="cat6"  style="display:none">
                                                           <label>Problem Sub-Catagory</label>
                                                           <select class="form-control" size="6" id="selection" style="width:300px" name="slave"> 
<option></option>
                                                                <option value="web1">Website login Problem</option>
																<option value="web2">Edit Information on website</option>
																<option value="web3">Password Reset on Website</option>
															</select>
                                                    </div>
													
													<div id="cat7"  style="display:none">
                                                           <label>Problem Sub-Catagory</label>
                                                           <select class="form-control" size="6" id="selection" style="width:300px" name="slave"> 
<option></option>
                                                                <option value="tp1">Swap request from TP_Project Recall</option>
															</select>
                                                    </div>
													  
                                               </div>
                                            </div>
                                            <br><br>
                                        </div><hr>
                                        <!--END OF CATAGORIES WITH SUB-CATAGORIES-->

									<!-- Compliant Channel Entry -->
									<label style="text-align:center">Compliant Channel</label>
									<div class="col-sm-2 col-sm-offset-4">
									<select name="compliant_channel">
										<option value="Inbound">Inbound</option>
										<option value="Email">Email</option>
										<option value="Live Chat">Live Chat</option>
										<option value="Facebook">Facebook</option>
									</select>
									</div></hr>
									
                                        <!--TRIGGERED FORM SECTION-->
                                        <div class="col-sm-12" style="height:260px; overflow:scroll;">
                                        <!--3G RELATED COMPLAIN-->
                                            <div id="Recharge1"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="Recharge1_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="Recharge1_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="Recharge1_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Scratch card serial number/TXN Number for MFS</label></td>
                                                              <td><input name="Recharge1_scratch_serial"  type="text" placeholder="Scratch card serial number/TXN Number for MFS"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="Recharge1_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="Recharge1_backoffice" value="No" checked>  NO 
																<input type="radio" name="Recharge1_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="Recharge1_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="Recharge1_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											<div id="Recharge2"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="Recharge2_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="Recharge2_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="Recharge2_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Scratch card serial number/TXN Number for MFS</label></td>
                                                              <td><input name="Recharge2_scratch_serial"  type="text" placeholder="Scratch card serial number/TXN Number for MFS"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="Recharge2_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="Recharge2_backoffice" value="No" checked>  NO 
																<input type="radio" name="Recharge2_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="Recharge2_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="Recharge2_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											<div id="Recharge3"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="Recharge3_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="Recharge3_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="Recharge3_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Scratch card serial number/TXN Number for MFS</label></td>
                                                              <td><input name="Recharge3_scratch_serial"  type="text" placeholder="Scratch card serial number/TXN Number for MFS"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="Recharge3_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="Recharge3_backoffice" value="No" checked>  NO 
																<input type="radio" name="Recharge3_backoffice" value="Yes">  YES
  															  </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="Recharge3_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="Recharge3_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											<div id="Recharge4"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="Recharge4_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="Recharge4_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="Recharge4_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Scratch card serial number/TXN Number for MFS</label></td>
                                                              <td><input name="Recharge4_scratch_serial"  type="text" placeholder="Scratch card serial number/TXN Number for MFS"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="Recharge4_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="Recharge4_backoffice" value="No" checked>  NO 
																<input type="radio" name="Recharge4_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="Recharge4_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="Recharge4_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											<div id="Recharge5"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="co-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="Recharge5_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="Recharge5_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="Recharge5_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Scratch card serial number/TXN Number for MFS</label></td>
                                                              <td><input name="Recharge5_scratch_serial"  type="text" placeholder="Scratch card serial number/TXN Number for MFS"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="Recharge5_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="Recharge5_backoffice" value="No" checked>  NO 
																<input type="radio" name="Recharge5_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="Recharge5_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="Recharge5_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											<div id="Recharge6"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="Recharge6_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="Recharge6_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="Recharge6_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Scratch card serial number/TXN Number for MFS</label></td>
                                                              <td><input name="Recharge6_scratch_serial"  type="text" placeholder="Scratch card serial number/TXN Number for MFS"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="Recharge6_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="Recharge6_backoffice" value="No" checked>  NO 
																<input type="radio" name="Recharge6_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="Recharge6_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="Recharge6_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											<div id="Recharge7"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="Recharge7_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="Recharge7_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="Recharge7_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Scratch card serial number/TXN Number for MFS</label></td>
                                                              <td><input name="Recharge7_scratch_serial"  type="text" placeholder="Scratch card serial number/TXN Number for MFS"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="Recharge7_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="Recharge7_backoffice" value="No" checked>  NO 
																<input type="radio" name="Recharge7_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="Recharge7_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="Recharge7_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											<div id="Recharge8"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="Recharge8_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="Recharge8_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="Recharge8_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Scratch card serial number/TXN Number for MFS</label></td>
                                                              <td><input name="Recharge8_scratch_serial"  type="text" placeholder="Scratch card serial number/TXN Number for MFS"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="Recharge8_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="Recharge8_backoffice" value="No" checked>  NO 
																<input type="radio" name="Recharge8_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="Recharge8_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="Recharge8_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											<div id="Recharge9"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="Recharge9_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="Recharge9_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="Recharge9_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Scratch card serial number/TXN Number for MFS</label></td>
                                                              <td><input name="Recharge9_scratch_serial"  type="text" placeholder="Scratch card serial number/TXN Number for MFS"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="Recharge9_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="Recharge9_backoffice" value="No" checked>  NO 
																<input type="radio" name="Recharge9_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="Recharge9_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="Recharge9_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											<div id="Recharge10"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="Recharge10_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="Recharge10_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="Recharge10_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Scratch card serial number/TXN Number for MFS</label></td>
                                                              <td><input name="Recharge10_scratch_serial"  type="text" placeholder="Scratch card serial number/TXN Number for MFS"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="Recharge10_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="Recharge10_backoffice" value="No" checked>  NO 
																<input type="radio" name="Recharge10_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="Recharge10_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="Recharge10_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											
											<!-- TV -->
											<div id="TV1"  style="display:none">
                                               <div class="form-inline">
                                                 <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="TV1_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="TV1_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="TV1_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="TV1_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="TV1_backoffice" value="No" checked>  NO 
																<input type="radio" name="TV1_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="TV1_technicalteam" value="No" checked>  NO 
																<input type="radio" name="TV1_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="TV1_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="TV1_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="TV2"  style="display:none">
                                               <div class="form-inline">
                                                 <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="TV2_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="TV2_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="TV2_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="TV2_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="TV2_backoffice" value="No" checked>  NO 
																<input type="radio" name="TV2_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="TV2_technicalteam" value="No" checked>  NO 
																<input type="radio" name="TV2_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="TV2_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="TV2_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="TV3"  style="display:none">
                                               <div class="form-inline">
                                                 <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="TV3_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="TV3_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="TV3_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="TV3_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="TV3_backoffice" value="No" checked>  NO 
																<input type="radio" name="TV3_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="TV3_technicalteam" value="No" checked>  NO 
																<input type="radio" name="TV3_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="TV3_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="TV3_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="TV4"  style="display:none">
                                               <div class="form-inline">
                                                 <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="TV4_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="TV4_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="TV4_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="TV4_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="TV4_backoffice" value="No" checked>  NO 
																<input type="radio" name="TV4_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="TV4_technicalteam" value="No" checked>  NO 
																<input type="radio" name="TV4_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="TV4_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="TV4_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="TV10"  style="display:none">
                                               <div class="form-inline">
                                                 <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="TV10_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="TV10_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="TV10_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="TV10_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="TV10_backoffice" value="No" checked>  NO 
																<input type="radio" name="TV10_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="TV10_technicalteam" value="No" checked>  NO 
																<input type="radio" name="TV10_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="TV10_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="TV10_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="TV5"  style="display:none">
                                               <div class="form-inline">
                                                 <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="TV5_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="TV5_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="TV5_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="TV5_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="TV5_backoffice" value="No" checked>  NO 
																<input type="radio" name="TV5_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="TV5_technicalteam" value="No" checked>  NO 
																<input type="radio" name="TV5_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="TV5_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="TV5_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="TV6"  style="display:none">
                                               <div class="form-inline">
                                                 <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="TV6_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="TV6_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="TV6_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="TV6_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="TV6_backoffice" value="No" checked>  NO 
																<input type="radio" name="TV6_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="TV6_technicalteam" value="No" checked>  NO 
																<input type="radio" name="TV6_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="TV6_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="TV6_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="TV7"  style="display:none">
                                               <div class="form-inline">
                                                 <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="TV7_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="TV7_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="TV7_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="TV7_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="TV7_backoffice" value="No" checked>  NO 
																<input type="radio" name="TV7_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="TV7_technicalteam" value="No" checked>  NO 
																<input type="radio" name="TV7_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="TV7_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="TV7_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="TV8"  style="display:none">
                                               <div class="form-inline">
                                                 <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="TV8_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="TV8_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="TV8_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="TV8_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="TV8_backoffice" value="No" checked>  NO 
																<input type="radio" name="TV8_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="TV8_technicalteam" value="No" checked>  NO 
																<input type="radio" name="TV8_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="TV8_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="TV8_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="TV9"  style="display:none">
                                               <div class="form-inline">
                                                 <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="TV9_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="TV9_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="TV9_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="TV9_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="TV9_backoffice" value="No" checked>  NO 
																<input type="radio" name="TV9_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="TV9_technicalteam" value="No" checked>  NO 
																<input type="radio" name="TV9_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="TV9_comment"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="TV9_alt_no"  type="text"  ></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											<!-- TV END -->
											
											<!-- ACTIVATION -->
											 <div id="activation1"  style="display:none">
                                                <div class="form-inline">
                                                 <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="activation1_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="activation1_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="activation1_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Installer or Retailer Name</label></td>
                                                              <td><input name="activation1_installer_name"  type="text" placeholder="Installer or Retailer Name"></td>
                                                          </tr>
														  <tr>
                                                              <td><label>Installer or Retailer Number</label></td>
                                                              <td><input name="activation1_installer_number"  type="text" placeholder="Installer or Retailer Number"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="activation1_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="activation1_backoffice" value="No" checked>  NO 
																<input type="radio" name="activation1_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="activation1_technicalteam" value="No" checked>  NO 
																<input type="radio" name="activation1_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
														  
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="activation1_comment" rows="2"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="activation1_alt_no"  type="text"></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											
											<div id="activation2"  style="display:none">
                                                <div class="form-inline">
                                                 <div class="col-sm-6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="activation2_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="activation2_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="activation2_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Installer or Retailer Name</label></td>
                                                              <td><input name="activation2_installer_name"  type="text" placeholder="Installer or Retailer Name"></td>
                                                          </tr>
														  <tr>
                                                              <td><label>Installer or Retailer Number</label></td>
                                                              <td><input name="activation2_installer_number"  type="text" placeholder="Installer or Retailer Number"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="activation2_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="col-sm-6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="activation2_backoffice" value="No" checked>  NO 
																<input type="radio" name="activation2_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="activation2_technicalteam" value="No" checked>  NO 
																<input type="radio" name="activation2_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
														  
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="activation2_comment" rows="2"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="activation2_alt_no"  type="text"></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											
											<div id="activation3"  style="display:none">
                                                <div class="form-inline">
                                                 <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="activation3_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="activation3_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="activation3_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Installer or Retailer Name</label></td>
                                                              <td><input name="activation3_installer_name"  type="text" placeholder="Installer or Retailer Name"></td>
                                                          </tr>
														  <tr>
                                                              <td><label>Installer or Retailer Number</label></td>
                                                              <td><input name="activation3_installer_number"  type="text" placeholder="Installer or Retailer Number"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="activation3_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="span6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="activation3_backoffice" value="No" checked>  NO 
																<input type="radio" name="activation3_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="activation3_technicalteam" value="No" checked>  NO 
																<input type="radio" name="activation3_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
														  
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="activation3_comment" rows="2"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="activation3_alt_no"  type="text"></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="activation4"  style="display:none">
                                                <div class="form-inline">
                                                 <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="activation4_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="activation4_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="activation4_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Installer or Retailer Name</label></td>
                                                              <td><input name="activation4_installer_name"  type="text" placeholder="Installer or Retailer Name"></td>
                                                          </tr>
														  <tr>
                                                              <td><label>Installer or Retailer Number</label></td>
                                                              <td><input name="activation4_installer_number"  type="text" placeholder="Installer or Retailer Number"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="activation4_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="span6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="activation4_backoffice" value="No" checked>  NO 
																<input type="radio" name="activation4_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="activation4_technicalteam" value="No" checked>  NO 
																<input type="radio" name="activation4_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
														  
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="activation4_comment" rows="2"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="activation4_alt_no"  type="text"></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="activation5"  style="display:none">
                                                <div class="form-inline">
                                                 <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="activation5_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="activation5_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="activation5_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Installer or Retailer Name</label></td>
                                                              <td><input name="activation5_installer_name"  type="text" placeholder="Installer or Retailer Name"></td>
                                                          </tr>
														  <tr>
                                                              <td><label>Installer or Retailer Number</label></td>
                                                              <td><input name="activation5_installer_number"  type="text" placeholder="Installer or Retailer Number"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="activation5_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="span6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="activation5_backoffice" value="No" checked>  NO 
																<input type="radio" name="activation5_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="activation5_technicalteam" value="No" checked>  NO 
																<input type="radio" name="activation5_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
														  
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="activation5_comment" rows="2"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="activation5_alt_no"  type="text"></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="activation6"  style="display:none">
                                                <div class="form-inline">
                                                 <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="activation6_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="activation6_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="activation6_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Installer or Retailer Name</label></td>
                                                              <td><input name="activation6_installer_name"  type="text" placeholder="Installer or Retailer Name"></td>
                                                          </tr>
														  <tr>
                                                              <td><label>Installer or Retailer Number</label></td>
                                                              <td><input name="activation6_installer_number"  type="text" placeholder="Installer or Retailer Number"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="activation6_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="span6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="activation6_backoffice" value="No" checked>  NO 
																<input type="radio" name="activation6_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="activation6_technicalteam" value="No" checked>  NO 
																<input type="radio" name="activation6_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
														  
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="activation6_comment" rows="2"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="activation6_alt_no"  type="text"></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="activation7"  style="display:none">
                                                <div class="form-inline">
                                                 <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="activation7_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="activation7_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="activation7_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Installer or Retailer Name</label></td>
                                                              <td><input name="activation7_installer_name"  type="text" placeholder="Installer or Retailer Name"></td>
                                                          </tr>
														  <tr>
                                                              <td><label>Installer or Retailer Number</label></td>
                                                              <td><input name="activation7_installer_number"  type="text" placeholder="Installer or Retailer Number"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="activation7_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="span6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="activation7_backoffice" value="No" checked>  NO 
																<input type="radio" name="activation7_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="activation7_technicalteam" value="No" checked>  NO 
																<input type="radio" name="activation7_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
														  
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="activation7_comment" rows="2"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="activation7_alt_no"  type="text"></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											
											<div id="activation8"  style="display:none">
                                                <div class="form-inline">
                                                 <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="activation8_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="activation8_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="activation8_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Installer or Retailer Name</label></td>
                                                              <td><input name="activation8_installer_name"  type="text" placeholder="Installer or Retailer Name"></td>
                                                          </tr>
														  <tr>
                                                              <td><label>Installer or Retailer Number</label></td>
                                                              <td><input name="activation8_installer_number"  type="text" placeholder="Installer or Retailer Number"></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="activation8_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="span6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="activation8_backoffice" value="No" checked>  NO 
																<input type="radio" name="activation8_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>
														  <tr>
                                                              <td><label>Request to Technical </br>
															  Team Directly?</label></td>
                                                              <td>
																<input type="radio" name="activation8_technicalteam" value="No" checked>  NO 
																<input type="radio" name="activation8_technicalteam" value="Yes">  YES
															  </td>
                                                          </tr>
														  
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="activation8_comment" rows="2"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Alternate No:</label></td>
                                                              <td><input name="activation8_alt_no"  type="text"></td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
										<!-- ACTIVATION END -->
										
										<!-- TRADE -->
										<div id="trade1"  style="display:none">
                                                <div class="form-inline">
                                                 <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Installer Name</label></td>
                                                              <td>
                                                              <input type="text" name="trade1_installer_name" class="div" placeholder="Installer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Location:</label></td>
                                                              <td>
															  <textarea name="trade1_location" placeholder="Location"></textarea>
                                                              </td>
                                                          </tr>  
														  <td>Date and Time:</label></td>
                                                              <td>
															  <input type="datetime-local" name="trade1_datetime" placeholder="Location"/>
                                                              </td>
                                                          </tr> 
														  
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="trade1_comment" rows="2"></textarea></td>
                                                          </tr>
														  
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="trade1_backoffice" value="No" checked>  NO 
																<input type="radio" name="trade1_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
										
										<div id="trade2"  style="display:none">
                                                <div class="form-inline">
                                                 <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Installer Name</label></td>
                                                              <td>
                                                              <input type="text" name="trade2_installer_name" class="div" placeholder="Installer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Location:</label></td>
                                                              <td>
															  <textarea name="trade2_location" placeholder="Location"></textarea>
                                                              </td>
                                                          </tr>  
														  <td>Date and Time:</label></td>
                                                              <td>
															  <input type="datetime-local" name="trade2_datetime" placeholder="Location"/>
                                                              </td>
                                                          </tr> 
														  
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="trade3_comment" rows="2"></textarea></td>
                                                          </tr>
														  
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="trade2_backoffice" value="No" checked>  NO 
																<input type="radio" name="trade2_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="trade3"  style="display:none">
                                                <div class="form-inline">
                                                 <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Installer Name</label></td>
                                                              <td>
                                                              <input type="text" name="trade3_installer_name" class="div" placeholder="Installer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Location:</label></td>
                                                              <td>
															  <textarea name="trade3_location" placeholder="Location"></textarea>
                                                              </td>
                                                          </tr>  
														  <td>Date and Time:</label></td>
                                                              <td>
															  <input type="datetime-local" name="trade3_datetime" placeholder="Location"/>
                                                              </td>
                                                          </tr> 
														  
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="trade3_comment" rows="2"></textarea></td>
                                                          </tr>
														  
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="trade3_backoffice" value="No" checked>  NO 
																<input type="radio" name="trade3_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											<div id="trade4"  style="display:none">
                                                <div class="form-inline">
                                                 <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Installer Name</label></td>
                                                              <td>
                                                              <input type="text" name="trade4_installer_name" class="div" placeholder="Installer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Location:</label></td>
                                                              <td>
															  <textarea name="trade4_location" placeholder="Location"></textarea>
                                                              </td>
                                                          </tr>  
														  <td>Date and Time:</label></td>
                                                              <td>
															  <input type="datetime-local" name="trade4_datetime" placeholder="Location"/>
                                                              </td>
                                                          </tr> 
														  
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="trade4_comment" rows="2"></textarea></td>
                                                          </tr>
														  
                                                          <tr>
                                                              <td><label>Request to Back Office?</label></td>
                                                              <td>
																<input type="radio" name="trade4_backoffice" value="No" checked>  NO 
																<input type="radio" name="trade4_backoffice" value="Yes">  YES
															  </td>
                                                          </tr>   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
										
										<!-- TRADE END -->
										
										<!-- Contact Request -->
										<div id="contact_request"  style="display:none">
                                                <div class="span8">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="contact_request_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="contact_request_customer_number" placeholder="Customer Number">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Customer Email:</label></td>
                                                              <td><input name="contact_request_customer_email"  type="email" placeholder="Customer Email"  ></td>
                                                          </tr>
														  
                                                          <tr>
                                                              <td><label>To Whome Customer Wants to Talk to</label></td>
                                                              <td>
																<textarea name="contact_request_talk_to" rows="1"></textarea>
															  </td>
                                                          </tr> 
														  <tr>
                                                              <td><label>Comment</label></td>
                                                              <td><textarea name="contact_request_comment" rows="1"></textarea></td>
                                                          </tr>
                                                      </table>
                                                </div>
                                        </div>
										<!-- Contact Request -->
										
										<!--Website Start-->
										<div id="web1"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="web1_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="web1_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="web1_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="web1_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="span6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Customer Email:</label></td>
                                                              <td><input name="web1_customer_email"  type="email" placeholder="Customer Email"  ></td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="web1_comment"></textarea></td>
                                                          </tr>
   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											
											<div id="web2"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="web2_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="web2_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="web2_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="web2_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="span6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Customer Email:</label></td>
                                                              <td><input name="web2_customer_email"  type="email" placeholder="Customer Email"  ></td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="web2_comment"></textarea></td>
                                                          </tr>
   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											
											<div id="web3"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="web3_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="web3_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Subscriber ID:</label></td>
                                                              <td><input name="web3_subscriber_id"  type="text" placeholder="Subscriber ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>Smart Card ID:</label></td>
                                                              <td><input type="text" name="web3_smartcard_id" placeholder="Smart Card ID"></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="span6">   
                                                      <table> 
                                                          <tr>
                                                              <td><label>Customer Email:</label></td>
                                                              <td><input name="web3_customer_email"  type="email" placeholder="Customer Email"  ></td>
                                                          </tr>
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="web3_comment"></textarea></td>
                                                          </tr>
   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
											
											<!--TP-TP-->
											<div id="tp1"  style="display:none">
                                               <div class="form-inline">
                                                    <div class="span6">
                                                      <table>
                                                          <tr>
                                                              <td><label>Customer Name</label></td>
                                                              <td>
                                                              <input type="text" name="tp1_customer_name" class="div" placeholder="Customer Name">
                                                              </td>
                                                          </tr>

                                                          <tr>
														  <td>Customer Number:</label></td>
                                                              <td>
															  <input type="tel" name="tp1_customer_number" placeholder="Customer Number" input pattern=".{11,13}" title="11-13 characters">
                                                              </td>
                                                          </tr>
														  
														  <tr>
                                                              <td><label>Customer Area:</label></td>
                                                              <td><textarea cols="50" rows="2" name="tp1_customerarea"></textarea></td>
                                                          </tr>

                                                          <tr>
                                                              <td><label>Financial ID:</label></td>
                                                              <td><input name="tp1_financialid"  type="text" placeholder="Financial ID"  ></td>
                                                          </tr>
                                                           <tr>
                                                              <td><label>OLD CAS:</label></td>
                                                              <td><input type="text" name="tp1_oldcas" placeholder="OLD CAS"></td>
                                                          </tr>
														  <tr>
                                                              <td><label>NEW CAS:</label></td>
                                                              <td><input type="text" name="tp1_newcas" placeholder="NEW CAS"></td>
                                                          </tr>
														  <tr>
                                                              <td><label>TP name and Address</label>:</label></td>
                                                              <td><textarea cols="50" rows="1" name="tp1_tpnameandaddress"></textarea></td>
                                                          </tr>
                                                      </table>
                                                    </div> 
                                                    <div class="span6">   
                                                      <table> 
														  
                                                          <tr>
                                                              <td><label>TP Division:</label></td>
                                                              <td><input name="tp1_division"  type="text" placeholder="TP Division"  ></td>
                                                          </tr>
														  <tr>
                                                              <td><label>TP RMN:</label></td>
                                                              <td><input name="tp1_tprnm"  type="text" placeholder="TP RNM"  ></td>
                                                          </tr>
														  <tr>
                                                              <td><label>Swap Date:</label></td>
                                                              <td><input name="tp1_swapdate"  type="date" placeholder="Swap Date"  ></td>
                                                          </tr>
														  <tr>
                                                              <td><label>For OB Agents</label><br><label>Successful?</label></td>
                                                              <td><input name="tp1_obagents"  type="radio" value = "Yes">Yes
																  <input name="tp1_obagents"  type="radio" value = "No">No
															  </td>
                                                          </tr>
														  
                                                          <tr>
                                                              <td><label>Comment:</label></td>
                                                              <td><textarea cols="50" rows="2" name="tp1_comment"></textarea></td>
                                                          </tr>
   
                                                      </table>
                                                    </div>
                                              </div>
                                            </div>
											
										<!--Website End-->
                                        <!--SERVICE RELATED PROBLEM ENDS-->

                                        </div>                    
									
                                    </div>
                                    <hr>
                                    <div class="span2 offset4">
                                    </div>
                                    <div class="span6 offset4">
                                    <textarea cols="50" rows="2" name="agent_message" id="agent_message"  type="text"  style="background-color:#D7FFD7; display:none" placeholder="Please Leave a Message"></textarea>
                                    <input disabled type="checkbox" value="2" id="agent_wrap" name="status" onClick="showHide()"> Check, if issue solved.
                                    <button style="margin-top:5px;" class="btn btn-xs btn-success">SEND</button>
                                    </div>
                          </form>
                          </div>  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  
  <script>      
    $(document).on('change','#selection', function () {
        $('.form').hide(); 
        $('#' + $(this).val()).show().siblings().hide();
    });
</script> 
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
