<?php require("layouts/headerFrontPage.php"); ?>
<style>
        .background {
            position: relative;
            height: 80vh;
        }
        .top-half {
            background-color: white;
            height: 35%;
            width: 100%;
        }
        .bottom-half {
            background-color: #3A81D3;
            height: 70%;
            width: 100%;
        }
        .cat {
            position: absolute;
            bottom: 70%;
            left: 20%;
            transform: translate(-50%, 50%);
        }

        .liner {
            position: absolute;
            bottom: 70%;
            left: 5%;
            transform: translate(-50%, 50%);
        }

        .paws {
            position: absolute;
            bottom: 90%;
            left: 80%;
            transform: translate(-50%, 50%);
        }
        .content {
            position: absolute;
            top: 20%;
            right: 10%;
            transform: translateY(-50%);
        }
    </style>

<div class="background">
        <div class="top-half">
        <div class="container content">
            <div class="row">
                <div class="col-md-6">
                    <!-- This column is intentionally left blank or can contain some other content -->
                </div>
                <div class="col-md-6">
                    <!-- Content on the right -->
                    <h1><b>Welcome to Pet Care!</b></h1>
                    <br>
                    <p style="color:gray;">"Pet grooming straight from the heart. Your pet - our passion, we care"</p>
                </div>
            </div>
        </div>
        </div>
        <div class="bottom-half"></div>
        <!-- <img src="public/static_system/assets/images/liner.png" class="liner" alt="Cat Image"> -->
        <img style="width: 400px;" src="public/static_system/assets/images/cat.png" class="cat" alt="Cat Image">
        <img style="width: 120px;" src="public/static_system/assets/images/paws.png" class="paws" alt="Cat Image">
        
    </div>




<?php require("layouts/footerFrontPage.php"); ?>