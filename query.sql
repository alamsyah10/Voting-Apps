CREATE TABLE poll_answers(
  id bigint not null auto_increment,
  title varchar(200),
  votes bigint,
  question_id bigint,
  primary key (id),
  foreign key (question_id) references poll_questions (id),
  on delete cascade
)


SELECT distinct lesson.name as Lesson_Name, lecturer.name as Lecturer_Name, count(student.id) as jum from lesson
Inner join lecturer_lesson on lesson.id = lecturer_lesson.id
inner join lecturer on lecturer.id = lecturer_lesson.lecturer_id
inner join lesson_student on lesson_student.lesson_id = lecturer_lesson.lesson_id
inner join student on student.id = lesson_student.student_id
group by Lesson_Name;
