/* 
	GREAT GUIDE FOR SETUP
	https://www.unixsheikh.com/articles/sqlite-the-only-database-you-will-ever-need-in-most-cases.html

	Install script:
	This is run when there is no existing data in the database.
	During install, the old .sqlite file is over written.

	TODO: See the update script to non-destructively modify the tables. 
*/

/* PRAGMA auto_vacuum = FULL; --Prevents the reuse of primary key values after deleting a row */

/* Temporarily disable the following for resetting database - See bottom of the file for re-enabling*/
PRAGMA STRICT = OFF;
PRAGMA foreign_keys = OFF;
PRAGMA ignore_check_constraints = TRUE;

DROP TABLE IF EXISTS foos;
DROP TABLE IF EXISTS bars;

/* 
PRAGMA STRICT = ON;
PRAGMA foreign_keys = ON;
PRAGMA ignore_check_constraints = FALSE;
*/

CREATE TABLE foos (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	title TEXT NOT NULL CHECK(LENGTH(title) <= 255),
	description TEXT CHECK(LENGTH(description) <= 999),
	slug TEXT NOT NULL CHECK(LENGTH(slug) <= 255),
	version INTEGER NOT NULL,
	in_production INTEGER DEFAULT 0 NOT NULL CHECK(in_production <= 1),
	deleted INTEGER DEFAULT 0 NOT NULL CHECK(deleted <= 1)
);

CREATE TABLE bars (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	title TEXT NOT NULL CHECK(LENGTH(title) <= 255),
	course_id INTEGER NOT NULL,
	deleted INTEGER DEFAULT 0 NOT NULL CHECK(deleted <= 1),
	FOREIGN KEY (course_id) REFERENCES foos(id) 
);
