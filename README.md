<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<h1>Project Title</h1>

<h2>Live Demo</h2>
<strong>Please watch this video 👇</strong>

[![Live Demo](image_link)](video_link)
<ul> Please check the following:
<li> To DO
</li>
</ul>

<h2>Project Infra Structure</h2>
<ul>
<li> The Project is a Decoupled Modular Monolithic App :
    HMVC Modules (you can turn on/off each module and republish/reuse it at another project)
<p>
<a target="_blank" href="https://drive.google.com/uc?export=view&id=1DT3YIcfRSaU_SeiSzPht_vljOWu745Sr">
<img src="https://drive.google.com/uc?export=view&id=1DT3YIcfRSaU_SeiSzPht_vljOWu745Sr" width="200" height="200">
</a>

<a target="_blank" href="https://drive.google.com/uc?export=view&id=18jSzl7SrJKevpDNko9kgWgvZLWJwXK_Y">
<img src="https://drive.google.com/uc?export=view&id=18jSzl7SrJKevpDNko9kgWgvZLWJwXK_Y" width="200" height="200">
</a>
</p>

<li> Module Structure (Repository Design Pattern)
<p>
<a target="_blank" href="https://drive.google.com/uc?export=view&id=1_CTRCCiZ0X4nG06_xTv48y6MH5vBb1gx">
<img src="https://drive.google.com/uc?export=view&id=1_CTRCCiZ0X4nG06_xTv48y6MH5vBb1gx" width="400" height="200">
</a>
</p>

<li> Separated/Attached Tests
<p>
<a target="_blank" href="https://drive.google.com/uc?export=view&id=1JzE_2ZtJXvIZjWXmb_tZUAmE3gsHgdD4">
<img src="https://drive.google.com/uc?export=view&id=1JzE_2ZtJXvIZjWXmb_tZUAmE3gsHgdD4" width="200" height="200">
</a>
</p>
</ul>

<h2>Import Solution Implementation</h2>
<pre>

</pre>

<h3>How To Run The Project Locally</h3>
<pre>
Requirements (all can be installed automatically using docker desktop):
---------------
- PHP 8.2
- Run Docker Desktop
- MYSQL
- SQL lite PHP Extension

<hr>
Run the following at the project root dir Terminal
---------------
<ul>
<li>Download Vendor folder
composer install

<li>Make Sail alias
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

<li>Generate .env file from .env.decrypted:
php artisan env:decrypt --key={Given Key}

<li>Laravel Sail install
php artisan sail:install

<li>Run Your local server up:
sail up -d

<li>Run Your local server down:
sail down

<li>To Run Unit/Feature Tests but configure your test with xdebug
php artisan test --testsuite={Modules or ModuleName}
</ul>

if you have an issue you can see <a href="https://laravel.com/docs/10.x/sail">Laravel Sail</a>
</pre>

