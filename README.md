# To-Dos/Problems/What could have gone better:
## Routing and Responses:
I'm used to using at least something like Slim which facilitates routing and working with actual responses.  
In order to not lose any time, I've decided to just return the JSON body with PHP's built-in HTTP functions along with some headers.  
This is **not** how I would usually do it and that bugs me.

## What could be improved:
* routing
* docker-compose:
    * depends_on, healthchecks, environment vars
    * create own images, push them to a registry and pull them from there
    * restart policies and configuration for zero-downtime deployment
* tests:
    * way more tests, integration tests
    * mutation tests
* code:
    * value objects or models
* database:
    * introduce a user_medications table and change the data and logic accordingly
* security/authorization:
    * use a proper authorization mechanism, e.g. JWT
    * you could add custom fields to a JWT, e.g. the user_id or a scope/rights (normal user <-> pharmacist)
    * could be handled by a middleware
* **Swagger** requests, or rather their responses, aren't working right, probably due to the less-than-ideal API responses
* Logging and monitoring are not implemented
* phpstan and the codefixer are not yet configured/ready to run


## General notes:
* Error handling/Exceptions:  
  I've seen this approach somewhere and just thought it was neat. I know that exception-driven code   
  *might* be more difficult to understand, at times and takes up a tiny bit more processing power, given that   
  exceptions sometimes need to bubble up from deep inside the code. You could, however, handle many different exceptions the same way, e.g. group them together according to their status code and have a ResponseBuilder/JsonFormatter return the errors in a similar fashion
* I've used guzzle **just** for having Request and Response objects since I couldn't get the http extension to work in the beginning and I didn't want to lose more time.
    * That's also the reason why the exceptions don't extend HttpException, yet.

## Frameworks
Using Slim would have worked nicely for such a project since it provides all the necessary basics in a short and simple way. I seem to recall that there's a Symfony API repo/skeleton that would have created the routing and simple Actions/Controllers and I'd guess that Lumen offers an equally fast setup.




# About the API
## How to
Start up the project:

    make up

Swagger is available under http://localhost:8081/#/
See "What could be improved" to find out why the requests are not returning the right response.. So you'd need to resort to Postman.
