# PHP User IP Address library

[![N|Solid](http://www.itechempires.com/wp-content/uploads/2017/07/logo.png)](http://www.itechempires.com/)

PHP User IP Address Class Library is used to get current User IP Address and valiated given IP address.

### Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install PHP UserIP library Use following command:

    $ composer require yogeshkoli/user-ip

Or you can also clone the complete repository with Git Use following command:

	$ https://github.com/yogeshkoli/user-ip.git

### Requirements

This library is supported by PHP versions 5.6

### Available Methods

Available methods in this library:

```php
UserIP::get();
UserIP::validate($ip);
```
### How to Use this package? 
Here is sample examples of using this package:
#### Get User IP Address:
```php
 <?php

require __DIR__ . '/../vendor/autoload.php';

use YogeshKoli\UserIP\UserIP;

var_dump(UserIP::get());
```
Output:
```php
/example/UserIPTest.php:7:string '192.168.10.1' (length=12)
```
#### Validated Given IP Address:

```php
<?php

require __DIR__ . '/../vendor/autoload.php';

use YogeshKoli\UserIP\UserIP;

$ip = '192.168.10.1';

var_dump(UserIP::validate($ip));
```
Output:
```php
/example/ValidateIPTest.php:9:boolean true
```

### Contribute
1. Check for open issues or open a new issue to start a discussion around a bug or feature.
1. Fork the repository on GitHub to start making your changes.
1. Write one or more tests for the new feature or that expose the bug.
1. Make code changes to implement the feature or fix the bug.
1. Send a pull request to get your changes merged and published.

This is intended for large and long-lived objects.

### License

This project is licensed under **MIT license**. See the [LICENSE](LICENSE) file for more info.

### Copyright

2017 Yogesh Koli, [yogeshkoli.com](http://www.yogeshkoli.com/)

If you find it useful, let me know :wink:

You can contact me on [Twitter](https://twitter.com/iyogeshkoli) or through my [email](mailto:info@yogeshkoli.com).