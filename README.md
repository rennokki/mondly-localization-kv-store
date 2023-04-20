# Mondly Localization KV Store

To compare all the business logic related code (excluding default commits for framework files): [6555ecd...HEAD](https://github.com/rennokki/mondly-localization-kv-store/compare/6555ecd...HEAD)

## Octane

### ZIP download with Octane

Particulary, I would have used Octane to process all locales at once with Swoole's Coroutines via Octane, so that I can build the ZIP archive faster.

### Caching

Usually, I use [renoki-co/laravel-eloquent-query-cache](https://github.com/renoki-co/laravel-eloquent-query-cache) to cache the queries and handle automatic invalidations.

With Octane, I could have also been using Swoole's internal key-value cache to speed up the things a bit, reducing the need of an external cache driver.
