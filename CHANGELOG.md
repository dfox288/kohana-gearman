CHANGELOG
---------

### Automate the compilation of available Gearman tasks

* Remove the need to add the Gearman tasks in the config file
* Set a Worker function timeout globally in the config
* Allow the overwrite of this timeout in each Task
* Added Minion Worker Task (Kohana Minion Module)


### Use string for servers config

* Use string for servers like PECL GearmanClient::addServers() instead of array
* Move classes into Gearman folder (due to collisions w/Minion Tasks folder)
* Remove netbeans files and make/build


### Prepared PHPUnit

* Started a bootstrap & phpunit.xml with a basic autoloader (although probably
Kohana will be required)
* Renamed the test files
* Minor whitespace fixes


### Kohana 3.3 compatibility

* Update filenames for PSR-0


### Merge branch from shadowhand & xibao

* refs/remotes/shadowhand/bugfix/upgrade-userguide:
* Upgraded user guide for Kohana 3.2
* Add libgearman as a dependancy
* Bump changelog version number
* Adding gitignore, fixing mistaking in install file...
* Simplier build...
