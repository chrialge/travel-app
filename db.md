# Entity

## table

name: users

attributes:

-   ID || BIGINT | AI | NOTNULL | UNIQUE | PK | INDEX
-   name || VARCHAR(50) | MIN: 3 | NOTNULL
-   lastname || VARCHAR(50) | MIN: 3 |NOTNULL
-   password|| VARCHAR(50)| MIN: 3 | NOTNULL
-   email|| VARCHAR(100) | NOTNULL

## table

name: travels

attributes:

-   ID || BIGINT | AI | NOTNULL | UNIQUE | PK | INDEX
-   user_id || BIGINT | NOTNULL | FK
-   name || VARCHAR(50) | MIN: 3 | NOTNULL
-   data_start || DATE | NOTNULL
-   date_arrived || DATE | NOTNULL
-   image|| VARCHAR(255) | NULL
-   content|| TEXT | NULL

## table

name: steps

attributes:

-   ID || BIGINT | AI | NOTNULL | UNIQUE | PK | INDEX
-   travel_id || BIGINT | NOTNULL | FK
-   name || VARCHAR(50) | MIN: 3 | NOTNULL
-   date || DATE | NOTNULL
-   time_start || DATE | NOTNULL
-   time_arrived || DATE | NOTNULL
-   image|| VARCHAR(255) | NULL
-   location || VARCHAR(255) || NOTNULL
-   description|| TEXT | NULL

## table

name: notes

attributes:

-   ID || BIGINT | AI | NOTNULL | UNIQUE | PK | INDEX
-   step_id || BIGINT | NOTNULL | FK
-   customer_name || VARCHAR(50) | MIN: 3 | NOTNULL
-   customer_lastname || VARCHAR(50) | MIN: 3 | NOTNULL
-   customer_email || VARCHAR(50) | MIN: 3 | NOTNULL
-   note|| TEXT | NULL

## table

name: vote

attributes:

-   ID || BIGINT | AI | NOTNULL | UNIQUE | PK | INDEX
-   step_id || BIGINT | NOTNULL | FK
-   vote || TINYINT || NOTNULL
