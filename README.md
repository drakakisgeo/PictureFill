PictureFill
===========

PHP Helper for PictureFill [Laravel 4.1]

## What is it?

The basic idea is simple, I wanted to write one line of code and generate the huge block of html that PictureFill expects to find so it can dynamically load a different image according end user's screen size. If you want to learn more about PictureFill.js just visit https://github.com/scottjehl/picturefill

### In action

You can see a live example on the http://www.laravel.gr homepage.


## Why to use it?

Instead of this (yeah, you' ve got to do this for each picture)

```html
 <span data-picture data-alt="A giant stone">
        <span data-src="mypic_small.jpg"></span>
        <span data-src="mypic_medium.jpg"     data-media="(min-width: 400px)"></span>
        <span data-src="mypic_large.jpg"      data-media="(min-width: 800px)"></span>
        <span data-src="mypic_extralarge.jpg" data-media="(min-width: 1000px)"></span>

        <!-- Fallback content for non-JS browsers. Same img src as the initial, unqualified source element. -->
        <noscript>
            <img src="mypic_small.jpg" alt="A giant stone">
        </noscript>
    </span>
```

you just need to write this

```php
PictureFill::make("mypic.jpg","A giant stone")
```

You may wonder how you can set the media queries or the different variations of images? ( _small, _medium e.t.c)

There is a config file

```php
    return [
    'default'=>[
        ["_small","(max-width: 640px)"],
        ["_medium","(min-width: 641px)"],
        ["_large","(min-width: 1025px)"],
        ["_xlarge","(min-width: 1441px)"]

    ]

    ];
```
You set the file name suffix, and the media query that will trigger it.

And what if...you need to parse a different array at runtime?

```php
PictureFill::make("mypic.jpg","A giant stone", $differentsetup)
```

## Usage

To try this out:

Begin by installing the package through Composer.

```js
require: {
    "lollypopgr/picture-fill": "dev-master"
}
```

Next, add the service provider to `app/config/app.php`.

```php
'providers' => [
    // ..
    'Lollypopgr\PictureFill\PictureFillServiceProvider'
]
```

```php
'aliases' => [
    // ..
    'PictureFill' =>'Lollypopgr\PictureFill\PictureFill'
]
```

That's it! You're all set to go.
