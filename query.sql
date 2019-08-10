CREATE TABLE poll_answers(
  id bigint not null auto_increment,
  title varchar(200),
  votes bigint,
  question_id bigint,
  primary key (id),
  foreign key (question_id) references poll_questions (id),
  on delete cascade
)
