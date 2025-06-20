```sql
CREATE TABLE user (
    id int primary key autoincrement,
    username nvarchar(30) not null,
    pwd nvarchar(255) not null,
    created_at datetime default current_time
);

CREATE TABLE comments (
    id int primary key autoincrement,
    message text not null,
    created_at datetime default current_time,
    user_id int,
    foreign key(user_id) references user (id) on delete cascade
)
```
