# Jobber [PHP + Vue.js]

Jobber is a job listing web application where user can see, search, filter and upload jobs. Created on <strong>Vue 3</strong> and <strong>REST API</strong> coded in <strong>PHP 8+</strong> using <strong>OOP principles</strong>.

<h2>Description</h2>

<ul>
<li>Application has 5 (home, job upload, explore, job view & about) pages. <strong>Vue router</strong> is used to maintain <strong>SPA</strong> while navigating the website.</li>
<li>Job categories are retrieved from the database <strong>instead of hardcoding</strong> them in the front-end. This keeps <strong>Vue code clean, simple and easily maintainable</strong>, avoiding potential trouble in case of having <strong>100+ different job categories.</strong></li>
<li>In order to upload the job, inserted form data has to meet the requirements. In case of providing invalid data, <strong>errors are displayed on the same page without reloading</strong>.</li>
<li>After the form data is validated and new job is successfully saved in the database, the user is redirected to the explore page, <strong>using Vue router</strong>, where they're presented the updated list of jobs</li>
<li>Explore page has 3 <strong>filter options</strong> (job category, job type & salary type). The user is able to apply several filters together, or one at a time.</li>
<li>Search option makes it easier for the user to find what they're looking for. <strong>Search fields</strong> are presented on the home and explore pages.</li>
</ul>

<ul>
<li>The project is hosted at <a href="https://www.000webhost.com/">www.000webhost.com</a> hosting.</li>
<li>Application can be accessed using the following URL: <a href="https://ujobber.000webhostapp.com/">https://ujobber.000webhostapp.com/</a></li>
<ul>
