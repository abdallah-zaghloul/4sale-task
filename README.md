<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<h1>4Sale Task</h1>

<h2>Live Demo</h2>
<strong>Please watch this video 👇</strong>

[![Live Demo](https://img.youtube.com/vi/D0B7YzCT3RM/0.jpg)](https://www.youtube.com/watch?v=D0B7YzCT3RM)

<h2>Task Description</h2>

<pre>
<strong>Challenge Idea</strong>
------------------------------

For Backend Application (Senior Backend)
We have two providers collect data from them in json les we need to read
and make some filter operations on them to get the result
• DataProviderX data is stored in [DataProviderX.json]
• DataProviderY data is stored in [DataProviderY.json]

DataProviderX schema is
{
    parentAmount:200,   
    Currency:'USD',
    parentEmail:'parent1@parent.eu',
    statusCode:1,
    registerationDate: '2018-11-30',
    parentIdentification: 'd3d29d70-1d25-11e3-8591-034165a3a613'
}

we have three status for DataProviderX
• authorised which will have statusCode 1
• decline which will have statusCode 2
• refunded which will have statusCode 3
DataProviderY schema is
{
    balance:300,
    currency:'AED',
    email:'parent2@parent.eu',
    status:100,
    created_at: '22/12/2018',
    id: '4fc2-a8d1'
}

we have three status for DataProviderY
• authorised which will have statusCode 100
• decline which will have statusCode 200
• refunded which will have statusCode 300

<strong>Acceptance Criteria</strong>
-----------------------------------

Using PHP Laravel, implement this API endpoint:
• it should list all users which combine transactions
from all the available providerDataProviderX and DataProviderY)

• it should be able to filter result by payment providers 
for example /api/v1/users?provider=DataProviderX it should return users from DataProviderX

• it should be able to filter result three statusCode
(authorised, decline, refunded) for example /api/v1/users?statusCode=authorised 
it should return all users from all providers that
have status code authorised

• it should be able to ler by amount range 
for example /api/v1/users?balanceMin=10&balanceMax=100 
it should return result between 10 and 100 including 10 and 100

• it should be able to filter by currency
• it should be able to combine all this filters together

<strong>The Evaluation</strong>

Task will be evaluated based on
1. Code quality
2. Application performance in reading large les
3. Code scalability : ability to add DataProviderZ by small changes
4. Unit tests coverage
5. Docker
</pre>


<h2>Project Infra Structure</h2>
<ul>
<li> The Project is a Decoupled Modular Monolithic App :
    HMVC Modules (you can turn on/off each module and republish/reuse it at another project)
<p>
<a target="_blank" href="https://drive.google.com/uc?export=view&id=1bm9ravd4eUSwu-qjnE3x1O42zTT2Lrlq">
<img src="https://drive.google.com/uc?export=view&id=1bm9ravd4eUSwu-qjnE3x1O42zTT2Lrlq">
</a>

<a target="_blank" href="https://drive.google.com/uc?export=view&id=1ehlCX18KliEDFMe7pqkKTJIJDDVeKIhq">
<img src="https://drive.google.com/uc?export=view&id=1ehlCX18KliEDFMe7pqkKTJIJDDVeKIhq">
</a>
</p>

<li> Module Structure (Repository Design Pattern)
<p>
<a target="_blank" href="https://drive.google.com/uc?export=view&id=1snsMfaRDm6hW-uOmEus4e6ZVi35rBlqO">
<img src="https://drive.google.com/uc?export=view&id=1_CTRCCiZ0X4nG06_xTv48y6MH5vBb1gx">
</a>
</p>

<li> Separated/Attached Tests
<p>
<a target="_blank" href="https://drive.google.com/uc?export=view&id=11hd7ACMLYU9WcTXBD5Eo_7mOBdM20I6M">
<img src="https://drive.google.com/uc?export=view&id=11hd7ACMLYU9WcTXBD5Eo_7mOBdM20I6M">
</a>
</p>
</ul>

<h2>Solution Implementation</h2>
<strong> Database Choice (PostgreSQL): </strong>
<table>

<th></th>
<th>PostgreSQL</th>
<th>MySQL</th>
<th>MariaDB</th>

<tr>
<td>UUID datatype</td>
<td>Built-in</td>
<td>Not supported</td>
<td>Supported at last version</td>
</tr>

<tr>
<td>JSON datatype</td>
<td>JSONB</td>
<td>JSON</td>
<td>Long Text</td>
</tr>

<tr>
<td>ENUMs</td>
<td>Checks & Enums</td>
<td>Enums</td>
<td>Enums</td>
</tr>

</table>
<pre>
  PostgreSQL: is the most suitable for this situation because of :
  - UUID Support as PK as a built-in datatype instead of :
     * MySQL: deals with it as string or string-to-binary conversion <a href="https://forums.mysql.com/read.php?24,700512,700514">Bad Performance</a>
     * MariaDB: support UUID data-type at last version only with no support for JSON
  - JSONB (JSON Binary): support processing on JSON and array indexes (if needed later on)
  - Checks (Check Constrains) : is the best to be used for Scalability because :
    * better than multiple Joins
    * no needs/risks to alter schema as with ENUM
    * <a href="https://making.close.com/posts/native-enums-or-check-constraints-in-postgresql">scalable - more performant</a>
</pre>

<strong> How to Query ?</strong>

- Repository Design Pattern => for complex queries
- skip invalid query params
- query run acc to count of params ex : (1 => where, +1 =>whereIn)
- rely on Checks (described above) for well-defined values as currency, provider status, providers
- separated Query layer called (Criteria) => single responsibility & re-usability & remove tight coupling
- use eloquent builder instead of ORM
- use Joins instead of whereHas('run exists query')
- use cursorPagination (rely on PHP generators) => can afford large database streaming & avoid memory leak
- cache can be enabled and disabled
- finally : we should use elastic search => I will learn it with your team

<strong>Separated Unit/Feature tests</strong>

- tested at about 10 million records (users/transactions) using laravel Benchmark
- implement both feature/unit tests

  <a target="_blank" href="https://drive.google.com/uc?export=view&id=1rc_Ei6KBmQAEmvjVmoPN7XBGxPn_eZNk">
  <img src="https://drive.google.com/uc?export=view&id=1rc_Ei6KBmQAEmvjVmoPN7XBGxPn_eZNk"></a>

<strong>Docker</strong>

- app is dockerized using laravel sail


<strong>Bonuses</strong>

- implement search for multiple comma query params for the same param ex :
    statusCode=authorised,200,refunded
- skip invalid query params
- control pagination count (max=1000) ex :
    paginationCount=200

<strong>Criteria Benefits</strong>
- scalable: you can add any filter at anytime on the same query
- maintainable & re-usable
- fluent builder design pattern for easy chaning
- you can skip it and call another one
- it can be passed from module to another
- can be extended for another API ex: show user that have the current transactions by ID


  <a target="_blank" href="https://drive.google.com/uc?export=view&id=1EUgSrZdEw-n51Lg_YX_b4Z3eK4WKDJcz">
  <img src="https://drive.google.com/uc?export=view&id=1EUgSrZdEw-n51Lg_YX_b4Z3eK4WKDJcz"></a>

  <a target="_blank" href="https://drive.google.com/uc?export=view&id=1qw7oDkzMgojYbDlfPEJjK9XK6bxufo3I">
  <img src="https://drive.google.com/uc?export=view&id=1qw7oDkzMgojYbDlfPEJjK9XK6bxufo3I"></a>


<h3>How To Run The Project Locally</h3>
<pre>
Requirements (all can be installed automatically using docker desktop):
---------------
- PHP 8.2
- Run Docker Desktop
- PostgreSQL
- SQL lite PHP Extension

* you will find the postman collection at the project root files:
  4Sale-task.postman_collection.json

<hr>
Run the following at the project root dir Terminal
---------------
<ul>
<li>Download Vendor folder
composer install

<li>Make Sail alias
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

<li>Generate .env file from .env.decrypted:
php artisan env:decrypt --key=base64:PtOlApk/cv8f9pSWmmasyCmKJ+nAkvUrIKeAGNAl0HQ=

<li>Laravel Sail install
php artisan sail:install

<li>Run Your local server up:
sail up -d

<li>Run Your local server down:
sail down

<li>To Run Unit/Feature Tests but configure your test with xdebug
sail php artisan test --testsuite={Modules or ModuleName}
</ul>

if you have an issue you can see <a href="https://laravel.com/docs/10.x/sail">Laravel Sail</a>
</pre>

