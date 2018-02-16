<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    body {
    	font-family: sans-serif;
    	font-weight: normal;
    	margin: 10px;
    	color: #999;
    	background-color: #eee;
    }

    form {
    	margin: 40px 0;
    }

    div {
    	clear: both;
    	margin: 0 50px;
    }

    label {
      width: 80px;
      border-radius: 3px;
      border: 1px solid #D1D3D4
    }

    /* hide input */
    input.radio:empty {
    	margin-left: -999px;
    }

    /* style label */
    input.radio:empty ~ label {
    	position: relative;
    	float: left;
    	line-height: 15px;
    	text-indent: 20px;
      font-size: 12px;
    	cursor: pointer;
    	-webkit-user-select: none;
    	-moz-user-select: none;
    	-ms-user-select: none;
    	user-select: none;
    }

    input.radio:empty ~ label:before {
    	position: absolute;
    	display: block;
    	top: 0;
    	bottom: 0;
    	left: 0;
    	content: '';
    	width: 15px;
    	background: #D1D3D4;
    	border-radius: 3px 0 0 3px;
    }

    /* toggle hover */
    input.radio:hover:not(:checked) ~ label:before {
    	content:'\2714';
    	text-indent: 2px;
    	color: #C2C2C2;
    }

    input.radio:hover:not(:checked) ~ label {
    	color: #888;
    }

    /* toggle on */
    input.radio:checked ~ label:before {
    	content:'\2714';
    	text-indent: 2px;
    	color: white;
    	background-color: #4DCB6D;
    }

    input.radio:checked ~ label {
    	color: #777;
      background-color: #4DCB6D;
      color:white;
    }

    /* radio focus
    input.radio:focus ~ label:before {
    	box-shadow: 0 0 0 1px #999;
    }
    */
    </style>
  </head>
  <body>
    <div>
    <input type="radio" name="radio" id="radio1" class="radio" checked/>
    <label for="radio1">12.00 am</label>
    </div>

    <div>
    <input type="radio" name="radio" id="radio2" class="radio"/>
    <label for="radio2">11.00 am</label>
    </div>

    <div>
    <input type="radio" name="radio" id="radio3" class="radio"/>
    <label for="radio3">10.00 am</label>
    </div>

    <div>
    <input type="radio" name="radio" id="radio4" class="radio"/>
    <label for="radio4">09.00 pm</label>
    </div>
  </body>
</html>
