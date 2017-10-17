# Pico y Placa predictor

This exercise was created as a web app, using MVC software architectural pattern.
This exercise was solved using:

1. Laravel 5.5.14
2. Php 7.0.22
3. Javascript (jquery)
4. Css  
5. Bootstrap 
6. Phpunit 
7. OS ubuntu 


Most of the files inside this repositories are from Laravel skeletor, the files with the actual solution are: 


######Controller
- prediction_p_p-master/app/Http/Controllers/PicoPlacaMainController.php

######Model
- prediction_p_p-master/app/Models/PicoPlacaPredictorModel.php

######View 
- prediction_p_p-master/resources/views/main.blade.php

######Routes
- prediction_p_p-master/routes/web.php

######Unit Test
- prediction_p_p-master/tests/Features/TestPicoPlaca.php


### Install and test exercise 

1. Download .ova
2. Load .ova in virtual box
3. Turn on the virtual machine
4. Virtual machine password: ruby12345
5. To start the app 
  - Go to naty@rubyvm:~/phpProjects/pico-placa-projects and run php artisan serve
![alt text](https://github.com/natykn/prediction_p_p/blob/master/imageReadme/terminal1.png)


###### Preview
![alt text](https://github.com/natykn/prediction_p_p/blob/master/imageReadme/responsePicoPlaca.png)

6. To run unit test
 - Go to naty@rubyvm:~/phpProjects/pico-placa-projects and run vendor/bin/phpunit
![alt text](https://github.com/natykn/prediction_p_p/blob/master/imageReadme/terminal2.png)



###Note 
 - if you want to see some web application screenshots, go to imageReadme folder.
