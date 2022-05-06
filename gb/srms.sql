create table stu_details (roll bigint, course varchar(10), email varchar(50), name varchar(50), password varchar(30));
alter table stu_details ADD PRIMARY KEY(`roll`);
alter table stu_details ADD UNIQUE(roll);
alter table stu_details ADD UNIQUE(email);

create table tch_details (id int NOT NULL, name varchar(30), email varchar(50), password varchar(30), ca varchar(10));
alter table tch_details ADD PRIMARY KEY(id);
alter table tch_details ADD UNIQUE(email);

create table adm_details (id int NOT NULL, name varchar(30), email varchar(50), password varchar(30));
alter table adm_details ADD PRIMARY KEY(id);
alter table adm_details ADD UNIQUE(id);
alter table adm_details ADD UNIQUE(email);

create table subjects (course varchar(10),sem int, sub_code varchar(30),sub_name varchar(256));

create table reset_password (email varchar(50),token varchar(50), `time` bigint(20), `table` varchar(20));

create table bca (roll bigint NOT NULL, sem1 varchar(256), sem2 varchar(256), sem3 varchar(256), sem4 varchar(256), sem5 varchar(256), sem6 varchar(256));
alter table bca ADD PRIMARY KEY(roll);
alter table bca ADD UNIQUE(roll);

create table btechcse (roll bigint NOT NULL, sem1 VARCHAR(256), sem2 VARCHAR(256), sem3 VARCHAR(256), sem4 VARCHAR(256), sem5 VARCHAR(256), sem6 VARCHAR(256), sem7 VARCHAR(256), sem8 VARCHAR(256));
alter table  btechcse ADD PRIMARY KEY(roll);
alter table  btechcse ADD UNIQUE(roll);

insert into tch_details (id, name, email, password, ca) values (200, 'Prof. JB', 'prof-jb@srms.com', 'password', 'bca');
insert into tch_details (id, name, email, password, ca) values (201, 'Prof. KR', 'prof-kr@srms.com', 'password', 'btechcse');

insert into subjects values("bca",1,"BCAN101","Digital Electronics");
insert into subjects values("bca",1,"BCAN102","Environment Studies");
insert into subjects values("bca",1,"BCAN103","C Programming");
insert into subjects values("bca",1,"BMN101","Basic Mathematical Computation");
insert into subjects values("bca",1,"BCAN193","Programming Lab with C");
insert into subjects values("bca",1,"BCAN181","PC Software Lab");
	
insert into subjects values("bca",2,"BCAN201","Computer Architecture");
insert into subjects values("bca",2,"BCAN202","Software Engineering");                  
insert into subjects values("bca",2,"BCAN203","Data Structure with C");  
insert into subjects values("bca",2,"BMN201","01 Advanced Mathematical Computation");  
insert into subjects values("bca",2,"HUN201","English Language and Communication");  
insert into subjects values("bca",2,"BCAN293","Data Structure Lab using C");  
insert into subjects values("bca",2,"HUN291","Business Presentation and Language Lab");
insert into subjects values("bca",3,"BCAN301","Operating Systems");
insert into subjects values("bca",3,"BCANE302A","Object Oriented Programming with C++");
insert into subjects values("bca",3,"BCAN303","Computer Graphics");
insert into subjects values("bca",3,"BMN301","Mathematics for Computing");
insert into subjects values("bca",3,"BCANE392A","Programming Lab with C++");
insert into subjects values("bca",3,"BCAN381","Web Technology Lab");
insert into subjects values("bca",4,"BCAN401","Database Management System"); 		
insert into subjects values("bca",4,"BCAN402","Programming with Java"); 				 
insert into subjects values("bca",4,"BCAN403","Computer Networking"); 				   	
insert into subjects values("bca",4,"BMN401","Numerical Analysis"); 					  
insert into subjects values("bca",4,"BCAN491","Database Lab");					    
insert into subjects values("bca",4,"BCAN492","Programming Lab with Java"); 			
insert into subjects values("bca",4,"BCAN481","Soft Skill Development");
insert into subjects values("bca",5,"BCAN501","Cyber Security"); 		
insert into subjects values("bca",5,"BCAN502","Unix and Shell Programming"); 				 
insert into subjects values("bca",5,"BCAN591","Minor Project"); 					  
insert into subjects values("bca",5,"BCAN592","Linux Lab");					   	
insert into subjects values("bca",5,"BCAN583","Industrial Training");
insert into subjects values("bca",5,"BCAN501","Management and Accounting");
insert into subjects values("bca",6,"HUN601","Values and Ethics of Profession");
insert into subjects values("bca",6,"BCANE601A","Python Programming");
insert into subjects values("bca",6,"BCANE602B","Advanced DBMS");
insert into subjects values("bca",6,"CLC602","Communication Skills");

insert into subjects values("btechcse",3,"ESC301","Analog and Digital Electronics");
insert into subjects values("btechcse",3,"ESC391","Analog and Digital Electronics Practical");


insert into stu_details values (14901219028,'bca','debashis@gmail.com', 'Debashis Das',	   'password');
insert into stu_details values (14901219010,'bca','kunal@gmail.com',    'Kunal Chowdhury', 'password');
insert into stu_details values (14901219007,'btechcse','omprakash@gmail.com','Om Prakash Mahto','password');
	
insert into bca (roll,sem1,sem2,sem3,sem4) values(14901219028,"BCAN101:B:3|BCAN102:A:2|BCAN103:E:4|BMN101:B:3|BCAN193:E:3|BCAN181:E:3",
"BCAN201:O:3|BCAN202:O:4|BCAN203:O:4|BMN201:O:3|HUN201:E:3|BCAN293:O:3|HUN291:O:3","BCAN301:O:4|BCANE302A:E:4|BCAN303:E:3|BMN301:A:3|BCANE392A:O:3|BCAN381:O:3",
"BCAN401:E:4|BCAN402:E:4|BCAN403:E:3|BMN401:E:3|BCAN491:O:3|BCAN492:O:3|BCAN481:O:2");






