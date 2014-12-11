# Laracasts Feed 

**API for fetching RSS feed from Laracasts and returning it as JSON with some extra features**

This application fetches the Laracasts XML RSS feed and converts it to JSON format. 
By doing so I can fetch the feed with React.js in my latest chrome extension.

## Caching

To prevent abuse this application (API) caches responses for 30 minutes.

**I suggest that the app that consumes this API has a waiting period of 1 hour.**

## API

### GET Feed

**URL:** `laracasts-feed.mariobasic.com/api/v1/feed`

> Returns lessons and series from current feed from Laracasts in JSON.

Attributes for each lesson or series from feed:

- title: **string**
- summary: **string**
- link: **string** (Link to that lesson or series)
- type: **string** (Returns if the item is a lesson or series)

_Example output:_

```
[
    {
        "title": "Code Katas in PHP",
        "summary": "If martial artists use kata as a method for exercise and practice, what might be the equivalent for coders, like us? Well, code katas are short, repeatable programming challenges, which are meant to exercise everything from your focus, to your workflow. ",
        "link": "https:\/\/laracasts.com\/series\/code-katas-in-php",
        "type": "series"
    },
    {
        "title": "Tennis Scoring",
        "summary": "Let's tackle the tennis scoring kata. If you're familiar with the game, you'll know that the rules can be a bit tricky. As such, this will make for a great exercise!\ \ View the source for this code kata on GitHub.",
        "link": "https:\/\/laracasts.com\/series\/code-katas-in-php\/episodes\/5",
        "type": "lesson"
    }
    ...
]
```

### GET Lessons only

**URL:** `laracasts-feed.mariobasic.com/api/v1/feed/lessons`

> Returns only the lessons from the current feed from Laracasts in JSON.

Attributes for each lesson or series from feed:

- title: **string**
- summary: **string**
- link: **string** (Link to that lesson or series)
- type: **string** (Returns if the item is a lesson or series)
- date: **string** (Date when the lesson was updated in format DD.MM.YYYY (23.12.2014))

_Example output:_

```
[
    {
        "title": "Tennis Scoring",
        "summary": "Let's tackle the tennis scoring kata. If you're familiar with the game, you'll know that the rules can be a bit tricky. As such, this will make for a great exercise!\ \ View the source for this code kata on GitHub.",
        "link": "https:\/\/laracasts.com\/series\/code-katas-in-php\/episodes\/5",
        "type": "lesson",
        "date": "10.12.2014"
    },
    {
        "title": "Exercise: A Command-Line Task App",
        "summary": "Let's put everything we've learned so far to work, as we build a fun little task app that runs on the command line. \ \ View the source for this lesson on GitHub.",
        "link": "https:\/\/laracasts.com\/series\/how-to-build-command-line-apps-in-php\/episodes\/6",
        "type": "lesson",
        "date": "06.12.2014"
    }
    ...
]
```

## Postman collection

If you are using Postman use this public link to add this API:

`https://www.getpostman.com/collections/e6a73bdd0071327127ae`


