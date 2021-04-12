# Buto-Plugin-DbSchema
Widgets to list tables and fields from a database schema file(s).

## Widget list_field
```
type: widget
data:
  plugin: db/schema
  method: list_field
  data:
    schema:
      - '/plugin/wf/account2/mysql/schema.yml'
```

## Widget list_table
```
type: widget
data:
  plugin: db/schema
  method: list_table
  data:
    schema:
      - '/plugin/wf/account2/mysql/schema.yml'
```
