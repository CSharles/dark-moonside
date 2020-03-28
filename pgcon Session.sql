SELECT * FROM "admon"."vrCourse";
SELECT * FROM "admon"."vrModule";
SELECT * FROM "admon"."vrLink";
Select * FROM "admon"."vrUser";
SELECT id, password FROM admon."vrUser" WHERE username= 'admin$255' OR email='admin$255' AND active=true;

SELECT "Description", "Active" FROM "admon"."vrLink" WHERE "Exam"=true AND "AddedBy"=1;

SELECT "Name", "CourseID", thumbnail FROM client.vrcourse_view;
SELECT "Name", "CourseID", thumbnail FROM client.vrcourse_view Where "CourseID"='CTA';
SELECT * FROM client.get_modules('CTB');
SELECT * FROM client.get_links('MTB101');
SELECT * FROM client.get_exams('MTB101');

SELECT pg_get_serial_sequence('"admon"."vrUser"', 'id');
DELETE FROM "admon"."vrUser" WHERE "id"=1;
ALTER SEQUENCE admon."vrUser_id_seq" RESTART WITH 1;

UPDATE "admon"."vrCourse" SET "Active" = true WHERE "CourseID"='CTA';

SELECT "vrCourse"."CourseID", Count("ModuleID") FROM "admon"."vrCourse" INNER JOIN "admon"."vrModule" ON "vrCourse"."CourseID" = "vrModule"."CourseID"
GROUP BY "vrCourse"."CourseID";

SELECT "vrModule"."ModuleID", Count("URL") FROM "admon"."vrModule" 
INNER JOIN "admon"."vrLink" 
ON "vrModule"."ModuleID" = "vrLink"."ModuleID"
GROUP BY "vrModule"."ModuleID";
SELECT * FROM admon."vrLink" WHERE "Description"= 'link Test D';

INSERT INTO admon."vrLink" VALUES('Exam Test D', 'https//www.examD.org/', 'MTA101', false, true, 1);
INSERT INTO admon."vrLink" ("Description", "URL", "ModuleID", "AddedBy") VALUES('link Test E', 'https//www.example5.org/', 'MTA101', 1);

UPDATE "admon"."vrLink" SET "Exam" =false WHERE "Description"='link Test D';

SELECT "Name", "Active" FROM admon."vrCourse" WHERE "AddedBy"=0;

SELECT "Name", "Active" FROM admon."vrModule" WHERE "AddedBy"=0;