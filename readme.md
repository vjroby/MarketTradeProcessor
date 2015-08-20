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
The message will be save in a database and put in the Redis queue. A Node.Js server is listening for the Redis messages.
When a message is sent the Node.Js will sent the message through web socket using Socket.Io to all front end clients.
The user will see the nea message in the list with an explanatory information.

Accepts JSON object in this structure

        {
          "userId": "433",
          "currencyFrom": "RON",
          "currencyTo": "GBP",
          "amountSell": 1200,
          "amountBuy": 747.1,
          "rate": 12.71,
          "timePlaced": "1-JUL-11 10:27:44",
          "originatingCountry": "RO"
        }


If the request was successful an HTTP CREATED (201) will be sent back.
In case of a validation error an HTTP BAD REQUEST (401) will be sent with an explanatory message of the error.
In case of an authorization error an HTTP UNAUTHORIZED (400) will be sent.

The type of security is very basic a JWT will be sent in a header key `X-Authorization` and the same JWT is set on the server.
The JWT can be set to expire and be created with user credentials or other type of Oauth 2.0

The API method for getting the messages is GET /message ,it will return all the messages from the database.
When the user enters in the view-messages page an AJAX call will be made to the server to get the messages.
It uses `csrf` as a security method for AJAX reuqests.

The tests are run using PHPUnit 4.8.3. Just run `phpunit` in the root of the project.

Improvement features:

- Oauth 2.0 implementation for APIs securities with JWT
- Multiple views of messages
- Search and pagination implementation in view messages
- Sorting of messages
