# Translator Tier List

A place where fans like you and me can share and discover Youtube channels that translate content from
[Virtual Youtubers](https://en.wikipedia.org/wiki/Virtual_YouTuber) into English. The quality of the translations are rated by the community and categorized into different tiers.

## Setting up local development
Install a web server, [composer](https://getcomposer.org/) and [npm](https://yarnpkg.com/)

Clone the repo: `git clone https://github.com/BenjaminBrandtner/TranslatorTierList.git`  
Copy .env.example to .env  
Fill in configuration data into the .env file. Refer to the next section for what data you need.  
If you have a Laravel Nova license, copy the source code into nova_src, overwriting the dummy composer.json file. If not, leave it be, it will run fine without Nova.

Run these commands. Installing the dependencies will take a while.
```
composer install
php artisan key:generate
php artisan migrate:fesh --seed
```
The last command will create the database structure and seed it with a few Translation Channels.

Change into the frontend directory  
Copy .env.example to .env  
Adjust VITE_TTL_BASE_URL if the backend won't be running on localhost 

Run these commands:
```
npm install
npm run build
```

Change back into the root project directory  
Run `php artisan serve`

The backend is now running and will serve the frontend files you just built and answer API calls on localhost.

If you want to work on the frontend, open another console in the frontend directory and start the development server with `npm run dev`

### Filling .env
Fill in the details of your local database server. Alternatively, you can use a [filesystem-driven (SQLite) database](https://laravel.com/docs/8.x/database#configuration).  
If you want to work on anything that calls the Youtube API you'll need to [get an API Key](https://support.google.com/googleapi/answer/6158862?hl=en) for the Youtube Data API. Fill in the YOUTUBE_API_KEY. When you finished the steps for setting up local development, run `php artisan translationChannels:update` to update the channels in the database with the newest info from Youtube.
