# Salesdock

## Frontend

Products.php

## Classes

Class for search query are located in **_classes/Searchquery.php**

## Sql

Sql table with data **SQL Table.sql**

## Working

Currently there are 3 record in DB.

![image](https://github.com/deepucec9/Salesdock/blob/main/Pictures/Picture%201.png?raw=true)

User can select Search drop down and select to Product name to search using Product Name or Price.
(Only works if there exist a class/rule) 
By selecting Upload Speed and speed as less than 100 we get the below result.

![image](https://github.com/deepucec9/Salesdock/blob/main/Pictures/Picture%202.png?raw=true)

Only 2 classes added for now
```
Class 1: UploadSpeed
	Rule 1: UploadSpeedlessThan100
	Rule 2: UploadSpeedlessThan100AndFiber
Class 2: DownloadSpeed
	Rule1: DownloadSpeedGreaterThan100
  Rule 2: DownloadSpeedLessThan100
	Rule 3: DownloadSpeedLessThan100AndFiber
```

## Algorithm

System checks for condition for eg:

```
 if speed > 100 then Class AB 
 else if speed  > 100 and technology="fiber" then Class ABC
 ...
```
For any search which is not mentioned in the **searchquery.php** page system will give all the records as result with a echo message “No Search conditions added for selected filters!”
User can sort the list by *ProdutcName/Price* in ascending or descending order.
