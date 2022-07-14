drop schema if exists awesome_blog;

create schema awesome_blog;

use awesome_blog;

create table users
(
    id         serial primary key,
    name       varchar(255) not null,
    email      varchar(255) not null,
    password   varchar(255) not null,
    login_at   timestamp default current_timestamp,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp
);

create table posts
(
    id         serial primary key,
    title      varchar(255) not null,
    content    text not null,
    user_id    bigint unsigned not null,
    image_url  text not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_post_author foreign key (user_id) references users(id)
);

create table comments
(
    id         serial primary key,
    content    text not null,
    user_id    bigint unsigned not null,
    post_id    bigint unsigned not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    deleted_at timestamp default null on update current_timestamp,
    constraint fk_comment_author foreign key (user_id) references users(id),
    constraint fk_comment_post foreign key (post_id) references posts(id)

);