 <?php
// Include and configure log4php
include('log4php/Logger.php');

 
$configuration = array(
    'foo' => 1,
    'bar' => 2
);
 
// Passing the configurator as string
Logger::configure($configuration, 'log4php\MyConfigurator');
 
// Passing the configurator as an instance
Logger::configure($configuration, new MyConfigurator());
 ?>