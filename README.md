# php-hasher
A simple PHP Hasher to ensure data validity received from a client.

## Usage

### Instantiation

`$hasher = new Snailweb\Utils\Hasher('secret key', 'secret prefix', 'secret suffix', 'sha256');`

### Hash data to send
`$hasher->hash('my data');`

### Check data validity of received data
`$hasher->checkSum($receivedHash, $receivedData);`
