Welcome to Nominus.

# Installation & Usage

Install package via composer:

```bash
composer require rflex/nominus
```

Import class and instantiate it:
```php
use Rflex/Nominus;

public function test(string $token, string $holdingUUID) {
    $nominus = new Nominus($token, $holdingUUID);
}
```


# Available methods

## Current holding
Retrieve the holding with which you are working.
```php
$nominus->holding->current();
```

## Holding branches
Get the list of the holding's branches.
```php
$nominus->holding->branches();
```

## Holding organizations
Get the list of the holding's organizations.
```php
$nominus->holding->organizations();
```
