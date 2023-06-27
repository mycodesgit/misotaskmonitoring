<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MISO | Task Monitoring</title>
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="assets/adminLTE-3/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/adminLTE-3/dist/css/adminlte.min.css">
	<!-- Logo -->
	<link rel="shortcut icon" type="" href="assets/adminLTE-3/img/mislogoNoBG.png">
	

	<style>
		.box{
			width: 60% !important;
		}
		.boxmonitoring{
			width: 95% !important;
			height: 95% !important;
		}
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: #5f6f81;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 50% 50%;
            z-index: -1;
        }
        #progress-container {
		    position: relative;
		    height: 15px;
		    background-color: #f2f2f2;
		    border-radius: 4px;
		    overflow: hidden;
	    }

	    #progress-bar {
	        height: 100%;
	        background-color: #28a745;
	        transition: width 0.3s ease;
	    }

	    #progress-handle {
	        position: absolute;
	        top: 0;
	        left: 0%;
	        width: 10px;
	        height: 100%;
	        background-color: #fff;
	        border: 1px solid #ccc;
	        border-radius: 4px;
	        cursor: pointer;
	    }

	    .status-cell-component {
	        position: relative;
	        display: inline-flex;
	        align-items: center;
	        justify-content: center;
	        padding: 4px;
	        color: #fff;
	        font-weight: bold;
	        border-radius: 3px;
	        font-size: 12px;
	        line-height: 1;
	        text-transform: uppercase;
	        white-space: nowrap;
	    }

	    .status-cell-component .status-note-wrapper {
	        display: flex;
	        align-items: center;
	    }

	    .status-cell-component .add-status-note {
	        width: 8px;
	        height: 8px;
	        border-radius: 50%;
	        background-color: #fff;
	        margin-right: 4px;
	    }

	    .status-cell-component i {
	        margin-left: 4px;
	    }

	    .status-cell-component[data-status="working"] {
	        background-color: #fdae61;
	    }

	    .status-cell-component[data-status="done"] {
	        background-color: #5b8f29;
	    }

	    .status-cell-component[data-status="stuck"] {
	        background-color: #ff4d4f;
	    }
	    .table-avatar{
	        width: 35px !important;
	    }
	    .align-middle {
		    display: flex;
		    align-items: center;
		    justify-content: center;
		}
		.mailbox-name a{
			color: #000 !important;
		}

	</style>
</head>


	
	<!-- Page here-->
	
	

	

	