# KirschnBin
50-line Pastebin clone

## Setup
 1. Create MySQL table "entries" with column "id" as A_I Integer and "text" as text
 2. Create MySQL user with access to the table
 3. Insert Credentials into the config.php
 4. Upload to your Webserver
 
## Usage
 - Create Form will be returned if no id value in the URL is supplied
 - When a id value (index.php?id=1) is supplied you will get the Data in this row
 - When you create a new document you will be redirected the page with your data
