# PunyCMS
The absolute bare minimum Content Management System (CMS).
- [Background](#background)
- [Class Usage](#class-usage)
  - [Declaring The Class](#declaring-the-class)
  - [Dependencies](#dependencies)
- [Primary Methods](#methods)
  - [Add Entry](#add-entry)
  - [Edit Entry](#edit-entry)
  - [Search Entries](#search-entries)
  - [Delete Entry](#delete-entries)

## Background
The goal of this project was to be a "lightweight" CMS class to enable easy content management. It uses Linchpin for it's core database functions.

## Class Usage
### Declaring The Class
Just like any PHP class, declaring it follows the basic structure:
```PHP
$cms = new PunyCMS();
```

### Dependencies
PunyCMS requires the Linchpin PDO wrapper to function properly.


## Primary Methods
These are the functions that perform as the primary workhorse for the class.

### Add Entry
```PHP
add_entry( $category, $title, $content, $author, $created = null );
```
| Argument | Type | Description|
| --- | --- | --- |
| `$category` | string | Category of the content. Used for grouping things together. |
| `$title` | string | Title of the entry. |
| `$content` | string | Content of the entry. |
| `$author` | string | Author of the entry. |
| `$created` | string | Optional date of entry as 'Y-m-d H:I:s'; the default is null and will Auto generate a date |

### Edit Entry
```PHP
edit_entry();
```
| Argument | Type | Description|
| --- | --- | --- |
| `$var` | Type | Description. |

### Search Entries
```PHP
search_entries();
```
| Argument | Type | Description|
| --- | --- | --- |
| `$var` | Type | Description. |

### Delete Entry
```PHP
delete_entry();
```
| Argument | Type | Description|
| --- | --- | --- |
| `$var` | Type | Description. |
