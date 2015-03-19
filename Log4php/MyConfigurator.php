<?php
class MyConfigurator implements LoggerConfigurator {
	
    public function configure(LoggerHierarchy $hierarchy, $input = null) {
 
        // Create an appender which logs to file
        $appFile = new LoggerAppenderFile('foo');
        $appFile->setFile('logfiles/log.txt');
        $appFile->setAppend(true);
        $appFile->setThreshold('all');
        $appFile->activateOptions();
        
        // Use a different layout for the next appender
        $layout = new LoggerLayoutPattern();
        $layout->setConversionPattern("%date %logger %msg%newline");
        $layout->activateOptions();
        
        // Create an appender which echoes log events, using a custom layout
        // and with the threshold set to INFO 
        $appEcho = new LoggerAppenderEcho('bar');
        $appEcho->setLayout($layout);
        $appEcho->setThreshold('info');
        $appEcho->activateOptions();
        
        // Add both appenders to the root logger
        $root = $hierarchy->getRootLogger();
        $root->addAppender($appFile);
        $root->addAppender($appEcho);
    }
}
?>