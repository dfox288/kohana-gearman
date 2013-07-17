Kohana 3.x Gearman Client & Worker
==================================

Implementation of Gearman Client & Worker, uses PECL Gearman


Requirements
------------

* PHP 5.4+
* Kohana 3.x
* Gearman (Tested with v1.1.8 on CentOS & Ubuntu)
* [PECL Gearman](http://www.php.net/manual/en/book.gearman.php) `pecl install
gearman`
* Optional: Kohana Minion module for running the Worker


TODO
----

* ~~Remove the need to add each Gearman task in the config file~~
* ~~Use a comma separated list of servers instead of an array in the config~~
* ~~Include Minion Worker Task~~
* Unit tests
* Allow the use of multiple Task methods (currently just the `Task::work()`)
* Automatically map each `Task::doMethod` in `GearmanWorker::addFunction`
* Method to get/store task uniqid and retrieve status/response (Maybe use ORM?)
* Document the setup and create a couple of working examples (inc. using Minion)


Contributors
------------

* [Daniel Macedo](https://github.com/dm)
* [Kiall Mac Innes](https://github.com/kiall)
* [Prof Syd Xu](https://github.com/bububa)
* [Woody Gilk](https://github.com/shadowhand)
* [XiBao](https://github.com/xibao)


Copyright/License
-----------------

Copyright © Kiall Mac Innes et al.

Licensed under [Kohana License](http://kohanaframework.org/license).
