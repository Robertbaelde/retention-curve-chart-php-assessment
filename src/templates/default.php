<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="/src/public/css/main.css" >
    
        <title>Weekly Retention curves chart</title>
    </head>
    
    <body>
    	<div class="col-md-6 offset-md-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                    	<h1>
                    		<i class="fas fa-chart-line"></i>
                    		<span>Weekly Retention curves chart</span>
                    	</h1>
                	</div>
                </div>
            </div>
    
     		<div class="container-fluid">
                <div class="row">
                	<div class="col">
                		<p>Retention curve chart that shows how far a group of users (weekly cohorts) has progressed through the Onboarding Flow.</p>
                		
                    	<div id="app">
                    		<weekly-cohort-chart></weekly-cohort-chart>
                    	</div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                	<div class="col">
                    	<footer>
                    		<a href="https://www.giuseppemaccario.com/" target="_blank">
                    			<span>G. Maccario</span>
                    		</a>
                    	</footer>
                    </div>
                </div>
            </div>
		</div>
    
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
        
        <script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        
        <script type="text/javascript" src="/src/public/js/main.js"></script>
    </body>
</html>