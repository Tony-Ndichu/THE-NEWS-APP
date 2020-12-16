## NoMore 2020 Front-end OR FullStack developer test
# The News App

# The Task I picked: Task Option 2: Fullstack (Laravel + Vue)

[Link to live application running on Heroku](https://tonys-news-app-generator.herokuapp.com/)
## Time taken

- 7 days

## How to run the app locally

- clone this repository `git clone https://github.com/Tony-Ndichu/THE-NEWS-APP.git`
- cd into the folder `cd THE-NEWS-APP`
- run `npm install`
- run `composer install`
- create a `.env` file `touch .env`
- copy the following values to the `.env` file
    - APP_ENV=development
    - APP_KEY=base64:L3haVZZ7ITr92A2+6BdCgCfMk3IGbi3mvo6bBv/GKPw=
    - APP_URL=http://localhost
    - DB_CONNECTION=mysql
    - DB_CONNECTION_2=mysql_2
    - DB_DATABASE=thenewsapp
    - DB_DATABASE_2=thenewsapptest
    - DB_HOST=34.121.115.5
    - DB_PASSWORD=rootpassword
    - DB_PORT=3306
    - DB_USERNAME=root

- make the file `setup.sh` executable `chmod +x setup.sh`
- run the file `./setup.sh` and wait for the message `Cron Job Ended` to show on the terminal
- run `php artisan serve`
- visit `localhost:8000`
- voila, presenting **The News App**

## Testing the app

- create a `.env.testing` file `touch .env.testing`
- copy the following values to the `.env.testing` file
    - DB_CONNECTION=mysql
    - DB_HOST=34.121.115.5
    - DB_PORT=3306
    - DB_DATABASE=thenewsapptest
    - DB_USERNAME=root
    - DB_PASSWORD=rootpassword

- run the command `php artisan optimize` 
- finally run the command `php artisan test`
## Improvements added
### Laravel BackEnd 

- added a laravel backend to better manage and scale the application
- added a mysql instance to enable persistence. The mysql instance is hosted on gcloud for maximum availability
- integrated a [live news api](https://newsapi.org/) that shows users rich real time news including images, author name, links to the news and date of publishing
- added a cron job and artisan command `php artisan news:fetch` that updates the database with new news every 24 hours to ensure users get only the latest news
- added unit tests


### VueJS FrontEnd

- implemented typescript
- used Vue-decorators instead of basic JS approach 
- switched to grid design to improve the ui
- made the site responsive to both mobile and desktop
- enriched user experience by adding pagination
- added a loader to ensure the user is aware when the app is fetching data
- added images and fontawesome icons to enrich the UI and UX

## What I would do if I had more time

- added more endpoints to the api including filtering the news by topic
- added more robust tests
- added optimizations to make the integration with the news api faster
- added a richer frontend design in terms of styling, typography and colors
- made the app more secure by adding some of the more sensitive credentials to the environment variables
- hosted the app on gcloud for maximum availability and optimized load times.
 