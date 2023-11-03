<a name="readme-top"></a>

# XML Timetabler

<div align="center">
    <img src="logo.png" alt="Logo" width="80" height="80">
</div>

<details>
    <summary>Contents</summary>
    <ol>
        <li>
            <a href="#introduction">Introduction</a>
        </li>
        <li>
            <a href="#why-do-this">Why Do This?</a>
        </li>
        <li>
            <a href="#why-no-database">Why No Database?</a>
        </li>
        <li>
            <a href="#before-implementing">Before Implementing</a>
        </li>
        <li>
            <a href="#what-do-i-need-to-run-this">What Do I Need to Run This?</a>
        </li>
    </ol>
</details>

## Introduction

Welcome to XML Timetabler, a simple PHP framework for inputting meeting/events to an XML file and then reading and updating that file as needed.

Please note that this project is a means to an end and a proof of concept. The overall goal was to develop an application that uses XML instead of a traditional database.

### Why Do This?

This project exists as a means to an end and also as a proof of concept. The overall goal was to develop an application that used XML instead of a database at all.

### Why No Database?

Because I don't think a database is always necessary when establishing other means of data storage. This is particularly useful for semi-fiat data (useful for a while then pointless) or when you don't plan to use or want another layer (database layer) in your application.

## Before Implementing

### What Do I Need to Run This?

This application was built in vanilla PHP and should run on whatever server stack you would run your PHP on. As there is no database, you can add this app to a directory that it will live at, connect it to your login system, or implement it as needed.

However, you will need a `teacher-list.xml` file in the root directory. The structure is as follows:

```xml
<teachers>
    <teacher id="Teacher.Name" name="Teacher name" />
</teachers>
```
The application, as written, will use the id attribute for URLs and associating teachers with tutorials, and the name attribute for the teachers' actual names.
<p align="center">[<a href="#readme-top">RETURN TO TOP</a>]</p>
