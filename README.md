# phplist-hosted-api

SOAP API for phpList.com Hosted accounts. This API is not supported by self-hosted versions of phpList (see the REST API).

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

Access URLs use the following format:

`https://www.phplist.com/API/soap.php?wdsl&tag=[installation]&user=[account email]&pass=[account password]`

[installation] is the name of the phpList account to use (the account name is stated on the [Account page](https://phplist.com/myaccount) of each phpList account). For the WSDL, add "&wsdl" to the above URL.

Documentation of supported functions is provided in soap-api-\*.md in API Blueprint format.
