# php-hasher
A simple PHP Hasher to ensure data validity received from a client.

## Usage

### Instantiation

```php
$hasher = new Snailweb\Utils\Hasher('secret key', 'secret prefix', 'secret suffix', 'sha256');
```

### Hash data to send
```php
$hasher->hash('my data');
```

### Check data validity of received data
```php
$hasher->checkSum($receivedHash, $receivedData);
```
