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
add_entry();
```
| Argument | Type | Description|
| --- | --- | --- |
| `$var` | Type | Description. |

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
