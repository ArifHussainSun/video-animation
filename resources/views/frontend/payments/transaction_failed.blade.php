<!DOCTYPE html>

<html lang='en' ng-app="myApp">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Payment Failed | <?php echo (!empty($data['itemprice']) ? "Amount: ".$data['currency'].$data['itemprice'] : ""); ?> <?php echo (!empty($data['itemname']) ? ' | Item Name: '.$data['itemname'] : ''); ?> <?php echo (!empty($data['message']) ? "Message: ".$data['message'] : ''); ?></title>
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <style>
        .thank-section { width: 100%; position: absolute; top: 50%; transform: translateY(-50%); text-align: center; }
        .thankyou-container { background: #333333; color: #fff; width: 100%; max-width: 800px; margin: 0 auto; padding: 45px 30px 30px 30px; box-shadow: 0px 4px 20px 5px rgba(0, 0, 0, 0.2); border-radius: 10px; }
        .thank-tick { font-size: 32px; width: 75px;height: 75px; background: rgb(226, 90, 80); border-radius: 50%;box-shadow: 0 6px 30px 0 rgba(255, 39, 39, 0.22);position: relative; color: #fff;margin: 0 auto; }
        .thank-tick i {position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); }
        .thank-tick > .after, .thank-tick > .before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgb(255, 255, 255); border-radius: 50%; z-index: 1; color: #fff; }
        .thank-tick > .after { opacity: .2; -webkit-animation: pulse 1.5s infinite; animation: pulse 1.5s infinite; }
        .thank-tick > .before { transform: scale(1); opacity: .1; -webkit-animation: 1.5s pulse .3s infinite; animation: 1.5s pulse .3s infinite; }
        .thank-detail { width: 100%; }
        .thank-detail h1 { padding: 5px 0 15px 0; position: relative; }
        .thank-detail h1:before { content: ''; background: rgb(39, 117, 255); width: 60px; height: 2px; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); }
        .thank-detail h3 { font-size: 17px; line-height: 24px; font-weight: 300; }
        .order-detail h2 { font-size: 24px; padding: 0 0 15px 0; position: relative; margin-bottom: 20px; }
        .order-detail h2:before { content: ''; background: rgb(39, 117, 255); width: 60px; height: 2px; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); }
        .order-detail ul { list-style: none; padding: 0; margin: 0 auto; width: 100%; max-width: 400px; overflow: hidden; }
        .order-detail ul li { width: 50%; float: left; padding: 5px 10px; border: 1px solid #ddd; }
        .order-detail ul li:nth-child(1) { border-top-left-radius: 6px; } 
        .order-detail ul li:nth-child(2) { border-top-right-radius: 6px; } 
        .order-detail ul li:nth-last-child(2) { border-bottom-left-radius: 6px; font-weight: 500; }
        .order-detail ul li:last-child { border-bottom-right-radius: 6px; font-weight: 500; }
        .success-table {max-width: 400px;margin: 0 auto;border: 1px solid;border-collapse: unset;border-radius: 1em;}
        
        @-webkit-keyframes pulse{0%{transform:scale(1)}50%{transform:scale(2)}to{transform:scale(1);opacity:0}}
        @keyframes pulse{0%{transform:scale(1)}50%{transform:scale(2)}to{transform:scale(1);opacity:0}}
        
        
        @media (max-width: 768px) {
        	.thank-detail h1 { font-size: 22px; }
        	.thank-detail h3 { font-size: 15px; }
            .order-detail h2 { font-size: 21px; padding: 0 0 10px 0; }
        	.thankyou-container { padding: 45px 20px 30px 20px; }
        }
    </style>
    
    @stacks('paymentScripts')
</head>
<body>

	<section class="thank-section">
		<div class="container">
			<div class="thankyou-container">
				<div class="thank-tick">
					<i class="fa fa-times"></i>
					<span class="before"></span>
					<span class="after"></span>
				</div>
				<div class="thank-detail">
					<h1>Transaction Failed</h1>
					<h3>{{ (!empty($data['message']) ? $data['message'] : "") }}</h3>
					<div class="order-detail">
						<h2>Please Try Again..!!</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
		
		
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		
</body>
</html>
