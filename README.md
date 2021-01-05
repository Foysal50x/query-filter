# A elegant way to filter database based on query filter.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/faisal50x/query-filter.svg?style=flat-square)](https://packagist.org/packages/faisal50x/query-filter)
[![Build Status](https://img.shields.io/travis/faisal50x/query-filter/master.svg?style=flat-square)](https://travis-ci.org/faisal50x/query-filter)
[![Quality Score](https://img.shields.io/scrutinizer/g/faisal50x/query-filter.svg?style=flat-square)](https://scrutinizer-ci.com/g/faisal50x/query-filter)
[![Total Downloads](https://img.shields.io/packagist/dt/faisal50x/query-filter.svg?style=flat-square)](https://packagist.org/packages/faisal50x/query-filter)

This is a simple package, It's can boost your productivity, make your code cleaner as well as simple. 
## Installation

You can install the package via composer:

```bash
composer require faisal50x/query-filter
```

## Usage

#### Before

```php
 public function index($request){
    $query = User::query();
     if(request()->has('status')) {
        $query = $query->where('status', request()->get('status'));
     }
     if(request()->has('role')) {
        $query = $query->where('role', request()->get('role'));
     }
    $users = $query->get();
}
```
#### Now
``` php

public function index($request, UserFilter $filter){
    //It's nice and clean
    $users = User::filter($filter)->get();
}

// User Filter
use Faisal50x\QueryFilter\QueryFilter;

class UserFilter extends QueryFilter {

    public function status($query, $status){
        return $query->whereStatus($status);
    }
    
    public function role($query, $role){
        return $query->whereRole($role);
    }
    
}

```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email hello@imfaisal.me instead of using the issue tracker.

## Credits

- [Faisal Ahmed](https://github.com/faisal50x)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
