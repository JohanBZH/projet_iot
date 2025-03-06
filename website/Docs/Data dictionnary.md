# Data dictionnary

| Table name  | Data_name | Data type | Key | Constraints
| :---------- |:----------|:--------|:---------|:----------|
| App_user  | id_user       |  int | Primary | Unique Not_null Auto_increment |
| App_user  | Login         |  varchar(50) |  | Unique Not_null |
| App_user  | Password      |  varchar(50) |  | Not_null |
| Data  | id_data       |  int | Primary | Unique Not_null Auto_increment |
| Data  | Time_stamp |  datetime |  | Not_null |
| Data  | Temperature      |  Float |  | Default Null |
| Data  | Humidity      |  Float |  | Default Null |
| Consult  | id_user       |  int | Foreign - References App_user (id_user) | Not_null |
| Consult  | id_data       |  int | Foreign - References Data (id_data)| Not_null |