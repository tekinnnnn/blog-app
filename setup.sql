drop schema if exists awesome_blog;

create schema awesome_blog;

use awesome_blog;

create table users
(
    id         serial primary key,
    name       varchar(255) not null,
    email      varchar(255) not null,
    password   varchar(255) not null,
    login_at   timestamp default null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp
);

create table posts
(
    id         serial primary key,
    title      varchar(255)    not null,
    content    text            not null,
    user_id    bigint unsigned not null,
    image_url  text            not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    constraint fk_post_author foreign key (user_id) references users (id)
);

create table comments
(
    id         serial primary key,
    content    text            not null,
    user_id    bigint unsigned not null,
    post_id    bigint unsigned not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    deleted_at timestamp default null on update current_timestamp,
    constraint fk_comment_author foreign key (user_id) references users (id),
    constraint fk_comment_post foreign key (post_id) references posts (id)

);

-- password: 12345
insert into users (name, email, password) values ('John Doe', 'john.doe@email.com', '$2y$10$XjCokIsAGS6tmQOpLo5tFuZxI4u7UFmjLgWtj86i1UsC6SUtHe9rW');

insert into posts (title, content, user_id, image_url) values ('First Post', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 'https://via.placeholder.com/150.png/09f/fff');
insert into posts (title, content, user_id, image_url) values ('Second Post', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 1, 'https://via.placeholder.com/150.png/09f/fff');
insert into posts (title, content, user_id, image_url) values ('Third Post', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.<br/><br/>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 1, 'https://via.placeholder.com/150.png/09f/fff');
insert into posts (title, content, user_id, image_url) values ('Fourth Post', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1, 'https://via.placeholder.com/150.png/09f/fff');

insert into comments (content, user_id, post_id) values ('First Comment', 1, 1);
insert into comments (content, user_id, post_id) values ('Second Comment', 1, 1);
insert into comments (content, user_id, post_id) values ('First Comment of Second Post', 1, 2);
insert into comments (content, user_id, post_id) values ('Second Comment of Second Post', 1, 2);
insert into comments (content, user_id, post_id) values ('Third Comment of Second Post', 1, 2);
insert into comments (content, user_id, post_id) values ('First Comment of Third Post', 1, 3);
insert into comments (content, user_id, post_id) values ('First Comment of Fourth Post', 1, 4);
insert into comments (content, user_id, post_id) values ('Second Comment of Fourth Post', 1, 4);
insert into comments (content, user_id, post_id) values ('Third Comment of Fourth Post', 1, 4);

