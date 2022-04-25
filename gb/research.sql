create table stu_details ( roll bigint, course varchar(10), email varchar(50),  name varchar(50), password varchar(50));
alter table stu_details ADD PRIMARY KEY(`roll`);
alter table stu_details ADD UNIQUE(`roll`);
alter table stu_details ADD UNIQUE(`email`);

insert into stu_details values (14901219028,'bca','debashis@gmail.com','Debashis','password');
insert into stu_details values (14901219010,'bca','kunal@gmail.com','Kunal','password');
insert into stu_details values (14901219007,'bca','omprakash@gmail.com','Om Prakash','password');


create table bca ( roll bigint, sem1 varchar(256), sem2 varchar(256), sem3 varchar(256), sem4 varchar(256), sem5 varchar(256), sem6 varchar(256));
alter table bca ADD UNIQUE(`roll`);
alter table bca ADD PRIMARY KEY(`roll`);

insert into bca (roll,sem1,sem2,sem3,sem4) values(14901219028,"BCAN101:B:3|BCAN102:A:2|BCAN103:E:4|BMN101:B:3|BCAN193:E:3|BCAN181:E:3",
"BCAN201:O:3|BCAN202:O:4|BCAN203:O:4|BMN201:O:3|HUN201:E:3|BCAN293:O:3|HUN291:O:3","BCAN301:O:4|BCANE302A:E:4|BCAN303:E:3|BMN301:A:3|BCANE392A:O:3|BCAN381:O:3",
"BCAN401:E:4|BCAN402:E:4|BCAN403:E:3|BMN401:E:3|BCAN491:O:3|BCAN492:O:3|BCAN481:O:2");


create table subjects (course varchar(10),sem int, sub_code varchar(30),sub_name varchar(256));

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


create table reset_password (email varchar(50), token varchar(50), time bigint(20));