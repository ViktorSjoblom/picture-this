# Picture This
<img src="https://media.giphy.com/media/w6pxsdH24ewG322Z2e/giphy.gif" width="100%">

### About

This is a project where we were suppose to build our own instagram copy. 

### Requirements

* As a user I should be able to create an account. 
* As a user I should be able to login.
* As a user I should be able to logout.
* As a user I should be able to edit my account email, password and biography.
* As a user I should be able to upload a profile avatar image.
* As a user I should be able to create new posts with image and description.
* As a user I should be able to edit my posts.
* As a user I should be able to delete my posts.
* As a user I should be able to like posts.
* As a user I should be able to remove likes from posts.

### Prerequisites

You need a server software, for example MAMP

### Installing

1. Clone the repository

```
$ git clone https://github.com/ViktorSjoblom/picture-this
```

2. Navigate to the folder where you cloned the repository via the terminal

3. Start a local server
```
php -S localhost:8000
```

4. Open up your favorite browser and enter localhost:8888/index.php in the url

5. Enjoy!


## Built With

* JavaScript Vanilla
* HTML
* CSS
* PHP

## Authors

* **Viktor Sjöblom**

## Testers

* [Andreas Pandzic](https://github.com/APandzic)
* [Viktor Puke](https://github.com/Vpuke)

## Code Review

* [Marcus Augustsson](https://github.com/MarcusIsCode)

```
1. There is a lot of folders some with repeating picture can be good to clean up if they aren't in use. in folder post/uploads

2. the interface for updating user information is a bit confusing, still nice with so many options but it doesn't seem like it wants to update profile picture.

3. you make good use of @param in functions which makes it easy to understand what your functions do.

4. on functions.php 169 it says "@return string" and you are missing that ":string" on line 172.

5. you are repetitive with a lot of statement like bindParam a suggestion could be to make it into a function

6. on store.php line 54 there is a redirect commented, not sure if it needs to be there

7. something to think about could be that FILTER_SANITIZE_STRING replaces quotes with something else and it can look strange if you were to use words that use them.

8. something to think about is to comment more like you have in login.php even thought you write nice and clean code that's easy to read

9. you check if use is logged in often with the function a suggestion would be to have it checked once then the user is able to reach user data etc but you do make secure instagram-clone

10. You write nice and readable code the page works fine and have a nice theme it's hard to find any faults with it i'm just picking crumbs when i wrote my comments and you have done a good jobb and deserves 10/10 likes 
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details


YRGO 2019


