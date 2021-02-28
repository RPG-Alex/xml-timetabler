# xml-timetabler
A simple php framework for inputting meeting/events to an xml file and then reading and updating that file as needed.

Before contributing:

Q: Why do this?

A: This project exists as a means to an end(s) and also as a proof of concept. The overall goal was to develop an application that used xml instead of a database at all.


Q: Why no database?

A: Because I don't think a database is always necessary establishing other means of data storage when the data is semi-fiat (by that I mean its useful for a while then pointless, for scheduling meetings for example), or when you don't plan to use or want another layer (database layer) to your application.


Before Implementing:

Q: What do I need to run this?

A: This application was built in vanilla php and should run on whatever server stack you would run your php on. As there is no database, you can add this app to a directory that it will live at, connect it to your login system or however you wish to implement it, and then get straight to using it!
