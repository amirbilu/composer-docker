# Composer Docker

Composer Docker is a simple plugin for building your project image.

## Getting Started

`composer require amirbilu/composer-docker`

## Useage

Example `composer.json`:

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

Then run `composer docker` (add -vvv for debugging information)

A good practice would be to add the above to post-install-cmd hook:

```json
{
   "scripts":{
        "post-install-cmd":[
            "composer docker"
        ]
    }
}
