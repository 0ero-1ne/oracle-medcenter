-- ALL SCRIPT WAS CREATED IN DbVisualizer
-- FOR PL/SQL SCRIPTS WHERE ADDED '--/' CHARS BEFORE AND AFTER STATEMENT - JUST FOR CORRECT RUNNING OF SCRIPT

-- PREPARING THE DATABASE TO CREATE THE NECESSARY OBJECTS
-- AT FIRST DROP ALL TABLES WITH THE SAME NAME


-- DROP TABLE PHARMACY
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'PHARMACY';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE PHARMACY';
    END IF;
END;
--/


-- DROP TABLE SUPPLIERS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'SUPPLIERS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE SUPPLIERS';
    END IF;
END;
--/


-- DROP TABLE COMMENTS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'COMMENTS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE COMMENTS';
    END IF;
END;
--/


-- DROP TABLE TREATMENTS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'TREATMENTS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE TREATMENTS';
    END IF;
END;
--/


-- DROP TABLE PRICELIST
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'PRICELIST';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE PRICELIST';
    END IF;
END;
--/


-- DROP TABLE EMPLOYEE_POSITION
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'EMPLOYEE_POSITION';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE EMPLOYEE_POSITION';
    END IF;
END;
--/


-- DROP TABLE POSITIONS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'POSITIONS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE POSITIONS';
    END IF;
END;
--/


-- DROP BRANCH_DEPARTMENT TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'BRANCH_DEPARTMENT';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE BRANCH_DEPARTMENT';
    END IF;
END;
--/


-- DROP BRANCHES TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'BRANCHES';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE BRANCHES';
    END IF;
END;
--/


-- DROP TABLE DEPARTMENTS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'DEPARTMENTS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE DEPARTMENTS';
    END IF;
END;
--/


-- DROP TABLE TALONS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'TALONS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE TALONS';
    END IF;
END;
--/


-- DROP TABLE PATIENTS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'PATIENTS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE PATIENTS';
    END IF;
END;
--/


-- DROP TABLE EMPLOYEES
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'EMPLOYEES';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE EMPLOYEES';
    END IF;
END;
--/


-- DROP PERSON_ADDRESS TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'PERSON_ADDRESS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE PERSON_ADDRESS';
    END IF;
END;
--/


-- DROP PERSONS TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'PERSONS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE PERSONS';
    END IF;
END;
--/


-- DROP ADDRESSES TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'ADDRESSES';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE ADDRESSES';
    END IF;
END;
--/


-- DROP TABLE PASSPORTS
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'PASSPORTS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE PASSPORTS';
    END IF;
END;
--/


-- DROP USERS TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'USERS';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE USERS';
    END IF;
END;
--/


-- DROP ROLES TABLE
--/
DECLARE
    table_exists INTEGER;
BEGIN
	SELECT count(*) INTO table_exists
    FROM dba_tables WHERE table_name = 'ROLES';

    IF (table_exists) <> 0 THEN
        EXECUTE IMMEDIATE 'DROP TABLE ROLES';
    END IF;
END;
--/





-- CREATING THE MINIMUM REQUIRED NUMBER OF DATABASE OBJECTS
-- FIRST OF ALL, OF COURSE, WE NEED TABLES, THAT DESCRIBE OUR ENTITIES


CREATE TABLE ROLES
(
	role_name VARCHAR2(64) PRIMARY KEY
);

INSERT ALL
    INTO ROLES VALUES ('guest')
	INTO ROLES VALUES ('user') -- PATIENT
	INTO ROLES VALUES ('doctor')
	INTO ROLES VALUES ('manager') -- ADMIN
SELECT 1 FROM DUAL;


--/
CREATE OR REPLACE PROCEDURE add_role
(
    X VARCHAR2
)
IS
BEGIN
    INSERT INTO ROLES VALUES(X);  
END;
--/






CREATE TABLE ADDRESSES
(
	id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
	region VARCHAR2(64) NOT NULL,
	town VARCHAR2(64) NOT NULL,
	street VARCHAR2(64) NOT NULL,
	house_number VARCHAR2(10) NOT NULL, -- VARCHAR2 BECAUSE MAY BE NOT ONLY NUMBERS, BUT ANOTHER AS "-, a-z, A-Z" (80B)
	flat VARCHAR2(10) -- VARCHAR2 BECAUSE MAY BE NOT ONLY NUMBERS, BUT ANOTHER AS "-, a-z, A-Z" (301-A)
);


CREATE TABLE PASSPORTS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    passport_number VARCHAR2(64) NOT NULL UNIQUE, -- IDENTIFICATION NUMBER
    date_of_issue DATE NOT NULL,
    date_of_expiry DATE NOT NULL,
    authority VARCHAR2(256) NOT NULL -- THE AUTHORITY THAT ISSUED THE PASSPORT
);

CREATE TABLE USERS
(
	id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
	user_role VARCHAR2(64) NOT NULL,
	email VARCHAR2(256) NOT NULL UNIQUE,
	password VARCHAR2(256) NOT NULL,
	CONSTRAINT FK_USER_ROLE
		FOREIGN KEY (user_role)
		REFERENCES ROLES (role_name)
);

CREATE TABLE PERSONS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    first_name VARCHAR2(64) NOT NULL, -- COLUMN FOR NAME
	second_name VARCHAR2(64) NOT NULL, -- COLUMN FOR SURNAME
	last_name VARCHAR2(64), -- COLUMN FOR PATRONOMYC (USUALLY FOR CIS)
	passport_id INTEGER,
	birth_date DATE NOT NULL,
	gender CHAR(1) NOT NULL,
	CONSTRAINT FK_PATIENT_PASSPORT
	   FOREIGN KEY (passport_id)
	   REFERENCES PASSPORTS(id),
	CONSTRAINT CHK_PATIENT_GENDER CHECK (gender IN ('m','f'))
);

CREATE TABLE PERSON_ADDRESS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    person_id INTEGER NOT NULL,
    address_id INTEGER NOT NULL,
    CONSTRAINT FK_PERSON_ADDRESS_PERSON
        FOREIGN KEY (person_id)
        REFERENCES PERSONS(id),
    CONSTRAINT FK_PERSON_ADDRESS_ADDRESS
        FOREIGN KEY (address_id)
        REFERENCES ADDRESSES(id)
);

CREATE TABLE PATIENTS
(
	id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
	auth_data INTEGER NOT NULL,
	person_id INTEGER NOT NULL,
	phone VARCHAR2(20) NOT NULL,
	CONSTRAINT FK_PATIENT_AUTHDATA
	   FOREIGN KEY (auth_data)
	   REFERENCES USERS(id),
	CONSTRAINT FK_PATIENT_PERSON
	   FOREIGN KEY (person_id)
	   REFERENCES PERSONS(id)
);

CREATE TABLE EMPLOYEES
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    auth_data INTEGER NOT NULL,
    person_id INTEGER NOT NULL,
	hire_date DATE NOT NULL,
	education VARCHAR2(256) NOT NULL,
	phone VARCHAR2(20) NOT NULL,
	salary INTEGER NOT NULL,
	on_vacation CHAR(1) NOT NULL,
	CONSTRAINT FK_EMPLOYEE_AUTHDATA
	   FOREIGN KEY (auth_data)
	   REFERENCES USERS(id),
	CONSTRAINT FK_EMPLOYEE_PERSON
	   FOREIGN KEY (person_id)
	   REFERENCES PERSONS(id),
	CONSTRAINT CHK_EMPLOYEE_ONVACATION CHECK (on_vacation in ('0', '1')) -- 0 - not on vacation, 1 - on vacation
);

CREATE TABLE DEPARTMENTS -- FOR EXAMPLE: DENTAL DEPARTMENT, THERAPEUTIC DEPARTMENT, ETC.
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    department_name VARCHAR2(256) NOT NULL,
    department_manager INTEGER NOT NULL, -- EMPLOYEE ID
    CONSTRAINT FK_DEPARTMENT_EMPLOYEE
        FOREIGN KEY (department_manager)
        REFERENCES EMPLOYEES(id)
);

CREATE TABLE POSITIONS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    position_name VARCHAR2(256),
    department_id INTEGER NOT NULL,
    position_type VARCHAR2(20), -- IN THE MEDICAL DEPARTMENT THERE ARE NOT ONLY DOCTORS, BUT ALSO CLEANERS, PROGRAMMERS, ETC.
    CONSTRAINT CHK_POSITION_TYPE CHECK (position_type IN ('doctor', 'head_doctor', 'programmer', 'cleaner', 'security')),
    CONSTRAINT FK_POSITION_DEPARTMENT
        FOREIGN KEY (department_id)
        REFERENCES DEPARTMENTS(id)
);

CREATE TABLE BRANCHES
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    address_id INTEGER NOT NULL,
    branch_manager INTEGER NOT NULL,
    CONSTRAINT FK_BRANCH_ADDRESS
        FOREIGN KEY (address_id)
        REFERENCES ADDRESSES(id),
    CONSTRAINT FK_BRANCH_MANAGER
        FOREIGN KEY (branch_manager)
        REFERENCES EMPLOYEES(id)
);

CREATE TABLE BRANCH_DEPARTMENT
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    branch_id INTEGER NOT NULL,
    department_id INTEGER NOT NULL,
    CONSTRAINT FK_BRANCH_DEPARTMENT_BRANCH
        FOREIGN KEY (branch_id)
        REFERENCES BRANCHES(id),
    CONSTRAINT FK_BRANCH_DEPARTMENT_DEPARTMENT
        FOREIGN KEY (department_id)
        REFERENCES DEPARTMENTS(id)    
);

CREATE TABLE EMPLOYEE_POSITION
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    employee_id INTEGER NOT NULL,
    position_id INTEGER NOT NULL,
    CONSTRAINT FK_EMPLOYEE_POSITION_EMPLOYEE_ID
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id),
    CONSTRAINT FK_EMPLOYEE_POSITION_POSITION_NAME
        FOREIGN KEY (position_id)
        REFERENCES POSITIONS(id)
);

CREATE TABLE TALONS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    talon_date DATE NOT NULL,
    employee_id INTEGER NOT NULL,
    patient_id INTEGER,
    CONSTRAINT FK_TALON_EMPLOYEE
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id),
    CONSTRAINT FK_TALON_PATIENT
        FOREIGN KEY (patient_id)
        REFERENCES PATIENTS(id)
);

CREATE TABLE SUPPLIERS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    supplier_name VARCHAR2(256) NOT NULL,
    supplier_country VARCHAR2(64) NOT NULL
);

CREATE TABLE PHARMACY
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    drug VARCHAR2(256) NOT NULL,
    price INTEGER NOT NULL,
    stock INTEGER NOT NULL,
    need_recipe CHAR(1) NOT NULL,
    supplier INTEGER NOT NULL,
    CONSTRAINT FK_DRUG_SUPPLIER
        FOREIGN KEY (supplier)
        REFERENCES SUPPLIERS(id),
    CONSTRAINT CHK_NEED_RECIPE CHECK (need_recipe in ('0', '1')) -- 0 - no need in recipe, 1 - need recipe
);

CREATE TABLE PRICELIST
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    position_id INTEGER NOT NULL,
    service VARCHAR2(256) NOT NULL,
    price NUMBER(10, 2) NOT NULL,
    CONSTRAINT FK_PRICELIST_POSITITON
        FOREIGN KEY (position_id)
        REFERENCES POSITIONS(id)
);

CREATE TABLE TREATMENTS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    employee_id INTEGER NOT NULL,
    patient_id INTEGER NOT NULL,
    start_of_tratment DATE NOT NULL,
    end_of_treatment DATE,
    diagnosis VARCHAR2(256) NOT NULL,
    treatment_info VARCHAR2(1024) NOT NULL,
    recommendations VARCHAR2(1024) NOT NULL,
    CONSTRAINT FK_TREATMENTS_EMPLOYEE
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id),
    CONSTRAINT FK_TREATMENTS_PATIENT
        FOREIGN KEY (patient_id)
        REFERENCES PATIENTS(id)    
);

CREATE TABLE COMMENTS
(
    id INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    user_id INTEGER NOT NULL,
    employee_id INTEGER NOT NULL,
    comment_text VARCHAR2(1024) NOT NULL,
    CONSTRAINT FK_COMMENT_USER
        FOREIGN KEY (user_id)
        REFERENCES USERS(id),
    CONSTRAINT FK_COMMENT_EMPLOYEE
        FOREIGN KEY (employee_id)
        REFERENCES EMPLOYEES(id)
);





-- CRUD PROCEDURES FOR EVERY TABLE

-- ADDRESSES PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_address
(
    p_region in ADDRESSES.region%TYPE,
    p_town in ADDRESSES.town%TYPE,
    p_street in ADDRESSES.street%TYPE,
    p_house_number in ADDRESSES.house_number%TYPE,
    p_flat in ADDRESSES.flat%TYPE
)
IS
BEGIN
    INSERT INTO ADDRESSES(region, town, street, house_number, flat)
    VALUES (p_region, p_town, p_street, p_house_number, p_flat);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_address
(
    p_id in ADDRESSES.id%TYPE,
    p_region in ADDRESSES.region%TYPE,
    p_town in ADDRESSES.town%TYPE,
    p_street in ADDRESSES.street%TYPE,
    p_house_number in ADDRESSES.house_number%TYPE,
    p_flat in ADDRESSES.flat%TYPE
)
IS
BEGIN
    UPDATE ADDRESSES
    SET region = (select nvl2(p_region, p_region, (select region from addresses where id = p_id)) from dual),
        town = (select nvl2(p_town, p_town, (select town from addresses where id = p_id)) from dual),
        street = (select nvl2(p_street, p_street, (select street from addresses where id = p_id)) from dual),
        house_number = (select nvl2(p_house_number, p_house_number, (select house_number from addresses where id = p_id)) from dual),
        flat = (select nvl2(p_flat, p_flat, (select flat from addresses where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_address
(
    p_id in ADDRESSES.id%TYPE
)
IS
BEGIN
    DELETE FROM ADDRESSES WHERE id = p_id;
    COMMIT;
END;
--/



-- PASSPORTS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_passport
(
    p_passport_number in PASSPORTS.passport_number%TYPE,
    p_date_of_issue in VARCHAR2,
    p_date_of_expiry in VARCHAR2,
    p_authority in PASSPORTS.authority%TYPE
)
IS 
BEGIN
    INSERT INTO PASSPORTS(passport_number, date_of_issue, date_of_expiry, authority)
    VALUES (p_passport_number, to_date(p_date_of_issue, 'dd.mm.yyyy'), to_date(p_date_of_expiry, 'dd.mm.yyyy'), p_authority);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_passport
(
    p_id in PASSPORTS.id%TYPE,
    p_passport_number in PASSPORTS.passport_number%TYPE,
    p_date_of_issue VARCHAR2,
    p_date_of_expiry VARCHAR2,
    p_authority in PASSPORTS.authority%TYPE
)
IS
BEGIN
    UPDATE PASSPORTS
    SET passport_number = (select nvl2(p_passport_number, p_passport_number, (select passport_number from passports where id = p_id)) from dual),
        date_of_issue = (select nvl2(p_date_of_issue, to_date(p_date_of_issue, 'dd.mm.yyyy'), (select date_of_issue from passports where id = p_id)) from dual),
        date_of_expiry = (select nvl2(p_date_of_expiry, to_date(p_date_of_expiry, 'dd.mm.yyyy'), (select date_of_expiry from passports where id = p_id)) from dual),
        authority = (select nvl2(p_authority, p_authority, (select authority from passports where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_passport
(
    p_id in PASSPORTS.id%TYPE
)
IS
BEGIN
    DELETE FROM PASSPORTS WHERE id = p_id;
    COMMIT;
END;
--/



-- USERS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_user
(
    p_user_role in USERS.user_role%TYPE,
    p_email in USERS.email%TYPE,
    p_password in USERS.password%TYPE
)
IS 
BEGIN
    INSERT INTO USERS(user_role, email, password)
    VALUES (p_user_role, p_email, p_password);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_user
(
    p_id in USERS.id%TYPE,
    p_user_role in USERS.user_role%TYPE,
    p_email in USERS.email%TYPE,
    p_password in USERS.password%TYPE
)
IS
BEGIN
    UPDATE USERS
    SET user_role = (select nvl2(p_user_role, p_user_role, (select user_role from users where id = p_id)) from dual),
        email = (select nvl2(p_email, p_email, (select email from users where id = p_id)) from dual),
        password = (select nvl2(p_password, p_password, (select password from users where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_user
(
    p_id in USERS.id%TYPE
)
IS
BEGIN
    DELETE FROM USERS WHERE id = p_id;
    COMMIT;
END;
--/



-- PERSONS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_person
(
    p_first_name in PERSONS.first_name%TYPE,
    p_second_name in PERSONS.second_name%TYPE,
    p_last_name in PERSONS.last_name%TYPE,
    p_passport_id in PERSONS.passport_id%TYPE,
    p_birth_date VARCHAR2,
    p_gender in PERSONS.gender%TYPE
)
IS 
BEGIN
    INSERT INTO PERSONS(first_name, second_name, last_name, passport_id, birth_date, gender)
    VALUES (p_first_name, p_second_name, p_last_name, p_passport_id, to_date(p_birth_date, 'dd.mm.yyyy'), p_gender);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_person
(
    p_id in PERSONS.id%TYPE,
    p_first_name in PERSONS.first_name%TYPE,
    p_second_name in PERSONS.second_name%TYPE,
    p_last_name in PERSONS.last_name%TYPE,
    p_passport_id in PERSONS.passport_id%TYPE,
    p_birth_date VARCHAR2,
    p_gender in PERSONS.gender%TYPE
)
IS 
BEGIN
    UPDATE PERSONS
    SET first_name = (select nvl2(p_first_name, p_first_name, (select first_name from persons where id = p_id)) from dual),
        second_name = (select nvl2(p_second_name, p_second_name, (select second_name from persons where id = p_id)) from dual),
        last_name = (select nvl2(p_last_name, p_last_name, (select last_name from persons where id = p_id)) from dual),
        passport_id = (select nvl2(p_passport_id, p_passport_id, (select passport_id from persons where id = p_id)) from dual),
        birth_date = (select nvl2(p_birth_date, to_date(p_birth_date, 'dd.mm.yyyy'), (select birth_date from persons where id = p_id)) from dual),
        gender = (select nvl2(p_gender, p_gender, (select gender from persons where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_person
(
    p_id in PERSONS.id%TYPE
)
IS
BEGIN
    DELETE FROM PERSONS WHERE id = p_id;
    COMMIT;
END;
--/



-- PERSON_ADDRESS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_person_address
(
    p_person_id in PERSON_ADDRESS.person_id%TYPE,
    p_address_id in PERSON_ADDRESS.address_id%TYPE
)
IS 
BEGIN
    INSERT INTO PERSON_ADDRESS(person_id, address_id) VALUES (p_person_id, p_address_id);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_person_address
(
    p_id in PERSON_ADDRESS.id%TYPE,
    p_person_id in PERSON_ADDRESS.person_id%TYPE,
    p_address_id in PERSON_ADDRESS.address_id%TYPE
)
IS 
BEGIN
    UPDATE PERSON_ADDRESS
    SET person_id = (select nvl2(p_person_id, p_person_id, (select person_id from person_address where id = p_id)) from dual),
        address_id = (select nvl2(p_address_id, p_address_id, (select address_id from person_address where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_person_address
(
    p_id in PERSON_ADDRESS.id%TYPE
)
IS 
BEGIN
    DELETE FROM PERSON_ADDRESS WHERE id = p_id;
    COMMIT;
END;
--/



-- PATIENTS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_patient
(
    p_auth_data in PATIENTS.auth_data%TYPE,
    p_person_id in PATIENTS.person_id%TYPE,
    p_phone in PATIENTS.phone%TYPE
)
IS 
BEGIN
    INSERT INTO PATIENTS(auth_data, person_id, phone) VALUES (p_auth_data, p_person_id, p_phone);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_patient
(
    p_id in PATIENTS.id%TYPE,
    p_auth_data in PATIENTS.auth_data%TYPE,
    p_person_id in PATIENTS.person_id%TYPE,
    p_phone in PATIENTS.phone%TYPE
)
IS 
BEGIN
    UPDATE PATIENTS
    SET auth_data = (select nvl2(p_auth_data, p_auth_data, (select auth_data from patients where id = p_id)) from dual),
        person_id = (select nvl2(p_person_id, p_person_id, (select person_id from patients where id = p_id)) from dual),
        phone = (select nvl2(p_phone, p_phone, (select phone from patients where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_patient
(
    p_id in PATIENTS.id%TYPE
)
IS 
BEGIN
    DELETE FROM PATIENTS WHERE id = p_id;
    COMMIT;
END;
--/



-- EMPLOYEES PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_employee
(
    p_auth_data in EMPLOYEES.auth_data%TYPE,
    p_person_id in EMPLOYEES.person_id%TYPE,
    p_hire_date in VARCHAR2,
    p_education in EMPLOYEES.education%TYPE,
    p_phone in EMPLOYEES.phone%TYPE,
    p_salary in EMPLOYEES.salary%TYPE,
    p_on_vacation in EMPLOYEES.on_vacation%TYPE
)
IS 
BEGIN
    INSERT INTO EMPLOYEES(auth_data, person_id, hire_date, education, phone, salary, on_vacation)
    VALUES(p_auth_data, p_person_id, to_date(p_hire_date, 'dd.mm.yyyy'), p_education, p_phone, p_salary, p_on_vacation);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_employee
(
    p_id in EMPLOYEES.id%TYPE,
    p_auth_data in EMPLOYEES.auth_data%TYPE,
    p_person_id in EMPLOYEES.person_id%TYPE,
    p_hire_date in VARCHAR2,
    p_education in EMPLOYEES.education%TYPE,
    p_phone in EMPLOYEES.phone%TYPE,
    p_salary in EMPLOYEES.salary%TYPE,
    p_on_vacation in EMPLOYEES.on_vacation%TYPE
)
IS 
BEGIN
    UPDATE EMPLOYEES
    SET auth_data = (select nvl2(p_auth_data, p_auth_data, (select auth_data from employees where id = p_id)) from dual),
        person_id = (select nvl2(p_person_id, p_person_id, (select person_id from employees where id = p_id)) from dual),
        hire_date = (select nvl2(p_hire_date, to_date(p_hire_date, 'dd.mm.yyyy'), (select hire_date from employees where id = p_id)) from dual),
        education = (select nvl2(p_education, p_education, (select education from employees where id = p_id)) from dual),
        phone = (select nvl2(p_phone, p_phone, (select phone from employees where id = p_id)) from dual),
        salary = (select nvl2(p_salary, p_salary, (select salary from employees where id = p_id)) from dual),
        on_vacation = (select nvl2(p_on_vacation, p_on_vacation, (select on_vacation from employees where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_employee
(
    p_id in EMPLOYEES.id%TYPE
)
IS 
BEGIN
    DELETE FROM EMPLOYEES WHERE id = p_id;
    COMMIT;
END;
--/



-- DEPARTMENTS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_department
(
    p_dep_name in DEPARTMENTS.department_name%TYPE,
    p_dep_manager in DEPARTMENTS.department_manager%TYPE
)
IS
BEGIN
    INSERT INTO DEPARTMENTS(department_name, department_manager) VALUES (p_dep_name, p_dep_manager);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_department
(
    p_id in DEPARTMENTS.id%TYPE,
    p_dep_name in DEPARTMENTS.department_name%TYPE,
    p_dep_manager in DEPARTMENTS.department_manager%TYPE
)
IS
BEGIN
    UPDATE DEPARTMENTS
    SET department_name = (select nvl2(p_dep_name, p_dep_name, (select department_name from departments where id = p_id)) from dual),
        department_manager = (select nvl2(p_dep_manager, p_dep_manager, (select department_manager from departments where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_department
(
    p_id in DEPARTMENTS.id%TYPE
)
IS
BEGIN
    DELETE FROM DEPARTMENTS WHERE id = p_id;
    COMMIT;
END;
--/



-- POSITIONS PROCEDURES
--/
CREATE OR REPLACE PROCEDURE create_position
(
    p_pos_name in POSITIONS.position_name%TYPE,
    p_dep_id in POSITIONS.department_id%TYPE,
    p_pos_type in POSITIONS.position_type%TYPE
)
IS
BEGIN
    INSERT INTO POSITIONS(position_name, department_id, position_type)
    VALUES (p_pos_name, p_dep_id, p_pos_type);
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE update_position
(
    p_id in POSITIONS.id%TYPE,
    p_pos_name in POSITIONS.position_name%TYPE,
    p_dep_id in POSITIONS.department_id%TYPE,
    p_pos_type in POSITIONS.position_type%TYPE
)
IS
BEGIN
    UPDATE POSITIONS
    SET position_name = (select nvl2(p_pos_name, p_pos_name, (select position_name from positions where id = p_id)) from dual),
        department_id = (select nvl2(p_dep_id, p_dep_id, (select department_id from positions where id = p_id)) from dual),
        position_type = (select nvl2(p_pos_type, p_pos_type, (select position_type from positions where id = p_id)) from dual)
    WHERE id = p_id;
    COMMIT;
END;
--/

--/
CREATE OR REPLACE PROCEDURE delete_position
(
    p_id in POSITIONS.id%TYPE
)
IS
BEGIN
    DELETE FROM POSITIONS WHERE id = p_id;
    COMMIT;
END;
--/



-- 



