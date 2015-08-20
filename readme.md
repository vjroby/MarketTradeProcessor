Market Trade Processor
======================

Technologies used:

- Laravel 5.1 PHP Framework
- Blade as a template engine
- Twitter Bootstrap 3.2
- jQuery 1.11
- Node.Js
- Socket.IO
- Redis as a queueing system
- MySQL 5.6
- PHPUnit 4.8 for running tests
- Vagrant Ubuntu 14 64bit box
- Jmeter 2.3 and Postman (Chrome extension) for API testing

The project was develop in a Vagrant box.
The API method for receiving messages is POST /message.
Accepts JSON object in this structure

```
{}

```
If the request was successful an HTTP CREATED (201) will be sent back.
In case of a validation error an HTTP BAD REQUEST (401) will be sent with an explanatory message of the error.
In case of an authorization error an HTTP UNAUTHORIZED (400) will be sent.



The API method for getting the messages is GET /message

Improvement features:

- Oauth 2.0 implementation for APIs securities with JWT
- Multiple views of messages
- Search and pagination implementation in view messages
- Sorting of messages
- 
