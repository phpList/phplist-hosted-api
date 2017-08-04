# phplist-hosted-api

SOAP API for phpList.com Hosted accounts. This API is not supported by self-hosted versions of phpList (see the REST API v1&2).

## Requirements

### Account

+ A phpList hosted account (freely available at [phpList.com](http://phplist.com/signup))
+ Enable API support for your account (request access from [your account](https://phplist.com/contactus))

### Clients

#### PHP

+ A client library which implements the API is `phplistHostedClient.class.php`
  + A copy of [NuSoap PHP](https://sourceforge.net/projects/nusoap/)'s /lib directory is required by the PHP client library and should be located within the same directory
+ An example implementation of the PHP client library is `APIexample.php`

## Usage

See soap-api-\*.md for usage documentation in API Blueprint format.
