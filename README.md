# Composer Docker

Composer Docker is a simple plugin for building your project image.

## Getting Started

`composer require amirbilu/composer-docker`

Example `composer.json` (optional):

```json
{
  "extra": {
    "composer-docker":{
      "tags":[
        "tag1",
        "tag2"
      ],
      "path": "path/to/dockerfile"
    }
  }
}
```

### Options
* tags - defaults to none
* path - defaults to '.'

## Usage
Run `composer docker` (add -vvv for debugging information)

A good practice would be to add the above to post-install-cmd hook:

```json
{
   "scripts":{
        "post-install-cmd":[
            "composer docker"
        ]
    }
}
