<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<img src="https://img.shields.io/badge/PHP-7.3+-purple" alt="Surveys">
<img src="https://img.shields.io/badge/Laravel_version-8.75-red" alt="Laravel 8.75">
<img src="https://img.shields.io/badge/Database-MySQL-green" alt="Surveys">
<img src="https://img.shields.io/badge/JavaScript-yellow" alt="Surveys">
</p>
<p align="center">
<img src="https://img.shields.io/badge/Project_date-04.2022-blue" alt="Project creation month: 04.2022">
<img src="https://img.shields.io/badge/Subject-Anonymous_surveys-black" alt="Surveys">
</p>

# Project assumptions

## **1. Administrator Panel:**

***a) Adding a New Survey:***
- Ability to define whether a survey is visible to users (published/unpublished status).
- Ability to define a URL Slug under which the survey will be accessible for completion.
- Ability to add any number of questions.
- Ability to delete and edit questions.
- Ability to change the order of questions.
- Answers to questions can be in the form of text or 'Yes/No' type.

***b) Deleting a Survey Template:***
- Deleting a template should also remove all user entries in the deleted survey.

***c) Visible List of Added Surveys with Pagination (Maximum of 10 entries per page):***
- Each entry includes a button that leads to a subpage with a general summary/statistics of the specific survey based on responses from all users. The format and types of statistics are entirely flexible (e.g., the total number of responses, the number of 'Yes' responses to question #1, etc.).

***d) View of the List of Last Completed Entries with Pagination (Maximum of 10 entries per page):***
- While listing, each entry includes a link to modify the survey template, its main name, and the completion date in the format "Day/Month/Year Hour:Minute:Second."
- Ability to delete an entire entry.

## 2. General Issues:

***a) Access to a Survey Only via the Appropriate URL Slug:***
- Access to a specific survey is granted only if the correct URL Slug is known.

***b) General Error Handling (Validation, Anticipating Unexpected User Actions):***
- Comprehensive error handling, including validation and the ability to anticipate unexpected user interactions.


#
### **additional info**

## !! Attention, there are default credentials hard-coded in Seeder and UserFactory !!
ex. default seeded users
```
johndoe@mail.com:password
doejohn@mail.com:password
```
