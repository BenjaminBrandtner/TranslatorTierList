# API
## Youtube API

https://developers.google.com/youtube/v3/getting-started
https://developers.google.com/youtube/v3/docs/

You need a Google Account and have to request an API key. Manage here: https://console.developers.google.com/apis/

There is a php-Client for Google APIs, developed by Google:
https://github.com/googleapis/google-api-php-client

Every request to the API consumes at least one point of quota. You get 10.000 quota points per day.

- A read operation that retrieves a list of resources -- channels, videos, playlists -- usually costs 1 point.
- A search request costs 100 points.

### Request Parameters

Required: part One Resource has multiple parts (basically, sets of information). You have to specify, which part you
want to retrieve.

Optional: filter Filter down exactly which resources you want.

### Pitfalls

https://developers.google.com/youtube/v3/docs/channels/list
It's not documented anywhere, but for this request you can only specify a maximum of 50 channel ids in the id filter.
