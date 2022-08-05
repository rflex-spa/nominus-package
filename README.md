Welcome to Nominus.

# Installation & Usage

Install package via composer:

```bash
composer require rflex/nominus
```

Set environment variable:
```bash
NOMINUS_URL=https://nominus.example.com
```

Import class and instantiate it:
```php
use Rflex/Nominus;

public function test(string $bearerToken, string $holdingUUID) {
    $nominus = new Nominus($bearerToken, $holdingUUID);
}
```


# Available methods

## Holding

### Current holding
Retrieve the holding with which you are working.
```php
$nominus->holding->current();
```

### Holding branches
Get the list of the holding's branches.
```php
$nominus->holding->branches();
```

### Holding organizations
Get the list of the holding's organizations.
```php
$nominus->holding->organizations();
```

### Holding information
Retrieve the complete list of information from a holding.
```php
$nominus->holding->info();
```

## Branches
### By Id
Get one branch by its id.
```php
$nominus->holding->branch->getById($branchId);
```

### Branch areas
Get all branches of an area.
```php
$nominus->holding->branch->areas($branchId);
```

## Organizations
### By id
Get organization by its id.
```php
$nominus->holding->organization->getById($organizationId);
```

### By code
Get organization by its code.
```php
$nominus->holding->organization->getByCode($organizationCode);
```

### Organization companies
```php
$nominus->holding->organization->companies($organizationId);
```

### Organization areas
```php
$nominus->holding->organization->areas($organizationId);
```

### Organization products
Get the activated rFlex products for this organization.
```php
$nominus->holding->organization->products($organizationId);
```

### Organization product integrations
Check if a rFlex product for the organization has any integration with another platform.
```php
$nominus->holding->organization->productIntegrations($organizationId, $productId);
```

## Areas
### By id
Get area by its id.
```php
$nominus->holding->organization->areas->getById($organizationId, $areaId);
```

### By multiple ids
Get areas by them ids.
```php
$nominus->holding->organization->areas->getByIds($organizationId, [$areaId1, $areaId2, $areaId3]);
```

### Area branches
Get the branches of an area.
```php
$nominus->holding->organization->areas->branches($organizationId, $areaId);
```
